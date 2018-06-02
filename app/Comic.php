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

    /**
     * Returns the URL to the comic on the xkcd website.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return sprintf('https://xkcd.com/%s', $this->xkcd_id);
    }
}
