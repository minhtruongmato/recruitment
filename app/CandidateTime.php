<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateTime extends Model
{
    protected $table = 'candidates_time';

    protected $fillable = [
        'candidates_id', 'time_id'
    ];

    public function Candidate()
    {
        return $this->belongsTo('App\Candidate');
    }

    public function Time()
    {
        return $this->belongsTo('App\Time');
    }
}
