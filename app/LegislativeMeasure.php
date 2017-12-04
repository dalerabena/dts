<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegislativeMeasure extends Model
{
    protected $fillable = [
        'user_id',
        'law_type',
        'ord_res_no',
        'title_subject',
        'authors',
        'co_authors',
        'proponents',
        'co_sponsors',
        'referred_to',
        'referred_when',
        'committee_action',
        'committee_action_date',
        'remarks',
        'reported',
        'reported_when',
        'sb_action',
        'enacted_approved_date',
        'date_transmitted_to_mayor',
        'date_approved_by_mayor',
        'date_transmitted_to_sp',
        'sp_action',
        'implemented',
        'vetoed',
        'vetoed_reasons',
        'notes'
    ];

    public function copies() {
        return $this->hasMany('\App\LegislativeMeasureCopy', 'legislative_measure_id');
    }

    public function law_details() {
        return $this->hasOne('\App\LawType', 'id', 'law_type');
    }
}
