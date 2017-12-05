<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resform extends Model
{
    protected $fillable = [
        'resolution_no',
        'title',
        'sponsors',
        'approved_date',
        'sp_approval'
    ];

    public function copies() {
        return $this->hasMany('\App\ResformCopy', 'resform_id');
    }
}
