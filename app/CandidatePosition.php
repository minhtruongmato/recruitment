<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidatePosition extends Model
{
    protected $table = 'candidates_positions';

    protected $fillable = [
        'candidates_id', 'positions_id'
    ];

    public function Candidate()
    {
        return $this->belongsTo('App\Candidate');
    }

    public function Position()
    {
        return $this->belongsTo('App\Position');
    }
}
