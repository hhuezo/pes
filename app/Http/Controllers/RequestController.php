<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use App\Models\catalogue\JobTitle;

class RequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->can('read admin job application')) {
            $requests = ModelsRequest::get();
        } else if (auth()->user()->can('read job application')) {
            $requests = ModelsRequest::whereIn('employer_id', function ($query) {
                $query->select('id')->from('employer')->where('users_id', '=', auth()->user()->id);
            })->get();

        }


        return view('job_application.index', ['requests' => $requests]);
    }


    public function create()
    {
        $job_titles = JobTitle::get();
        return view('request.create',['job_titles'=>$job_titles]);
    }

    public function store(Request $request)
    {
        //
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

    public function destroy($id)
    {
        //
    }
}
