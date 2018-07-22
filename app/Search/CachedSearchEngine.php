<?php

namespace App\Search;

use App\Comic;
use Illuminate\Support\Facades\Cache;
use function sha1;

class CachedSearchEngine
{
    private $searchEngine;

    public function __construct(SearchEngine $searchEngine)
    {
        $this->searchEngine = $searchEngine;
    }

    public function search(string $terms): ?Comic
    {
        $key = sha1($terms);

        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $result = $this->searchEngine->search($terms);

        if ($this->shouldCache($terms)) {
            Cache::put($key, $result, now()->addDays(30));
        }

        return $result;
    }

    /**
     * Determines if we should cache the given search term.
     *
     * @param string $terms
     * @return bool
     */
    private function shouldCache(string $terms): bool
    {
        return $terms !== '!random';
    }
}
