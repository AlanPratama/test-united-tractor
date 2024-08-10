<?php

namespace App\Repository;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface{

    protected $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function getAllProducts()
    {
        return $this->productModel->with("category")->get();
    }

    public function getOneProduct($id)
    {
        return $this->productModel->with("category")->find($id);
    }

    public function createProduct(array $data)
    {
        $product = new Product();
        $product->name = $data["name"];
        $product->price = $data["price"];
        $product->product_category_id = $data["product_category_id"];
        $product->image = $data["image"];

        $product->save();

        return $product;
    }

    public function updateProduct(Product $product, array $data)
    {
        $product->name = $data["name"];
        $product->price = $data["price"];
        $product->product_category_id = $data["product_category_id"];
        $product->image = $data["image"];

        $product->save();

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = $this->productModel->find($id);

        if(!$product) {
            return false;
        }

        $product->delete();

        if($product->image) {
            Storage::delete($product->image);
        }

        return true;
    }


}
