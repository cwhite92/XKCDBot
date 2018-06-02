<?php

namespace App\Http\Controllers;

use App\Search\CachedSearchEngine;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    private $searchEngine;

    public function __construct(CachedSearchEngine $searchEngine)
    {
        $this->searchEngine = $searchEngine;
    }

    public function search(Request $request)
    {
        $terms = $request->input('text');

        if (empty($terms)) {
            abort(400);
        }

        $comic = $this->searchEngine->search($terms);

        if ($comic === null) {
            return response(
                sprintf("I couldn't find a comic matching %s", $terms),
                200,
                ['content-type' => 'text/plain']
            );
        }

        return response()->json([
            'response_type' => 'in_channel',
            'attachments' => [
                [
                    'fields' => [
                        [
                            'title' => $comic->title,
                            'value' => $comic->alt,
                            'short' => false
                        ]
                    ],
                    'actions' => [
                        [
                            'type' => 'button',
                            'text' => 'View comic on xkcd.com',
                            'url' => $comic->url
                        ]
                    ],
                    'image_url' => $comic->image,
                    'fallback' => $comic->url
                ]
            ]
        ]);
    }
}
