<?php

namespace ChrisWhite\XkcdSlack;

class ComicSearcher
{
    public function search($searchTerms)
    {
        $searchTerms = strtolower($searchTerms);

        foreach ($this->getComics() as $comic) {
            if (strtolower($comic['safe_title']) === $searchTerms) {
                // Perfect match!
                return $this->normaliseComic($comic);
            }
        }
    }

    protected function normaliseComic(array $comic)
    {
        return [
            'title' => $comic['safe_title'],
            'alt' => $comic['alt'],
            'image_url' => $comic['img']
        ];
    }

    protected function getComics()
    {
        $dir = new \DirectoryIterator(__DIR__.'/../storage');

        foreach ($dir as $file) {
            if ($file->isDir() || $file->isDot()) continue;

            yield json_decode(file_get_contents($file->getPathname()), true);
        }
    }
}