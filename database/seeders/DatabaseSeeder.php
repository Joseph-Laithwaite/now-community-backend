<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPermission;
use App\Models\Brand;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         UserPermission::factory(20)->create();
         Brand::factory(5)->create();
   //       Product::factory(10)->create(['brand_id'=>'1']);
		 // Product::factory(10)->create(['brand_id'=>'2']);
		 // Product::factory(10)->create(['brand_id'=>'3']);
		 // Product::factory(10)->create(['brand_id'=>'4']);
		 // Product::factory(10)->create(['brand_id'=>'5']);
    }
}
