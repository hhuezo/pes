<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnglishLevel extends Model
{
    use HasFactory;
    protected $table = 'catalog_english_level';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'description_level',
        'description_level_en'
    ];


    protected $guarded = [];


    public function detail_has_english_level()
    {
        return $this->belongsToMany('App\Models\JobRequestDetail','request_detail_english_level','catalog_english_level_id');
    }

}
