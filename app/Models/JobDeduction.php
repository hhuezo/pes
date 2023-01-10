<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDeduction extends Model
{
    use HasFactory;

    protected $table = 'request_deduction';
    //protected $table = 'employer_deduction'; //NO usar esta

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'deduction_housing_amount_person_week',
        'housing_utilities',
        'medical',
        'daily_transportation',
        'other',
        'meals',
        'no_deduction',
        'other_deductions_desc',
        'housing_includes_utilities',
        'explain_housing_utilities',
        'is_deposit_required',
        'housing_notes',
        'deduction_daily_amount_housing',
        'deduction_daily_amount_transportation',
        'deduction_daily_amount_others',
        'transportation_notes',
        'how_many_meals_provided',
        'has_cost_per_meal',
        'cost_per_meal',
        'deduction_amount_per_meal',
        'meals_notes',
        'request_id'
    ];

    protected $guarded = [];


    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }
}
