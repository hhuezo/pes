<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\catalogue\Templates;
use PDF;

class FormatController extends Controller
{


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$type)
    {
        $job_request = JobRequest::findOrFail($id);



        $template = Templates::findOrFail($type);



        return view('formats.create', ['job_request' => $job_request,'template' => $template]);
        //echo $request->get('note');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note =  $request->get('note');



        $pdf = \PDF::loadView('formats.print', ["note"=>$note]);
        return $pdf->stream('nota.pdf');
        // download PDF file with download method
        //return $pdf->download('pdf_file.pdf');
        //return view('formats.print', ['note' => $note]);

       /* $pdf =  \PDF::loadView('reportes.marcacion.fipl25_imprimir', ['NumeroInicio' => $request->get('NumeroInicio'), 'NumeroFinal' => $request->get('NumeroFinal') ])
        ->setPaper('letter', 'landscape');
        //$pdf = \PDF::loadView('marcacion.reporteMarcacion.imprimirSalidaTemprana', ['marcacionMax' => $marcacionMax])->setPaper('A4', 'landscape')->setWarnings(false);

        return $pdf->stream('ejemplo.pdf');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job_request = JobRequest::findOrFail($id);
        return view('formats.show', ['job_request' => $job_request]);
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
