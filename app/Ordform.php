<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordform extends Model
{
    protected $fillable = [
        'ordinance_no',
        'subject_matter',
        'sponsors',
        'approved_date',
        'sp_actions'
    ];

    public function copies() {
        return $this->hasMany('\App\OrdformCopy', 'ordform_id');
    }
}
