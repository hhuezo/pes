<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityZip extends Model
{
    use HasFactory;
    protected $table = 'catalog_city_zip';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'czc_state_fips',
        'czc_state',
        'czc_state_abbr',
        'czc_zipcode',
        'czc_county',
        'czc_city',
    ];

    protected $guarded = [];
}
