<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequestDetail extends Model
{
    use HasFactory;
    protected $table = 'request_detail';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'request_id',
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
        'occupation_experience_id',
        'employer_worksite_id'

    ];

    protected $guarded = [];


    public function title()
    {
        return $this->belongsTo('App\Models\catalogue\JobTitle', 'job_title_id', 'id');
    }

    public function job_request()
    {
        return $this->belongsTo('App\Models\JobRequest', 'request_id', 'id');
    }

    public function occupation_experience()
    {
        return $this->belongsTo('App\Models\catalogue\JobTitle', 'occupation_experience_id', 'id');
    }

    public function degree_code()
    {
        return $this->belongsTo('App\Models\catalogue\DegreeCode', 'minimum_education_id', 'id');
    }

    public function request_special_skills()
    {
        return $this->hasMany('App\SpecialSkillJobRequest');
    }

    public function employer_worksite()
    {
        return $this->belongsTo('App\Models\EmployerWorksite', 'employer_worksite_id', 'id');
    }

    public function detail_has_english_level()
    {
        return $this->hasMany('App\Models\RequestDetailEnglishLevel', 'id', 'request_detail_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\catalogue\JobTitle', 'job_title_id', 'id');
    }

    public function candidate_has_request_detail()
    {
        return $this->belongsToMany('App\Models\candidate\Candidate','candidates_per_request','request_detail_id');
    }


}
