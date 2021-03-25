<?php


namespace App\Entity;


class Category
{
    public ?int $catId;
    public string $catTitle;
    public ?int $parent_id;
    private array $categories = [];

    public function addCategory(Category $category): void {
        $this->categories[] = $category;
    }


    public function getCategory() : array
    {
        return $this->categories;

    }

}