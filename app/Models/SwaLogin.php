<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwaLogin extends Model
{
    use HasFactory;
    protected $table = 'swa_login';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'swa_username',
        'swa_password',
        'employer_id',
        'catalog_swa_id',
    ];

    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }

    public function swa()
    {
        return $this->belongsTo('App\Models\catalogue\Swa', 'catalog_swa_id', 'id');
    }
}
