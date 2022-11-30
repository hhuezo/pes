<?php

namespace App\Http\Controllers;

use App\Models\catalogue\NaicsCode;
use App\Models\catalogue\primaryBusinessType;
use App\Models\catalogue\State;
use App\Models\Employer;
use App\Models\EmployerWorksite;
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

        //dd($request);
        
        $mailing_address_same_above = $request['mailing_address_same_above'];

        if ($mailing_address_same_above == 'on') {
            $mailing_address_same_above = 1;
        }else{
            $mailing_address_same_above = 0;
        }


        $signed_all_documents = $request['signed_all_documents'];

        if ($signed_all_documents == 'on') {
            $signed_all_documents = 1;
        }else{
            $signed_all_documents = 0;
        }
        
        
        $add_contact_person = $request['add_contact_person'];

        if ($add_contact_person == 'on') {
            $add_contact_person = 1;
        }else{
            $add_contact_person = 0;
        }
        

//dd($mailing_address_same_above);
//dd($signed_all_documents);
//dd($add_contact_person);


        if ($mailing_address_same_above == 0 && $signed_all_documents == 0 && $add_contact_person == 0) {
            $messages = [

                'legal_business_name.required' => 'legal_business_name is required',   
                'federal_id_number.required' => 'federal_id_number is required',   
                'year_business_established.required' => 'year_business_established is required',   
                'number_employees_full_time.required' => 'number_employees_full_time is required',   
                'primary_business_phone.required' => 'primary_business_phone is required',   
                'primary_business_type_id.required' => 'primary_business_type_id is required',   
                'naics_id.required' => 'naics_id is required',   
                'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
                'principal_street_address.required' => 'principal_street_address is required',   
                'principal_city.required' => 'principal_city is required',   
                'principal_country.required' => 'principal_country is required',   
                'principal_state_id.required' => 'principal_state_id is required',   
                'principal_zip_code.required' => 'principal_zip_code is required',   

                'mailing_address.required' => 'mailing_address is required',   
                'mailing_city.required' => 'mailing_city is required',   
                'mailing_state.required' => 'mailing_state is required',   
                'mailing_zip_code.required' => 'mailing_zip_code is required',   
                'signatory_name.required' => 'signatory_name is required',   
                'signatory_last_name.required' => 'signatory_last_name is required',   
                'signatory_job_title.required' => 'signatory_job_title is required',   
                'signatory_email.required' => 'signatory_email is required',   
                'signatory_phone.required' => 'signatory_phone is required',   

                'primary_contact_name.required' => 'primary_contact_name is required',   
                'primary_contact_last_name.required' => 'primary_contact_last_name is required',   
                'primary_contact_job_title.required' => 'primary_contact_job_title is required',   
                'primary_contact_email.required' => 'primary_contact_email is required',   
                'primary_contact_phone.required' => 'primary_contact_phone is required',   
                'primary_contact_cellphone.required' => 'primary_contact_cellphone is required',   
            ];

            $request->validate([

                'legal_business_name' => 'required|min:600',
                'federal_id_number' => 'required|min:9',
                'year_business_established' => 'required|min:4',
                'number_employees_full_time' => 'required|min:10',
                'primary_business_phone' => 'required|min:8',
                'primary_business_type_id' => 'required|min:8',
                'naics_id' => 'required|min:8',
                'year_end_gross_company_income' => 'required|min:4',
                'principal_street_address' => 'required|min:600',
                'principal_city' => 'required|min:600',
                'principal_country' => 'required|min:600',
                'principal_state_id' => 'required|min:8',
                'principal_zip_code' => 'required|min:5',

                'mailing_address' => 'required|min:600',
                'mailing_city' => 'required|min:200',
                'mailing_state' => 'required|min:100',
                'mailing_zip_code' => 'required|min:8',
                'signatory_name' => 'required|min:100',
                'signatory_last_name' => 'required|min:100',
                'signatory_job_title' => 'required|min:100',
                'signatory_email' => 'required|min:100',
                'signatory_phone' => 'required|min:8',

                'primary_contact_name' => 'required|min:100',
                'primary_contact_last_name' => 'required|min:100',
                'primary_contact_job_title' => 'required|min:100',
                'primary_contact_email' => 'required|min:100',
                'primary_contact_phone' => 'required|min:8',
                'primary_contact_cellphone' => 'required|min:8',
              ], $messages);
      
        }


        if ($mailing_address_same_above == 0 && $signed_all_documents == 0 && $add_contact_person == 1) {
            $messages = [
                'legal_business_name.required' => 'legal_business_name is required',   
                'federal_id_number.required' => 'federal_id_number is required',   
                'year_business_established.required' => 'year_business_established is required',   
                'number_employees_full_time.required' => 'number_employees_full_time is required',   
                'primary_business_phone.required' => 'primary_business_phone is required',   
                'primary_business_type_id.required' => 'primary_business_type_id is required',   
                'naics_id.required' => 'naics_id is required',   
                'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
                'principal_street_address.required' => 'principal_street_address is required',   
                'principal_city.required' => 'principal_city is required',   
                'principal_country.required' => 'principal_country is required',   
                'principal_state_id.required' => 'principal_state_id is required',   
                'principal_zip_code.required' => 'principal_zip_code is required',   

                'mailing_address.required' => 'mailing_address is required',   
                'mailing_city.required' => 'mailing_city is required',   
                'mailing_state.required' => 'mailing_state is required',   
                'mailing_zip_code.required' => 'mailing_zip_code is required',   
                'signatory_name.required' => 'signatory_name is required',   
                'signatory_last_name.required' => 'signatory_last_name is required',   
                'signatory_job_title.required' => 'signatory_job_title is required',   
                'signatory_email.required' => 'signatory_email is required',   
                'signatory_phone.required' => 'signatory_phone is required',   
                
            ];

            $request->validate([
                'mailing_address' => 'required|min:600',
                'mailing_city' => 'required|min:200',
                'mailing_state' => 'required|min:100',
                'mailing_zip_code' => 'required|min:8',
                'signatory_name' => 'required|min:100',
                'signatory_last_name' => 'required|min:100',
                'signatory_job_title' => 'required|min:100',
                'signatory_email' => 'required|min:100',
                'signatory_phone' => 'required|min:8',

                'legal_business_name' => 'required|min:600',
                'federal_id_number' => 'required|min:9',
                'year_business_established' => 'required|min:4',
                'number_employees_full_time' => 'required|min:10',
                'primary_business_phone' => 'required|min:8',
                'primary_business_type_id' => 'required|min:8',
                'naics_id' => 'required|min:8',
                'year_end_gross_company_income' => 'required|min:4',
                'principal_street_address' => 'required|min:600',
                'principal_city' => 'required|min:600',
                'principal_country' => 'required|min:600',
                'principal_state_id' => 'required|min:8',
                'principal_zip_code' => 'required|min:5',

              ], $messages);
      
        }



        if ($mailing_address_same_above == 0 && $signed_all_documents == 1 && $add_contact_person == 0) {
            $messages = [
                'legal_business_name.required' => 'legal_business_name is required',   
                'federal_id_number.required' => 'federal_id_number is required',   
                'year_business_established.required' => 'year_business_established is required',   
                'number_employees_full_time.required' => 'number_employees_full_time is required',   
                'primary_business_phone.required' => 'primary_business_phone is required',   
                'primary_business_type_id.required' => 'primary_business_type_id is required',   
                'naics_id.required' => 'naics_id is required',   
                'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
                'principal_street_address.required' => 'principal_street_address is required',   
                'principal_city.required' => 'principal_city is required',   
                'principal_country.required' => 'principal_country is required',   
                'principal_state_id.required' => 'principal_state_id is required',   
                'principal_zip_code.required' => 'principal_zip_code is required',   

                'mailing_address.required' => 'mailing_address is required',   
                'mailing_city.required' => 'mailing_city is required',   
                'mailing_state.required' => 'mailing_state is required',   
                'mailing_zip_code.required' => 'mailing_zip_code is required',   


                'primary_contact_name.required' => 'primary_contact_name is required',   
                'primary_contact_last_name.required' => 'primary_contact_last_name is required',   
                'primary_contact_job_title.required' => 'primary_contact_job_title is required',   
                'primary_contact_email.required' => 'primary_contact_email is required',   
                'primary_contact_phone.required' => 'primary_contact_phone is required',   
                'primary_contact_cellphone.required' => 'primary_contact_cellphone is required',   
            ];

            $request->validate([
                'legal_business_name' => 'required|min:600',
                'federal_id_number' => 'required|min:9',
                'year_business_established' => 'required|min:4',
                'number_employees_full_time' => 'required|min:10',
                'primary_business_phone' => 'required|min:8',
                'primary_business_type_id' => 'required|min:8',
                'naics_id' => 'required|min:8',
                'year_end_gross_company_income' => 'required|min:4',
                'principal_street_address' => 'required|min:600',
                'principal_city' => 'required|min:600',
                'principal_country' => 'required|min:600',
                'principal_state_id' => 'required|min:8',
                'principal_zip_code' => 'required|min:5',

                'mailing_address' => 'required|min:600',
                'mailing_city' => 'required|min:200',
                'mailing_state' => 'required|min:100',
                'mailing_zip_code' => 'required|min:8',


                'primary_contact_name' => 'required|min:100',
                'primary_contact_last_name' => 'required|min:100',
                'primary_contact_job_title' => 'required|min:100',
                'primary_contact_email' => 'required|min:100',
                'primary_contact_phone' => 'required|min:8',
                'primary_contact_cellphone' => 'required|min:8',
              ], $messages);
      
        }


        
        if ($mailing_address_same_above == 0 && $signed_all_documents == 1 && $add_contact_person == 1) {
            $messages = [
                'legal_business_name.required' => 'legal_business_name is required',   
                'federal_id_number.required' => 'federal_id_number is required',   
                'year_business_established.required' => 'year_business_established is required',   
                'number_employees_full_time.required' => 'number_employees_full_time is required',   
                'primary_business_phone.required' => 'primary_business_phone is required',   
                'primary_business_type_id.required' => 'primary_business_type_id is required',   
                'naics_id.required' => 'naics_id is required',   
                'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
                'principal_street_address.required' => 'principal_street_address is required',   
                'principal_city.required' => 'principal_city is required',   
                'principal_country.required' => 'principal_country is required',   
                'principal_state_id.required' => 'principal_state_id is required',   
                'principal_zip_code.required' => 'principal_zip_code is required',   

                'mailing_address.required' => 'mailing_address is required',   
                'mailing_city.required' => 'mailing_city is required',   
                'mailing_state.required' => 'mailing_state is required',   
                'mailing_zip_code.required' => 'mailing_zip_code is required',   

            ];

            $request->validate([
                'legal_business_name' => 'required|min:600',
                'federal_id_number' => 'required|min:9',
                'year_business_established' => 'required|min:4',
                'number_employees_full_time' => 'required|min:10',
                'primary_business_phone' => 'required|min:8',
                'primary_business_type_id' => 'required|min:8',
                'naics_id' => 'required|min:8',
                'year_end_gross_company_income' => 'required|min:4',
                'principal_street_address' => 'required|min:600',
                'principal_city' => 'required|min:600',
                'principal_country' => 'required|min:600',
                'principal_state_id' => 'required|min:8',
                'principal_zip_code' => 'required|min:5',

                'mailing_address' => 'required|min:600',
                'mailing_city' => 'required|min:200',
                'mailing_state' => 'required|min:100',
                'mailing_zip_code' => 'required|min:8',

              ], $messages);
      
        }


        
        if ($mailing_address_same_above == 1 && $signed_all_documents == 0 && $add_contact_person == 0) {
            $messages = [
                'legal_business_name.required' => 'legal_business_name is required',   
                'federal_id_number.required' => 'federal_id_number is required',   
                'year_business_established.required' => 'year_business_established is required',   
                'number_employees_full_time.required' => 'number_employees_full_time is required',   
                'primary_business_phone.required' => 'primary_business_phone is required',   
                'primary_business_type_id.required' => 'primary_business_type_id is required',   
                'naics_id.required' => 'naics_id is required',   
                'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
                'principal_street_address.required' => 'principal_street_address is required',   
                'principal_city.required' => 'principal_city is required',   
                'principal_country.required' => 'principal_country is required',   
                'principal_state_id.required' => 'principal_state_id is required',   
                'principal_zip_code.required' => 'principal_zip_code is required',   

                'signatory_name.required' => 'signatory_name is required',   
                'signatory_last_name.required' => 'signatory_last_name is required',   
                'signatory_job_title.required' => 'signatory_job_title is required',   
                'signatory_email.required' => 'signatory_email is required',   
                'signatory_phone.required' => 'signatory_phone is required',   

                'primary_contact_name.required' => 'primary_contact_name is required',   
                'primary_contact_last_name.required' => 'primary_contact_last_name is required',   
                'primary_contact_job_title.required' => 'primary_contact_job_title is required',   
                'primary_contact_email.required' => 'primary_contact_email is required',   
                'primary_contact_phone.required' => 'primary_contact_phone is required',   
                'primary_contact_cellphone.required' => 'primary_contact_cellphone is required',   
            ];

            $request->validate([
                'legal_business_name' => 'required|min:600',
                'federal_id_number' => 'required|min:9',
                'year_business_established' => 'required|min:4',
                'number_employees_full_time' => 'required|min:10',
                'primary_business_phone' => 'required|min:8',
                'primary_business_type_id' => 'required|min:8',
                'naics_id' => 'required|min:8',
                'year_end_gross_company_income' => 'required|min:4',
                'principal_street_address' => 'required|min:600',
                'principal_city' => 'required|min:600',
                'principal_country' => 'required|min:600',
                'principal_state_id' => 'required|min:8',
                'principal_zip_code' => 'required|min:5',

                'signatory_name' => 'required|min:100',
                'signatory_last_name' => 'required|min:100',
                'signatory_job_title' => 'required|min:100',
                'signatory_email' => 'required|min:100',
                'signatory_phone' => 'required|min:8',

                'primary_contact_name' => 'required|min:100',
                'primary_contact_last_name' => 'required|min:100',
                'primary_contact_job_title' => 'required|min:100',
                'primary_contact_email' => 'required|min:100',
                'primary_contact_phone' => 'required|min:8',
                'primary_contact_cellphone' => 'required|min:8',
              ], $messages);
      
        }


        if ($mailing_address_same_above == 1 && $signed_all_documents == 0 && $add_contact_person == 1) {
            $messages = [
                'legal_business_name.required' => 'legal_business_name is required',   
                'federal_id_number.required' => 'federal_id_number is required',   
                'year_business_established.required' => 'year_business_established is required',   
                'number_employees_full_time.required' => 'number_employees_full_time is required',   
                'primary_business_phone.required' => 'primary_business_phone is required',   
                'primary_business_type_id.required' => 'primary_business_type_id is required',   
                'naics_id.required' => 'naics_id is required',   
                'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
                'principal_street_address.required' => 'principal_street_address is required',   
                'principal_city.required' => 'principal_city is required',   
                'principal_country.required' => 'principal_country is required',   
                'principal_state_id.required' => 'principal_state_id is required',   
                'principal_zip_code.required' => 'principal_zip_code is required',   

                'signatory_name.required' => 'signatory_name is required',   
                'signatory_last_name.required' => 'signatory_last_name is required',   
                'signatory_job_title.required' => 'signatory_job_title is required',   
                'signatory_email.required' => 'signatory_email is required',   
                'signatory_phone.required' => 'signatory_phone is required',   

            ];

            $request->validate([

                'legal_business_name' => 'required|min:600',
                'federal_id_number' => 'required|min:9',
                'year_business_established' => 'required|min:4',
                'number_employees_full_time' => 'required|min:10',
                'primary_business_phone' => 'required|min:8',
                'primary_business_type_id' => 'required|min:8',
                'naics_id' => 'required|min:8',
                'year_end_gross_company_income' => 'required|min:4',
                'principal_street_address' => 'required|min:600',
                'principal_city' => 'required|min:600',
                'principal_country' => 'required|min:600',
                'principal_state_id' => 'required|min:8',
                'principal_zip_code' => 'required|min:5',
                
                'signatory_name' => 'required|min:100',
                'signatory_last_name' => 'required|min:100',
                'signatory_job_title' => 'required|min:100',
                'signatory_email' => 'required|min:100',
                'signatory_phone' => 'required|min:8',

              ], $messages);
      
        }


        if ($mailing_address_same_above == 1 && $signed_all_documents == 1 && $add_contact_person == 0) {
            $messages = [
                'legal_business_name.required' => 'legal_business_name is required',   
                'federal_id_number.required' => 'federal_id_number is required',   
                'year_business_established.required' => 'year_business_established is required',   
                'number_employees_full_time.required' => 'number_employees_full_time is required',   
                'primary_business_phone.required' => 'primary_business_phone is required',   
                'primary_business_type_id.required' => 'primary_business_type_id is required',   
                'naics_id.required' => 'naics_id is required',   
                'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
                'principal_street_address.required' => 'principal_street_address is required',   
                'principal_city.required' => 'principal_city is required',   
                'principal_country.required' => 'principal_country is required',   
                'principal_state_id.required' => 'principal_state_id is required',   
                'principal_zip_code.required' => 'principal_zip_code is required',   

                'primary_contact_name.required' => 'primary_contact_name is required',   
                'primary_contact_last_name.required' => 'primary_contact_last_name is required',   
                'primary_contact_job_title.required' => 'primary_contact_job_title is required',   
                'primary_contact_email.required' => 'primary_contact_email is required',   
                'primary_contact_phone.required' => 'primary_contact_phone is required',   
                'primary_contact_cellphone.required' => 'primary_contact_cellphone is required',   
            ];

            $request->validate([
                'legal_business_name' => 'required|min:600',
                'federal_id_number' => 'required|min:9',
                'year_business_established' => 'required|min:4',
                'number_employees_full_time' => 'required|min:10',
                'primary_business_phone' => 'required|min:8',
                'primary_business_type_id' => 'required|min:8',
                'naics_id' => 'required|min:8',
                'year_end_gross_company_income' => 'required|min:4',
                'principal_street_address' => 'required|min:600',
                'principal_city' => 'required|min:600',
                'principal_country' => 'required|min:600',
                'principal_state_id' => 'required|min:8',
                'principal_zip_code' => 'required|min:5',

                'primary_contact_name' => 'required|min:100',
                'primary_contact_last_name' => 'required|min:100',
                'primary_contact_job_title' => 'required|min:100',
                'primary_contact_email' => 'required|min:100',
                'primary_contact_phone' => 'required|min:8',
                'primary_contact_cellphone' => 'required|min:8',
              ], $messages);
      
        }



  
        //dd($mailing_address_same_above);

