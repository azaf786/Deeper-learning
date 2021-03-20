<?php

Namespace App\Entity;


class Product
{
    public int $id;
    public string $title;
    public float $averageRating;
    /** @var array CheckIn[] */
    private array $checkIns = [];

    public function addCheckIn(CheckIn $checkIn): void {
        $this->checkIns[] = $checkIn;
    }

    /**
     * @return array
     */
    public function getCheckIns(): array
    {
        return $this->checkIns;
    }
}