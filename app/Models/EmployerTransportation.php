<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerTransportation extends Model
{
    use HasFactory;
    protected $table = 'employer_transportation';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'employer_id',
        'request_id',
        'arrange_and_pay',
        'reimburse',
        'provide_advance',
        'pes_arramge_inbound_transportation',
        'date_added'

    ];

    protected $guarded = [];
}
