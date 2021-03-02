<?php

namespace Tests\Service;

use App\Entity\Checkin;
use App\Service\CheckinService;
use Tests\TestCase;

use function random_int;

class CheckinServiceTest extends TestCase
{
    public function testGenerate(): void
    {
        $checkinService = new CheckinService();

        $recordCount = random_int(1, 5);

        $checkins = $checkinService->generate($recordCount);

        $this->assertCount($recordCount, $checkins);
        $this->assertInstanceOf(Checkin::class, $checkins[0]);
    }
}
