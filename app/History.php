<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    protected $fillable = [
        'document_id',
        'forwarded_to',
        'reference_number',
        'subject',
        'detail',
        'comment',
        'action',
        'action_by'
    ];

    public function user() {
        return $this->belongsTo('\App\User', 'action_by');
    }
}
