<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateField extends Model
{
    protected $table = 'candidates_fields';

    protected $fillable = [
        'candidates_id', 'fields_id'
    ];

    public function Candidate()
    {
        return $this->belongsTo('App\Candidate');
    }

    public function Field()
    {
        return $this->belongsTo('App\Candidate');
    }
}
