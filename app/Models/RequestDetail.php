<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDetail extends Model
{
    use HasFactory;


    protected $table = 'request_detail';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'request_id',
        'listed_above',
        'job_title_id',
        'number_workers',
        'it_has_cba',
        'how_paid',
        'pay_rate',
        'use_tip_credit',
        'is_there_benefits',
        'explain_benefits',
        'are_there_any_requeriments',
        'requeriments',
        'any_additional_wage_notes',
        'is_overtime_available',
        'ant_workday_sun_hour',
        'ant_workday_mon_hour',
        'ant_workday_tue_hour',
        'ant_workday_wed_hour',
        'ant_workday_thu_hour',
        'ant_workday_fri_hour',
        'ant_workday_sat_hour',
        'ant_workday_total_hours',
        'primary_shift_time',
        'are_there_additional_shift_times',
        'user_id',
        'created_at',
        'desc_job_duties',
        'has_to_supervise_others',
        'minimum_education_id',
        'other_us_degree',
        'majors_or_field_of_study',
        'has_second_us_degree',
        'majors_or_field_of_study_2',
        'is_training_required',
        'field_training_required',
        'is_employement_experience_required',
        'months_of_experience_required',
        'has_special_skills_required',
        'suggested_socnet_cod_id',
        'has_legal_representative',
        'employer_worksite_id',
        'official_job_title',
        'is_travel_required',
        'geographic_location_frecuency',
        'is_located_multiple_pwd_msa',
        'months_of_training_required',
        'occupation_experience_id',
        'alternate_experience_accepted',
        'alternate_education_level_id',
        'if_other_specify_degree',
        'alternate_major',
        'alternate_training_accepted',
        'alternate_training_number_months',
        'alternate_field_of_training',
        'alternate_employment_exp_required',
        'altername_months_number_exp',
        'alternate_especial_skills_accepted'
    ];

    public function title()
    {
        return $this->belongsTo('App\Models\catalogue\JobTitle', 'job_title_id', 'id');
    }

    protected $guarded = [];

}
