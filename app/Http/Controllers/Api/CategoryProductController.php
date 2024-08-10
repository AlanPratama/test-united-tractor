<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\CategoryProductService;
// use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{

    protected $categoryProductService;

    public function __construct(CategoryProductService $categoryProductService)
    {
        $this->categoryProductService = $categoryProductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryProducts = $this->categoryProductService->getAllCategoryProducts();

        return response()->json([
            "status" => "success",
            "message" => "Category Product found",
            "data" => $categoryProducts
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
            'name' => 'required|unique:category_products,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "create Category Product failed!",
                "errors" => $validator->errors()
            ], 422);
        }

        $categoryProduct = $this->categoryProductService->createCategoryProduct($request->all());

        return response()->json([
            "status" => "success",
            "message" => "Category Product created successfully",
            "data" => $categoryProduct
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
        $categoryProduct = $this->categoryProductService->getOneCategoryProduct($id);

        if (!$categoryProduct) {
            return response()->json([
                "status" => "failed",
                "message" => "Category Product not found",
                "data" => []
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "message" => "Category Product found",
            "data" => $categoryProduct
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
            'name' => 'required|unique:category_products,name,' . $id . ",id"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "update Category Product failed!",
                "errors" => $validator->errors()
            ], 422);
        }

        $categoryProduct = $this->categoryProductService->updateCategoryProduct($id, $request->all());

        if (!$categoryProduct) {
            return response()->json([
                "status" => "failed",
                "message" => "Category Product not found"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "message" => "Category Product updated successfully",
            "data" => $categoryProduct
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

        if ($this->categoryProductService->deleteCategoryProduct($id)) {
            return response()->json([
                "status" => "success",
                "message" => "Category Product deleted successfully!"
            ], 200);
        }

        return response()->json([
            "status" => "failed",
            "message" => "Category Product not found"
        ], 404);
    }
}
