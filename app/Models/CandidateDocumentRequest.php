<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDocumentRequest extends Model
{
    use HasFactory;

    protected $table = 'candidate_documents_per_request';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'request_id',
        'document_id',
        'candidate_id',
        'comments',
        'date',
        'document_path',
        'result_id'
    ];

    protected $guarded = [];
}
