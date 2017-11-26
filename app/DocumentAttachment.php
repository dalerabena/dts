<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentAttachment extends Model
{
    protected $fillable = [
    	'document_id',
    	'filename',
    	'path'
    ];
}
