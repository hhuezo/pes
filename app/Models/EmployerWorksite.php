<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerWorksite extends Model
{
    use HasFactory;

    protected $table = 'employer_worksite';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'street_address',
        'city_address',
        'country_address',
        'state_id_address',
        'zip_code_address'

    ];

    protected $guarded = [];


    public function state()
    {
        return $this->belongsTo('App\Models\catalogue\State', 'state_id_address', 'id');
    }
}
