<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{


    protected $fillable = [
        'xkcd_id',
        'title',
        'transcript',
        'alt',
        'image',
        'published_at'
    ];
}
