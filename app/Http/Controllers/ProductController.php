<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        dd(Product::all());
        return Product::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        return Product::create($request->all());
    }

    public function show(string $id)
    {
        return Product::find($id);
    }
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product-> update($request->all());
        return $product;
    }

    public function destroy(string $id)
    {
        return Product::destroy($id);
    }

    public function search(string $name)
    {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }
}
