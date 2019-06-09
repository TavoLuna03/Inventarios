<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    public function show($id)
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $Category = Category::create($request->all());

        return (new CategoryResource($Category))
                ->response()
                ->setStatusCode(201);
    }

    public function answer($id, Request $request)
    {
        $request->merge(['correct' => (bool) json_decode($request->get('correct'))]);
        $request->validate([
            'correct' => 'required|boolean'
        ]);

        $Category = Category::findOrFail($id);
        $Category->answers++;
        $Category->points = ($request->get('correct')
                           ? $Category->points + 1
                           : $Category->points - 1);
        $Category->save();

        return new CategoryResource($Category);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }

   
}
