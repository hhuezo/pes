<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaicsCode extends Model
{
    use HasFactory;
    protected $table = 'catalogue_naics_code';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'code',
        'name',
        'primary_business_type_id'

    ];

    protected $guarded = [];
}
