<?php

namespace App\Repository;


interface CategoryProductRepositoryInterface {
    public function getAllCategoryProducts();
    public function getOneCategoryProduct($id);
    public function createCategoryProduct(array $data);
    public function updateCategoryProduct($id, array $data);
    public function deleteCategoryProduct($id);
}
