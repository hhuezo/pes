<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $table = 'documents_per_request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'date_uploaded',
        'document_route',
        'catalog_documents_id',
        'document_header',
        'document_body',
        'document_footer',
        'request_detail_id',
        'request_id'
    ];

    protected $guarded = [];
}
