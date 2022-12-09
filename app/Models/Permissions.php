<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $table = 'permissions';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name',

    ];

    protected $guarded = [];
}
