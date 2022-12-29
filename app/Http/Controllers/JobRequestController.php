<?php

namespace App\Http\Controllers;

use App\Models\catalogue\City;
use App\Models\catalogue\JobTitle;
use App\Models\catalogue\MedicalDeduction;
use App\Models\catalogue\State;
use App\Models\JobDeduction;
use App\Models\JobRequest;
use App\Models\JobRequestDetail;
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
        $job_titles = JobTitle::get();
        $details = JobRequestDetail::where('request_id', '=', $id)->get();
        return view('job_request.edit', ['job_request' => $job_request, 'job_titles' => $job_titles, 'details' => $details]);
    }

    public function update(Request $request, $id)
    {
        $job_application = JobRequest::findOrFail($id);

        $imageBase64 = str_replace("data:image/png;base64", "", $request->get('sign'));

        $uniqid = $id . ".png";
        $ruteOut =  (public_path("sign/") . $uniqid);
        $imageBinary = base64_decode($imageBase64);
        $bytes = file_put_contents($ruteOut, $imageBinary);

        $job_application->signature = $uniqid;
        $job_application->update();
        Alert::info('', 'Record saved');
        return redirect('job_request/' . $id . '/edit');

    }


    public function job_request_deductions(Request $request)
    {

        $deduction = JobDeduction::where('request_id','=',$request->get('request_id'))->first();
        if($deduction)
        {
            $job_request = JobRequest::findOrFail($request->get('request_id'));

            if($request->get('deduction_housing_amount_person_week'))
            {
                $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                $deduction->is_deposit_required = $request->get('is_deposit_required');
                $deduction->housing_utilities = $request->get('housing_utilities');
                $deduction->housing_notes = $request->get('housing_notes');
            }
            else{
                $deduction->deduction_housing_amount_person_week = null;
                $deduction->is_deposit_required = null;
                $deduction->housing_utilities = null;
                $deduction->housing_notes = null;
            }
        }
        else{
            $job_request = JobRequest::findOrFail($request->get('request_id'));
            $deduction = new JobDeduction();
            $deduction->request_id = $request->get('request_id');
            $deduction->employer_id = $job_request->employer_id;

            if($request->get('deduction_housing_amount_person_week'))
            {
                $deduction->deduction_housing_amount_person_week = $request->get('deduction_housing_amount_person_week');
                $deduction->is_deposit_required = $request->get('is_deposit_required');
                $deduction->housing_utilities = $request->get('housing_utilities');
                $deduction->housing_notes = $request->get('housing_notes');
            }
            else{
                $deduction->deduction_housing_amount_person_week = null;
                $deduction->is_deposit_required = null;
                $deduction->housing_utilities = null;
                $deduction->housing_notes = null;
            }

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

            if($request->get('how_many_meals_provided'))
            {
                $deduction->how_many_meals_provided = $request->get('how_many_meals_provided');
                $deduction->is_there_costo_per_meal = $request->get('is_there_costo_per_meal');
                $deduction->cost_per_meal = $request->get('cost_per_meal');
                $deduction->deduction_amount_per_meal = $request->get('deduction_amount_per_meal');
                $deduction->meals_notes = $request->get('meals_notes');
            }
            else{
                $deduction->how_many_meals_provided = null;
                $deduction->is_there_costo_per_meal = null;
                $deduction->cost_per_meal = null;
                $deduction->deduction_amount_per_meal = null;
                $deduction->meals_notes = null;
            }










            $deduction->save();
        }
        return back();

    }

    public function form9141($id)
    {
        $job_request = JobRequest::with('employer')->findOrFail($id);
        //dd($job_request);
        return view('reports.form9141', ['job_request' => $job_request]);
    }

    public function destroy($id)
    {
        //
    }
}
