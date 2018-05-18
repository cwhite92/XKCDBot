<?php

namespace App\Search\Source;

use App\Comic;
use GuzzleHttp\Client;
use function preg_match;

class GoogleSource
{
    public function search(string $terms): ?Comic
    {
        $client = new Client([
            'base_uri' => 'https://www.googleapis.com'
        ]);

        $response = $client->get('/customsearch/v1', [
            'query' => [
                'key' => config('services.google.key'),
                'cx' => config('services.google.app_id'),
                'q' => $terms
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        if ($response['searchInformation']['totalResults'] === 0) {
            return null;
        }

        $hit = $response['items'][0];

        preg_match('~^.*xkcd.com\/([0-9]+)\/?$~', $hit['link'], $matches);

        if (count($matches) === 0) {
            return null;
        }

        return Comic::where('xkcd_id', $matches[1])
            ->first();
    }
}
