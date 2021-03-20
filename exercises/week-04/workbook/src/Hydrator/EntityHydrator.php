<?php


namespace App\Hydrator;


use App\Entity\CheckIn;
use App\Entity\Product;

class EntityHydrator
{
    public function hydrateProduct(): Product
    {
        // ...
    }

    public function hydrateCheckIn(): CheckIn
    {
        // ...
    }

    public function hydrateProductWithCheckIns(array $data): Product
    {
        $product = new Product();
        $product->id = $data[0]['product_id'];
        $product->title = $data[0]['title'];
        $product->averageRating = $data[0]['averageRating'];
        foreach ($data as $checkinRow) {
            $checkIn = new CheckIn();
            $checkIn->id = $checkinRow['id'];
            $checkIn->name = $checkinRow['name'];
            $checkIn->review = $checkinRow['review'];
            $checkIn->rating = $checkinRow['rating'];
            $checkIn->productId = $checkinRow['product_id'];

            $product->addCheckin($checkIn);
        }

        return $product;
    }

}