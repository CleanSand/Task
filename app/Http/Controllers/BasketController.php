<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        return Basket::all();
    }

    public function store(Request $request, int $id)
    {
        $userID = auth()->user()->id;
        $data = $request->all();
        $data['userID'] = $userID;
        $data['productID'] = $id;
        return Basket::create($data);
    }


    public function show(Basket $basket)
    {
        return $basket;
    }

    public function update(Request $request, Basket $basket)
    {
        $request->validate([
            'UserID' => ['required', 'integer'],
            'ProductID' => ['required', 'integer'],
        ]);

        $basket->update($request->validated());

        return $basket;
    }

    public function destroy(Basket $basket)
    {
        $basket->delete();

        return response()->json();
    }
}
