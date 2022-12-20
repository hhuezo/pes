<?php

namespace App\Http\Controllers;

use App\Models\catalogue\JobTitle;
use App\Models\JobApplicationDetail;
use App\Models\JobRequest;
use App\Models\JobRequestDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JobRequestController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->can('read admin job application')) {
            $job_requests = JobRequest::get();
        } else if (auth()->user()->can('read job application')) {
            $user = auth()->user();
            $employer = $user->user_has_employer->first();
            $job_requests = JobRequest::where('employer_id','=',$employer->id)->get();
        }


        return view('job_request.index', ['job_requests' => $job_requests]);
    }

    public function create()
    {
        $job_titles = JobTitle::get();
        return view('job_request.create',['job_titles'=>$job_titles]);
    }

    public function store(Request $request)
    {
       /* $employer = Employer::where('users_id', '=', auth()->user()->id)->first();


        $job = new JobApplication();
        $job->employer_id = $employer->id;
        $job->start_date = $request->get('start_date');
        $job->end_date = $request->get('end_date');
        $job->need_h2b_workers = $request->get('need_h2b_workers');

        $job->explain_multiple_employment = $request->get('explain_multiple_employment');
        $job->paid  = $request->get('paid');
        /*$job->is_uniform_required  = $request->get('is_uniform_required');
        $job->uniform_pieces_required = $request->get('uniform_pieces_required');
        $job->job_notes = $request->get('job_notes');
        $job->save();

        Alert::success('Ok', 'Record saved');
        return redirect('job_application/' . $job->id . '/edit');*/
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $job_request = JobRequest::findOrFail($id);
        $job_titles = JobTitle::get();
        $details = JobRequestDetail::where('request_id','=',$id)->get();
        return view('job_request.edit', ['job_request' => $job_request,'job_titles' => $job_titles,'details' => $details]);
    }

    public function update(Request $request, $id)
    {
        $job_application = JobRequest::findOrFail($id);

        $imageBase64 = str_replace("data:image/png;base64", "", $request->get('sign'));

        $uniqid = $id.".png";
        $ruteOut =  (public_path("sign/") . $uniqid );
        $imageBinary = base64_decode($imageBase64);
        $bytes = file_put_contents($ruteOut, $imageBinary);

        $job_application->signature = $uniqid;
        $job_application->update();
        Alert::info('', 'Record saved');
        return redirect('job_request/' . $id . '/edit');

        dd($job_application);
    }

    public function destroy($id)
    {
        //
    }
}
