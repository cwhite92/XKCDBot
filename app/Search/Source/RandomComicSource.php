<?php

namespace App\Search\Source;

use App\Comic;

class RandomComicSource
{
    public function search(string $terms): ?Comic
    {
        if ($terms === '!random') {
            return Comic::inRandomOrder()
                ->first();
        }

        return null;
    }
}
