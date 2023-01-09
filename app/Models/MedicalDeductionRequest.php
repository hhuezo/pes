<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDeductionRequest extends Model
{
    use HasFactory;
    protected $table = 'medical_deduction_per_request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'comments',
        'request_deduction_id',
        'catalog_medical_deduction_id',
        'employer_id',
        'deduction_ammount',
        'date_added'
    ];

    protected $guarded = [];
}
