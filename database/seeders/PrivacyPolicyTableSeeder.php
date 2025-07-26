<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use App\Models\UsingCondition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivacyPolicyTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('privacy_policies')->delete();

        PrivacyPolicy::create([
            'description_ar' => 'وصف شروط الاستخدام بالعربي',
            'description_fr' => 'using conditions description by english',
        ]);
    }
}
