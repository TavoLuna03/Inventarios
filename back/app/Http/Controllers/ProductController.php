<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollection(Product::all());
    }

    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        dd($request);
        $product = Product::create($request->all());
        
        return (new ProductResource($product))
                ->response()
                ->setStatusCode(201);
    }

    public function quantity($id, Request $request)
    {

        $product = Product::findOrFail($id);
        $product->quantity++;

        $product->save();

        return new ProductResource($product);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }

}
