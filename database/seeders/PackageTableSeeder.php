<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('packages')->delete();

        Package::factory()->count(20)->create();
    }
}
