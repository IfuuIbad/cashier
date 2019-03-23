<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class ItemCategory extends Model
{
    protected $guarded = [];

    public function items() {
    	return $this->hasMany(Item::class);
    }
}
