<?php

namespace App\Entity;

use DateTime;
use JsonSerializable;

class Checkin implements JsonSerializable
{
    public int $id;
    public string $name;
    public ?string $review;
    public int $rating;
    public DateTime $dateTime;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'review' => $this->review,
            'rating' => $this->rating,
            'dateTime' => $this->dateTime->format(DateTime::ATOM),
        ];
    }
}
