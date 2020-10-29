<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'name' => ['required', 'max:200']
            ]);
        $name = $validatedData['name'];

        $category = new Category;
        $category->name = $name;
        $category->save();

        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param $category
     * @return \Illuminate\Http\Response
     */
    public function show($id, $category)
    {
        return $category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:200']
        ]);
        $name = $validatedData['name'];

        $category = Category::find($id);
        $category->name = $name;
        $category->save();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Category::destroy($id);
    }

    public function all($id)
    {
        return Category::find($id)->products;
    }
}
