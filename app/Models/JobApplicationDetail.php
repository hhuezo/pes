<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationDetail extends Model
{
    use HasFactory;
    protected $table = 'job_application_detail';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'job_app_id',
        'job_title',
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
        'ant_workday_sun',
        'ant_workday_sun_hour',
        'ant_workday_mon',
        'ant_workday_mon_hour',
        'ant_workday_tue',
        'ant_workday_tue_hour',
        'ant_workday_wed',
        'ant_workday_wed_hour',
        'ant_workday_thu',
        'ant_workday_thu_hour',
        'ant_workday_fri',
        'ant_workday_fri_hour',
        'ant_workday_sat',
        'ant_workday_sat_hour',
        'ant_workday_total_hours',
        'primary_shift_time',
        'are_there_additional_shift_times'

    ];

    protected $guarded = [];

}
