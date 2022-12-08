<?php

namespace App\Http\Controllers;

use App\Models\JobApplicationDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Employer;
use App\Models\JobApplication;

class JobApplicationDetailController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->get('job_app_id') == 0) {
            $employer = Employer::where('users_id', '=', auth()->user()->id)->first();

            $job = new JobApplication();
            $job->employer_id = $employer->id;
            $job->start_date = $request->get('start_date_modal');
            $job->end_date = $request->get('end_date_modal');
            $job->need_h2b_workers = $request->get('need_h2b_workers_modal');

            $job->explain_multiple_employment = $request->get('explain_multiple_employment_modal');
            /* $job->paid  = $request->get('paid');
          $job->is_uniform_required  = $request->get('is_uniform_required');
            $job->uniform_pieces_required = $request->get('uniform_pieces_required');
            $job->job_notes = $request->get('job_notes');*/
            $job->save();
        }


        $detail =  new JobApplicationDetail();
        if ($request->get('job_app_id') == 0) {
            $detail->job_app_id = $job->id;
        } else {
            $detail->job_app_id = $request->get('job_app_id');
        }

        $detail->job_title = $request->get('job_title');
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
        $detail->save();

        Alert::success('Ok', 'Record saved');
        if ($request->get('job_app_id') == 0) {
            return redirect('job_application/' . $job->id . '/edit');
        }

        return redirect('job_application/' . $request->get('job_app_id') . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
