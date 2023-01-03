<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialSkill extends Model
{
    use HasFactory;
    protected $table = 'special_skills';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name ',
        'status',

    ];

    protected $guarded = [];
}
