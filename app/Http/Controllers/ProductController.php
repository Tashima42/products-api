<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $allProducts = Product::all();
            if(empty($allProducts)) {
                return response()->json(['error' => 'There isn\'t any products']);
            }
            return response($allProducts, 200);
        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator  = Validator::make($request->all(), [
                'name' => 'required|max:200|string|unique:App\Models\Product,name',
                'description' => 'max:10000|string|nullable',
                'category_id' => 'required|integer|exists:App\Models\Category,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $product = new Product;
            foreach ($request->all() as $dataName => $data) {
                $product[$dataName] = $data;
            }
            $product->save();
            return response($product, 201);
        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }


    }

    public function show($id)
    {
        try {
            $validator  = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:App\Models\Product,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $product = Product::find($id);
            if(empty($product)) {
                return response()->json(['message' => 'This product doesn\'t exists']);
            }
            return response($product, 200);

        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $toValidate = ['id' => $id];
            $toValidate += $request->all();
            $validator  = Validator::make($toValidate, [
                'name' => 'max:200|string|unique:App\Models\Product,name',
                'description' => 'max:10000|string|nullable',
                'category_id' => 'integer|exists:App\Models\Category,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $product = Product::find($id);
            if(empty($product)) {
                return response()->json(['message' => 'This product doesn\'t exists']);
            }
            foreach ($request->all() as $dataKey => $data) {
                $product[$dataKey] = $data;
            }
            $product->save();
            return response($product, 200);

        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }


    }

    public function destroy($id)
    {
        try {
            $validator  = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:App\Models\Product,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $product = Product::find($id);
            if(empty($product)) {
                return response()->json(['message' => 'This product doesn\'t exists']);
            }
            $product->delete();
            return response()->json(['message' => 'Deleted'], 200);

        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
