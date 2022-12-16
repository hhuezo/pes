<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class primaryBusinessType extends Model
{
    use HasFactory;
    protected $table = 'catalog_primary_business_type';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name_english',
        'name_spanish',
        'active'
    ];

    protected $guarded = [];
}
