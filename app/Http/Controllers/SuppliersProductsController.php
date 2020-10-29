<?php

namespace App\Http\Controllers;

use App\Models\SuppliersProducts;
use Illuminate\Http\Request;

class SuppliersProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SuppliersProducts::all();
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
            'product_id' => ['required', 'integer', 'exists:App\Models\Product,id'],
            'supplier_id' => ['required', 'integer', 'exists:App\Models\Supplier,id'],
            'price' => ['required', 'numeric']
        ]);

        $suppliersProducts = new SuppliersProducts;
        foreach ($validatedData as $dataName => $data) {
            $suppliersProducts[$dataName] = $data;
        }
        $suppliersProducts->save();

        return $suppliersProducts;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SuppliersProducts::find($id);
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
            'product_id' => ['integer', 'exists:App\Models\Product,id'],
            'supplier_id' => ['integer', 'exists:App\Models\Supplier,id'],
            'price' => ['numeric']
        ]);

        $suppliersProducts = SuppliersProducts::find($id);
        foreach ($validatedData as $dataName => $data) {
            $suppliersProducts[$dataName] = $data;
        }
        $suppliersProducts->save();

        return $suppliersProducts;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplierProducts = SuppliersProducts::find($id);
        return $supplierProducts->delete();
    }
}
