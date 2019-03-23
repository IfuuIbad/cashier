<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Transaction;
use Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

    	return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        DB::beginTransaction();

        try {
            $user->transactions()
                ->create([
                    'total' => $request->total,
                    'pay_total' => $request->pay_total,
                    'change_total' => $request->total - $request->pay_total
                ])
                ->details()
                ->createMany(Cart::with('item')->where('user_id', '=', Auth::user()->id)->get()->map(function ($cart){
                        return[
                            'item_id' => $cart->item_id,
                            'quantity' => $cart->quantity,
                            'subtotal' => $cart->item->price * $cart->quantity,
                        ];
                    })
                ->toArray());

            $user->carts()->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

    	return redirect()->route('transaction.show', Transaction::latest()->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
