<?php

use Illuminate\Database\Seeder;
use App\Models\ItemCategory;

class ItemCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
        	['name' => 'Makanan'],
        	['name' => 'Minuman'],
        	['name' => 'Alat Tulis'],
        	['name' => 'Alat Dapur'],
        	['name' => 'Pembersih']
        ];

        foreach ($categories as $category) {
        	ItemCategory::create($category);
        }
    }
}
