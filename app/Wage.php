<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    protected $table = 'wages';

    protected $fillable = [
        'title', 'slug', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
