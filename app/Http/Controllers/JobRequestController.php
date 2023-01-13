<?php

namespace App\Http\Controllers;

use App\Models\catalogue\DegreeCode;
use App\Models\catalogue\JobTitle;
use App\Models\catalogue\MedicalDeduction;
use App\Models\catalogue\State;
use App\Models\catalogue\TypeRepresentation;
use App\Models\catalogue\CityZip;

use App\Models\EmployerWorksite;
use App\Models\JobDeduction;
use App\Models\JobRequest;
use App\Models\JobRequestDetail;
use App\Models\MedicalDeductionRequest;
use App\Models\SpecialSkillJobRequest;
use App\Models\BackgroundCheck;
use App\Models\EmployerTransportation;
use App\Models\EmployerRepresentative;


use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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

        session_start();
        session(['tab_request' => '2']);

        Alert::success('Ok', 'Record saved');
        return redirect('job_request/' . $job->id . '/edit');
    }

    public function get_div_deductions(Request $request)
    {
        return view('job_request.div_deductions', [
            "Housing" => $request->get('Housing'), "Medical" => $request->get('Medical'), "DailyTransportation" => $request->get('DailyTransportation'),
            "Other" => $request->get('Other'), "Meals" => $request->get('Meals'), "NoDeductions" => $request->get('NoDeductions'), "request_id" => $request->get('request_id'),
            "medical_deductions" => MedicalDeduction::get()
        ]);
    }

    public function get_div_deductions_medical(Request $request)
    {
        return view('job_request.div_deductions_medical', [
            "ChkMedical" => $request->get('ChkMedical'), "ChkDental" => $request->get('ChkDental'),
            "ChkVision" => $request->get('ChkVision'), "ChkOther" => $request->get('ChkOther')
        ]);
    }


    public function edit($id)
    {
        $job_request = JobRequest::findOrFail($id);
        $deduction = JobDeduction::where('request_id', '=', $job_request->id)->first();

        //dd($deduction);

        if ($deduction) {
            $deduction_medical = MedicalDeductionRequest::where('request_deduction_id', '=', $deduction->id)->where('catalog_medical_deduction_id', '=', '1')->first();
            $deduction_dental = MedicalDeductionRequest::where('request_deduction_id', '=', $deduction->id)->where('catalog_medical_deduction_id', '=', '2')->first();
            $deduction_vision = MedicalDeductionRequest::where('request_deduction_id', '=', $deduction->id)->where('catalog_medical_deduction_id', '=', '3')->first();
            $deduction_other = MedicalDeductionRequest::where('request_deduction_id', '=', $deduction->id)->where('catalog_medical_deduction_id', '=', '4')->first();

        } else {
            $deduction_medical = null;
            $deduction_dental = null;
            $deduction_vision = null;
            $deduction_other = null;
        }




        $bgcheck_reg = BackgroundCheck::where('request_id','=',$job_request->id)->where('employer_id','=',$job_request->employer_id)->first();

        $employer_transportation = EmployerTransportation::where('request_id','=',$job_request->id)->where('employer_id','=',$job_request->employer_id)->first();

        if($job_request->employer_representative_id)
        {
            $employer_representative = EmployerRepresentative::findOrFail($job_request->employer_representative_id);
        }
        else{
            $employer_representative = null;
        }




        //dd($employer_representative);

        $types_representation = TypeRepresentation::where('status','=','ACT')->get();



        $states = State::select('id', 'cs_state as name')->get();

        if ($employer_representative) {
            $ZipCode = CityZip::findOrFail($employer_representative->er_county_id);
            $counties = CityZip::where('czc_state', '=', $ZipCode->czc_state)->select('id', 'czc_county as name')->groupBy('czc_county')->get();
            $cities = CityZip::select('id', 'czc_city as name')->where('czc_state', '=', $ZipCode->czc_state)->where('czc_county', '=', $ZipCode->czc_county)->groupBy('czc_city')->get();
            $codes_zip = CityZip::where('czc_state', '=', $ZipCode->czc_state)->where('czc_county', '=', $ZipCode->czc_county)->where('czc_city', '=', $ZipCode->czc_city)->groupBy('czc_zipcode')->get();

        }
        else{
            $counties = null;
            $cities = null;
            $codes_zip = null;

        }

        //dd($codes_zip);

       /* if ($employer->principal_state_id != null) {

            $ZipCode = CityZip::findOrFail($employer->principal_county_id);
            $counties_mailing = CityZip::where('czc_state', '=', $ZipCode->czc_state)->select('id', 'czc_county as name')->groupBy('czc_county')->get();
            $cities_mailing = CityZip::select('id', 'czc_city as name')->where('czc_state', '=', $ZipCode->czc_state)->where('czc_county', '=', $ZipCode->czc_county)->groupBy('czc_city')->get();
            $codes_zip_mailing = CityZip::where('czc_state', '=', $ZipCode->czc_state)->where('czc_county', '=', $ZipCode->czc_county)->where('czc_city', '=', $ZipCode->czc_city)->groupBy('czc_zipcode')->get();

        } else {
            $counties_mailing = null;
            $cities_mailing = null;
            $codes_zip_mailing = null;
        }*/

        //dd($employer);


        //dd($bgcheck_reg);

        //dd($deduction_medical);
        //dd($deduction);
        //dd($job_request);

        //dd($counties);

        $job_titles = JobTitle::get();
        $details = JobRequestDetail::where('request_id', '=', $id)->get();
        $degree_codes = DegreeCode::get();
        return view('job_request.edit', ['job_request' => $job_request, 'job_titles' => $job_titles, 'details' => $details, 'degree_codes' => $degree_codes,
                    'deduction' => $deduction, 'deduction_medical' => $deduction_medical, 'deduction_dental' => $deduction_dental, 'deduction_vision' => $deduction_vision,
                    'deduction_other' => $deduction_other, 'bgcheck_reg' => $bgcheck_reg, 'employer_transportation' => $employer_transportation, 'types_representation' => $types_representation,
                    'states' => $states, 'counties' => $counties, 'cities' => $cities,
                    'codes_zip' => $codes_zip, 'employer_representative' => $employer_representative]);

    }

    public function update(Request $request, $id)
    {


         $job = JobRequest::findOrFail($id);

       // $job->employer_id = $employer->id;
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
        $job->update();

        session_start();
        session(['tab_request' => '2']);
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

        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();

        //dd($deduction);

        //dd($request->get('Housing'));
        //dd($request->get('Medical'));
        //dd($request->get('DailyTransportation'));
        //dd($request->get('Other'));
        //dd($request->get('Meals'));
        //dd($request->get('NoDeductions'));

        //dd("fdfdf");
        //dd($request->get('Housing'));

        if ($request->get('Housing') == 'on' || $request->get('Medical') == 'on' || $request->get('DailyTransportation') == 'on' || $request->get('Other') == 'on' || $request->get('Meals') == 'on' || $request->get('NoDeductions') == 'on') {

            //dd($deduction);

            if ($deduction) {
                //EDITANDO DEDUCCIONES



                $job_request = JobRequest::findOrFail($request->get('request_id'));



                //dd($request->get('Housing'));

                //Housing
                if ($request->get('Housing') == 'on') {
                    $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                    $deduction->housing_utilities = 1;
                    $deduction->explain_housing_utilities = $request->get('explain_housing_utilities');

                    if ($request->get('is_deposit_required') == 1) {
                        $deduction->is_deposit_required = 1;
                        $deduction->deposit_amount = $request->get('deposit_amount');
                        $deduction->is_deposit_refundable = $request->get('is_deposit_refundable');
                    } else {

                        $deduction->is_deposit_required = 0;
                        $deduction->deposit_amount = null;
                        $deduction->is_deposit_refundable = null;
                    }

                    $deduction->housing_notes = $request->get('housing_notes');
                    $deduction->housing_includes_utilities = $request->get('housing_utilities');
                } else {
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
                if ($request->get('Medical') == 'on') {
                    $deduction->medical = 1;
                } else {
                    $deduction->medical = 0;
                }



                //DailyTransportation
                if ($request->get('DailyTransportation') == 'on') {
                    $deduction->daily_transportation = 1;
                    $deduction->deduction_daily_amount_person_week = $request->get('deduction_daily_amount_person_week');
                    $deduction->daily_notes = $request->get('daily_notes');
                } else {
                    $deduction->daily_transportation = 0;
                    $deduction->deduction_daily_amount_person_week = null;
                    $deduction->daily_notes = null;
                }


                //Other Deductions
                if ($request->get('Other') == 'on') {
                    $deduction->other = 1;
                    $deduction->other_deductions = $request->get('other_deductions');
                } else {
                    $deduction->other = 0;
                    $deduction->other_deductions = null;
                }



                //Meals
                if ($request->get('Meals') == 'on') {
                    $deduction->meals = 1;
                    $deduction->how_many_meals_provided = $request->get('how_many_meals_provided');
                    $deduction->cost_per_meal = $request->get('cost_per_meal');
                    $deduction->meals_notes = $request->get('meals_notes');
                    $deduction->is_there_cost_per_meal = $request->get('is_there_costo_per_meal');

                    $deduction->deduction_amount_per_meal = $request->get('deduction_amount_per_meal');
                } else {
                    $deduction->meals = 0;
                    $deduction->how_many_meals_provided = null;
                    $deduction->cost_per_meal = null;
                    $deduction->meals_notes = null;
                    $deduction->is_there_cost_per_meal = 0;
                    $deduction->deduction_amount_per_meal = null;
                }

                //dd($request->get('NoDeductions'));

                //No Deductions
                if ($request->get('NoDeductions') == 'on') {
                    $deduction->no_deduction = 1;
                } else {
                    $deduction->no_deduction = 0;
                }


                $deduction->save();








                //Medical
                if ($request->get('Medical') == 'on') {

                    //dd($job_request->employer_id);
                    //$medical_ded_req = MedicalDeductionRequest::findOrFail($request->get('request_id'));

                    $medical_ded_req = MedicalDeductionRequest::where('employer_id', '=', $job_request->employer_id)->get();

                    foreach ($medical_ded_req as $mdr) {
                        $mdr_del = MedicalDeductionRequest::findOrFail($mdr->id);
                        $mdr_del->delete();
                    }


                    //dd($medical_ded_req);

                    //$medical_ded_req->delete();

                    //dd("existe deductions");

                    if ($request->get('ChkMedical') == 'on') {
                        $deduction->deduction_medical_paycheck = 1;


                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_medical_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 1;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_medical_paycheck');
                        $mdr->save();
                    } else {
                        $deduction->deduction_medical_paycheck = 0;
                    }


                    if ($request->get('ChkDental') == 'on') {
                        $deduction->deduction_dental_paycheck = 1;

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_dental_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 2;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_dental_paycheck');
                        $mdr->save();
                    } else {
                        $deduction->deduction_dental_paycheck = 0;
                    }


                    if ($request->get('ChkVision') == 'on') {
                        $deduction->deduction_vision_paycheck = 1;

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_vision_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 3;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_vision_paycheck');
                        $mdr->save();
                    } else {
                        $deduction->deduction_vision_paycheck = 0;
                    }


                    if ($request->get('ChkOther') == 'on') {
                        $deduction->deduction_other_paycheck = 1;

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_other_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 4;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_other_paycheck');
                        $mdr->save();
                    } else {
                        $deduction->deduction_other_paycheck = 0;
                    }

                    $deduction->save();
                } else {
                    $deduction->medical = 0;
                    $medical_ded_req = MedicalDeductionRequest::where('employer_id', '=', $job_request->employer_id)->get();

                    foreach ($medical_ded_req as $mdr) {
                        $mdr_del = MedicalDeductionRequest::findOrFail($mdr->id);
                        $mdr_del->delete();
                    }
                }


                session_start();
                session(['tab_request' => '4']);

                //dd(session('tab_request'));

                Alert::success('Ok', 'Record saved');
                return redirect('job_request/' . $request->get('request_id') . '/edit');

            } else {
                //CREANDO NUEVAS DEDUCCIONES

                //dd("hola dos");
                $job_request = JobRequest::findOrFail($request->get('request_id'));

                //Housing
                $deduction = new JobDeduction();
                $deduction->request_id = $request->get('request_id');
                $deduction->employer_id = $job_request->employer_id;

                //dd("hola tres");
                //dd($request->get('Housing'));
                if ($request->get('Housing') == 'on') {
                    $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                    $deduction->housing_utilities = $request->get('housing_utilities');
                    $deduction->explain_housing_utilities = $request->get('explain_housing_utilities');
                    //$deduction->is_deposit_required = $request->get('is_deposit_required');

                    if ($request->get('is_deposit_required') == 1) {
                        $deduction->is_deposit_required = 1;
                        $deduction->deposit_amount = $request->get('deposit_amount');
                        $deduction->is_deposit_refundable = $request->get('is_deposit_refundable');
                    } else {
                        $deduction->is_deposit_required = 0;
                        $deduction->deposit_amount = null;
                        $deduction->is_deposit_refundable = null;
                    }

                    $deduction->housing_notes = $request->get('housing_notes');
                    $deduction->housing_includes_utilities = $request->get('housing_utilities');
                } else {
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
                if ($request->get('Medical') == 'on') {
                    $deduction->medical = 1;
                } else {
                    $deduction->medical = 0;
                }


                //DailyTransportation
                if ($request->get('DailyTransportation') == 'on') {
                    $deduction->daily_transportation = 1;
                    $deduction->deduction_daily_amount_person_week = $request->get('deduction_daily_amount_person_week');
                    $deduction->daily_notes = $request->get('daily_notes');
                } else {
                    $deduction->daily_transportation = 0;
                    $deduction->deduction_daily_amount_person_week = null;
                    $deduction->daily_notes = null;
                }

                //Other Deductions
                if ($request->get('Other') == 'on') {
                    $deduction->other = 1;
                    $deduction->other_deductions = $request->get('other_deductions');
                } else {
                    $deduction->other = 0;
                    $deduction->other_deductions = null;
                }

                //Meals
                if ($request->get('Meals') == 'on') {
                    $deduction->meals = 1;
                    $deduction->how_many_meals_provided = $request->get('how_many_meals_provided');
                    $deduction->cost_per_meal = $request->get('cost_per_meal');
                    $deduction->meals_notes = $request->get('meals_notes');
                    $deduction->is_there_cost_per_meal = $request->get('is_there_costo_per_meal');

                    $deduction->deduction_amount_per_meal = $request->get('deduction_amount_per_meal');
                } else {
                    $deduction->meals = 0;
                    $deduction->how_many_meals_provided = null;
                    $deduction->cost_per_meal = null;
                    $deduction->meals_notes = null;
                    $deduction->is_there_cost_per_meal = 0;
                    $deduction->deduction_amount_per_meal = null;
                }


                //No Deductions
                if ($request->get('NoDeductions') == 'on') {
                    $deduction->no_deduction = 1;
                } else {
                    $deduction->no_deduction = 0;
                }

                $deduction->save();




                //Medical
                if ($request->get('Medical') == 'on') {
                    if ($request->get('ChkMedical') == 'on') {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
                        $deduction->deduction_medical_paycheck = 1;
                        $deduction->save();

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_medical_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 1;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_medical_paycheck');
                        $mdr->save();
                    } else {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
                        $deduction->deduction_medical_paycheck = 0;
                        $deduction->save();
                    }


                    if ($request->get('ChkDental') == 'on') {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
                        $deduction->deduction_dental_paycheck = 1;
                        $deduction->save();


                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_dental_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 2;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_dental_paycheck');
                        $mdr->save();
                    } else {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
                        $deduction->deduction_dental_paycheck = 0;
                        $deduction->save();
                    }


                    if ($request->get('ChkVision') == 'on') {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
                        $deduction->deduction_vision_paycheck = 1;
                        $deduction->save();

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_vision_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 3;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_vision_paycheck');
                        $mdr->save();
                    } else {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
                        $deduction->deduction_vision_paycheck = 0;
                        $deduction->save();
                    }


                    if ($request->get('ChkOther') == 'on') {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
                        $deduction->deduction_other_paycheck = 1;
                        $deduction->save();

                        $mdr = new MedicalDeductionRequest();
                        $mdr->comments = $request->get('deduction_other_note');
                        $mdr->request_deduction_id = $deduction->id;
                        $mdr->catalog_medical_deduction_id = 4;
                        $mdr->employer_id = $job_request->employer_id;
                        $mdr->deduction_ammount = $request->get('deduction_other_paycheck');
                        $mdr->save();
                    } else {
                        $deduction = JobDeduction::where('request_id', '=', $request->get('request_id'))->first();
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


            session_start();
            session(['tab_request' => '4']);

            Alert::success('Ok', 'Record saved');
            return redirect('job_request/' . $request->get('job_request_id') . '/edit');
        } else {
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
            $medical_ded_req = MedicalDeductionRequest::where('employer_id', '=', $job_request->employer_id)->get();

            foreach ($medical_ded_req as $mdr) {
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

            session_start();
            session(['tab_request' => '4']);

            //dd(session('tab_request'));

            Alert::success('Ok', 'Record saved');
            return redirect('job_request/' . $request->get('request_id') . '/edit');
        }
    }


    public function job_request_requirements(Request $request){

        //dd($request);

        $user =  auth()->user();
        $employer = $user->user_has_employer->first();

        //dd($request->get('is_included_criminal_history'));


        //dd($is_background_check_pre_employement, $is_background_check_post_employement, $is_background_check_other);

        if ($request->get('is_background_check_pre_employement')== 'on'){
            $is_background_check_pre_employement = 1;
        }else{
            $is_background_check_pre_employement = 0;
        }

        if ($request->get('is_background_check_post_employement')== 'on'){
            $is_background_check_post_employement = 1;
        }else{
            $is_background_check_post_employement = 0;
        }


        if ($request->get('is_background_check_other')== 'on'){
            $is_background_check_other = 1;
            $others_description=$request->get('others_description');
        }else{
            $is_background_check_other = 0;
            $others_description=null;
        }

        if ($request->get('is_drug_testing_other')== 'on'){
            $is_drug_testing_other = 1;
            $testing_other_description=$request->get('testing_other_description');
        }else{
            $is_drug_testing_other = 0;
            $testing_other_description=null;
        }




        if ($request->get('is_drug_testing_pre_employment')== 'on'){
            $is_drug_testing_pre_employment = 1;
        }else{
            $is_drug_testing_pre_employment = 0;
        }



        if ($request->get('is_drug_testing_post_employment')== 'on'){
            $is_drug_testing_post_employment = 1;
        }else{
            $is_drug_testing_post_employment = 0;
        }

        if ($request->get('is_drug_testing_post_injury')== 'on'){
            $is_drug_testing_post_injury = 1;
        }else{
            $is_drug_testing_post_injury = 0;
        }

        if ($request->get('is_drug_testing_other')== 'on'){
            $is_drug_testing_other = 1;
        }else{
            $is_drug_testing_other = 0;
        }




        $bgcheck_reg = BackgroundCheck::where('request_id','=',$request->get('request_id'))->where('employer_id','=',$employer->id)->first();

        if($bgcheck_reg){
            $bgcheck_id = BackgroundCheck::where('request_id','=',$request->get('request_id'))->where('employer_id','=',$employer->id)->first()->id;

            $bgcheck_upd = BackgroundCheck::findOrFail($bgcheck_id);



            if ($request->get('is_background_check_required')==1){
                $bgcheck_upd->is_background_check_required=1;
                $bgcheck_upd->is_included_criminal_history=$request->get('is_included_criminal_history');
                $bgcheck_upd->is_background_check_pre_employement=$is_background_check_pre_employement;
                $bgcheck_upd->is_background_check_post_employement=$is_background_check_post_employement;
                $bgcheck_upd->is_background_check_other=$is_background_check_other;
                $bgcheck_upd->others_description=$others_description;
            }else{
                $bgcheck_upd->is_background_check_required=0;
                $bgcheck_upd->is_included_criminal_history=0;
                $bgcheck_upd->is_background_check_pre_employement=0;
                $bgcheck_upd->is_background_check_post_employement=0;
                $bgcheck_upd->is_background_check_other=0;
                $bgcheck_upd->others_description=null;
            }



            if ($request->get('is_drug_testing_required') == 1) {
                $bgcheck_upd->is_drug_testing_required=1;
                $bgcheck_upd->is_drug_testing_pre_employment=$is_drug_testing_pre_employment;
                $bgcheck_upd->is_drug_testing_post_employment=$is_drug_testing_post_employment;
                $bgcheck_upd->is_drug_testing_post_injury=$is_drug_testing_post_injury;
                $bgcheck_upd->is_drug_testing_other=$is_drug_testing_other;
                $bgcheck_upd->testing_other_description=$testing_other_description;
            } else {
                $bgcheck_upd->is_drug_testing_required=0;
                $bgcheck_upd->is_drug_testing_pre_employment=0;
                $bgcheck_upd->is_drug_testing_post_employment=0;
                $bgcheck_upd->is_drug_testing_post_injury=0;
                $bgcheck_upd->is_drug_testing_other=0;
                $bgcheck_upd->testing_other_description=null;
            }


            if ($request->get('are_there_other_requirements')==1) {
                $bgcheck_upd->are_there_other_requirements=1;
                $bgcheck_upd->other_requirements_description=$request->get('other_requirements_description');
            } else {
                $bgcheck_upd->are_there_other_requirements=0;
                $bgcheck_upd->other_requirements_description=null;
            }

            $bgcheck_upd->request_id=$request->get('request_id');

            $bgcheck_upd->update();

        }else{
            $bgcheck = new BackgroundCheck();
            $bgcheck->employer_id=$employer->id;
            $bgcheck->is_background_check_required=$request->get('is_background_check_required');
            $bgcheck->is_included_criminal_history=$request->get('is_included_criminal_history');
            $bgcheck->is_background_check_pre_employement=$is_background_check_pre_employement;
            $bgcheck->is_background_check_post_employement=$is_background_check_post_employement;
            $bgcheck->is_background_check_other=$is_background_check_other;
            $bgcheck->others_description=$others_description;
            $bgcheck->is_drug_testing_required=$request->get('is_drug_testing_required');
            $bgcheck->is_drug_testing_pre_employment=$is_drug_testing_pre_employment;
            $bgcheck->is_drug_testing_post_employment=$is_drug_testing_post_employment;
            $bgcheck->is_drug_testing_post_injury=$is_drug_testing_post_injury;
            $bgcheck->is_drug_testing_other=$is_drug_testing_other;
            $bgcheck->testing_other_description=$testing_other_description;
            $bgcheck->are_there_other_requirements=$request->get('are_there_other_requirements');
            $bgcheck->other_requirements_description=$request->get('other_requirements_description');
            $bgcheck->request_id=$request->get('request_id');
            $bgcheck->save();

        }


        // dd($request->get('arrange_and_pay'));
        //dd($request->get('reimburse'));
        // dd($request->get('provide_advance'));

        if ($request->get('arrange_and_pay')=='on') {
            $arrange_and_pay = 1;
            $reimburse=0;
            $provide_advance=0;
            $pes_arramge_inbound_transportation = $request->get('pes_arramge_inbound_transportation');
        }


        if ($request->get('reimburse')=='on') {
            $arrange_and_pay = 0;
            $reimburse=1;
            $provide_advance=0;
            $pes_arramge_inbound_transportation = null;
        }

        if ($request->get('provide_advance')=='on') {
            $arrange_and_pay = 0;
            $reimburse=0;
            $provide_advance=1;
            $pes_arramge_inbound_transportation = null;
        }


        //dd($arrange_and_pay, $reimburse, $provide_advance, $pes_arramge_inbound_transportation);



        $cuenta_et = EmployerTransportation::where('request_id','=',$request->get('request_id'))->where('employer_id','=',$employer->id)->get()->count();


        if ($cuenta_et > 0) {
            $et_id = EmployerTransportation::where('request_id','=',$request->get('request_id'))->where('employer_id','=',$employer->id)->first()->id;

            $et_upd = EmployerTransportation::findOrFail($et_id);
            $et_upd->employer_id=$employer->id;
            $et_upd->request_id=$request->get('request_id');
            $et_upd->arrange_and_pay=$arrange_and_pay;
            $et_upd->reimburse=$reimburse;
            $et_upd->provide_advance=$provide_advance;
            $et_upd->pes_arramge_inbound_transportation=$pes_arramge_inbound_transportation;
            $et_upd->save();
        }else{
            $et = new EmployerTransportation();
            $et->employer_id=$employer->id;
            $et->request_id=$request->get('request_id');
            $et->arrange_and_pay=$arrange_and_pay;
            $et->reimburse=$reimburse;
            $et->provide_advance=$provide_advance;
            $et->pes_arramge_inbound_transportation=$pes_arramge_inbound_transportation;
            $et->save();
        }


        session_start();
        session(['tab_request' => '5']);



        Alert::info('', 'Record saved');
        return redirect('job_request/' . $request->get('request_id') . '/edit');

    }


    public function job_request_representative(Request $request){

        //dd($request);
        $user =  auth()->user();
        $employer = $user->user_has_employer->first();


        //dd($job_request);

        $cuenta_er = EmployerRepresentative::where('employer_id','=',$employer->id)->get()->count();

        $job_request = JobRequest::findOrFail($request->get('request_id'));

        if ($cuenta_er > 0) {
            $er_id = EmployerRepresentative::where('employer_id','=',$employer->id)->first()->id;

            $ZipCode = CityZip::findOrFail($request->get('er_zip_addr1'));

            $er_upd = EmployerRepresentative::findOrFail($er_id);
            $er_upd->employer_id = $employer->id;
            $er_upd->er_last_name = $request->get('er_last_name');
            $er_upd->er_first_name = $request->get('er_first_name');
            $er_upd->er_middle_name = $request->get('er_middle_name');
            $er_upd->er_address_1 = $request->get('er_address_1');
            $er_upd->er_county_id = $ZipCode->id;
            $er_upd->er_city_id =  $ZipCode->id;
            $er_upd->er_state_id = $request->get('er_state_id');
            $er_upd->er_zip_addr1 =  $ZipCode->czc_zipcode;
            $er_upd->er_country_id = $request->get('er_country_id');
            $er_upd->er_telephone_number = $request->get('er_telephone_number');
            $er_upd->er_lawfirm_email = $request->get('er_lawfirm_email');
            $er_upd->er_telephone_number_ext = $request->get('er_telephone_number_ext');
            $er_upd->er_lawfirm_business_name = $request->get('er_lawfirm_business_name');
            $er_upd->er_lawfirm_fein_number = $request->get('er_lawfirm_fein_number');
            $er_upd->er_type_of_representation_id = $request->get('er_type_of_representation_id');
            $er_upd->er_state_good_standing_id = $request->get('er_state_good_standing_id');
            $er_upd->er_highest_state_court_name = $request->get('er_highest_state_court_name');
            $er_upd->er_state_bar_number = $request->get('er_state_bar_number');
            $er_upd->save();

            $job_request->employer_representative_id = $er_upd->id;
            $job_request->update();

        }else{
            $er = new EmployerRepresentative();
            $er->employer_id = $employer->id;
            $er->er_last_name = $request->get('er_last_name');
            $er->er_first_name = $request->get('er_first_name');
            $er->er_middle_name = $request->get('er_middle_name');
            $er->er_address_1 = $request->get('er_address_1');
            $er->er_county_id = $request->get('er_county_id');
            $er->er_city_id = $request->get('er_city_id');
            $er->er_state_id = $request->get('er_state_id');
            $er->er_zip_addr1 = $request->get('er_zip_addr1');
            $er->er_country_id = $request->get('er_country_id');
            $er->er_telephone_number = $request->get('er_telephone_number');
            $er->er_lawfirm_email = $request->get('er_lawfirm_email');
            $er->er_telephone_number_ext = $request->get('er_telephone_number_ext');
            $er->er_lawfirm_business_name = $request->get('er_lawfirm_business_name');
            $er->er_lawfirm_fein_number = $request->get('er_lawfirm_fein_number');
            $er->er_type_of_representation_id = $request->get('er_type_of_representation_id');
            $er->er_state_good_standing_id = $request->get('er_state_good_standing_id');
            $er->er_highest_state_court_name = $request->get('er_highest_state_court_name');
            $er->er_state_bar_number = $request->get('er_state_bar_number');
            $er->save();

            $job_request->employer_representative_id = $er->id;
            $job_request->update();
        }


        session_start();
        session(['tab_request' => '1']);


        Alert::info('', 'Record saved');
        return redirect('job_request/' . $job_request->id . '/edit');
    }

    public function form9141($id)
    {

       /* $detail = JobRequestDetail::findOrFail($id);
        $job_request = JobRequest::with('employer')->findOrFail($detail->request_id);
        $contact_worksite = EmployerWorksite::where('employer_id', '=', $job_request->employer_id)->where('address_type_id', '=', 5)->first();

        if ($contact_worksite) {
            $contact_worksite_city = $contact_worksite->city->czc_city;
            $contact_worksite_state = $contact_worksite->state->cs_state;
            $contact_worksite_zip_code = $contact_worksite->zip_code_address;
            $contact_worksite_country = $contact_worksite->zip_code_address;
        } else {
            $contact_worksite_city = "";
            $contact_worksite_state = "";
            $contact_worksite_zip_code = "";
        }

        $fields = '{
            "Visa type":"normal","Enter contact\'s last (family) name": "' . $detail->job_request->employer->primary_contact_last_name . '",
            "Enter first (given) name": "' . $detail->job_request->employer->primary_contact_name . '",
            "Enter middle name if applicable": "' . $detail->job_request->employer->contact_middle_name . '",
            "Enter contact\'s job title": "' . $detail->job_request->employer->primary_contact_job_title . '",
            "Enter address line 1": "' . $detail->job_request->employer->primary_contact_job_title . '",
            "Enter city": "' . $contact_worksite_city . '",
            "Enter state": "' . $contact_worksite_state . '",
            "Enter postal code": "' . $contact_worksite_zip_code . '",
            "Enter country": "USA"
        '. '}';

       // echo $fields;




        $response = Http::asForm()->post('http://192.168.10.201:8081/PdfService-0.0.1/', [
            'pdfName' => 'formarruinado.pdf',
            'fields' => $fields
        ]);

        return view('reports.form91412', ["base64"=>$response]);*/

        /*  //data:image/jpeg;base64,

        $this->base64_to_jpeg('data:image/jpeg;base64,'.$img,'form4191.png');

        echo($response);

        dd($response);*/
        $job_request = JobRequest::with('employer')->findOrFail($id);
        $request_details = JobRequestDetail::where('request_id','=',$id)->get();
        $contact_worksite = EmployerWorksite::where('employer_id','=',$job_request->employer_id)->where('address_type_id','=',5)->first();

        $array_details = [];

        foreach($request_details as $obj)
        {
            array_push($array_details,$obj->id);
        }

        $special_skills = SpecialSkillJobRequest::whereIn('request_detail_id',$array_details)->get();
        $degree_codes = DegreeCode::get();
        return view('reports.form9141', ['request_details' => $request_details,'contact_worksite' => $contact_worksite,'special_skills' => $special_skills,'degree_codes'=>$degree_codes]);

    }


    function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }


    public function destroy($id)
    {
        //
    }
}
