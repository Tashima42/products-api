<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SuppliersProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuppliersProductsController extends Controller
{
    public function index()
    {
        try {
            $allSuppliersProducts = Category::all();
            if(empty($allSuppliersProducts)) {
                return response()->json(['error' => 'There isn\'t any suppliers-products']);
            }
            return response($allSuppliersProducts, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer|exists:App\Models\Product,id',
                'supplier_id' => 'required|integer|exists:App\Models\Supplier,id',
                'price' => 'required|numeric'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $suppliersProducts = new SuppliersProducts;
            foreach ($request->all() as $dataName => $data) {
                $suppliersProducts[$dataName] = $data;
            }
            $suppliersProducts->save();
            return response($suppliersProducts, 201);

        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:App\Models\SuppliersProducts,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $supplierProduct = SuppliersProducts::find($id);
            if(empty($supplierProduct)) {
                return response()->json(['message' => 'This supplier-product doesn\'t exists']);
            }
            return response($supplierProduct, 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500) ;
        }
        return SuppliersProducts::find($id);
    }

    public function update(Request $request, $id)
    {
        try {
            $toValidate = ['id' => $id];
            $toValidate += $request->all();

            $validator = Validator::make($toValidate, [
                'product_id' => 'integer|exists:App\Models\Product,id',
                'supplier_id' => 'integer|exists:App\Models\Supplier,id',
                'price' => 'numeric'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $suppliersProducts = SuppliersProducts::find($id);
            foreach ($request->all() as $dataName => $data) {
                $suppliersProducts[$dataName] = $data;
            }
            $suppliersProducts->save();
            return response($suppliersProducts, 200);

        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:App\Models\SuppliersProducts,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $suppliersProducts = SuppliersProducts::find($id);
            if(empty($suppliersProducts)) {
                return response()->json(['error' => 'This supplier-product doesn\'t exists']);
            }
            $suppliersProducts->delete();
            return response()->json(['message' => 'Deleted'], 200);
        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500) ;
        }
    }
}
