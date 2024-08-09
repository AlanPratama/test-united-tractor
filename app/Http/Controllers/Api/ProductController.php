<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with("category")->get();

        return response()->json([
            "status" => "success",
            "message" => "Product created successfully",
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
            $categoryProduct = CategoryProduct::find($request->product_category_id);

            if(!$categoryProduct) {
                return response()->json([
                    "status" => "failed",
                    "message" => "Category Product not found!",
                ], 404);
            }
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->product_category_id = $request->product_category_id;

        if($request->hasFile("image")) {
            $file = $request->file("image");
            $extention = $file->getClientOriginalExtension();
            $fileName = Str::slug($request->name) . "-" . time() . "." . $extention;
            $path = $file->storeAs("products", $fileName);
            $product->image = $path;
        }

        $product->save();

        return response()->json([
            "status" => "success",
            "message" => "Product created successfully",
            "data" => Product::with("category")->find($product->id)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with("category")->find($id);

        if(!$product) {
            return response()->json([
                "status" => "failed",
                "message" => "Product not found"
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


        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                "status" => "failed",
                "message" => "Product not found"
            ], 404);
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->product_category_id = $request->product_category_id;

        if($request->hasFile("image")) {
            if($product->image) {
                Storage::delete($product->image);
            }

            $file = $request->file("image");
            $extention = $file->getClientOriginalExtension();
            $fileName = Str::slug($request->name) . "-" . time() . "." . $extention;
            $path = $file->storeAs("products", $fileName);
            $product->image = $path;
        }

        $product->save();

        return response()->json([
            "status" => "success",
            "message" => "Product updated successfully",
            "data" => $product
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
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                "status" => "failed",
                "message" => "Product not found"
            ], 404);
        }

        $product->delete();

        if($product->image) {
            Storage::delete($product->image);
        }

        return response()->json([
            "status" => "success",
            "message" => "Product deleted successfully!"
        ], 200);
    }
}
