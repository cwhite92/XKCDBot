<?php

namespace ChrisWhite\XkcdSlack\Search;

use Predis\Client;

class CachedEngine implements EngineInterface
{
    /**
     * Holds the decorated search engine.
     *
     * @var EngineInterface
     */
    protected $engine;

    /**
     * Holds the predis client.
     *
     * @var Client
     */
    protected $client;

    /**
     * The amount of seconds to keep a result cached.
     */
    const EXPIRY_SECONDS = 604800;

    /**
     * Instantiates a new cached search engine.
     *
     * @param EngineInterface $engine
     * @param Client $client
     */
    public function __construct(EngineInterface $engine, Client $client)
    {
        $this->engine = $engine;
        $this->client = $client;
    }

    /**
     * Performs a cached comic search over all sources.
     *
     * @param $terms
     * @return mixed
     */
    public function search($terms)
    {
        $cachedValue = $this->client->get($terms);

        if ($cachedValue) {
            return unserialize($cachedValue);
        }

        $freshValue = $this->engine->search($terms);

        $this->client->set($terms, serialize($freshValue));
        $this->client->expire($terms, static::EXPIRY_SECONDS);

        return $freshValue;
    }
}