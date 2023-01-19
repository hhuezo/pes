<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;
    protected $table = 'request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'need_h2b_workers',
        'explain_multiple_employment',
        'paid',
        'is_uniform_required',
        'uniform_pieces_required',
        'job_notes',
        'user_id',
        'created_at',
        'start_date'.
        'end_date',
        'signature',
        'has_acwia',
        'has_sports_league_regs',
        'has_reason_not_acwia',
        'has_acwia_institution_highed',
        'has_acwia_related_nonprofit',
        'has_acwia_research_nonprofit',
        'swa_username',
        'swa_password',
        'application_phone_number',
        'application_email',
        'application_website',
        'last_season_impact',
        'additional_information',
        'pwd_case_number',
        'pwd_received_date',
        'pwd_submited_date',
        'pwd_file_upload',
        'source_type_dba',
        'source_type_sca',
        'source_type_survey',
        'survey_name_title',
        'survey_date_of_submission',
        'employer_representative_id',
        'request_status_id'

    ];

    protected $guarded = [];



    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }


    public function status()
    {
        return $this->belongsTo('App\Models\catalogue\RequestStatus', 'request_status_id', 'id');
    }
}
