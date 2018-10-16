<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    protected $table = 'candidates_languages';
    public $timestamps = false;
    protected $fillable = [
        'candidates_id', 'languages_id'
    ];
}
