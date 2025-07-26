<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('cities')->delete();

        City::factory()->count(1)->create();
    }
}
