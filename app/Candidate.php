<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'name', 'image', 'title', 'slug', 'gender', 'address', 'email', 'phone', 'birthday', 'marital', 'time_id', 'rating', 'experience', 'educations_id', 'wages_id', 'skill', 'work_experience', 'content', 'created_by', 'updated_by', 'is_deleted', 'created_at', 'updated_at'
    ];

    public function career()
    {
        return $this->belongsToMany('App\Career', 'candidates_career', 'candidates_id', 'career_id');
    }

    public function field()
    {
        return $this->belongsToMany('App\Field', 'candidates_fields', 'candidates_id', 'fields_id');
    }

    public function location()
    {
        return $this->belongsToMany('App\Location', 'candidates_locations', 'candidates_id', 'locations_id');
    }

    public function position()
    {
        return $this->belongsToMany('App\Position', 'candidates_positions', 'candidates_id', 'positions_id');
    }

    public function language()
    {
        return $this->belongsToMany('App\Language', 'candidates_languages', 'candidates_id', 'languages_id')->withPivot('level');
    }

    public function time()
    {
        return $this->belongsTo('App\Time', 'time_id');
    }

    public function education()
    {
        return $this->belongsTo('App\Education', 'educations_id', 'id');
    }

    public function wage()
    {
        return $this->belongsTo('App\Wage', 'wages_id', 'id');
    }
}
