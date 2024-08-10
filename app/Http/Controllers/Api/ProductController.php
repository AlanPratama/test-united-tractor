<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Service\CategoryProductService;
use App\Service\ProductService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryProductService;

    public function __construct(ProductService $productService, CategoryProductService $categoryProductService)
    {
        $this->productService = $productService;
        $this->categoryProductService = $categoryProductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();

        return response()->json([
            "status" => "success",
            "message" => "Product found",
            "data" => $products
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            "product_category_id" => "integer"
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "create Product failed!",
                "errors" => $validator->errors()
            ], 422);
        }

        if($request->product_category_id) {
            $categoryProduct = $this->categoryProductService->getOneCategoryProduct($request->product_category_id);

            if(!$categoryProduct) {
                return response()->json([
                    "status" => "failed",
                    "message" => "Category Product not found!",
                    "data" => []
                ], 404);
            }
        }

        $data = $request->only("name", "price", "product_category_id");

        if($request->hasFile("image")) {
            $file = $request->file("image");
            $extention = $file->getClientOriginalExtension();
            $fileName = Str::slug($request->name) . "-" . time() . "." . $extention;
            $path = $file->storeAs("products", $fileName);
            $data["image"] = $path;
        }

        $product = $this->productService->createProduct($data);

        return response()->json([
            "status" => "success",
            "message" => "Product created successfully",
            "data" => Product::with("category")->find($product->id)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->getOneProduct($id);

        if(!$product) {
            return response()->json([
                "status" => "failed",
                "message" => "Product not found",
                "data" => []
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "message" => "Product found",
            "data" => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer|min:0',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
            "product_category_id" => "integer"
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "create Product failed!",
                "errors" => $validator->errors()
            ], 422);
        }

        if($request->product_category_id) {
            if(!$this->categoryProductService->getOneCategoryProduct($request->product_category_id)) {
                return response()->json([
                    "status" => "failed",
                    "message" => "Category Product not found!",
                    "data" => []
                ], 404);
            }
        }

        $data = $request->only("name", "price", "product_category_id");
        $product = $this->productService->getOneProduct($id);

        if(!$product) {
            return response()->json([
                "status" => "failed",
                "message" => "Product not found",
                "data" => []
            ], 404);
        }

        $data["image"] = $product->image;

        if($request->hasFile("image")) {
            if($product->image) {
                Storage::delete($product->image);
            }

            $file = $request->file("image");
            $extention = $file->getClientOriginalExtension();
            $fileName = Str::slug($request->name) . "-" . time() . "." . $extention;
            $path = $file->storeAs("products", $fileName);
            $data["image"] = $path;
        }

        $updatedProduct = $this->productService->updateProduct($product, $data);

        return response()->json([
            "status" => "success",
            "message" => "Product updated successfully",
            "data" => $updatedProduct
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->deleteProduct($id);

        if(!$product) {
            return response()->json([
                "status" => "failed",
                "message" => "Product not found"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "message" => "Product deleted successfully!"
        ], 200);
    }
}
