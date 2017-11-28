<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'reference_number',
        'subject',
        'detail',
        'priority',
        'department',
        'initial_comment'
    ];

    public function attachments() {
        return $this->hasMany('\App\DocumentAttachment', 'document_id');
    }
}
