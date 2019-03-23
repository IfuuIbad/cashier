<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class Cart extends Model
{
    protected $guarded = [];

    public function item() {
    	return $this->belongsTo(Item::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
