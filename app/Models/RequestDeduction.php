<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDeduction extends Model
{
    use HasFactory;

    protected $table = 'request_deduction';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'deduction_housing_amount_person_week',
        'housing_utilities',
        'daily_transportation',
        'explain_housing_utilities',
        'is_deposit_required',
        'deposit_amount',
        'is_deposit_refundable',
        'housing_notes',
        'medical',
        'meals',
        'housing_includes_utilities',
        'no_deduction',
        'other',
        'deduction_medical_paycheck',
        'deduction_dental_paycheck',
        'deduction_vision_paycheck',
        'deduction_other_paycheck',
        'medical_dental_vision_other_notes',
        'deduction_daily_amount_person_week',
        'daily_notes',
        'other_deductions',
        'how_many_meals_provided',
        'is_there_cost_per_meal',
        'cost_per_meal',
        'deduction_amount_per_meal',
        'meals_notes',
        'request_id',
        'date_added'
    ];

    protected $guarded = [];

}
