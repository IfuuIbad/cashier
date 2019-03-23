<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\ItemCategory;
use Auth;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemCarts = Cart::with('item')->where('user_id', '=', Auth::user()->id)->get();
        $categories = ItemCategory::all();

        $totalPrice = 0;
        foreach ($itemCarts as $cart) {
            $totalPrice = $totalPrice + ($cart->item->price * $cart->quantity);
        }

        return view('checkout', compact(['items', 'itemCarts', 'totalPrice', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::create($request->all());

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Cart $cart)
    {
        $cart->update(request()->all());

    	return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

    	return redirect()->back();
    }
}
