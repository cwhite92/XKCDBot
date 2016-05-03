<?php

namespace ChrisWhite\XkcdSlack\Bing;

use GuzzleHttp\Client as GuzzleClient;
use SimpleXMLElement;

class Client
{
    /**
     * The Guzzle client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Our Bing application key for authorization.
     *
     * @var string
     */
    protected $applicationKey;

    /**
     * The URL used for a web search.
     */
    const WEB_SEARCH_URL = 'https://api.datamarket.azure.com/Bing/Search/v1/Web?Query=%27{{query}}%27&Adult=%27Off%27&$format=json';

    /**
     * Instantiates a Bing client.
     *
     * @param \GuzzleHttp\Client $client
     * @param $applicationKey
     */
    public function __construct(GuzzleClient $client, $applicationKey)
    {
        $this->client = $client;
        $this->applicationKey = $applicationKey;
    }

    /**
     * Performs a web search for the provided query.
     *
     * @param $query
     */
    public function performWebSearch($query)
    {
        $url = str_replace('{{query}}', rawurlencode($query), self::WEB_SEARCH_URL);

        $response = $this->client->request('GET', $url, [
            'auth' => [$this->applicationKey, $this->applicationKey]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}