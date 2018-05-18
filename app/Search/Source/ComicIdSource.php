<?php

namespace App\Search\Source;

use App\Comic;

class ComicIdSource
{
    public function search(string $terms): ?Comic
    {
        return Comic::where('xkcd_id', $terms)
            ->first();
    }
}
