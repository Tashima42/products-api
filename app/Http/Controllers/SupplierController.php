<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $allSuppliers = Supplier::all();
            if(empty($allSuppliers)) {
                return response()->json(['error' => 'There isn\'t any categories']);
            }
            return response($allSuppliers, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'company_name' => 'required|max:500|string|unique:App\Models\Supplier,company_name',
                'trading_name' => 'required|max:500|string',
                'cnpj' => 'required|max:20|string|unique:App\Models\Supplier,cnpj',
                'address_1' => 'required|max:2000|string',
                'address_2' =>  'max:2000|string|nullable',
                'telephone_1' => 'required|max:15|string',
                'telephone_2' => 'max:15|string|nullable'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $supplier = new Supplier;
            foreach ($request->all() as $dataName => $data) {
                $supplier[$dataName] = $data;
            }
            $supplier->save();
            return response($supplier, 201);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function show($id)
    {
        return Supplier::find($id);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'company_name' => 'max:500|string|unique:App\Models\Supplier,company_name',
                'trading_name' => 'max:500|string',
                'cnpj' => 'max:20|string|unique:App\Models\Supplier,cnpj',
                'address_1' => 'max:2000|string',
                'address_2' =>  'max:2000|string|nullable',
                'telephone_1' => 'max:15|string',
                'telephone_2' => 'max:15|string|nullable'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $supplier = Supplier::find($id);
            if(empty($supplier)) {
                return response()->json(['message' => 'This supplier doesn\'t exists']);
            }
            foreach ($request->all() as $dataName => $data) {
                $supplier[$dataName] = $data;
            }
            $supplier->save();
            return response($supplier, 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:App\Models\Supplier,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $supplier = Supplier::find($id);
            if(empty($supplier)) {
                return response()->json(['error' => 'This supplier doesn\'t exists']);
            }
            $supplier->delete();
            return response()->json(['message' => 'Deleted'], 200);
        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500) ;
        }
    }
}
