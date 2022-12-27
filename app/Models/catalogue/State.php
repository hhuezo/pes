<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'catalog_states';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name'
    ];

    protected $guarded = [];
}
