<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'view_city';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name'
    ];

    protected $guarded = [];
}
