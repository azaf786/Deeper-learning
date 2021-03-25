<?php


namespace App\Entity;


class Products
{
    public ?int $id;
    public string $title;
    public ?string $description;
    public float $price;

    public function addProducts(Products $products): void {
        $this->products[] = $products;
    }


    public function getProducts() : array
    {
        return $this->products;

    }
}