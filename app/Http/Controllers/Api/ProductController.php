<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Product Listing
    public function index(Request $request){
        $products = Product::all();
        return response()->json([
            'status' => true,
            'message' => "Product Listed Successfully",
            'data' => $products,
        ], 200);
    }

    //Add Product
    public function create(Request $request){

        $validateProduct = Validator::make($request->all(),[
            'product_name' => 'required|unique:products,product_name',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
        ]);

        if($validateProduct->fails()){
            return response()->json([
                'status' => false,
                'message' => "validation error",
                'data' => $validateProduct->errors(),
            ], 422);
        }

        $inputData = array(
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => isset($request->description) ? $request->description : '',
        );

        $products = Product::create($inputData);

        return response()->json([
            'status' => true,
            'message' => "Product Added Successfully",
            'data' => $products,
        ], 200);

    }

     //Update Product
    public function update(Request $request){
        $validateProduct = Validator::make($request->all(),[
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
        ]);

        if($validateProduct->fails()){
            return response()->json([
                'status' => false,
                'message' => "validation error",
                'data' => $validateProduct->errors(),
            ], 422);
        }

        $products = Product::find($request->product_id);
        $products->product_name = $request->product_name;
        $products->quantity = $request->quantity;
        $products->price = $request->price;
        $products->description = isset($request->description);
        $products->save();

        return response()->json([
            'status' => true,
            'message' => "Product Updated Successfully",
            'data' => $products,
        ], 200);
    }

    //Delete Product
    public function delete(Request $request){
        $validateProduct = Validator::make($request->all(),[
            'product_id' => 'required|exists:products,id',
        ]);

        if($validateProduct->fails()){
            return response()->json([
                'status' => false,
                'message' => "validation error",
                'data' => $validateProduct->errors(),
            ], 422);
        }

        $products = Product::find($request->product_id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Product Deleted Successfully",
        ], 200);
    }
}
