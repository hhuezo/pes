<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalBusinessDays extends Model
{
    use HasFactory;
    protected $table = 'catalogue_normal_business_days';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name'
    ];

    protected $guarded = [];
}
