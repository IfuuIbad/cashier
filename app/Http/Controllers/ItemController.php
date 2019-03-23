<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Models\ItemCategory;
use Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::doesntHave('cart')->where('stock', '>', 0)->orderBy('name')->paginate(15);
        $itemCarts = Cart::with('item')->where('user_id', '=', Auth::user()->id)->get();
        $categories = ItemCategory::all();

        $totalPrice = 0;
        foreach ($itemCarts as $cart) {
            $totalPrice = $totalPrice + ($cart->item->price * $cart->quantity);
        }

        return view('home', compact(['items', 'itemCarts', 'categories', 'totalPrice']));
    }

}
