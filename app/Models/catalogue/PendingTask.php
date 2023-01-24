<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingTask extends Model
{
    use HasFactory;

    protected $table = 'catalog_pending_tasks';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name ',
        'status'

    ];

    protected $guarded = [];
}
