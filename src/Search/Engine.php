<?php

namespace ChrisWhite\XkcdSlack\Search;

class Engine
{
    /**
     * Holds the sources to aid the search.
     *
     * @var array
     */
    protected $sources = [];

    /**
     * Holds the comic repository responsible for retrieving the comic.
     *
     * @var ComicRepository
     */
    protected $comics;

    /**
     * Instantiates a new search engine.
     *
     * @param array $sources
     * @param ComicRepository $comics
     */
    public function __construct(array $sources, ComicRepository $comics)
    {
        $this->sources = $sources;
        $this->comics = $comics;
    }

    /**
     * Performs a comic search over all sources.
     *
     * @param $terms
     * @return mixed
     */
    public function search($terms)
    {
        foreach ($this->sources as $source) {
            $comicId = $source->search($terms);

            if (is_null($comicId)) {
                // We didn't get a match, try next source.
                continue;
            }

            return $this->comics->find($comicId);
        }

        // We didn't get a comic match over any of our sources.
        return null;
    }
}