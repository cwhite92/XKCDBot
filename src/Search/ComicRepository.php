<?php

namespace ChrisWhite\XkcdSlack\Search;

class ComicRepository
{
    protected $comicsDirectory;

    /**
     * Instantiates a new comic retriever.
     *
     * @param $comicsDirectory
     */
    public function __construct($comicsDirectory)
    {
        $this->comicsDirectory = $comicsDirectory;
    }

    /**
     * Retrieves a comic by its ID.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $path = sprintf('%s/%s.json', $this->comicsDirectory, $id);

        return json_decode(file_get_contents($path), true);
    }
}