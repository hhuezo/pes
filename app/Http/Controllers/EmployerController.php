<?php

namespace App\Http\Controllers;

use App\Models\catalogue\NaicsCode;
use App\Models\catalogue\primaryBusinessType;
use App\Models\catalogue\State;
use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        //$this->middleware( 'auth' );
    }
    public function index()
    {
        return view('catalogo.categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $primary_business_types = primaryBusinessType::where('active', '=', 1)->get();
        $principal_states = State::get();
        return view('employer.create', ['primary_business_types' => $primary_business_types, 'principal_states' => $principal_states]);
    }

    public function get_naics_code($id)
    {
        return NaicsCode::where('primary_business_type_id', '=', $id)->get();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employer = new Employer();
        $employer->legal_business_name = $request->get('legal_business_name');
        $employer->applicable_trade_name = $request->get('applicable_trade_name');
        $employer->trade_name = $request->get('trade_name');
        $employer->federal_id_number = $request->get('federal_id_number');
        $employer->year_business_established = $request->get('year_business_established');
        $employer->number_employees_full_time = $request->get('number_employees_full_time');
        $employer->primary_business_phone = $request->get('primary_business_phone');
        $employer->primary_business_fax = $request->get('primary_business_fax');
        $employer->company_website = $request->get('company_website');
        $employer->has_participate_h2b = $request->get('has_participate_h2b');
        if ($request->get('has_participate_h2b') == 1) {
            $employer->quantity_year_has_participate_h2b = $request->get('quantity_year_has_participate_h2b');
        }

        $employer->primary_business_type_id = $request->get('primary_business_type_id');
        $employer->naics_id = $request->get('naics_id');

        if ($request->get('naics_code') == 6) {
            $employer->year_end_gross_company_income = $request->get('year_end_gross_company_income');
        }
        $employer->naics_code = $request->get('naics_code');

        $employer->year_end_net_company_income = $request->get('year_end_net_company_income');
        $employer->principal_country = $request->get('principal_country');
        $employer->principal_state_id = $request->get('principal_state_id');
        $employer->principal_city = $request->get('principal_city');
        $employer->principal_street_address = $request->get('principal_street_address');
        $employer->principal_zip_code = $request->get('principal_zip_code');



        if ($request->get('mailing_address_same_above') == null) {
            $employer->mailing_address_same_above = 0;
            $employer->mailing_address = $request->get('mailing_address');
            $employer->mailing_city = $request->get('mailing_city');
            $employer->mailing_state = $request->get('mailing_state');
            $employer->mailing_zip_code = $request->get('mailing_zip_code');
        }
        else{
            $employer->mailing_address_same_above = 1;
        }

        $employer->primary_contact_name = $request->get('primary_contact_name');
        $employer->primary_contact_last_name = $request->get('primary_contact_last_name');
        $employer->primary_contact_job_title = $request->get('primary_contact_job_title');
        $employer->primary_contact_email = $request->get('primary_contact_email');
        $employer->primary_contact_phone = $request->get('primary_contact_phone');
        $employer->primary_contact_cellphone = $request->get('primary_contact_cellphone');
        /* $employer->add_contact_person = $request->get('add_contact_person');
        $employer->additional_contact = $request->get('additional_contact');
        $employer->additional_contact_job_title = $request->get('additional_contact_job_title');
        $employer->additional_contact_email = $request->get('additional_contact_email');
        $employer->additional_contact_phone = $request->get('additional_contact_phone');
        $employer->additional_contact_cellphone = $request->get('additional_contact_cellphone');*/

        $employer->signed_all_documents = $request->get('signed_all_documents');
        if ($request->get('signed_all_documents') == 0) {
            $employer->signatory_name = $request->get('signatory_name');
            $employer->signatory_last_name = $request->get('signatory_last_name');
            $employer->signatory_job_title = $request->get('signatory_job_title');
            $employer->signatory_email = $request->get('signatory_email');
            $employer->signatory_phone = $request->get('signatory_phone');
        }
        $employer->save();


    }

    public function place_employment($id)
    {

        return view('employer.place_employment', ['employer' => Employer::findOrFail($id)]);
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
