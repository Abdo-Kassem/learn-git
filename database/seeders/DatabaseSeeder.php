<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminTableSeeder;
use Database\Seeders\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(AdminTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(PrivacyPolicyTableSeeder::class);
        $this->call(AboutTableSeeder::class);
        $this->call(AppSettingTableSeeder::class);
        //$this->call(CategoryTableSeeder::class);
        //$this->call(SubcategoryTableSeeder::class);
        //$this->call(PackageTableSeeder::class);

    }
}
