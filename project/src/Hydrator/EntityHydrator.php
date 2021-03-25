<?php


namespace App\Hydrator;


use App\Entity\CheckIn;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Products;

class EntityHydrator
{
    public function hydrateProduct(array $data): Product
    {
        $product = new Product();
        $product->id = $data['id'];
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->imagePath = $data['image_path'];
        $product->average_rating = $data['average_rating'];

        return $product;
    }

    public function hydrateProducts(array $data): Products
    {
        $products = new Products();
        $products->id = $data['id'];
        $products->title = $data['title'];
        $products->description = $data['description'] ?? null;
        $products->price = $data['price'];

        return $products;
    }

    public function hydrateCheckIn(): CheckIn
    {
        $checkIn = new CheckIn();
        $checkIn->id = $data['id'] ?? null;
        $checkIn->name = $data['name'];
        $checkIn->rating = $data['rating'];
        $checkIn->review = $data['review'];
        $checkIn->productId = $data['product_id'];

        return $checkIn;
    }


    public function hydrateCategory(array $data): Category
    {
            $category = new Category();
            $category->catId = $data['catId'] ?? null;
            $category->catTitle = $data['catTitle'];
            $category->parent_id = $data['parent_id'] ?? null;
//            $category->addCategory($category);
//            var_dump($category);
            return $category;

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