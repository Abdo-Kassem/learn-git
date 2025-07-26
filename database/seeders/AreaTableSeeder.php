<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('areas')->delete();

        Area::factory()->count(1)->create();
    }
}
