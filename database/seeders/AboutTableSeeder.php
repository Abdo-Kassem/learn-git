<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('abouts')->delete();

        About::create([
            'description_ar' => 'عن التطبيق بالعربي',
            'description_fr' => 'about App by french',
        ]);
    }
}
