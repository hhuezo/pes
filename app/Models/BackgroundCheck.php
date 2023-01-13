<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundCheck extends Model
{
    use HasFactory;
    protected $table = 'background_check';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'is_background_check_required',
        'is_included_criminal_history',
        'is_background_check_pre_employement',
        'is_background_check_post_employement',
        'is_background_check_other',
        'others_description',
        'is_drug_testing_required',
        'is_drug_testing_pre_employment',
        'is_drug_testing_post_employment',
        'is_drug_testing_post_injury',
        'is_drug_testing_other',
        'testing_other_description',
        'are_there_other_requirements',
        'other_requirements_description',
        'request_id'

    ];

    protected $guarded = [];
}
