<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $table = 'catalog_airport';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'ident',
        'type',
        'name',
        'elevation_ft',
        'continent',
        'iso_country',
        'iso_region',
        'municipality',
        'gps_code',
        'iata_code',
        'local_code',
        'Lon',
        'Lat',
        'catalog_countries_id',
        'catalog_states_id',
        'catalog_airport_type_id'
    ];

    protected $guarded = [];
}
