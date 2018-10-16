<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateCareer extends Model
{
    protected $table = 'candidates_career';

    protected $fillable = [
        'candidates_id', 'career_id'
    ];

    public function Candidate()
    {
        return $this->belongsTo('App\Candidate');
    }

    public function Career()
    {
        return $this->belongsTo('App\Career');
    }
}
