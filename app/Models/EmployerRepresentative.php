<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerRepresentative extends Model
{
    use HasFactory;
    protected $table = 'employer_representative';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'er_last_name',
        'er_first_name',
        'er_middle_name',
        'er_address_1',
        'er_county_id',
        'er_city_id',
        'er_state_id',
        'er_zip_addr1',
        'er_address_2',
        'er_state_id2',
        'er_county_id2',
        'er_city_id_2',
        'er_zip_addr2',
        'er_country_id',
        'er_province',
        'er_telephone_number',
        'er_lawfirm_email',
        'er_telephone_number_ext',
        'er_lawfirm_business_name',
        'er_lawfirm_fein_number',
        'er_type_of_representation_id',
        'date_added'

    ];

    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'er_city_id', 'id');
    }


    public function county()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'er_county_id', 'id');
    }

}