/*
        $messages = [
            'legal_business_name.required' => 'legal_business_name is required',          
            'federal_id_number.required' => 'federal_id_number is required',          
            'year_business_established.required' => 'year business is required',          
            'number_employees_full_time.required' => 'Number employees full time is required',   
            'primary_business_phone.required' => 'primary_business_phone is required',   
            'primary_business_type_id.required' => 'primary_business_type_id is required',   
            'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
            'principal_street_address.required' => 'principal_street_address is required',   
            'principal_city.required' => 'principal_city is required',   
            'principal_country.required' => 'principal_country is required',   
            'principal_state_id.required' => 'principal_state_id is required',   
            'principal_zip_code.required' => 'principal_zip_code is required',   
            'mailing_address.required' => 'mailing_address is required',   
            'mailing_city.required' => 'mailing_city is required',   
            'mailing_state.required' => 'mailing_state is required',   
            'mailing_zip_code.required' => 'mailing_zip_code is required',   
            'primary_contact_name.required' => 'primary_contact_name is required',   
            'primary_contact_last_name.required' => 'primary_contact_last_name is required',   
            'primary_contact_job_title.required' => 'primary_contact_job_title is required',   
            'primary_contact_email.required' => 'primary_contact_email is required',   
            'primary_contact_phone.required' => 'primary_contact_phone is required',
            'primary_contact_cellphone.required' => 'primary_contact_cellphone is required',            

            // 'telefono.min'  => 'Nombre debe tener por lo menos 8 digitos',
            // 'email.required' => 'Email es requerido'
  
        ];
  
        $request->validate([
          'legal_business_name' => 'required|min:200',
          'federal_id_number' => 'required|min:9',
          'year_business_established' => 'required|min:4',
          'number_employees_full_time' => 'required|min:1',
          'primary_business_phone' => 'required|min:8',
          'primary_business_type_id' => 'required|min:8',
          'year_end_gross_company_income' => 'required|min:4',
          'principal_street_address' => 'required|min:200',
          'principal_city' => 'required|min:100',
          'principal_country' => 'required|min:100',
          'principal_state_id' => 'required|min:8',
          'principal_zip_code' => 'required|min:8',
          'mailing_address' => 'required|min:500',
          'mailing_city' => 'required|min:200',
          'mailing_state' => 'required|min:100',
          'mailing_zip_code' => 'required|min:8',
          'primary_contact_name' => 'required|min:200',
          'primary_contact_last_name' => 'required|min:200',
          'primary_contact_job_title' => 'required|min:500',
          'primary_contact_email' => 'required|min:100',
          'primary_contact_phone' => 'required|min:8',
          'primary_contact_cellphone' => 'required|min:8',

          // 'email' => 'required' 
        ], $messages);
*/
        


