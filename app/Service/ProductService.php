<?php

namespace App\Service;

use App\Repository\ProductRepositoryInterface;

class ProductService
{

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }


    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getOneProduct($id)
    {
        return $this->productRepository->getOneProduct($id);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->createProduct($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->updateProduct($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }

}
