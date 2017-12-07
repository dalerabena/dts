<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaAttachment extends Model
{
    protected $fillable = [
        'session_id',
        'agenda_id',
        'filename',
        'path'
    ];
}
