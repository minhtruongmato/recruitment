<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';

    protected $fillable = [
        'title', 'slug', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    public function CandidateField()
    {
        return $this->belongsToMany('App\CandidateField', 'candidates_fields', 'fields_id', 'candidates_id');
    }
}
