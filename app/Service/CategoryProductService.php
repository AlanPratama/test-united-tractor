<?php

namespace App\Service;

use App\Repository\CategoryProductRepositoryInterface;

class CategoryProductService {

    protected $categoryProductRepository;

    public function __construct(CategoryProductRepositoryInterface $categoryProductRepository)
    {
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function getAllCategoryProducts() {
        return $this->categoryProductRepository->getAllCategoryProducts();
    }

    public function getOneCategoryProduct($id) {
        return $this->categoryProductRepository->getOneCategoryProduct($id);
    }

    public function createCategoryProduct(array $data) {
        return $this->categoryProductRepository->createCategoryProduct($data);
    }

    public function updateCategoryProduct($id, array $data) {
        return $this->categoryProductRepository->updateCategoryProduct($id, $data);
    }

    public function deleteCategoryProduct($id) {
        return $this->categoryProductRepository->deleteCategoryProduct($id);
    }

}
