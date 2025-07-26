<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_fr');
            $table->integer('days_number')->default(1);
            $table->decimal('price', 10, 2)->default(99);
            $table->foreignId('category_id')->references('id')->on('categories')
                ->restrictOnDelete()->restrictOnUpdate();
            $table->longText('description_ar')->nullable();
            $table->longText('description_fr')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
