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
        'comment',
        'priority',
        'status'
    ];

    public function attachments() {
        return $this->hasMany('\App\DocumentAttachment', 'document_id');
    }

    public function history() {
        return $this->hasMany('\App\History', 'document_id');
    }

    public function refPriority() {
        return $this->hasOne('\App\RefPriority', 'id', 'priority');
    }
}
