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

        //dd($job_request);

        $job_titles = JobTitle::get();
        $details = JobRequestDetail::where('request_id', '=', $id)->get();
        return view('job_request.edit', ['job_request' => $job_request, 'job_titles' => $job_titles, 'details' => $details]);
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





        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();


        //dd($request->get('Housing'));
        //dd($request->get('Medical'));
        //dd($request->get('DailyTransportation'));
        //dd($request->get('Other'));
        //dd($request->get('Meals'));
        //dd($request->get('NoDeductions'));

        //dd("fdfdf");
        //dd($request->get('Housing'));

        if($request->get('Housing')=='on' || $request->get('Medical')=='on' || $request->get('DailyTransportation')=='on' || $request->get('Other')=='on' || $request->get('Meals')=='on' || $request->get('NoDeductions')=='on'){

            if($deduction)
            {
                $job_request = JobRequest::findOrFail($request->get('request_id'));

                //Housing
                if($request->get('deduction_housing_amount_person_week'))
                {
                    $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                    $deduction->housing_utilities = $request->get('housing_utilities');
                    $deduction->explain_housing_utilities = $request->get('explain_housing_utilities');
                    $deduction->is_deposit_required = $request->get('is_deposit_required');

                    if ($request->get('is_deposit_required') == 1) {
                        $deduction->deposit_amount = $request->get('deposit_amount');
                        $deduction->is_deposit_refundable = $request->get('is_deposit_refundable');
                    }else{
                        $deduction->deposit_amount = null;
                        $deduction->is_deposit_refundable = null;
                    }

                    $deduction->housing_notes = $request->get('housing_notes');
                    $deduction->housing_includes_utilities = $request->get('housing_includes_utilities');
                }
                else{
                    $deduction->deduction_housing_amount_person_week = null;
                    $deduction->housing_utilities = null;
                    $deduction->explain_housing_utilities = null;
                    $deduction->is_deposit_required = null;
                    $deduction->deposit_amount = null;
                    $deduction->is_deposit_refundable = null;
                    $deduction->housing_notes = null;
                    $deduction->housing_includes_utilities = null;
                }

            }
            else{
                $job_request = JobRequest::findOrFail($request->get('request_id'));

                //Housing
                $deduction = new JobDeduction();
                $deduction->request_id = $request->get('request_id');
                $deduction->employer_id = $job_request->employer_id;

                if($request->get('deduction_housing_amount_person_week'))
                {
                    $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                    $deduction->housing_utilities = $request->get('housing_utilities');
                    $deduction->explain_housing_utilities = $request->get('explain_housing_utilities');
                    $deduction->is_deposit_required = $request->get('is_deposit_required');

                    if ($request->get('is_deposit_required') == 1) {
                        $deduction->deposit_amount = $request->get('deposit_amount');
                        $deduction->is_deposit_refundable = $request->get('is_deposit_refundable');
                    }else{
                        $deduction->deposit_amount = null;
                        $deduction->is_deposit_refundable = null;
                    }

                    $deduction->housing_notes = $request->get('housing_notes');
                    $deduction->housing_includes_utilities = $request->get('housing_includes_utilities');
                }
                else{
                    $deduction->deduction_housing_amount_person_week = null;
                    $deduction->housing_utilities = null;
                    $deduction->explain_housing_utilities = null;
                    $deduction->is_deposit_required = null;
                    $deduction->deposit_amount = null;
                    $deduction->is_deposit_refundable = null;
                    $deduction->housing_notes = null;
                    $deduction->housing_includes_utilities = null;
                }


                //Medical



                if($request->get('deduction_daily_amount_person_week'))
                {
                    $deduction->deduction_daily_amount_person_week = $request->get('deduction_daily_amount_person_week');
                    $deduction->daily_notes = $request->get('daily_notes');
                }
                else{
                    $deduction->deduction_daily_amount_person_week = null;
                    $deduction->daily_notes = null;
                }

                if($request->get('other_deductions'))
                {
                    $deduction->other_deductions = $request->get('other_deductions');
                }
                else{
                    $deduction->other_deductions = null;
                }

                $deduction->save();
            }




            $cuenta = MedicalDeductionRequest::where('employer_id', '=', $job_request->employer_id)
                                                ->where('request_deduction_id', '=', $deduction->id)->get()->count();


            //$cd = MedicalDeductionRequest::find($id_detalle);





              //Medical
              if($request->get('deduction_medical_paycheck')){
                $deduction->medical = 1;
                $user =  auth()->user();
               // $employer = $user->user_has_employer->first();

                $mdr = new MedicalDeductionRequest();
                $mdr->comments = $request->get('deduction_medical_note');
                $mdr->request_deduction_id = $deduction->id;
                $mdr->catalog_medical_deduction_id = 1; //Medical
                $mdr->employer_id = $job_request->employer_id;
                $mdr->deduction_ammount = $request->get('deduction_medical_paycheck');
                $mdr->save();
            }

            //Dental
            if($request->get('deduction_dental_paycheck')){
                $deduction->dental = 1;
                $user =  auth()->user();
                //$employer = $user->user_has_employer->first();

                $mdr = new MedicalDeductionRequest();
                $mdr->comments = $request->get('deduction_dental_note');
                $mdr->request_deduction_id = $deduction->id;
                $mdr->catalog_medical_deduction_id = 2; //Dental
                $mdr->employer_id = $job_request->employer_id;
                $mdr->deduction_ammount = $request->get('deduction_dental_paycheck');
                $mdr->save();
            }

            //Vision
            if($request->get('deduction_vision_paycheck')){
                $deduction->vision = 1;
                $user =  auth()->user();
                //$employer = $user->user_has_employer->first();

                $mdr = new MedicalDeductionRequest();
                $mdr->comments = $request->get('deduction_vision_note');
                $mdr->request_deduction_id = $deduction->id;
                $mdr->catalog_medical_deduction_id = 3; //Vision
                $mdr->employer_id = $job_request->employer_id;
                $mdr->deduction_ammount = $request->get('deduction_vision_paycheck');
                $mdr->save();
            }

            //Other
            if($request->get('deduction_other_paycheck')){
                $deduction->other = 1;
                $user =  auth()->user();
                //$employer = $user->user_has_employer->first();

                $mdr = new MedicalDeductionRequest();
                $mdr->comments = $request->get('deduction_other_note');
                $mdr->request_deduction_id = $deduction->id;
                $mdr->catalog_medical_deduction_id = 4; //Other
                $mdr->employer_id = $job_request->employer_id;
                $mdr->deduction_ammount = $request->get('deduction_other_paycheck');
                $mdr->save();
            }



        }else{
            Alert::info('', 'OK without ckeck');

        }








        // Alert::success('Ok', 'Record saved');
        // return redirect('job_request/' . $request->get('job_request_id'). '/edit');
        return back();

    }

    public function destroy($id)
    {
        //
    }
}
