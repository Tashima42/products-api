<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Supplier::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => ['required', 'max:500', 'string', 'unique:App\Models\Supplier,company_name'],
            'trading_name' => ['required', 'max:500', 'string'],
            'cnpj' => ['required', 'max:20', 'string', 'unique:App\Models\Supplier,cnpj'],
            'address_1' => ['required', 'max:2000', 'string'],
            'address_2' =>  ['max:2000', 'string', 'nullable'],
            'telephone_1' => ['required', 'max:15', 'string'],
            'telephone_2' => ['max:15', 'string', 'nullable'],
        ]);

        $supplier = new Supplier;
        foreach ($validatedData as $dataName => $data) {
            $supplier[$dataName] = $data;
        }
        $supplier->save();

        return $supplier;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Supplier::find($id);
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
        $validatedData = $request->validate([
            'company_name' => ['max:500', 'string', 'unique:App\Models\Supplier,company_name'],
            'trading_name' => ['max:500', 'string'],
            'cnpj' => ['max:20', 'string', 'unique:App\Models\Supplier,cnpj'],
            'address_1' => ['max:2000', 'string'],
            'address_2' =>  ['max:2000', 'string', 'nullable'],
            'telephone_1' => ['max:15', 'string'],
            'telephone_2' => ['max:15', 'string', 'nullable'],
        ]);

        $supplier = Supplier::find($id);
        foreach ($validatedData as $dataName => $data) {
            $supplier[$dataName] = $data;
        }
        $supplier->save();

        return $supplier;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        return $supplier->delete();
    }
}
