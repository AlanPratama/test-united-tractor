<?php

namespace App\Repository;

use App\Models\Product;

interface ProductRepositoryInterface {
    public function getAllProducts();
    public function getOneProduct($id);
    public function createProduct(array $data);
    public function updateProduct(Product $product, array $data);
    public function deleteProduct($id);
}
