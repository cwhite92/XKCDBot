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
    public function getComicUrlAttribute()
    {
        return sprintf('https://xkcd.com/%d', $this->xkcd_id);
    }

    /**
     * Returns the URL to the explainxkcd entry for this comic.
     *
     * @return string
     */
    public function getExplainUrlAttribute()
    {
        return sprintf('https://www.explainxkcd.com/wiki/index.php/%d', $this->xkcd_id);
    }
}
