<?php

namespace ChrisWhite\XkcdSlack\Search\Sources;

use ChrisWhite\XkcdSlack\Bing\Client;

class BingSource implements SourceInterface
{
    /**
     * The Bing client used for performing searches.
     *
     * @var Client
     */
    protected $client;

    /**
     * Instantiates a new BingSource.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Perform a Bing search based on the provided terms.
     *
     * @param $terms
     * @return int|null
     */
    public function search($terms)
    {
        $terms = 'site:xkcd.com '.$terms;

        $bingResults = $this->client->performWebSearch($terms);

        if (!isset($bingResults['d']['results'][0])) {
            // No results from Bing :(
            return null;
        }

        $firstResult = $bingResults['d']['results'][0];

        return $this->parseComicId($firstResult);
    }

    /**
     * Parses the XKCD comic ID from a URL.
     *
     * @param $result
     * @return int|null
     */
    protected function parseComicId($result)
    {
        $url = $result['Url'];

        preg_match('~^.+xkcd.com\/([0-9]+)\/$~', $url, $matches);

        if (isset($matches[1])) {
            return $matches[1];
        }

        return null;
    }
}