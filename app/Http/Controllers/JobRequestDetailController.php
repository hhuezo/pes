<?php

namespace App\Http\Controllers;

use App\Models\catalogue\DegreeCode;
use App\Models\catalogue\JobTitle;
use App\Models\catalogue\SpecialSkill;
use App\Models\catalogue\EnglishLevel;

use App\Models\EmployerWorksite;
use App\Models\JobOfferSupervise;
use App\Models\JobRequest;
use App\Models\JobRequestDetail;
use App\Models\SpecialSkillJobRequest;
use App\Models\RequestDetail;
use App\Models\RequestDetailEnglishLevel;
use App\Models\ShiftTime;


use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JobRequestDetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }


    public function create_detail($id)
    {
        $job_request = JobRequest::findOrFail($id);
        $job_titles = JobTitle::get();
        $degree_codes = DegreeCode::get();
        $worksites = EmployerWorksite::where('employer_id', '=', $job_request->employer_id)->get();
        return view('job_request_detail.create', [
            'job_request' => $job_request, 'job_titles' => $job_titles, 'degree_codes' => $degree_codes,
            'worksites' => $worksites
        ]);
    }


    public function store(Request $request)
    {

        $detail =  new JobRequestDetail();
        $detail->request_id = $request->get('job_request_id');
        $detail->job_title_id = $request->get('job_title');
        $detail->number_workers = $request->get('number_workers');

        $detail->employer_worksite_id = $request->get('employer_worksite_id');
        $detail->official_job_title = $request->get('official_job_title');
        $detail->is_travel_required = $request->get('is_travel_required');
        if ($detail->is_travel_required == 1) {
            $detail->geographic_location_frecuency = $request->get('geographic_location_frecuency');
        } else {
            $detail->geographic_location_frecuency = null;
        }

        $detail->is_located_multiple_pwd_msa = $request->get('is_located_multiple_pwd_msa');


        $detail->desc_job_duties = $request->get('desc_job_duties');
        if ($request->get('it_has_cba') == null) {
            $detail->it_has_cba = 0;
        } else {
            $detail->it_has_cba = 1;
        }
        $detail->how_paid = $request->get('how_paid');
        $detail->pay_rate = $request->get('pay_rate');
        $detail->use_tip_credit = $request->get('use_tip_credit');
        $detail->is_there_benefits = $request->get('is_there_benefits');
        $detail->explain_benefits = $request->get('explain_benefits');
        $detail->are_there_any_requeriments = $request->get('are_there_any_requeriments');
        $detail->requeriments = $request->get('requeriments');
        $detail->any_additional_wage_notes = $request->get('any_additional_wage_notes');
        $detail->is_overtime_available = $request->get('is_overtime_available');
        $detail->ant_workday_sun_hour = $request->get('ant_workday_sun_hour');
        $detail->ant_workday_mon_hour = $request->get('ant_workday_mon_hour');
        $detail->ant_workday_tue_hour = $request->get('ant_workday_tue_hour');
        $detail->ant_workday_wed_hour = $request->get('ant_workday_wed_hour');
        $detail->ant_workday_thu_hour = $request->get('ant_workday_thu_hour');
        $detail->ant_workday_fri_hour = $request->get('ant_workday_fri_hour');
        $detail->ant_workday_sat_hour = $request->get('ant_workday_sat_hour');
        $detail->ant_workday_total_hours = $request->get('ant_workday_total_hours');
        //$detail->primary_shift_time = $request->get('primary_shift_time');
        $detail->are_there_additional_shift_times = $request->get('are_there_additional_shift_times');
        $detail->user_id = auth()->user()->id;
        $detail->save();

        session_start();
        session(['tab_detail' => '2']);

        Alert::success('Ok', 'Record saved');
        return redirect('job_request_detail/' . $detail->id . '/edit');
    }


    public function edit($id)
    {
        $detail =  JobRequestDetail::findOrFail($id);
        $job_request = JobRequest::findOrFail($detail->request_id);


        $details = RequestDetail::where('request_id','=',$job_request->id)->get();


        //dd($details);

        $array_id_details = [];

        foreach($details as $detail){
            array_push($array_id_details, $detail->id);
        }

        $positions = RequestDetailEnglishLevel::whereIn('request_detail_id',$array_id_details)->with('english_level')->get();




        $job_offerts = JobOfferSupervise::where('request_detail_id', '=', $id)->get();

        $id_job_title_array = [];

        foreach ($job_offerts as $obj) {
            array_push($id_job_title_array, $obj->catalog_job_title_id);
        }

        if ($job_offerts) {
            $job_titles = JobTitle::whereNotIn('id', $id_job_title_array)->get();
        } else {
            $job_titles = JobTitle::get();
        }

        $job_titles = JobTitle::whereNotIn('id', $id_job_title_array)->get();

        $degree_codes = DegreeCode::get();

        $special_skills = SpecialSkillJobRequest::where('request_detail_id', '=', $id)->where('is_alternate_skill', '=', 0)->get();
        $special_skills_alternative = SpecialSkillJobRequest::where('request_detail_id', '=', $id)->where('is_alternate_skill', '=', 1)->get();
        $skills = SpecialSkill::get();

        $worksites = EmployerWorksite::where('employer_id', '=', $job_request->employer_id)->get();









        $english_details =  RequestDetailEnglishLevel::where('request_detail_id','=',$detail->id)->get();

        $array_english_levels = [];

        $total_workers = 0;

        if ($english_details){
            foreach($english_details as $english_detail){
                $total_workers += $english_detail->number_of_workers;
                array_push($array_english_levels, $english_detail->catalog_english_level_id);
            }
        }

        //dd($detail->id, $total_workers, $array_english_levels);


        $english_levels = EnglishLevel::whereNotIn('id',$array_english_levels)->get();


        $shift_times = ShiftTime::where('request_detail_id','=',$detail->id)->get();



        return view('job_request_detail.edit', [
            'job_request' => $job_request, 'job_titles' => $job_titles, 'degree_codes' => $degree_codes, 'detail' => $detail,
            'special_skills' => $special_skills, 'special_skills_alternative' => $special_skills_alternative, 'skills' => $skills,
            'job_offerts' => $job_offerts, 'worksites' => $worksites, 'english_levels' => $english_levels, 'total_workers' => $total_workers,
            'positions' => $positions, 'shift_times' => $shift_times
        ]);
    }

    public function update(Request $request, $id)
    {
        $detail = JobRequestDetail::findOrFail($id);
        //$detail->request_id = $request->get('job_request_id');
        $detail->job_title_id = $request->get('job_title');
        $detail->number_workers = $request->get('number_workers');

        $detail->employer_worksite_id = $request->get('employer_worksite_id');
        $detail->official_job_title = $request->get('official_job_title');
        $detail->is_travel_required = $request->get('is_travel_required');
        if ($detail->is_travel_required == 1) {
            $detail->geographic_location_frecuency = $request->get('geographic_location_frecuency');
        } else {
            $detail->geographic_location_frecuency = null;
        }

        $detail->is_located_multiple_pwd_msa = $request->get('is_located_multiple_pwd_msa');

        $detail->desc_job_duties = $request->get('desc_job_duties');
        if ($request->get('it_has_cba') == null) {
            $detail->it_has_cba = 0;
        } else {
            $detail->it_has_cba = 1;
        }
        $detail->how_paid = $request->get('how_paid');
        $detail->pay_rate = $request->get('pay_rate');
        $detail->use_tip_credit = $request->get('use_tip_credit');

        $detail->is_there_benefits = $request->get('is_there_benefits');
        if ($request->get('is_there_benefits') == 1) {
            $detail->explain_benefits = $request->get('explain_benefits');
        } else {
            $detail->explain_benefits = null;
        }



        $detail->are_there_any_requeriments = $request->get('are_there_any_requeriments');
        if ($request->get('are_there_any_requeriments') == 1) {
            $detail->requeriments = $request->get('requeriments');
        } else {
            $detail->requeriments = null;
        }


        $detail->any_additional_wage_notes = $request->get('any_additional_wage_notes');
        $detail->is_overtime_available = $request->get('is_overtime_available');
        $detail->ant_workday_sun_hour = $request->get('ant_workday_sun_hour');
        $detail->ant_workday_mon_hour = $request->get('ant_workday_mon_hour');
        $detail->ant_workday_tue_hour = $request->get('ant_workday_tue_hour');
        $detail->ant_workday_wed_hour = $request->get('ant_workday_wed_hour');
        $detail->ant_workday_thu_hour = $request->get('ant_workday_thu_hour');
        $detail->ant_workday_fri_hour = $request->get('ant_workday_fri_hour');
        $detail->ant_workday_sat_hour = $request->get('ant_workday_sat_hour');
        $detail->ant_workday_total_hours = $request->get('ant_workday_total_hours');
        //$detail->primary_shift_time = $request->get('primary_shift_time');
        $detail->are_there_additional_shift_times = $request->get('are_there_additional_shift_times');
        //$detail->user_id = auth()->user()->id;
        $detail->save();



        $primary_shift_start_time = $request->get('primary_shift_start_time');
        $primary_shift_end_time = $request->get('primary_shift_end_time');
        $secondary_shift_start_time = $request->get('secondary_shift_start_time');
        $secondary_shift_end_time = $request->get('secondary_shift_end_time');


        $st_upd = ShiftTime::where('request_detail_id','=',$detail->id)->get();


        if ($st_upd) {// Update a Shift Time
            if ($primary_shift_start_time <> '' && $primary_shift_end_time <> '') {
                $st_upd->start_time = $primary_shift_start_time;
                $st_upd->end_time = $primary_shift_end_time;
                $st_upd->request_detail_id = $detail->id;
                $st_upd->update();
            }

            if ($secondary_shift_start_time <> '' && $secondary_shift_end_time <> '') {
                $st_upd->start_time = $secondary_shift_start_time;
                $st_upd->end_time = $secondary_shift_end_time;
                $st_upd->request_detail_id = $detail->id;
                $st_upd->update();
            }
        } else { // Create a new Shift Time
            if ($primary_shift_start_time <> '' && $primary_shift_end_time <> '') {
                $st = new ShiftTime();
                $st->start_time = $primary_shift_start_time;
                $st->end_time = $primary_shift_end_time;
                $st->request_detail_id = $detail->id;
                $st->save();
            }

            if ($secondary_shift_start_time <> '' && $secondary_shift_end_time <> '') {
                $st = new ShiftTime();
                $st->start_time = $secondary_shift_start_time;
                $st->end_time = $secondary_shift_end_time;
                $st->request_detail_id = $detail->id;
                $st->save();
            }
        }



        //dd($primary_shift_start_time, $primary_shift_end_time, $secondary_shift_start_time, $secondary_shift_end_time);




        /*if (($primary_shift_start_time <> '' && $primary_shift_end_time <> '') &&
            ($secondary_shift_start_time <> '' && $secondary_shift_end_time <> '')) {
                $st = new ShiftTime();
                $st->start_time = $primary_shift_start_time;
                $st->end_time = $primary_shift_end_time;
                $st->request_detail_id = $detail->id;
                $st->save();

                $st = new ShiftTime();
                $st->start_time = $secondary_shift_start_time;
                $st->end_time = $secondary_shift_end_time;
                $st->request_detail_id = $detail->id;
                $st->save();
        }*/





        session_start();
        session(['tab_detail' => '2']);

        Alert::info('Ok', 'Record saved');
        return redirect('job_request_detail/' . $detail->id . '/edit');
    }

    public function english_levels(Request $request){
        //dd("entro a agregar niveles de ingles");




        $rdel = new RequestDetailEnglishLevel();
        $rdel->request_detail_id = $request->get('request_detail_id');
        $rdel->catalog_english_level_id = $request->get('catalog_english_level_id');
        $rdel->number_of_workers = $request->get('number_of_workers');
        $rdel->save();

        session_start();
        session(['tab_detail' => '3']);

        Alert::success('Ok', 'Record saved');
        return back();

    }

    public function job_requirements(Request $request)
    {

        $detail =  JobRequestDetail::findOrFail($request->get('id'));
        $detail->minimum_education_id = $request->get('minimum_education_id');
        if ($request->get('minimum_education_id') == 7) {
            $detail->other_us_degree = $request->get('other_us_degree');
            $detail->majors_or_field_of_study = $request->get('majors_or_field_of_study');
        } else {
            $detail->other_us_degree = null;
            $detail->majors_or_field_of_study = null;
        }
        $detail->has_second_us_degree = $request->get('has_second_us_degree');
        if ($request->get('has_second_us_degree') == 1) {
            $detail->majors_or_field_of_study_2 = $request->get('majors_or_field_of_study_2');
        } else {
            $detail->majors_or_field_of_study_2 = null;
        }

        $detail->is_training_required = $request->get('is_training_required');
        if ($request->get('is_training_required') == 1) {
            $detail->field_training_required = $request->get('field_training_required');
            $detail->months_of_training_required = $request->get('months_of_training_required');
        } else {
            $detail->field_training_required = null;
            $detail->months_of_training_required = null;
        }

        $detail->is_employement_experience_required = $request->get('is_employement_experience_required');
        if ($request->get('is_employement_experience_required') == 1) {
            $detail->months_of_experience_required = $request->get('months_of_experience_required');
            $detail->occupation_experience_id = $request->get('occupation_experience_id');
        } else {
            $detail->months_of_experience_required = null;
            $detail->occupation_experience_id = null;
        }

        $detail->has_special_skills_required = $request->get('has_special_skills_required');
        if ($request->get('has_special_skills_required') == 1) {

            $count = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('is_alternate_skill', '=', 0)->count();

            if ($count == 0) {
                $special_skills_1 = new SpecialSkillJobRequest();
                $special_skills_1->request_detail_id = $request->get('id');
                $special_skills_1->special_skill_id = 1;
                $special_skills_1->detail = $request->get('special_skills_1');
                $special_skills_1->save();

                $special_skills_2 = new SpecialSkillJobRequest();
                $special_skills_2->request_detail_id = $request->get('id');
                $special_skills_2->special_skill_id = 2;
                $special_skills_2->detail = $request->get('special_skills_2');
                $special_skills_2->save();


                $special_skills_3 = new SpecialSkillJobRequest();
                $special_skills_3->request_detail_id = $request->get('id');
                $special_skills_3->special_skill_id = 3;
                $special_skills_3->detail = $request->get('special_skills_3');
                $special_skills_3->save();


                $special_skills_4 = new SpecialSkillJobRequest();
                $special_skills_4->request_detail_id = $request->get('id');
                $special_skills_4->special_skill_id = 4;
                $special_skills_4->detail = $request->get('special_skills_4');
                $special_skills_4->save();
            } else {
                $special_skills_1 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 1)->where('is_alternate_skill', '=', 0)->first();
                $special_skills_1->detail = $request->get('special_skills_1');
                $special_skills_1->update();

                $special_skills_2 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 2)->where('is_alternate_skill', '=', 0)->first();
                $special_skills_2->detail = $request->get('special_skills_2');
                $special_skills_2->update();


                $special_skills_3 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 3)->where('is_alternate_skill', '=', 0)->first();
                $special_skills_3->detail = $request->get('special_skills_3');
                $special_skills_3->update();

                $special_skills_4 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 4)->where('is_alternate_skill', '=', 0)->first();
                $special_skills_4->detail = $request->get('special_skills_4');
                $special_skills_4->update();
            }
        } else {
            SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('is_alternate_skill', '=', 0)->delete();
        }


        $detail->update();

        session_start();
        session(['tab_detail' => '4']);

        session(['tab_request' => '2']);

        Alert::success('Ok', 'Record saved');
        return back();
    }


    public function job_requirements_alternative(Request $request)
    {
        $detail =  JobRequestDetail::findOrFail($request->get('id'));
        $detail->alternate_experience_accepted = $request->get('alternate_experience_accepted');
        if ($request->get('alternate_experience_accepted') == 1) {

            $detail->alternate_education_level_id = $request->get('alternate_education_level_id');
            if ($request->get('alternate_education_level_id') == 7) {
                $detail->if_other_specify_degree = $request->get('if_other_specify_degree');
                $detail->alternate_major = $request->get('alternate_major');
            } else {
                $detail->if_other_specify_degree = null;
                $detail->alternate_major = null;
            }

            $detail->alternate_training_accepted = $request->get('alternate_training_accepted');
            if ($request->get('alternate_training_accepted') == 1) {
                $detail->alternate_training_number_months = $request->get('alternate_training_number_months');
                $detail->alternate_field_of_training = $request->get('alternate_field_of_training');
            } else {
                $detail->alternate_training_number_months = null;
                $detail->alternate_field_of_training = null;
            }

            $detail->alternate_employment_exp_required = $request->get('alternate_employment_exp_required');
            if ($request->get('alternate_employment_exp_required') == 1) {
                $detail->altername_months_number_exp = $request->get('altername_months_number_exp');
            } else {
                $detail->altername_months_number_exp = null;
            }


            $detail->alternate_especial_skills_accepted = $request->get('alternate_especial_skills_accepted');
            if ($request->get('alternate_especial_skills_accepted') == 1) {

                $count = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('is_alternate_skill', '=', 1)->count();

                if ($count == 0) {
                    $special_skills_1 = new SpecialSkillJobRequest();
                    $special_skills_1->request_detail_id = $request->get('id');
                    $special_skills_1->special_skill_id = 1;
                    $special_skills_1->is_alternate_skill = 1;
                    $special_skills_1->detail = $request->get('special_skills_1');
                    $special_skills_1->save();

                    $special_skills_2 = new SpecialSkillJobRequest();
                    $special_skills_2->request_detail_id = $request->get('id');
                    $special_skills_2->special_skill_id = 2;
                    $special_skills_2->is_alternate_skill = 1;
                    $special_skills_2->detail = $request->get('special_skills_2');
                    $special_skills_2->save();


                    $special_skills_3 = new SpecialSkillJobRequest();
                    $special_skills_3->request_detail_id = $request->get('id');
                    $special_skills_3->special_skill_id = 3;
                    $special_skills_3->is_alternate_skill = 1;
                    $special_skills_3->detail = $request->get('special_skills_3');
                    $special_skills_3->save();


                    $special_skills_4 = new SpecialSkillJobRequest();
                    $special_skills_4->request_detail_id = $request->get('id');
                    $special_skills_4->special_skill_id = 4;
                    $special_skills_4->is_alternate_skill = 1;
                    $special_skills_4->detail = $request->get('special_skills_4');
                    $special_skills_4->save();
                } else {
                    $special_skills_1 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 1)->where('is_alternate_skill', '=', 1)->first();
                    $special_skills_1->detail = $request->get('special_skills_1');
                    $special_skills_1->update();

                    $special_skills_2 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 2)->where('is_alternate_skill', '=', 1)->first();
                    $special_skills_2->detail = $request->get('special_skills_2');
                    $special_skills_2->update();


                    $special_skills_3 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 3)->where('is_alternate_skill', '=', 1)->first();
                    $special_skills_3->detail = $request->get('special_skills_3');
                    $special_skills_3->update();

                    $special_skills_4 = SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('special_skill_id', '=', 4)->where('is_alternate_skill', '=', 1)->first();
                    $special_skills_4->detail = $request->get('special_skills_4');
                    $special_skills_4->update();
                }
            } else {
                SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('is_alternate_skill', '=', 1)->delete();
            }
        } else {

            $detail->alternate_education_level_id = 0;
            $detail->if_other_specify_degree = null;
            $detail->alternate_major = null;

            $detail->alternate_training_accepted = 0;
            $detail->alternate_training_number_months = null;
            $detail->alternate_field_of_training = null;

            $detail->alternate_employment_exp_required = 0;
            $detail->altername_months_number_exp = null;

            $detail->alternate_especial_skills_accepted = 0;
            SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->where('is_alternate_skill', '=', 1)->delete();
        }

        $detail->update();

        session_start();
        session(['tab_detail' => '1']);
        session(['tab_request' => '2']);


        Alert::success('Ok', 'Record saved');
        return redirect('job_request/' .  $detail->request_id . '/edit');
        //return back();
    }

    public function job_offer_supervise(Request $request)
    {
        $detail = JobRequestDetail::findOrFail($request->get('id'));
        $detail->has_to_supervise_others = $request->get('has_to_supervise_others');
        $detail->update();
        if ($request->get('has_to_supervise_others') == 1) {
            $job_offer = new JobOfferSupervise();
            $job_offer->catalog_job_title_id = $request->get('catalog_job_title_id');
            $job_offer->request_detail_id = $request->get('id');
            $job_offer->number_to_be_supervised = $request->get('number_to_be_supervised');
            $job_offer->save();
        } else {
            JobOfferSupervise::where('request_detail_id', '=', $request->get('id'))->delete();
        }

        session_start();
        session(['tab_detail' => '3']);

        Alert::success('Ok', 'Record saved');
        return back();
    }



    public function delete(Request $request)
    {
        JobOfferSupervise::where('request_detail_id', '=', $request->get('id'))->delete();
        SpecialSkillJobRequest::where('request_detail_id', '=', $request->get('id'))->delete();
        $detail = JobRequestDetail::findOrFail($request->get('id'));
        $detail->delete();
        Alert::error('', 'Record delete');
        return back();
    }


    public function destroy($id)
    {
        dd($id);
        $detail = JobRequestDetail::findOrFail($id);
        $detail->delete();
        Alert::error('', 'Record delete');
        return back();
    }
}
