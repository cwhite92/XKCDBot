<?php

namespace App\Http\Controllers;

use App\Search\CachedSearchEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComicController extends Controller
{
    private $searchEngine;

    public function __construct(CachedSearchEngine $searchEngine)
    {
        $this->searchEngine = $searchEngine;
    }

    public function __invoke(Request $request)
    {
        $terms = $request->input('text');

        if (empty($terms)) {
            abort(400);
        }

        $comic = $this->searchEngine->search($terms);

        Log::info('User searched for comic', [
            'terms' => $terms,
            'comic' => $comic ? $comic->toArray() : $comic
        ]);

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
                            'short' => false
                        ]
                    ],
                    'actions' => [
                        [
                            'name' => 'view',
                            'type' => 'button',
                            'text' => 'View comic on xkcd.com',
                            'url' => $comic->comic_url
                        ],
                        [
                            'name' => 'explain',
                            'type' => 'button',
                            'text' => 'Explain comic',
                            'url' => $comic->explain_url
                        ],
                        [
                            'name' => 'alt',
                            'type' => 'button',
                            'text' => 'Show alt text',
                            'confirm' => [
                                'title' => 'Alt text',
                                'text' => $comic->alt,
                                'ok_text' => 'OK',
                                'dismiss_text' => 'Cancel'
                            ]
                        ]
                    ],
                    'image_url' => $comic->image,
                    'fallback' => $comic->comic_url
                ]
            ]
        ]);
    }
}
