<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->float('min_price')->nullable();
            $table->float('max_price')->nullable();
            $table->bigInteger('subcategory_id')->nullable();
            $table->tinyInteger('state')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->bigInteger('area_id')->nullable();
            $table->string('query_search')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('search_histories');
    }
}
