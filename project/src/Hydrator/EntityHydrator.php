<?php


namespace App\Hydrator;


use App\Entity\Category;
use App\Entity\Products;
use App\Entity\User;

class EntityHydrator
{
    public function hydrateProduct(array $data): ?Products
    {
        $productClass = new Products();
        $productClass->id = $data['id'] ?? null;
        $productClass->title = $data['title'];
        $productClass->description = $data['description'];
        $productClass->price = $data['price'];
        $productClass->filePath = $data['filePath'];

        return $productClass;
    }

    public function hydrateProducts(array $data): ?Products
    {
        $products = new Products();
        $products->id = $data['id'] ?? null;
        $products->title = $data['title'];
        $products->description = $data['description'];
        $products->price = $data['price'];
        $products->filePath = $data['filePath'];

        return $products;
    }


    public function hydrateCategory(array $data): Category
    {
        $category = new Category();
        $category->catId = $data['catId'] ?? null;
        $category->catTitle = $data['catTitle'];
        $category->parent_id = $data['parent_id'] ?? null;
        return $category;

    }


    public function hydrateUser(array $data): User
    {
        $user = new User();
        $user->id = $data['id'] ?? null;
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        return $user;
    }

}