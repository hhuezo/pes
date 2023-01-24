<?php

namespace App\Http\Controllers;

use App\Models\catalogue\InvoiceStatus;
use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\catalogue\InvoiceType;
use App\Models\Invoice;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class JobRequestFinantialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //
    }

    public function store(Request $request)
    {

        $job_request = JobRequest::findOrFail($request->get('request_id'));
        $invoice = new Invoice();
        $invoice->request_id = $request->get('request_id');
        $invoice->catalog_invoice_types_id = $request->get('catalog_invoice_types_id');
        $invoice->ammount_due = $request->get('ammount_due');
        $invoice->date_due = $request->get('date_due');
        $invoice->comments = $request->get('comments');
        $invoice->employer_id = $job_request->employer_id;
        $invoice->catalog_invoice_status_id = 2;
        $invoice->save();

        Alert::success('', 'Record saved');
        return redirect('job_request_finantial/' . $request->get('request_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now = Carbon::now()->addDays(-1);

        $job_request = JobRequest::findOrFail($id);
        $invoices = Invoice::where('request_id', '=', $id)->get();
        $types = InvoiceType::get();
        $status = InvoiceStatus::where('id', '<', 4)->get();
        foreach ($invoices as $invoice) {
            $date = Carbon::parse($invoice->date_due);

            if ($now > $date  && $invoice->catalog_invoice_status_id == 2) {
                $invoice->catalog_invoice_status_id = 3;
                $invoice->save();
            }
            else if ($now <= $date  && $invoice->catalog_invoice_status_id == 3)
            {
                $invoice->catalog_invoice_status_id = 2;
                $invoice->save();
            }
        }

        $color = ["", "", "warning", "danger"];

        return view('job_request_finantial.show', ['job_request' => $job_request, 'invoices' => $invoices, 'types' => $types, 'status' => $status, 'color' => $color]);
    }

    public function pay(Request $request)
    {

        $file = $request->file('proof_of_payment');
        $id = uniqid();
        $file->move(public_path("invoice/"), $id . ' ' . $file->getClientOriginalName());

        $invoice = Invoice::findOrFail($request->get('id'));
        $invoice->proof_of_payment = $id . ' ' . $file->getClientOriginalName();
        $invoice->catalog_invoice_status_id = 1;
        $invoice->update();
        return redirect('job_request_finantial/' . $invoice->request_id);
    }

    function update_pay(Request $request){

        $id = $request->get('invoice_id_upd');

        $invoice = Invoice::findOrFail($id);
        $invoice->catalog_invoice_types_id = $request->get('catalog_invoice_types_id_upd');
        $invoice->ammount_due = $request->get('ammount_due_upd');
        $invoice->date_due = $request->get('date_due_upd');
        $invoice->comments = $request->get('comments_upd');
        $invoice->update();

        Alert::success('', 'Record saved');
        return redirect('job_request_finantial/' . $invoice->request_id);

    }


    public function edit($id)
    {
        //
        $invoice_types = InvoiceType::get();

        $invoice = Invoice::findOrFail($id);

        $response = ["types"=>$invoice_types, "invoice"=>$invoice];

        //dd($response);

        return $response;
    }


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
