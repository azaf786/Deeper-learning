<?php
declare(strict_types=1);

use App\Action\ListCheckinAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return static function (App $app) {
    $app->get('/', function(Request $request, Response $response) {
        $response->getBody()->write('Hello world..!');
        return $response;
    });

    $app->get('/checkins', ListCheckinAction::class);

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*');
    });
};
