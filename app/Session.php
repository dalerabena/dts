<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'session_type',
        'session_date',
        'session_time',
        'place'
    ];

    public function agendas() {
        return $this->hasMany('\App\Agenda', 'session_id');
    }
}
