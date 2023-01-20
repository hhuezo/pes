<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'catalog_invoice_types_id',
        'ammount_due',
        'catalog_invoice_status_id',
        'comments',
        'date_due',
        'modification_comments',
        'employer_id',
        'request_id'
    ];

    protected $guarded = [];


    public function type()
    {
        return $this->belongsTo('App\Models\catalogue\InvoiceType', 'catalog_invoice_types_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\catalogue\InvoiceStatus', 'catalog_invoice_status_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }


    public function request()
    {
        return $this->belongsTo('App\Models\JobRequest', 'request_id', 'id');
    }
}
