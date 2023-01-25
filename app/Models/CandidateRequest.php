<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateRequest extends Model
{
    use HasFactory;


    protected $table = 'candidates_per_request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'candidate_id',
        'request_detail_id',
        'recruitment_status_id',
        'recruitment_result_id',
        'comments',
        'is_no_show',
        'date_of_no_show',
        'catalog_no_show_id'
    ];

    protected $guarded = [];
}
