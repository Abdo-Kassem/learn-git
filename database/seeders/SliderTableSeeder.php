<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider = new Slider;
        $slider->title_ar = 'العنوان 1';
        $slider->title_fr = 'header 1';
        $slider->slider_image = 'uploads/sliders/default.jpg';
        $slider->save();

        $slider2 = new Slider;
        $slider2->title_ar = 'العنوان 2';
        $slider2->title_fr = 'header 2';
        $slider2->slider_image = 'uploads/sliders/default.jpg';
        $slider2->save();
    }
}
