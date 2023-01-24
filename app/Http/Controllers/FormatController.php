<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\catalogue\Templates;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Http;

class FormatController extends Controller
{


    public function index()
    {
        //
    }

    public function create($id, $type)
    {
        $job_request = JobRequest::findOrFail($id);



        $template = Templates::findOrFail($type);



        return view('formats.create', ['job_request' => $job_request, 'template' => $template]);
        //echo $request->get('note');
    }

    public function store(Request $request)
    {
        $note =  $request->get('note');

        $mailData = [
            'title' => 'Mail from Web-tuts.com',
            'body' => 'This is for testing email using smtp.'
        ];

       /* $response = Http::post('http://172.31.65.26:8080/esquelassqlservices2/correo/correoPin', [
            "to" => "hulexgsa@gmail.com",
            "user" => "jramirez",
            "student_code" => "1234567"
        ]);

        echo $response;
        return view('formats.print', ['note' => $note]);*/

        $pdf = \PDF::loadView('formats.print', ["note"=>$note]);
        return $pdf->stream('nota.pdf');


    }


    public function show($id)
    {
        $job_request = JobRequest::findOrFail($id);
        return view('formats.show', ['job_request' => $job_request]);
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
