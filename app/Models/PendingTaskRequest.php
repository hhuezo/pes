<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingTaskRequest extends Model
{
    use HasFactory;

    protected $table = 'pending_task_per_request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'date_started',
        'date_due',
        'date_finished',
        'detail',
        'status',
        'catalog_pending_task_id',
        'request_id',
        'employer_id'
    ];

    protected $guarded = [];

    public function pending_task()
    {
        return $this->belongsTo('App\Models\catalogue\PendingTask', 'catalog_pending_task_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }


    public function request()
    {
        return $this->belongsTo('App\Models\Request', 'request_id', 'id');
    }
}
