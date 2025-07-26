<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->string('SKU');
            $table->string('image');
            $table->tinyInteger('status')->default(1)->comment('1 mean active and 0 sold');
            $table->longText('description')->nullable();

            $table->foreignId('subcategory_id')->references('id')->on('subcategories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('brand_id')->nullable()->references('id')->on('brands')->onDelete('set null')->cascadeOnUpdate();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->references('id')->on('cities')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('area_id')->references('id')->on('areas')->restrictOnDelete()->cascadeOnUpdate();

            $table->integer('type')->nullable()->comment(' 1 => old , 2 => new');
            $table->integer('delivery_type')->nullable()->comment('1=>delivery from place 2=>shipping');
            //$table->json('location')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
