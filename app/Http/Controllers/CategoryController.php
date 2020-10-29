<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $allCategories = Category::all();
            if(empty($allCategories)) {
                return response()->json(['error' => 'There isn\'t any categories']);
            }
            return response($allCategories, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:200|string|unique:App\Models\Category,name'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $category = new Category;
            $category->name = $request->name;
            $category->save();

            return response($category, 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500) ;
        }
    }

    public function show($id)
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:App\Models\Category,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $category = Category::find($id);
            if(empty($category)) {
                return response()->json(['message' => 'This category doesn\'t exists']);
            }
            return response($category, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500) ;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $toValidate = ['id' => $id];
            $toValidate += $request->all();

            $validator = Validator::make($toValidate, [
                'name' => 'required|max:200|string|unique:App\Models\Category,name',
                'id' => 'required|integer|exists:App\Models\Category,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $category = Category::find($id);
            if(empty($category)) {
                return response()->json(['error' => 'This category doesn\'t exists'], 400);
            }
            $category->name = $request['name'];
            $category->save();

            return response($category, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500) ;
        }
    }

    public function destroy($id)
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:App\Models\Category,id'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $category = Category::find($id);
            if(empty($category)) {
                return response()->json(['error' => 'This category doesn\'t exists']);
            }
            $category->delete();
            return response()->json(['message' => 'Deleted'], 200);
        }  catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500) ;
        }
    }
}
