<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_fr')->nullable();
            $table->string('slider_image')->default('uploads/sliders/default.jpg');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
