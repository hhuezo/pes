<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStatus extends Model
{
    use HasFactory;
    protected $table = 'catalog_request_status';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name ',
        'status',

    ];

    protected $guarded = [];
}
