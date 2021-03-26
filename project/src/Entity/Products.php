<?php


namespace App\Entity;


class Products
{
    public ?int $id;
    public string $title;
    public string $description;
    public float $price;
    public string $filePath;

    /**
     * Products constructor.
     */
    public function __construct()
    {
    }

}