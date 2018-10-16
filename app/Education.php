<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'title', 'slug', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
