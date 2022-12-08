<?php

namespace App\Http\Controllers;

use App\Models\catalogue\NaicsCode;
use App\Models\catalogue\NormalBusinessDays;
use App\Models\catalogue\primaryBusinessType;
use App\Models\catalogue\State;
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
        $employers = Employer::get();
        $estate = ["Cancel", "Active"];
        return view('employer.index', ['employers' => $employers, 'estate' => $estate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employer = Employer::where('users_id', '=', auth()->user()->id)->first();
        if ($employer) {
            return redirect('employer/' . $employer->id . '/edit');
        }
        $user = auth()->user();
        $primary_business_types = primaryBusinessType::where('active', '=', 1)->get();
        $states = State::get();

        //$worksites = EmployerWorksite::where('employer_id', '=', $id)->get();
        $normal_business_days = NormalBusinessDays::get();
        $primary_business_types = primaryBusinessType::where('active', '=', 1)->get();
        return view('employer.create', [
            'primary_business_types' => $primary_business_types, 'states' => $states, 'user' => $user, 'normal_business_days' => $normal_business_days, 'user' => $user
        ]);
    }



    public function store(Request $request)
    {

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

        $employer->primary_business_type_id = $request->get('primary_business_type_id');
        $employer->naics_id = $request->get('naics_id');

        if ($request->get('naics_code') == 6) {
            $employer->naics_code = $request->get('naics_code');
        }
        $employer->year_end_gross_company_income = $request->get('year_end_gross_company_income');
        $employer->year_end_net_company_income = $request->get('year_end_net_company_income');
        $employer->users_id = auth()->user()->id;

        $employer->save();
        session_start();
        session(['action' => '2']);
        Alert::success('Ok', 'Record saved');
        return redirect('employer/' . $employer->id . '/edit');
    }


    public function get_naics_code($id)
    {
        return NaicsCode::where('primary_business_type_id', '=', $id)->get();
    }

    /*    public function activate(Request $request)
    {
        $employer = Employer::findOrFail($request->get('id'));
        $employer->validated = $request->get('cod');
        $employer->save();

        return redirect('employer/');
    }




/*
    public function employer_place_store(Request $request)
    {
        $employer = Employer::findOrFail($request->get('id'));
        $employer->main_worksite_location = $request->get('main_worksite_location');
        $employer->main_worksite_city = $request->get('main_worksite_city');
        $employer->main_worksite_country = $request->get('main_worksite_country');
        $employer->main_worksite_state = $request->get('main_worksite_state');
        $employer->main_worksite_zip_code = $request->get('main_worksite_zip_code');
        $employer->normal_business_days_id = $request->get('normal_business_days_id');
        $employer->normal_business_days_other = $request->get('normal_business_days_other');
        $employer->how_far_transportation_from_worksite = $request->get('how_far_transportation_from_worksite');
        $employer->local_transportation_website = $request->get('local_transportation_website');
        $employer->place_employment_notes = $request->get('place_employment_notes');

        $employer->update();

        return redirect('employer/' . $request->get('id') . '/edit');
        // return redirect()->action([EmployerController::class, 'place_employment/'.$employer->id]);
        // return redirect('employer_place_employment/' . $employer->id);
    }*/
    /*

    public function place_employment($id)
    {
        $employer = Employer::findOrFail($id);
        $naics = NaicsCode::where('primary_business_type_id', '=', $employer->naicsCode->primary_business_type_id)->get();
        $states = State::get();
        $worksites = EmployerWorksite::where('employer_id', '=', $id)->get();
        $normal_business_days = NormalBusinessDays::get();
        $primary_business_types = primaryBusinessType::where('active', '=', 1)->get();
        $principal_states = State::get();

        return view('employer.place_employment', [
            'employer' => $employer, 'states' => $states, 'worksites' => $worksites,
            'normal_business_days' => $normal_business_days, 'primary_business_types' => $primary_business_types,
            'principal_states' => $principal_states, 'naics' => $naics
        ]);
    }
*/
    /*
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

        return redirect('employer/' . $request->get('employer_id') . '/edit');

        /* $data = EmployerWorksite::where('employer_id', '=', $request->get('employer_id'))->get();

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
            if ($obj->state_id_address) {
                echo '<td>' . $obj->state->name . '</td>';
            } else {
                echo '<td></td>';
            }
            echo '<td>' . $obj->zip_code_address . '</td>';
        }
        echo ' </tr>
            </tbody>
            </table>';*//*
    }
*/

    public function edit($id)
    {

        $employer = Employer::findOrFail($id);
        $naics = NaicsCode::where('primary_business_type_id', '=', $employer->naicsCode->primary_business_type_id)->get();
        $states = State::get();
        $worksites = EmployerWorksite::where('employer_id', '=', $id)->get();
        $normal_business_days = NormalBusinessDays::get();
        $primary_business_types = primaryBusinessType::where('active', '=', 1)->get();
        //$principal_states = State::get();

        return view('employer.edit', [
            'employer' => $employer, 'states' => $states, 'worksites' => $worksites,
            'normal_business_days' => $normal_business_days, 'primary_business_types' => $primary_business_types, 'naics' => $naics
        ]);
    }


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
        $employer->users_id = auth()->user()->id;

        $employer->save();

        Alert::info('', 'Record saved');
        session_start();
        session(['action' => '2']);
      //dd(session('action'));

        return redirect('employer/' . $employer->id . '/edit')->with('message', 'Login Failed');
    }


    public function employer_place_of_business(Request $request)
    {
        $employer = Employer::findOrFail($request->get('id'));


        $employer->principal_street_address = $request->get('principal_street_address');
        $employer->principal_city = $request->get('principal_city');
        $employer->principal_country = $request->get('principal_country');
        $employer->principal_state_id = $request->get('principal_state_id');
        $employer->principal_zip_code = $request->get('principal_zip_code');


        if ($request->get('mailing_address_same_above') == null) {
            $employer->mailing_address_same_above = 0;
            $employer->mailing_address = $request->get('mailing_address');
            $employer->mailing_city = $request->get('mailing_city');
            $employer->mailing_state = $request->get('mailing_state');
            $employer->mailing_zip_code = $request->get('mailing_zip_code');
        } else {
            $employer->mailing_address_same_above = 1;
            $employer->mailing_address = null;
            $employer->mailing_city = null;
            $employer->mailing_state = null;
            $employer->mailing_zip_code = null;
        }
        Alert::info('', 'Record saved');
        session_start();
        session(['action' => '3']);
        $employer->update();
        return redirect('employer/' . $employer->id . '/edit');
    }


    public function employer_contact_information(Request $request)
    {
        $employer = Employer::findOrFail($request->get('id'));
        $employer->primary_contact_name = $request->get('primary_contact_name');
        $employer->primary_contact_last_name = $request->get('primary_contact_last_name');
        $employer->primary_contact_job_title = $request->get('primary_contact_job_title');
        $employer->primary_contact_email = $request->get('primary_contact_email');
        $employer->primary_contact_phone = $request->get('primary_contact_phone');
        $employer->primary_contact_cellphone = $request->get('primary_contact_cellphone');



        $employer->signed_all_documents = $request->get('signed_all_documents');
        if ($request->get('signed_all_documents') == 0) {
            $employer->signatory_name = $request->get('signatory_name');
            $employer->signatory_last_name = $request->get('signatory_last_name');
            $employer->signatory_job_title = $request->get('signatory_job_title');
            $employer->signatory_email = $request->get('signatory_email');
            $employer->signatory_phone = $request->get('signatory_phone');
        } else {
            $employer->signatory_name = null;
            $employer->signatory_last_name = null;
            $employer->signatory_job_title = null;
            $employer->signatory_email = null;
            $employer->signatory_phone = null;
        }
        Alert::info('', 'Record saved');
        session(['action' => '1']);
        $employer->update();
        return redirect('employer/' . $employer->id . '/edit');
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
}
