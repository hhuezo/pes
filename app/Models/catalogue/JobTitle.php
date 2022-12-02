<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $table = 'catalogue_job_title';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name',

    ];

    protected $guarded = [];
}
