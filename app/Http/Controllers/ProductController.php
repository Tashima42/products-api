<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            'name' => ['required', 'max:200', 'string', 'unique:App\Models\Product,name'],
            'description' => ['max:10000', 'string', 'nullable'],
            'category_id' => ['required', 'integer', 'exists:App\Models\Category,id'],
        ]);

        $product = new Product;
        foreach ($validatedData as $dataName => $data) {
            $product[$dataName] = $data;
        }
        $product->save();

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
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
            'name' => ['required', 'max:200', 'string', 'unique:App\Models\Product,name'],
            'description' => ['max:10000', 'string', 'nullable'],
            'category_id' => ['integer', 'exists:App\Models\Category,id'],
        ]);
        $product = Product::find($id);
        foreach ($validatedData as $dataKey => $data) {
            $product[$dataKey] = $data;
        }
        $product->save();

        return $product;
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
        return $product->delete();
    }
}
