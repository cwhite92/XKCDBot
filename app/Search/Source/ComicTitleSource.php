<?php

namespace App\Search\Source;

use App\Comic;

class ComicTitleSource
{
    public function search(string $terms): ?Comic
    {
        return Comic::where('title', $terms)
            ->first();
    }
}
