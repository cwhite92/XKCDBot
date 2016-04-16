<?php

require __DIR__.'/../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \ChrisWhite\XkcdSlack\ComicSearcher;

$settings = ['displayErrorDetails' => true];

$app = new \Slim\App(['settings' => $settings]);

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer(__DIR__.'/../src/templates/');

$app->get('/', function (Request $request, Response $response) {
    return $this->view->render($response, 'home.html');
});

$app->post('/xkcd', function (Request $request, Response $response) {
    $searchTerms = $request->getParam('text');

    if (empty($searchTerms)) return $response->withStatus(400);

    $searcher = new ComicSearcher();
    $result = $searcher->search($searchTerms);

    return $response->withJson([
        'response_type' => 'in_channel',
        'attachments' => [
            [
                'fields' => [
                    [
                        'title' => $result['title'],
                        'value' => $result['alt'],
                        'short' => false
                    ]
                ],
                'image_url' => $result['image_url']
            ]
        ]
    ]);
});

$app->run();