<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    use HasFactory;

    protected $table = 'catalog_templates';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'header',
        'body',
        'footer',
        'dynamic_word',
        'date_added',
        'user_added',
        'date_modified',
        'user_modifies',
        'status',
        'catalog_documents_id'
    ];

    protected $guarded = [];
}
