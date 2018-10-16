<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'title', 'slug', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
