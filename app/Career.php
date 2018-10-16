<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'career';

    protected $fillable = [
        'title', 'slug', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    public function CandidateCareer()
    {
        return $this->belongsToMany('App\CandidateCareer', 'candidates_career', 'career_id', 'candidates_id');
    }
}
