<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swa extends Model
{
    use HasFactory;

    protected $table = 'catalog_swa';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'state_desc',
        'wotc_contact',
        'wotc_unit',
        'wotc_website',
        'state_id',
        'status'
    ];

    protected $guarded = [];


    public function state()
    {
        return $this->belongsTo('App\Models\catalogue\State', 'state_id', 'id');
    }

}
