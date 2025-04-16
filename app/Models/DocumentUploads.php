<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentUploads extends Model
{
    protected $table = 'document_uploads';

    protected $fillable = [
        'id',
        'doc_id',
        'user_id',
        'file_name',
        'mime',
        'file_size',
        'uploaded_file',
        'remarks',
        'created_at',
        'updated_at',
    ];
}
