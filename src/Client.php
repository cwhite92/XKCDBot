<?php

namespace ChrisWhite\XkcdSlack;

use Slack\RealTimeClient;

class Client
{
    protected $loop;
    protected $client;

    public function __construct($token)
    {
        $this->loop = \React\EventLoop\Factory::create();
        $this->client = new RealTimeClient($this->loop);
        $this->client->setToken($token);
    }

    public function run()
    {
        $this->client->connect();

        $this->client->on('message', function ($data) use ($client) {
            $this->handleMessage($data);
        });

        $this->loop->run();
    }

    protected function handleMessage($data)
    {
        if (!$this->shouldHandle($data['text'])) {
            return;
        }

        echo "should handle: ".$data['text'];
    }

    protected function shouldHandle($message)
    {
        return substr($message, 0, 5) === '/xkcd';
    }
}