/*
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
        } else {
            $employer->mailing_address_same_above = 1;
        }

        $employer->primary_contact_name = $request->get('primary_contact_name');
        $employer->primary_contact_last_name = $request->get('primary_contact_last_name');
        $employer->primary_contact_job_title = $request->get('primary_contact_job_title');
        $employer->primary_contact_email = $request->get('primary_contact_email');
        $employer->primary_contact_phone = $request->get('primary_contact_phone');
        $employer->primary_contact_cellphone = $request->get('primary_contact_cellphone');

        $add_contact_person = $request->get('add_contact_person');

        


        // $employer->add_contact_person = $request->get('add_contact_person');
        // $employer->additional_contact = $request->get('additional_contact');
        // $employer->additional_contact_job_title = $request->get('additional_contact_job_title');
        // $employer->additional_contact_email = $request->get('additional_contact_email');
        // $employer->additional_contact_phone = $request->get('additional_contact_phone');
        // $employer->additional_contact_cellphone = $request->get('additional_contact_cellphone');

        $employer->signed_all_documents = $request->get('signed_all_documents');
        if ($request->get('signed_all_documents') == 0) {
            $employer->signatory_name = $request->get('signatory_name');
            $employer->signatory_last_name = $request->get('signatory_last_name');
            $employer->signatory_job_title = $request->get('signatory_job_title');
            $employer->signatory_email = $request->get('signatory_email');
            $employer->signatory_phone = $request->get('signatory_phone');
        }
        $employer->save();
        */
    }

    public function place_employment($id)
    {

        $states = State::get();
        $worksites = EmployerWorksite::where('employer_id', '=', $id)->get();
        return view('employer.place_employment', ['employer' => Employer::findOrFail($id), 'states' => $states, 'worksites' => $worksites]);
    }

    public function employer_additional_location(Request $request)
    {
        $employer_worksite = new EmployerWorksite();
        $employer_worksite->employer_id = $request->get('employer_id');
        $employer_worksite->street_address = $request->get('street_address');
        $employer_worksite->city_address = $request->get('city_address');
        $employer_worksite->country_address = $request->get('country_address');
        $employer_worksite->state_id_address = $request->get('state_id_address');
        $employer_worksite->zip_code_address = $request->get('zip_code_address');
        $employer_worksite->save();

        $data = EmployerWorksite::where('employer_id', '=', $request->get('employer_id'))->get();

        echo ' <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Street Address</th>
                <th>City address</th>
                <th>Country address</th>
                <th>State</th>
                <th>Zip code address</th>

            </tr>
        </thead>
        <tbody>';




        foreach ($data as $obj) {
            echo '<tr><td>' . $obj->street_address . '</td>';
            echo '<td>' . $obj->city_address . '</td>';
            echo '<td>' . $obj->country_address . '</td>';
            if($obj->state_id_address)
            {
                echo '<td>' . $obj->state->name . '</td>';
            }
            else{
                echo '<td></td>';
            }
            echo '<td>' . $obj->zip_code_address . '</td>';
        }
        echo ' </tr>
    </tbody>
</table>';
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
