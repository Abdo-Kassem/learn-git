<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->first_name = 'member';
        $user->last_name = 'one';
        $user->email = 'memberone@gmail.com';
        $user->phone = '01010101010';
        $user->status = 1;
        $user->password = bcrypt('123456');
        $user->city_id = City::value('id');
        $user->area_id = Area::where('city_id', $user->city_id)->value('id');
        $user->fcm_device_token = "d2f7dUsaT8Cy6A5TOn-DJP:APA91bHMiFClZW-GgA1FK49seFVpMe_Y9mWT98EcLCwKwTf5cLu8eUO-plpUhtovii8X49EoSrV1F30b9UvGMP2M5wJ07m1L1kFdvTPEp4D14BoT4mH4IwU";
        $user->last_login_date = '-----';
        $user->last_logout_date = '-----';
        $user->save();
    }
}
