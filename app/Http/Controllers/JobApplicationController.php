<?php

namespace App\Http\Controllers;

use App\Models\catalogue\JobTitle;
use App\Models\Employer;
use App\Models\JobApplication;
use App\Models\JobApplicationDetail;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

     //alert()->success('Title','Lorem Lorem Lorem');

        if (auth()->user()->can('read admin job application')) {
            $job_apllications = JobApplication::get();
        } else if (auth()->user()->can('read job application')) {
            $job_apllications = JobApplication::whereIn('employer_id', function ($query) {
                $query->select('id')->from('employer')->where('users_id', '=', auth()->user()->id);
            })
                ->get();

            //dd($job_apllications);
        }

        $job_applications = JobApplication::whereIn('employer_id', function ($query) {
            $query->select('id')->from('employer')->where('users_id', '=', auth()->user()->id);
        })
            ->get();


        return view('job_application.index', ['job_applications' => $job_applications]);
    }


    public function create()
    {
        $job_titles = JobTitle::get();
        return view('job_application.create',['job_titles'=>$job_titles]);
    }




    public function store(Request $request)
    {
        $employer = Employer::where('users_id', '=', auth()->user()->id)->first();


        $job = new JobApplication();
        $job->employer_id = $employer->id;
        $job->start_date = $request->get('start_date');
        $job->end_date = $request->get('end_date');
        $job->need_h2b_workers = $request->get('need_h2b_workers');

        $job->explain_multiple_employment = $request->get('explain_multiple_employment');
        $job->paid  = $request->get('paid');
        /*$job->is_uniform_required  = $request->get('is_uniform_required');
        $job->uniform_pieces_required = $request->get('uniform_pieces_required');
        $job->job_notes = $request->get('job_notes');*/
        $job->save();

        Alert::success('Ok', 'Record saved');
        return redirect('job_application/' . $job->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //|
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = JobApplication::findOrFail($id);
        $job_titles = JobTitle::get();
        $job_details = JobApplicationDetail::where('job_app_id','=',$id)->get();
        return view('job_application.edit', ['job' => $job,'job_titles' => $job_titles,'job_details' => $job_details]);
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

        $job = JobApplication::findOrFail($id);
        $job->start_date = $request->get('start_date');
        $job->end_date = $request->get('end_date');

        $job->need_h2b_workers = $request->get('need_h2b_workers');
        $job->explain_multiple_employment = $request->get('explain_multiple_employment');
        $job->paid  = $request->get('paid');
        $job->is_uniform_required  = $request->get('is_uniform_required');
        $job->uniform_pieces_required = $request->get('uniform_pieces_required');
        $job->job_notes = $request->get('job_notes');
        $job->update();

        return redirect('job_application/' . $job->id . '/edit');
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
