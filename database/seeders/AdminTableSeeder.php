<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin;
        $admin->first_name = 'admin';
        $admin->last_name = 'developer';
        $admin->email = 'superadmin@gmail.com';
        $admin->phone = '01010101010';
        $admin->address = 'Earth Country , Sky Street';
        $admin->password = bcrypt('123456');
        $admin->last_login_date = '-----';
        $admin->last_logout_date = '-----';
        $admin->save();
    }
}
