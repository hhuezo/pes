<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftTime extends Model
{
    use HasFactory;
    protected $table = 'shift_time';
    //protected $table = 'employer_deduction'; //NO usar esta

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'start_time',
        'end_time',
        'request_detail_id'
    ];

    protected $guarded = [];
}
