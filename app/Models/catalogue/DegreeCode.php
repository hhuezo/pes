<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeCode extends Model
{
    use HasFactory;
    protected $table = 'catalog_degree_codes';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name'
    ];

    protected $guarded = [];
}
