<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $table = 'request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'start_date',
        'end_date',
        'need_h2b_workers',
        'explain_multiple_employment',
        'paid_weekly',
        'paid_biweekly',
        'is_uniform_required',
        'uniform_pieces_required',
        'job_notes'

    ];

    protected $guarded = [];


    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }
}
