<?php

namespace App\Http\Controllers;

use App\Models\catalogue\City;
use App\Models\catalogue\JobTitle;
use App\Models\catalogue\MedicalDeduction;
use App\Models\catalogue\State;
use App\Models\JobDeduction;
use App\Models\JobRequest;
use App\Models\JobRequestDetail;
use App\Models\MedicalDeductionRequest;


use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class JobRequestController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->can('read admin job application')) {
            $job_requests = JobRequest::get();
        } else if (auth()->user()->can('read job application')) {
            $user = auth()->user();
            $employer = $user->user_has_employer->first();
            $job_requests = JobRequest::where('employer_id', '=', $employer->id)->get();
        }


        return view('job_request.index', ['job_requests' => $job_requests]);
    }

    public function create()
    {
        $job_titles = JobTitle::get();
        $states = State::get();
        return view('job_request.create', ['job_titles' => $job_titles, 'states' => $states]);
    }

    public function store(Request $request)
    {
        $user =  auth()->user();
        $employer = $user->user_has_employer->first();
        $time = Carbon::now('America/El_Salvador');

        $job = new JobRequest();
        $job->employer_id = $employer->id;
        $job->start_date = $request->get('start_date');
        $job->end_date = $request->get('end_date');
        $job->need_h2b_workers = $request->get('need_h2b_workers');
        if ($request->get('need_h2b_workers') == 1)
            $job->explain_multiple_employment = $request->get('explain_multiple_employment');
        else {
            $job->explain_multiple_employment = "";
        }
        $job->paid  = $request->get('workers_paid');
        $job->is_uniform_required  = $request->get('is_uniform_required');
        if ($request->get('is_uniform_required') == 1)
            $job->uniform_pieces_required = $request->get('uniform_pieces_required');
        else {
            $job->uniform_pieces_required = "";
        }
        $job->job_notes = $request->get('job_notes');
        $job->user_id = auth()->user()->id;
        $job->created_at = $time;
        $job->save();

        Alert::success('Ok', 'Record saved');
        return redirect('job_request/' . $job->id . '/edit');
    }

    public function get_div_deductions(Request $request)
    {
        return view('job_request.div_deductions', ["Housing"=>$request->get('Housing'),"Medical"=>$request->get('Medical'),"DailyTransportation"=>$request->get('DailyTransportation'),
        "Other"=>$request->get('Other'),"Meals"=>$request->get('Meals'),"NoDeductions"=>$request->get('NoDeductions'),"request_id"=>$request->get('request_id'),
        "medical_deductions" => MedicalDeduction::get()]);
    }

    public function get_div_deductions_medical(Request $request)
    {
        return view('job_request.div_deductions_medical', ["ChkMedical"=>$request->get('ChkMedical'),"ChkDental"=>$request->get('ChkDental'),
        "ChkVision"=>$request->get('ChkVision'),"ChkOther"=>$request->get('ChkOther')]);
    }


    public function edit($id)
    {
        $job_request = JobRequest::findOrFail($id);
        $deduction = JobDeduction::where('request_id','=',$job_request->id)->first();

        //dd($deduction);

        $deduction_medical = MedicalDeductionRequest::where('request_deduction_id','=',$deduction->id)->where('catalog_medical_deduction_id','=','1')->first();
        $deduction_dental = MedicalDeductionRequest::where('request_deduction_id','=',$deduction->id)->where('catalog_medical_deduction_id','=','2')->first();
        $deduction_vision = MedicalDeductionRequest::where('request_deduction_id','=',$deduction->id)->where('catalog_medical_deduction_id','=','3')->first();
        $deduction_other = MedicalDeductionRequest::where('request_deduction_id','=',$deduction->id)->where('catalog_medical_deduction_id','=','4')->first();

        //dd($deduction_medical);
        //dd($deduction);
        //dd($job_request);

        $job_titles = JobTitle::get();
        $details = JobRequestDetail::where('request_id', '=', $id)->get();
        return view('job_request.edit', ['job_request' => $job_request, 'job_titles' => $job_titles, 'details' => $details,
                    'deduction' => $deduction, 'deduction_medical' => $deduction_medical, 'deduction_dental' => $deduction_dental, 'deduction_vision' => $deduction_vision,
                    'deduction_other' => $deduction_other]);
    }

    public function update(Request $request, $id)
    {


        // $job_application = JobRequest::findOrFail($id);

        // $imageBase64 = str_replace("data:image/png;base64", "", $request->get('sign'));

        // $uniqid = $id . ".png";
        // $ruteOut =  (public_path("sign/") . $uniqid);
        // $imageBinary = base64_decode($imageBase64);
        // $bytes = file_put_contents($ruteOut, $imageBinary);

        // $job_application->signature = $uniqid;
        // $job_application->update();
        Alert::info('', 'Record saved');
        return redirect('job_request/' . $id . '/edit');

    }


    public function job_request_deductions(Request $request)
    {

        //dd("hola uno");
        //dd($request->get('request_id'));
        //dd("hola dos");

        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();

        //dd($deduction);

        //dd($request->get('Housing'));
        //dd($request->get('Medical'));
        //dd($request->get('DailyTransportation'));
        //dd($request->get('Other'));
        //dd($request->get('Meals'));
        //dd($request->get('NoDeductions'));

        //dd("fdfdf");
        //dd($request->get('Housing'));

        if($request->get('Housing')=='on' || $request->get('Medical')=='on' || $request->get('DailyTransportation')=='on' || $request->get('Other')=='on' || $request->get('Meals')=='on' || $request->get('NoDeductions')=='on'){

            //dd($deduction);

            if($deduction)
            {
                //EDITANDO DEDUCCIONES



                $job_request = JobRequest::findOrFail($request->get('request_id'));



                //dd($request->get('Housing'));

                //Housing
                if($request->get('Housing')=='on')
                {
                    $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                    $deduction->housing_utilities = 1;
                    $deduction->explain_housing_utilities = $request->get('explain_housing_utilities');

                    if ($request->get('is_deposit_required') == 1) {
                        $deduction->is_deposit_required = 1;
                        $deduction->deposit_amount = $request->get('deposit_amount');
                        $deduction->is_deposit_refundable = $request->get('is_deposit_refundable');
                    }else{
                        $deduction->is_deposit_required = 0;
                        $deduction->deposit_amount = null;
                        $deduction->is_deposit_refundable = null;
                    }

                    $deduction->housing_notes = $request->get('housing_notes');
                    $deduction->housing_includes_utilities = $request->get('housing_utilities');
                }
                else{
                    $deduction->deduction_housing_amount_person_week = null;
                    $deduction->housing_utilities = 0;
                    $deduction->explain_housing_utilities = null;
                    $deduction->is_deposit_required = 0;
                    $deduction->deposit_amount = null;
                    $deduction->is_deposit_refundable = null;
                    $deduction->housing_notes = null;
                    $deduction->housing_includes_utilities = null;
                }





                //Medical
                if($request->get('Medical')=='on')
                {
                    $deduction->medical = 1;
                }else{
                    $deduction->medical = 0;
                }



                //DailyTransportation
                if($request->get('DailyTransportation')=='on')
                {
                    $deduction->daily_transportation = 1;
                    $deduction->deduction_daily_amount_person_week = $request->get('deduction_daily_amount_person_week');
                    $deduction->daily_notes = $request->get('daily_notes');
                }else{
                    $deduction->daily_transportation = 0;
                    $deduction->deduction_daily_amount_person_week = null;
                    $deduction->daily_notes = null;
                }


                //Other Deductions
                if($request->get('Other')=='on')
                {
                    $deduction->other = 1;
                    $deduction->other_deductions = $request->get('other_deductions');
                }else{
                    $deduction->other = 0;
                    $deduction->other_deductions = null;
                }



                //Meals
                if($request->get('Meals')=='on')
                {
                    $deduction->meals = 1;
                    $deduction->how_many_meals_provided = $request->get('how_many_meals_provided');
                    $deduction->cost_per_meal = $request->get('cost_per_meal');
                    $deduction->meals_notes = $request->get('meals_notes');
                    $deduction->is_there_cost_per_meal = $request->get('is_there_costo_per_meal');

                    $deduction->deduction_amount_per_meal = $request->get('deduction_amount_per_meal');
                }else{
                    $deduction->meals = 0;
                    $deduction->how_many_meals_provided = null;
                    $deduction->cost_per_meal = null;
                    $deduction->meals_notes = null;
                    $deduction->is_there_cost_per_meal = 0;
                    $deduction->deduction_amount_per_meal = null;
                }

                //dd($request->get('NoDeductions'));

                //No Deductions
                if($request->get('NoDeductions')=='on')
                {
                    $deduction->no_deduction = 1;
                }else{
                    $deduction->no_deduction = 0;
                }


                $deduction->save();








                //Medical
                if($request->get('Medical')=='on')
                {

                    //dd($job_request->employer_id);
                    //$medical_ded_req = MedicalDeductionRequest::findOrFail($request->get('request_id'));

                    $medical_ded_req = MedicalDeductionRequest::where('employer_id','=',$job_request->employer_id)->get();

                    foreach($medical_ded_req as $mdr){
                        $mdr_del = MedicalDeductionRequest::findOrFail($mdr->id);
                        $mdr_del->delete();
                    }


                    //dd($medical_ded_req);

                    //$medical_ded_req->delete();

                    //dd("existe deductions");

                    if ($request->get('ChkMedical')=='on'){
                        $deduction->deduction_medical_paycheck = 1;


                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_medical_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 1;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_medical_paycheck');
                        $mdr->save();
                    }else{
                        $deduction->deduction_medical_paycheck = 0;
                    }


                    if ($request->get('ChkDental')=='on'){
                        $deduction->deduction_dental_paycheck = 1;

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_dental_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 2;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_dental_paycheck');
                        $mdr->save();
                    }else{
                        $deduction->deduction_dental_paycheck = 0;
                    }


                    if ($request->get('ChkVision')=='on'){
                        $deduction->deduction_vision_paycheck = 1;

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_vision_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 3;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_vision_paycheck');
                        $mdr->save();
                    }else{
                        $deduction->deduction_vision_paycheck = 0;
                    }


                    if ($request->get('ChkOther')=='on'){
                        $deduction->deduction_other_paycheck = 1;

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_other_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 4;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_other_paycheck');
                        $mdr->save();
                    }else{
                        $deduction->deduction_other_paycheck = 0;
                    }

                    $deduction->save();

                }else{
                    $deduction->medical = 0;
                    $medical_ded_req = MedicalDeductionRequest::where('employer_id','=',$job_request->employer_id)->get();

                    foreach($medical_ded_req as $mdr){
                        $mdr_del = MedicalDeductionRequest::findOrFail($mdr->id);
                        $mdr_del->delete();
                    }
                }


                //dd($job_request->id);

                Alert::success('Ok', 'Record saved');
                return redirect('job_request/' .$job_request->id. '/edit');






            }
            else{
                //CREANDO NUEVAS DEDUCCIONES

                //dd("hola dos");
                $job_request = JobRequest::findOrFail($request->get('request_id'));

                //Housing
                $deduction = new JobDeduction();
                $deduction->request_id = $request->get('request_id');
                $deduction->employer_id = $job_request->employer_id;

                //dd("hola tres");
                //dd($request->get('Housing'));
                if($request->get('Housing')=='on')
                {
                    $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                    $deduction->housing_utilities = $request->get('housing_utilities');
                    $deduction->explain_housing_utilities = $request->get('explain_housing_utilities');
                    //$deduction->is_deposit_required = $request->get('is_deposit_required');

                    if ($request->get('is_deposit_required') == 1) {
                        $deduction->is_deposit_required = 1;
                        $deduction->deposit_amount = $request->get('deposit_amount');
                        $deduction->is_deposit_refundable = $request->get('is_deposit_refundable');
                    }else{
                        $deduction->is_deposit_required = 0;
                        $deduction->deposit_amount = null;
                        $deduction->is_deposit_refundable = null;
                    }

                    $deduction->housing_notes = $request->get('housing_notes');
                    $deduction->housing_includes_utilities = $request->get('housing_utilities');
                }
                else{
                    $deduction->deduction_housing_amount_person_week = null;
                    $deduction->housing_utilities = 0;
                    $deduction->explain_housing_utilities = null;
                    $deduction->is_deposit_required = 0;
                    $deduction->deposit_amount = null;
                    $deduction->is_deposit_refundable = null;
                    $deduction->housing_notes = null;
                    $deduction->housing_includes_utilities = null;
                }


                //Medical
                if($request->get('Medical')=='on')
                {
                    $deduction->medical = 1;
                }else{
                    $deduction->medical = 0;
                }


                //DailyTransportation
                if($request->get('DailyTransportation')=='on')
                {
                    $deduction->daily_transportation = 1;
                    $deduction->deduction_daily_amount_person_week = $request->get('deduction_daily_amount_person_week');
                    $deduction->daily_notes = $request->get('daily_notes');
                }else{
                    $deduction->daily_transportation = 0;
                    $deduction->deduction_daily_amount_person_week = null;
                    $deduction->daily_notes = null;
                }

                //Other Deductions
                if($request->get('Other')=='on')
                {
                    $deduction->other = 1;
                    $deduction->other_deductions = $request->get('other_deductions');
                }else{
                    $deduction->other = 0;
                    $deduction->other_deductions = null;
                }

                //Meals
                if($request->get('Meals')=='on')
                {
                    $deduction->meals = 1;
                    $deduction->how_many_meals_provided = $request->get('how_many_meals_provided');
                    $deduction->cost_per_meal = $request->get('cost_per_meal');
                    $deduction->meals_notes = $request->get('meals_notes');
                    $deduction->is_there_cost_per_meal = $request->get('is_there_costo_per_meal');

                    $deduction->deduction_amount_per_meal = $request->get('deduction_amount_per_meal');
                }else{
                    $deduction->meals = 0;
                    $deduction->how_many_meals_provided = null;
                    $deduction->cost_per_meal = null;
                    $deduction->meals_notes = null;
                    $deduction->is_there_cost_per_meal = 0;
                    $deduction->deduction_amount_per_meal = null;
                }


                //No Deductions
                if($request->get('NoDeductions')=='on')
                {
                    $deduction->no_deduction = 1;
                }else{
                    $deduction->no_deduction = 0;
                }

                $deduction->save();




                //Medical
                if($request->get('Medical')=='on')
                {
                    if ($request->get('ChkMedical')=='on'){
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_medical_paycheck = 1;
                        $deduction->save();

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_medical_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 1;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_medical_paycheck');
                        $mdr->save();
                    }else{
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_medical_paycheck = 0;
                        $deduction->save();
                    }


                    if ($request->get('ChkDental')=='on'){
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_dental_paycheck = 1;
                        $deduction->save();


                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_dental_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 2;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_dental_paycheck');
                        $mdr->save();
                    }else{
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_dental_paycheck = 0;
                        $deduction->save();
                    }


                    if ($request->get('ChkVision')=='on'){
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_vision_paycheck = 1;
                        $deduction->save();

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_vision_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 3;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_vision_paycheck');
                        $mdr->save();
                    }else{
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_vision_paycheck = 0;
                        $deduction->save();
                    }


                    if ($request->get('ChkOther')=='on'){
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_other_paycheck = 1;
                        $deduction->save();

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_other_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 4;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_other_paycheck');
                        $mdr->save();
                    }else{
                        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
                        $deduction->deduction_other_paycheck = 0;
                        $deduction->save();
                    }

                }

                }




                //     $deduction->daily_notes = $request->get('daily_notes');
                // }
                // else{
                //     $deduction->deduction_daily_amount_person_week = null;
                //     $deduction->daily_notes = null;
                // }

                // if($request->get('other_deductions'))
                // {
                //     $deduction->other_deductions = $request->get('other_deductions');
                // }
                // else{
                //     $deduction->other_deductions = null;
                // }

                Alert::success('Ok', 'Record saved');
                return redirect('job_request/' . $request->get('job_request_id'). '/edit');


            }else{
                //dd("No he seleccionado ningun cheque");

                $deduction->deduction_housing_amount_person_week = null;
                $deduction->housing_utilities = 0;
                $deduction->explain_housing_utilities = null;
                $deduction->is_deposit_required = null;
                $deduction->deposit_amount = null;
                $deduction->is_deposit_refundable = null;
                $deduction->housing_notes = null;
                $deduction->housing_includes_utilities = null;



                $job_request = JobRequest::findOrFail($request->get('request_id'));

                $deduction->medical = 0;
                $medical_ded_req = MedicalDeductionRequest::where('employer_id','=',$job_request->employer_id)->get();

                foreach($medical_ded_req as $mdr){
                    $mdr_del = MedicalDeductionRequest::findOrFail($mdr->id);
                    $mdr_del->delete();
                }

                $deduction->deduction_medical_paycheck = 0;
                $deduction->deduction_dental_paycheck = 0;
                $deduction->deduction_vision_paycheck = 0;
                $deduction->deduction_other_paycheck = 0;



                $deduction->daily_transportation = 0;
                $deduction->deduction_daily_amount_person_week = null;
                $deduction->daily_notes = null;

                $deduction->other = 0;
                $deduction->other_deductions = null;

                $deduction->meals = 0;
                $deduction->how_many_meals_provided = null;
                $deduction->cost_per_meal = null;
                $deduction->meals_notes = null;
                $deduction->is_there_cost_per_meal = null;
                $deduction->deduction_amount_per_meal = null;

                $deduction->no_deduction = 0;

                $deduction->save();

                Alert::success('Ok', 'Record saved');
                return redirect('job_request/' . $request->get('request_id') . '/edit');


            }




    }















    public function destroy($id)
    {
        //
    }
}
