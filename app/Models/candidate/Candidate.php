<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $table = 'candidate';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name_candidate',
        'lastname_candidate',
        'category_to_apply_id',
        'valid_passport_common_answer_id',
        'birthdate',
        'document_number_type',
        'document_type_id',
        'document_number',
        'catalog_gender_id',
        'email',
        'cell_phone_number',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'catalog_employment_status_id'

    ];

    protected $guarded = [];

    public function candidate_has_request_detail()
    {
        return $this->belongsToMany('App\Models\RequestDetail','candidates_per_request','candidate_id');
    }
}
