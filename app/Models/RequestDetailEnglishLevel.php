<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDetailEnglishLevel extends Model
{
    use HasFactory;
    protected $table = 'request_detail_english_level';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'request_detail_id',
        'catalog_english_level_id',
        'number_of_workers'
    ];

    protected $guarded = [];

    public function english_level()
    {
        return $this->belongsTo('App\Models\catalogue\EnglishLevel', 'catalog_english_level_id', 'id');
    }

    public function request_detail()
    {
        return $this->belongsTo('App\Models\JobRequestDetail', 'request_detail_id', 'id');
    }

}
