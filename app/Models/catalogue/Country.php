<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'catalogue_country';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name',

    ];

    protected $guarded = [];
}
