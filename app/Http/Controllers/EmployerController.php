<?php

namespace App\Http\Controllers;

use App\Models\catalogue\NaicsCode;
use App\Models\catalogue\NormalBusinessDays;
use App\Models\catalogue\Industry;
use App\Models\catalogue\County;
use App\Models\catalogue\City;
use App\Models\catalogue\CodeZip;

use App\Models\catalogue\CityZip;
use App\Models\Employer;
use App\Models\EmployerWorksite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('administrator') || $user->hasRole('administrator pes')) {
            $employers = Employer::get();
            $estate = ["Cancel", "Active"];
            return view('employer.index', ['employers' => $employers, 'estate' => $estate]);
        } else {

            return redirect('employer/create');
        }
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

/*
        $data = NaicsCode::get();
        $a = array();
        foreach($data  as $obj)
        {
            if(substr($obj->cn_description,-1,200) == 't')
            {
                //echo substr($obj->cn_description,-1,200).'<br>';
                array_push($a,$obj->id);
            }
        }

        $data_update = NaicsCode::whereIn('id',$a)->get();
        foreach($data_update as $obj)
        {
            $naics = NaicsCode::findOrFail($obj->id);
            $naics->cn_description = substr($obj->cn_description, 0,-1);
            $naics->update();
        }
        dd( $a);
        */

       /* NaicsCode::whereIn('id',$a)
        ->update(['active' => 1]);
        dd($data);*/


        //dd(auth()->user()->id);
        $user =  auth()->user();
        $employer = $user->user_has_employer->first();

        if ($employer) {
            return redirect('employer/' . $employer->id . '/edit');
        }
        $user = auth()->user();
        $industries = Industry::get();
        $states =  CityZip::select('czc_state_fips as id','czc_state as name')
        ->groupBy('czc_state_fips','czc_state')
        ->get();

        //$worksites = EmployerWorksite::where('employer_id', '=', $id)->get();
        $normal_business_days = NormalBusinessDays::get();

        return view('employer.create', [
            'industries' => $industries, 'states' => $states, 'user' => $user, 'normal_business_days' => $normal_business_days, 'user' => $user
        ]);
    }



    public function store(Request $request)
    {





        $messages = [
            'legal_business_name.required' => 'legal_business_name is required',
            'federal_id_number.required' => 'federal_id_number is required',
            'year_business_established.required' => 'year_business_established is required',
            'number_employees_full_time.required' => 'number_employees_full_time is required',
            'primary_business_phone.required' => 'primary_business_phone is required',
            'industry_id.required' => 'industry_id is required',
            'naics_id.required' => 'naics_id is required',
            'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',
        ];



        $request->validate([
            'legal_business_name' => 'required|min:4',
            'federal_id_number' => 'required|min:9',
            'year_business_established' => 'required|min:4',
            'number_employees_full_time' => 'required|min:1',
            'primary_business_phone' => 'required|min:10',
            'industry_id' => 'required|min:0',
            'naics_id' => 'required|min:0',
            'year_end_gross_company_income' => 'required',
          ], $messages);



          //dd($request);

        //dd($request);

        /* validations  */

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

        $employer->catalog_industry_id = $request->get('industry_id');
        $employer->naics_id = $request->get('naics_id');

        if ($request->get('naics_code') == 6) {
            $employer->naics_code = $request->get('naics_code');
        }
        $employer->year_end_gross_company_income = $request->get('year_end_gross_company_income');
        $employer->year_end_net_company_income = $request->get('year_end_net_company_income');

        $employer->save();
        $employer->user_has_employer()->attach(auth()->user()->id);
        session_start();
        session(['action' => '3']);
        Alert::success('Ok', 'Record saved');
        return redirect('employer/' . $employer->id . '/edit');
        //return back();

    }


    public function get_naics_code($id)
    {
        return NaicsCode::where('industry_id', '=', $id)->get();
    }


    public function activate(Request $request)
    {
        $employer = Employer::findOrFail($request->get('id'));
        $employer->validated = 1;
        $employer->save();
        Alert::success('Ok', 'Record saved');
        return redirect('employer/');
    }


    public function edit($id)
    {



        $employer = Employer::findOrFail($id);



        $naics = NaicsCode::where('industry_id', '=', $employer->naicsCode->industry_id)->get();

        $states =  CityZip::select('czc_state_fips as id','czc_state as name')
        ->groupBy('czc_state_fips','czc_state')
        ->get();

        $worksites_main = EmployerWorksite::where('employer_id', '=', $id)->where('address_type_id','=','3')->first();
        $worksites_additional = EmployerWorksite::where('employer_id', '=', $id)->where('address_type_id','=','4')->get();

       // dd($worksites_additional);
        $normal_business_days = NormalBusinessDays::get();
        $industries = Industry::get();



        if($employer->principal_state_id != null)
        {
            $counties_principal = County::where('state','=',$employer->principal_state_id)->get();
            $county_principal = County::findOrFail($employer->principal_county_id);
            $cities_principal = City::where('state','=',$county_principal->state)->where('county','=',$county_principal->name)->get();
            $city_principal = City::findOrFail($employer->principal_city_id);
            $codes_zip_principal = CodeZip::where('czc_state_fips','=',$city_principal->state)->where('czc_county','=',$city_principal->county)->where('czc_city','=',$city_principal->name)->get();


            $counties_mailing = County::where('state','=',$employer->mailing_state_id)->get();
            $county_mailing = County::findOrFail($employer->mailing_county_id);
            $cities_mailing = City::where('state','=',$county_mailing->state)->where('county','=',$county_mailing->name)->get();
            $city_mailing = City::findOrFail($employer->mailing_city_id);
            $codes_zip_mailing = CodeZip::where('czc_state_fips','=',$city_mailing->state)->where('czc_county','=',$city_mailing->county)->where('czc_city','=',$city_mailing->name)->get();

        }
        else{
            $counties_principal = null;
            $county_principal = null;
            $cities_principal = null;
            $city_principal = null;
            $codes_zip_principal = null;


            $counties_mailing = null;
            $county_mailing = null;
            $cities_mailing = null;
            $city_mailing = null;
            $codes_zip_mailing = null;


        }

        $work_sites_main = EmployerWorksite::where('employer_id','=',$id)->where('address_type_id','=',3)->first();

        $work_sites_additional = EmployerWorksite::where('employer_id','=',$id)->where('address_type_id','=',4)->get();




        if($work_sites_main)
        {
            //dd("hola uno");
            $counties_work_sites = County::where('state','=',$work_sites_main->state_id_address)->get();
            $county_work_site = County::findOrFail($work_sites_main->county_id);
            $cities_work_site = City::where('state','=',$work_sites_main->state_id_address)->where('county','=',$county_work_site->name)->get();
            $city_work_site = City::findOrFail($work_sites_main->city_id);
            $codes_zip_work_site = CodeZip::where('czc_state_fips','=',$work_sites_main->state_id_address)->where('czc_county','=',$county_work_site->name)->where('czc_city','=',$city_work_site->name)->get();
        }
        else{
            //dd("hola dos");
            $counties_work_sites = null;
            $cities_work_site =  null;
            $city_work_site = null;
            $codes_zip_work_site = null;

        }



        //$principal_states = State::get();

        //dd($employer);

        return view('employer.edit', [
            'employer' => $employer, 'states' => $states, 'worksites_main' => $worksites_main, 'worksites_additional' => $worksites_additional,
            'normal_business_days' => $normal_business_days, 'industries' => $industries, 'naics' => $naics,
            'counties_principal' => $counties_principal, 'cities_principal' => $cities_principal,  'codes_zip_principal' => $codes_zip_principal,
            'counties_mailing' => $counties_mailing, 'cities_mailing' => $cities_mailing,  'codes_zip_mailing' => $codes_zip_mailing,
            'work_sites_main'=>$work_sites_main, 'work_sites_additional'=>$work_sites_additional, 'counties_work_sites'=>$counties_work_sites, 'cities_work_site'=>$cities_work_site, 'codes_zip_work_site'=>$codes_zip_work_site
        ]);

    }


    public function get_counties($id){

        $counties = County::where('state','=',$id)->get();

        return response()->json(
            $counties,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );



    }

    public function get_counties_mailing($id){

        $counties = County::where('state','=',$id)->get();

        return response()->json(
            $counties_mailing,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );



    }

    public function get_counties_worksite($id){

        $counties = County::where('state','=',$id)->get();

        return response()->json(
            $counties_worksite,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );



    }


    public function get_cities($id){

        //dd($id);

        $county = County::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $cities = City::where('state','=',$county->state)->where('county','=',$county->name)->get();

        return response()->json(
            $cities,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }

    public function get_cities_mailing($id){

        //dd($id);

        $county = County::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $cities = City::where('state','=',$county->state)->where('county','=',$county->name)->get();

        return response()->json(
            $cities_mailing,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }


    public function get_cities_worksite($id){

        //dd($id);

        $county = County::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $cities = City::where('state','=',$county->state)->where('county','=',$county->name)->get();

        return response()->json(
            $cities_worksite,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }


    public function get_zipcodes($id){

        //dd($id);

        $cities = City::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $codes_zip = CodeZip::where('czc_state_fips','=',$cities->state)->where('czc_county','=',$cities->county)->where('czc_city','=',$cities->name)->get();

        //dd($codes_zip);

        return response()->json(
            $codes_zip,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }


    public function get_zipcodes_mailing($id){

        //dd($id);

        $cities = City::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $codes_zip = CodeZip::where('czc_state_fips','=',$cities->state)->where('czc_county','=',$cities->county)->where('czc_city','=',$cities->name)->get();

        //dd($codes_zip);

        return response()->json(
            $codes_zip_mailing,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }


    public function get_zipcodes_worksite($id){

        //dd($id);

        $cities = City::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $codes_zip = CodeZip::where('czc_state_fips','=',$cities->state)->where('czc_county','=',$cities->county)->where('czc_city','=',$cities->name)->get();

        //dd($codes_zip);

        return response()->json(
            $codes_zip_worksite,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }

    public function update(Request $request, $id)
    {


        $messages = [
            'legal_business_name.required' => 'legal_business_name is required',
            'federal_id_number.required' => 'federal_id_number is required',
            'year_business_established.required' => 'year_business_established is required',
            'number_employees_full_time.required' => 'number_employees_full_time is required',
            'primary_business_phone.required' => 'primary_business_phone is required',
            'industry_id.required' => 'industry_id is required',
            'naics_id.required' => 'naics_id is required',
            'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',
        ];



        $request->validate([
            'legal_business_name' => 'required|min:4',
            'federal_id_number' => 'required|min:9',
            'year_business_established' => 'required|min:4',
            'number_employees_full_time' => 'required|min:1',
            'primary_business_phone' => 'required|min:10',
            'industry_id' => 'required|min:0',
            'naics_id' => 'required|min:0',
            'year_end_gross_company_income' => 'required|min:4',
          ], $messages);


          //dd($request->get('has_participate_h2b'));
          //dd($request->get('naics_id'));



        $employer =  Employer::findOrFail($id);
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
        }else{
            $employer->quantity_year_has_participate_h2b = null;
        }

        $employer->catalog_industry_id = $request->get('industry_id');


        if ($request->get('naics_code') != 6)
        {
            $employer->naics_id = $request->get('naics_id');
        }else  if ($request->get('naics_code') == 6) {
            $employer->naics_code = $request->get('naics_code');
        }

        $employer->year_end_gross_company_income = $request->get('year_end_gross_company_income');
        $employer->year_end_net_company_income = $request->get('year_end_net_company_income');
        //$employer->users_id = auth()->user()->id;

        $employer->save();

        Alert::info('', 'Record saved');
        session_start();
        session(['action' => '3']);
      //dd(session('action'));

        return redirect('employer/' . $employer->id . '/edit')->with('message', 'Login Failed');
    }


    public function employer_place_of_business(Request $request)
    {




        $mailing_address_same_above = $request['mailing_address_same_above'];

        if ($mailing_address_same_above == 'on') {
            $mailing_address_same_above = 1;
        }else{
            $mailing_address_same_above = 0;
        }

        //dd($mailing_address_same_above);
        //dd($request);

        //dd($mailing_address_same_above);

        //dd($mailing_address_same_above);

        if ($mailing_address_same_above == 0) {



            $messages = [
                'principal_street_address.required' => 'principal_street_address is required',
                'principal_city_id.required' => 'principal_city_id is required',
                'principal_county_id.required' => 'principal_county_id is required',
                'principal_state_id.required' => 'principal_state_id is required',
                'principal_zip_code.required' => 'principal_zip_code is required',

                'mailing_address.required' => 'mailing_address is required',
                'mailing_city.required' => 'mailing_city is required',
                'mailing_state_id.required' => 'mailing_state_id is required',
                'mailing_zip_code.required' => 'mailing_zip_code is required'

            ];

            //dd("uno");


            $request->validate([
                'principal_street_address' => 'required|min:6',
                'principal_city_id' => 'required|min:0',
                'principal_county_id' => 'required|min:0',
                'principal_state_id' => 'required|min:0',
                'principal_zip_code' => 'required|min:5',

                'mailing_street_address' => 'required|min:6',
                'mailing_city_id' => 'required|min:0',
                'mailing_county_id' => 'required|min:0',
                'mailing_state_id' => 'required|min:0',
                'mailing_zip_code' => 'required|min:5',
              ], $messages);

              //dd("dos");

              //dd($messages);

        }else{
            $messages = [
                'principal_street_address.required' => 'principal_street_address is required',
                'principal_city_id.required' => 'principal_city is required',
                'principal_county_id.required' => 'principal_county_id is required',
                'principal_state_id.required' => 'principal_state_id is required',
                'principal_zip_code.required' => 'principal_zip_code is required',

            ];



            $request->validate([
                'principal_street_address' => 'required|min:6',
                'principal_city_id' => 'required|min:0',
                'principal_county_id' => 'required|min:0',
                'principal_state_id' => 'required|min:0',
                'principal_zip_code' => 'required|min:5',

              ], $messages);

        }




        // Alert::info('', 'Record saved');
        // session_start();
        // session(['action' => '2']);
        //dd($request);

        //dd$request);
        //dd($messages);
        //dd($request);

        $employer = Employer::findOrFail($request->get('id'));

        $employer->principal_street_address = $request->get('principal_street_address');
        $employer->principal_city_id = $request->get('principal_city_id');
        $employer->principal_county_id = $request->get('principal_county_id');
        $employer->principal_state_id = $request->get('principal_state_id');
        $employer->principal_zip_code = $request->get('principal_zip_code');


        //alert('uno');

        // $employerWorkSite = new EmployerWorksite();
        // $employerWorkSite->employer_id = $employer->id;
        // $employerWorkSite->type_address_id = 1;
        // $employerWorkSite->state_id = $request->get('principal_state_id');
        // $employerWorkSite->county_id = $request->get('principal_county_id');
        // $employerWorkSite->city_id = $request->get('principal_city_id');
        // $employerWorkSite->zip_code = $request->get('principal_zip_code');
        // $employerWorkSite->street_address = $request->get('principal_street_address');
        // $employerWorkSite->save();

        //alert('dos');



        if ($mailing_address_same_above == 0) {
            $employer->mailing_address_same_above = 0;
            $employer->mailing_street_address = $request->get('mailing_street_address');
            $employer->mailing_state_id = $request->get('mailing_state_id');
            $employer->mailing_county_id = $request->get('mailing_county_id');
            $employer->mailing_city_id = $request->get('mailing_city_id');
            $employer->mailing_zip_code = $request->get('mailing_zip_code');


            // $employerWorkSite = new EmployerWorksite();
            // $employerWorkSite->employer_id = $employer->id;
            // $employerWorkSite->type_address_id = 2;
            // $employerWorkSite->state_id = $request->get('mailing_state_id');
            // $employerWorkSite->county_id = $request->get('mailing_county_id');
            // $employerWorkSite->city_id = $request->get('mailing_city_id');
            // $employerWorkSite->zip_code = $request->get('mailing_zip_code');
            // $employerWorkSite->street_address = $request->get('mailing_street_address');
            // $employerWorkSite->save();

        } else {
            $employer->mailing_address_same_above = 1;
            $employer->mailing_street_address = $request->get('principal_street_address');
            $employer->mailing_state_id = $request->get('principal_state_id');
            $employer->mailing_county_id = $request->get('principal_county_id');
            $employer->mailing_city_id = $request->get('principal_city_id');
            $employer->mailing_zip_code = $request->get('principal_zip_code');
        }
        Alert::info('', 'Record saved');
        session_start();
        session(['action' => '4']);
        $employer->update();



        return redirect('employer/' . $employer->id . '/edit');
        //return back();

    }


    public function employer_contact_information(Request $request)
    {

        //dd($request);

        $signed_all_documents = $request->get('signed_all_documents');

        if ($signed_all_documents == 'on') {
            $signed_all_documents = 1;
        }else{
            $signed_all_documents = 0;
        }

        $is_main_worksite_location = $request->get('is_main_worksite_location');

        if ($is_main_worksite_location == 'on') {
            $is_main_worksite_location = 1;
        }else{
            $is_main_worksite_location = 0;
        }




        //dd($is_main_worksite_location);

        if ($is_main_worksite_location == '0') {


            if ($signed_all_documents == '0') {

                $messages = [
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

                    'main_worksite_location.required' => 'main_worksite_location is required',
                    'main_worksite_city_id.required' => 'main_worksite_city_id is required',
                    'main_worksite_county_id.required' => 'main_worksite_county_id is required',
                    'main_worksite_state_id.required' => 'main_worksite_state_id is required',
                    'main_worksite_zip_code.required' => 'main_worksite_zip_code is required',

                ];

                //dd($request);
                //dd($request);
                //return back();

                $request->validate([
                    'signatory_name' => 'required|min:4',
                    'signatory_last_name' => 'required|min:4',
                    'signatory_job_title' => 'required|min:6',
                    'signatory_email' => 'required|min:6',
                    'signatory_phone' => 'required|min:10',

                    'primary_contact_name' => 'required|min:4',
                    'primary_contact_last_name' => 'required|min:4',
                    'primary_contact_job_title' => 'required|min:10',
                    'primary_contact_email' => 'required|min:10',
                    'primary_contact_phone' => 'required|min:10',
                    'primary_contact_cellphone' => 'required|min:10',

                    'main_worksite_location' => 'required|min:4',
                    'main_worksite_city_id' => 'required|min:0',
                    'main_worksite_county_id' => 'required|min:0',
                    'main_worksite_state_id' => 'required|min:0',
                    'main_worksite_zip_code' => 'required|min:5',

                  ], $messages);

            }else{

                $messages = [

                    'primary_contact_name.required' => 'primary_contact_name is required',
                    'primary_contact_last_name.required' => 'primary_contact_last_name is required',
                    'primary_contact_job_title.required' => 'primary_contact_job_title is required',
                    'primary_contact_email.required' => 'primary_contact_email is required',
                    'primary_contact_phone.required' => 'primary_contact_phone is required',
                    'primary_contact_cellphone.required' => 'primary_contact_cellphone is required',

                ];


                $request->validate([

                    'primary_contact_name' => 'required|min:4',
                    'primary_contact_last_name' => 'required|min:4',
                    'primary_contact_job_title' => 'required|min:10',
                    'primary_contact_email' => 'required|min:10',
                    'primary_contact_phone' => 'required|min:10',
                    'primary_contact_cellphone' => 'required|min:10',

                  ], $messages);
            }


        }else{
            if ($signed_all_documents == '0') {

                $messages = [
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
                    'signatory_name' => 'required|min:4',
                    'signatory_last_name' => 'required|min:4',
                    'signatory_job_title' => 'required|min:6',
                    'signatory_email' => 'required|min:6',
                    'signatory_phone' => 'required|min:10',

                    'primary_contact_name' => 'required|min:4',
                    'primary_contact_last_name' => 'required|min:4',
                    'primary_contact_job_title' => 'required|min:10',
                    'primary_contact_email' => 'required|min:10',
                    'primary_contact_phone' => 'required|min:10',
                    'primary_contact_cellphone' => 'required|min:10',

                  ], $messages);
            }else{

                $messages = [

                    'primary_contact_name.required' => 'primary_contact_name is required',
                    'primary_contact_last_name.required' => 'primary_contact_last_name is required',
                    'primary_contact_job_title.required' => 'primary_contact_job_title is required',
                    'primary_contact_email.required' => 'primary_contact_email is required',
                    'primary_contact_phone.required' => 'primary_contact_phone is required',
                    'primary_contact_cellphone.required' => 'primary_contact_cellphone is required',

                ];


                $request->validate([

                    'primary_contact_name' => 'required|min:4',
                    'primary_contact_last_name' => 'required|min:4',
                    'primary_contact_job_title' => 'required|min:10',
                    'primary_contact_email' => 'required|min:10',
                    'primary_contact_phone' => 'required|min:10',
                    'primary_contact_cellphone' => 'required|min:10',

                  ], $messages);
            }
        }

        //dd($request);




        $employer = Employer::findOrFail($request->get('id'));
        $employer->primary_contact_name = $request->get('primary_contact_name');
        $employer->primary_contact_last_name = $request->get('primary_contact_last_name');
        $employer->primary_contact_job_title = $request->get('primary_contact_job_title');
        $employer->primary_contact_email = $request->get('primary_contact_email');
        $employer->primary_contact_phone = $request->get('primary_contact_phone');
        $employer->primary_contact_cellphone = $request->get('primary_contact_cellphone');



        $employer->signed_all_documents = $signed_all_documents;
        if ($signed_all_documents == 0) {
            $employer->signatory_name = $request->get('signatory_name');
            $employer->signatory_last_name = $request->get('signatory_last_name');
            $employer->signatory_job_title = $request->get('signatory_job_title');
            $employer->signatory_email = $request->get('signatory_email');
            $employer->signatory_phone = $request->get('signatory_phone');
        } else {

            $employer->signatory_name = $request->get('primary_contact_name');
            $employer->signatory_last_name = $request->get('primary_contact_last_name');
            $employer->signatory_job_title = $request->get('primary_contact_job_title');
            $employer->signatory_email = $request->get('primary_contact_email');
            $employer->signatory_phone = $request->get('primary_contact_phone');

        }


        if ($is_main_worksite_location == '0') {

            $cuenta = EmployerWorksite::where('employer_id', '=', $employer->id)->where('address_type_id', '=', 3)->get()->count();


            if ($cuenta > 0){
                $id_ews = EmployerWorksite::where('employer_id', '=', $employer->id)->where('address_type_id', '=', 3)->get()->first()->id;
                $employerWorkSite =  EmployerWorksite::findOrFail($id_ews);

                $employerWorkSite->employer_id = $employer->id;
                $employerWorkSite->address_type_id = 3; //main worksites
                $employerWorkSite->state_id_address = $request->get('main_worksite_state_id');
                $employerWorkSite->county_id = $request->get('main_worksite_county_id');
                $employerWorkSite->city_id = $request->get('main_worksite_city_id');
                $employerWorkSite->zip_code_address = $request->get('main_worksite_zip_code');
                $employerWorkSite->street_address = $request->get('main_worksite_location');
                $employerWorkSite->update();
            }else{
                $employerWorkSite = new EmployerWorksite();
                $employerWorkSite->employer_id = $employer->id;
                $employerWorkSite->address_type_id = 3; //main worksites
                $employerWorkSite->state_id_address = $request->get('main_worksite_state_id');
                $employerWorkSite->county_id = $request->get('main_worksite_county_id');
                $employerWorkSite->city_id = $request->get('main_worksite_city_id');
                $employerWorkSite->zip_code_address = $request->get('main_worksite_zip_code');
                $employerWorkSite->street_address = $request->get('main_worksite_location');
                $employerWorkSite->save();
            }




        }else{ //sam as principal address

            $cuenta = EmployerWorksite::where('employer_id', '=', $employer->id)->where('address_type_id', '=', 3)->get()->count();




            if ($cuenta > 0){
                $id_ews = EmployerWorksite::where('employer_id', '=', $employer->id)->where('address_type_id', '=', 3)->get()->first()->id;
                $employerWorkSite =  EmployerWorksite::findOrFail($id_ews);

                $principal_state_id = Employer::where('id', '=', $employer->id)->get()->first()->principal_state_id;
                $principal_county_id = Employer::where('id', '=', $employer->id)->get()->first()->principal_county_id;
                $principal_city_id = Employer::where('id', '=', $employer->id)->get()->first()->principal_city_id;
                $principal_zip_code = Employer::where('id', '=', $employer->id)->get()->first()->principal_zip_code;
                $principal_street_address = Employer::where('id', '=', $employer->id)->get()->first()->principal_street_address;

                $employerWorkSite->employer_id = $employer->id;
                $employerWorkSite->address_type_id = 3; //main worksites
                $employerWorkSite->state_id_address = $principal_state_id;
                $employerWorkSite->county_id = $principal_county_id;
                $employerWorkSite->city_id = $principal_city_id;
                $employerWorkSite->zip_code_address = $principal_zip_code;
                $employerWorkSite->street_address = $principal_street_address;
                $employerWorkSite->update();
            }else{

                $principal_state_id = Employer::where('id', '=', $employer->id)->get()->first()->principal_state_id;
                $principal_county_id = Employer::where('id', '=', $employer->id)->get()->first()->principal_county_id;
                $principal_city_id = Employer::where('id', '=', $employer->id)->get()->first()->principal_city_id;
                $principal_zip_code = Employer::where('id', '=', $employer->id)->get()->first()->principal_zip_code;
                $principal_street_address = Employer::where('id', '=', $employer->id)->get()->first()->principal_street_address;

                $employerWorkSite = new EmployerWorksite();
                $employerWorkSite->employer_id = $employer->id;
                $employerWorkSite->address_type_id = 3; //main worksites
                $employerWorkSite->state_id_address = $principal_state_id;
                $employerWorkSite->county_id = $principal_county_id;
                $employerWorkSite->city_id = $principal_city_id;
                $employerWorkSite->zip_code_address = $principal_zip_code;
                $employerWorkSite->street_address = $principal_street_address;
                $employerWorkSite->save();

            }

        }

        $employer->is_main_worksite_location = $is_main_worksite_location;

        Alert::info('', 'Record saved');
        session(['action' => '2']);
        $employer->update();
        return redirect('employer/' . $employer->id . '/edit');
        //return back();
    }


    /*
    public function update(Request $request, $id)
    {
        $employer =  Employer::findOrFail($id);
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
            $employer->naics_code = $request->get('naics_code');
        }
        $employer->year_end_gross_company_income = $request->get('year_end_gross_company_income');
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
        /* $employer->add_contact_person = $request->get('add_contact_person');
        $employer->additional_contact = $request->get('additional_contact');
        $employer->additional_contact_job_title = $request->get('additional_contact_job_title');
        $employer->additional_contact_email = $request->get('additional_contact_email');
        $employer->additional_contact_phone = $request->get('additional_contact_phone');
        $employer->additional_contact_cellphone = $request->get('additional_contact_cellphone');*/

    /*  $employer->signed_all_documents = $request->get('signed_all_documents');
        if ($request->get('signed_all_documents') == 0) {
            $employer->signatory_name = $request->get('signatory_name');
            $employer->signatory_last_name = $request->get('signatory_last_name');
            $employer->signatory_job_title = $request->get('signatory_job_title');
            $employer->signatory_email = $request->get('signatory_email');
            $employer->signatory_phone = $request->get('signatory_phone');
        }
        $employer->update();




        return redirect('employer/' . $employer->id . '/edit');
    }


    public function destroy($id)
    {
        //
    }*/

    public function employer_additional_location(Request $request)
    {
        //dd("hola");

        $employer_id= $request->get('employer_id');
        $state_id_address= $request->get('state_id_address');
        $county_id= $request->get('county_id');
        $city_id= $request->get('city_id');
        $zip_code_address= $request->get('zip_code_address');
        $street_address= $request->get('street_address');


        $employerWorkSite = new EmployerWorksite();
        $employerWorkSite->employer_id = $employer_id;
        $employerWorkSite->address_type_id = 4; //additional worksites
        $employerWorkSite->state_id_address = $state_id_address;
        $employerWorkSite->county_id = $county_id;
        $employerWorkSite->city_id = $city_id;
        $employerWorkSite->zip_code_address = $zip_code_address;
        $employerWorkSite->street_address = $street_address;
        $employerWorkSite->save();

        Alert::info('', 'Record saved');
        session(['action' => '2']);
        return redirect('employer/' . $employer_id . '/edit');
    }

}
