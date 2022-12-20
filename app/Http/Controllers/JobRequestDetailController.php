<?php

namespace App\Http\Controllers;

use App\Models\JobRequestDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JobRequestDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        /*if ($request->get('job_app_id') == 0) {
            $employer = Employer::where('users_id', '=', auth()->user()->id)->first();

            $job = new JobRequest();
            $job->employer_id = $employer->id;
            $job->start_date = $request->get('start_date_modal');
            $job->end_date = $request->get('end_date_modal');
            $job->need_h2b_workers = $request->get('need_h2b_workers_modal');

            $job->explain_multiple_employment = $request->get('explain_multiple_employment_modal');

            $job->save();
        }*/


      /*  $detail =  new JobRequestDetail();
        if ($request->get('job_app_id') == 0) {
            $detail->job_app_id = $job->id;
        } else {
            $detail->job_app_id = $request->get('job_app_id');
        }*/


        $detail =  new JobRequestDetail();
        $detail->request_id = $request->get('job_request_id');
        $detail->job_title_id = $request->get('job_title');
        $detail->number_workers = $request->get('number_workers');
        if ($request->get('it_has_cba') == null) {
            $detail->it_has_cba = 0;
        } else {
            $detail->it_has_cba = 1;
        }
        $detail->how_paid = $request->get('how_paid');
        $detail->pay_rate = $request->get('pay_rate');
        $detail->use_tip_credit = $request->get('use_tip_credit');
        $detail->is_there_benefits = $request->get('is_there_benefits');
        $detail->explain_benefits = $request->get('explain_benefits');
        $detail->are_there_any_requeriments = $request->get('are_there_any_requeriments');
        $detail->requeriments = $request->get('requeriments');
        $detail->any_additional_wage_notes = $request->get('any_additional_wage_notes');
        $detail->is_overtime_available = $request->get('is_overtime_available');
        $detail->ant_workday_sun_hour = $request->get('ant_workday_sun_hour');
        $detail->ant_workday_mon_hour = $request->get('ant_workday_mon_hour');
        $detail->ant_workday_tue_hour = $request->get('ant_workday_tue_hour');
        $detail->ant_workday_wed_hour = $request->get('ant_workday_wed_hour');
        $detail->ant_workday_thu_hour = $request->get('ant_workday_thu_hour');
        $detail->ant_workday_fri_hour = $request->get('ant_workday_fri_hour');
        $detail->ant_workday_sat_hour = $request->get('ant_workday_sat_hour');
        $detail->ant_workday_total_hours = $request->get('ant_workday_total_hours');
        $detail->primary_shift_time = $request->get('primary_shift_time');
        $detail->are_there_additional_shift_times = $request->get('are_there_additional_shift_times');
        $detail->user_id = auth()->user()->id;
        $detail->save();

        Alert::success('Ok', 'Record saved');
        return redirect('job_request/' . $request->get('job_request_id'). '/edit');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $detail = JobRequestDetail::findOrFail($request->get('id'));
        $detail->delete();
        Alert::error('', 'Record delete');
        return back();
    }


    public function destroy($id)
    {
        dd($id);
        $detail = JobRequestDetail::findOrFail($id);
        $detail->delete();
        Alert::error('', 'Record delete');
        return back();
    }
}
