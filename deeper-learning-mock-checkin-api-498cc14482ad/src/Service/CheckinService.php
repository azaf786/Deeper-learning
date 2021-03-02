<?php

namespace App\Service;

use App\Entity\Checkin;
use Faker\Factory as Faker;

class CheckinService
{
    /**
     * @return Checkin[]
     */
    public function generate(int $recordCount): array
    {
        $checkins = [];

        for($i = 0; $i < $recordCount; $i++) {
            $checkins[] = $this->generateCheckin();
        }

        return $checkins;
    }

    private function generateCheckin(): Checkin
    {
        $faker = Faker::create();

        $checkin = new Checkin();
        $checkin->id = $faker->numberBetween(1);
        $checkin->dateTime = $faker->dateTime();
        $checkin->name = $faker->name();
        $checkin->rating = $faker->numberBetween(1, 5);
        $checkin->review = $faker->realText();

        return $checkin;
    }
}
