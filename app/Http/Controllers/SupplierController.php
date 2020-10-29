<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\Cnpj;

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
                'company_name' => ['required','max:500','string','unique:App\Models\Supplier,company_name'],
                'trading_name' => ['required','max:500','string'],
                'cnpj' => ['required','unique:App\Models\Supplier,cnpj', new Cnpj],
                'address_1' => ['required','max:2000','string'],
                'address_2' =>  ['max:2000','string','nullable'],
                'telephone_1' => ['required', 'min:8', 'max:15','string', 'regex:/(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})/'],
                'telephone_2' => ['min:8', 'max:15','string', 'regex:/(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})/','nullable']
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $requestData = $request->all();
            if($requestData['cnpj']) {
                $requestData['cnpj'] = preg_replace('/[^0-9]/', '', (string) $requestData['cnpj']);
            }

            $supplier = new Supplier;
            foreach ($requestData as $dataName => $data) {
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
                'company_name' => ['max:500','string','unique:App\Models\Supplier,company_name'],
                'trading_name' => ['max:500','string'],
                'cnpj' => ['unique:App\Models\Supplier,cnpj', new Cnpj],
                'address_1' => ['max:2000','string'],
                'address_2' =>  ['max:2000','string','nullable'],
                'telephone_1' => ['min:8', 'max:15','string', 'regex:/(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})/'],
                'telephone_2' => ['min:8', 'max:15','string', 'regex:/(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})/','nullable']
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $requestData = $request->all();
            if($requestData['cnpj']) {
                $requestData['cnpj'] = preg_replace('/[^0-9]/', '', (string) $requestData['cnpj']);
            }

            $supplier = Supplier::find($id);
            if(empty($supplier)) {
                return response()->json(['message' => 'This supplier doesn\'t exists']);
            }
            foreach ($requestData as $dataName => $data) {
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
                'id' => ['required','integer','exists:App\Models\Supplier,id']
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
