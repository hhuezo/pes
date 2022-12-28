<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaicsCode extends Model
{
    use HasFactory;
    protected $table = 'catalog_naics';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'cn_code',
        'cn_desciption',
        'industry_id'

    ];

    protected $guarded = [];
}
