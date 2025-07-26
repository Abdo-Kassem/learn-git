<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();

        Category::factory()->count(20)->create();
    }
}
