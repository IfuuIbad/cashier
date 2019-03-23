<?php

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!File::exists('public/images')) {
            File::makeDirectory('public/images');
        }

        factory(Item::class, 50)->create();
    }
}
