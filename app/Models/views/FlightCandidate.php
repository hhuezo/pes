<?php

namespace App\Models\views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightCandidate extends Model
{
    use HasFactory;

    protected $table = 'view_candidates_per_request';

    public $timestamps = false;


    protected $fillable = [
        'candidate_id',
        'name_candidate',
        'lastname_candidate',
        'recruitment_status_id',
        'recruitment_status',
        'job_title_id',
        'required_job_title',
        'english_level_id',
        'required_english_level',
        'recruiter_id',
        'request_id'
    ];

    protected $guarded = [];
}
