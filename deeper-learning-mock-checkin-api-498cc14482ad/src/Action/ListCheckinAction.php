<?php

namespace App\Action;

use App\Service\CheckinService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function json_encode;
use function random_int;

class ListCheckinAction
{
    private CheckinService $checkinService;

    public function __construct(CheckinService $checkinRepository)
    {
        $this->checkinService = $checkinRepository;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $recordCount = random_int(0, 5);
        $checkins = $this->checkinService->generate($recordCount);

        $response->getBody()->write(json_encode($checkins));

        return $response;
    }
}
