<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'session_id',
        'title',
        'proponents'
    ];

    public function attachments() {
        return $this->hasMany('\App\AgendaAttachment', 'agenda_id');
    }
}
