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
        'address_type_id',
        'state_id_address',
        'county_id',
        'city_id',
        'zip_code',
        'street_address'
    ];




    protected $guarded = [];


    public function state()
    {
        return $this->belongsTo('App\Models\catalogue\State', 'state_id_address', 'id');
    }

  /*  public function county()
    {
        return $this->belongsTo('App\Models\catalogue\County', 'county_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\catalogue\City', 'city_id', 'id');
    }*/

    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }

    public function typeAddress()
    {
        return $this->belongsTo('App\Models\TypeAddress', 'type_address_id', 'id');
    }


    public function county()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'county_id', 'id');
    }


    public function city()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'city_id', 'id');
    }

}
