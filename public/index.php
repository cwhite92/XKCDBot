<?php

require __DIR__.'/../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \ChrisWhite\XkcdSlack\ComicSearcher;

$app = new \Slim\App();
$container = $app->getContainer();

/**
 * Set up dependency injection.
 */
$container['bingClient'] = function () {
    $guzzle = new \GuzzleHttp\Client();

    return new \ChrisWhite\XkcdSlack\Bing\Client($guzzle, getenv('BING_APPLICATION_KEY'));
};

$container['localSource'] = function () {
    return new \ChrisWhite\XkcdSlack\Search\Sources\LocalSource(__DIR__.'/../storage');
};

$container['bingSource'] = function ($container) {
    return new \ChrisWhite\XkcdSlack\Search\Sources\BingSource($container['bingClient']);
};

$container['comicRepository'] = function () {
    return new \ChrisWhite\XkcdSlack\Search\ComicRepository(__DIR__.'/../storage');
};

$container['searchEngine'] = function($container) {
    $sources = [
        $container['localSource'],
        $container['bingSource']
    ];

    $comicRepository = $container['comicRepository'];

    return new \ChrisWhite\XkcdSlack\Search\Engine($sources, $comicRepository);
};

/**
 * Registers Twig as our template system.
 *
 * @param $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/../src/templates', ['cache' => false]);
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $container['request']->getUri()));

    return $view;
};

/**
 * Respond to requests for the homepage.
 */
$app->get('/', function (Request $request, Response $response) {
    return $this->view->render($response, 'home.html');
});

/**
 * Respond to requests for an XKCD comic search.
 */
$app->post('/xkcd', function (Request $request, Response $response) {
    $searchTerms = $request->getParam('text');

    if (empty($searchTerms)) {
        return $response->withStatus(400);
    }

    $searchEngine = $this->get('searchEngine');
    $comic = $searchEngine->search($searchTerms);

    if (is_null($comic)) {
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'text/plain')
            ->write(sprintf("I couldn't find a comic matching %s", $searchTerms));
    }

    return $response->withJson([
        'response_type' => 'in_channel',
        'attachments' => [
            [
                'fields' => [
                    [
                        'title' => $comic['title'],
                        'value' => $comic['alt'],
                        'short' => false
                    ]
                ],
                'image_url' => $comic['img']
            ]
        ]
    ]);
});

/**
 * Respond to Slack redirecting back from its OAuth flow.
 */
$app->get('/auth', function (Request $request, Response $response) {
    $provider = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => getenv('SLACK_CLIENT_ID'),
        'clientSecret'            => getenv('SLACK_CLIENT_SECRET'),
        'redirectUri'             => getenv('SLACK_REDIRECT_URI'),
        'urlAuthorize'            => 'https://slack.com/oauth/authorize',
        'urlAccessToken'          => 'https://slack.com/api/oauth.access',
        'urlResourceOwnerDetails' => 'https://slack.com/api/users.info'
    ]);

    if ($request->getParam('code')) {
        try {
            // We'll just request an access token and do nothing with it, which will complete the OAuth flow.
            $provider->getAccessToken('authorization_code', [
                'code' => $request->getParam('code')
            ]);
        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            // Silently fail... shhhh.
        }
    }

    return $response->withRedirect('/thanks');
});

/**
 * Respond to the OAuth flow being compelted.
 */
$app->get('/thanks', function (Request $request, Response $response) {
    return $this->view->render($response, 'thanks.html');
});

$app->run();