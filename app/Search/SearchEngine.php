<?php

namespace App\Search;

use App\Comic;
use App\Search\Source\ComicIdSource;
use App\Search\Source\ComicTitleSource;
use App\Search\Source\GoogleSource;
use App\Search\Source\RandomComicSource;

class SearchEngine
{
    private $sources;

    public function __construct()
    {
        $this->sources = [
            RandomComicSource::class,
            ComicIdSource::class,
            ComicTitleSource::class,
            GoogleSource::class,
        ];
    }

    public function search(string $terms): ?Comic
    {
        foreach ($this->sources as $source) {
            $result = app($source)->search($terms);

            if ($result !== null) {
                return $result;
            }
        }

        return null;
    }
}
