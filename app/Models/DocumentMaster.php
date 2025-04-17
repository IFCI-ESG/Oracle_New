<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentMaster extends Model
{
    protected $table = 'document_master';

    protected $fillable = [
        'doc_id',
        'doc_type',
        'module_name',
        'doc_particular',
        'doc_serial',
    ];
}
