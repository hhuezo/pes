<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialSkillJobRequest extends Model
{
    use HasFactory;
    protected $table = 'special_skills_per_request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'request_detail_id ',
        'special_skill_id',
        'detail',

    ];

    protected $guarded = [];

    public function special_skill()
    {
        return $this->belongsTo('App\Models\catalogue\SpecialSkill', 'special_skill_id', 'id');
    }
}
