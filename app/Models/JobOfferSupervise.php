<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOfferSupervise extends Model
{
    use HasFactory;

    protected $table = 'job_offer_soc_to_supervise';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'catalog_job_title_id ',
        'request_detail_id',
        'number_to_be_supervised',

    ];

    protected $guarded = [];

    public function title()
    {
        return $this->belongsTo('App\Models\catalogue\JobTitle', 'catalog_job_title_id', 'id');
    }
}
