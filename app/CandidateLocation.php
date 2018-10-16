<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateLocation extends Model
{
    protected $table = 'candidates_locations';

    protected $fillable = [
        'candidates_id', 'locations_id'
    ];

    public function Candidate()
    {
        return $this->belongsTo('App\Candidate');
    }

    public function Location()
    {
        return $this->belongsTo('App\Location');
    }
}
