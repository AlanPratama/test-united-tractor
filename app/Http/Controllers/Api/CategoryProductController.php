<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = CategoryProduct::all();

        return response()->json([
            "status" => "success",
            "message" => "Category Product created successfully",
            "data" => $category
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

        $category = new CategoryProduct();
        $category->name = $request->name;
        $category->save();

        // $category = CategoryProduct::create([
        //     "name" => $request->name
        // ]);

        return response()->json([
            "status" => "success",
            "message" => "Category Product created successfully",
            "data" => $category
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
        $category = CategoryProduct::find($id);

        if (!$category) {
            return response()->json([
                "status" => "failed",
                "message" => "Category Product not found"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "message" => "Category Product found",
            "data" => $category
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
        $category = CategoryProduct::find($id);
        if (!$category) {
            return response()->json([
                "status" => "failed",
                "message" => "Category Product not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:category_products,name,' . $category->id . ",id"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "create Category Product failed!",
                "errors" => $validator->errors()
            ], 422);
        }

        $category->name = $request->name;
        $category->save();

        return response()->json([
            "status" => "success",
            "message" => "Category Product updated successfully",
            "data" => $category
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
        $category = CategoryProduct::find($id);

        if (!$category) {
            return response()->json([
                "status" => "failed",
                "message" => "Category Product not found"
            ], 404);
        }

        foreach ($category->products as $products) {
            $products->product_category_id = null;
            $products->save();
        }

        $category->delete();

        return response()->json([
            "status" => "success",
            "message" => "Category Product deleted successfully!"
        ], 200);
    }
}
