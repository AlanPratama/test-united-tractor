<?php

namespace App\Repository;

use App\Models\CategoryProduct;

class CategoryProductRepository implements CategoryProductRepositoryInterface{

    protected $categoryProductModel;

    public function __construct(CategoryProduct $categoryProductModel)
    {
        $this->categoryProductModel = $categoryProductModel;
    }

    public function getAllCategoryProducts()
    {
        return $this->categoryProductModel->get();
    }

    public function getOneCategoryProduct($id)
    {
        return $this->categoryProductModel->find($id);
    }

    public function createCategoryProduct(array $data)
    {
        $categoryProduct = new CategoryProduct();
        $categoryProduct->name = $data["name"];
        $categoryProduct->save();

        return $categoryProduct;
    }

    public function updateCategoryProduct($id, array $data)
    {
        $categoryProduct = $this->categoryProductModel->find($id);

        if(!$categoryProduct) {
            return null;
        }

        $categoryProduct->name = $data["name"];
        $categoryProduct->save();
        return $categoryProduct;
    }

    public function deleteCategoryProduct($id)
    {
        $categoryProduct = $this->categoryProductModel->find($id);

        if(!$categoryProduct) {
            return false;
        }

        $categoryProduct->delete();
        return true;
    }
}

