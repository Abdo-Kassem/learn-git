<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingTableSeeder extends Seeder
{
  
    public function run()
    {
        DB::table('app_settings')->delete();

        AppSetting::create([
            'phone' => '+96611111111',
            'whatsapp_number' => '+96611111111',
            'email' => 'almarsa@gmail.com',
            'address' => 'address',
        ]);
    }
}
