<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use http\Message;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $userID = auth()->user()->id;
        return Basket::where('userID', 'like', $userID)->get();
    }

    public function store(Request $request, int $id)
    {
        $userID = auth()->user()->id;

        $basket = Basket::where('userID', $userID)
            ->where('productID', $id)
            ->first();

        if ($basket) {
            $basket->increment('amount', 1);
        } else {
            $basket = Basket::create([
                'userID' => $userID,
                'productID' => $id,
                'amount' => 1,
            ]);
        }

        return $basket;
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

    public function destroy(Basket $basket, int $id)
    {
        $userID = auth()->user()->id;

        $basket = Basket::where('userID', $userID)
            ->where('productID', $id)
            ->first();
        if($basket){
            return Basket::destroy($id);
        }else{
            return response([
                'message' => 'Forbidden for you'
            ], 403);
        }
    }
}
