<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItemCategory as Category;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class Item extends Model
{
    public function category() {
    	return $this->belongsTo(Category::class, 'item_category_id');
    }

    public function cart() {
    	return $this->hasOne(Cart::class);
    }

    public function transactions() {
    	return $this->hasManyThrough(Transaction::class, TransactionDetail::class);
    }
}
