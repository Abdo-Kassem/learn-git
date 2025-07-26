<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->references('id')->on('packages')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->references('id')->on('products')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->boolean('is_expired')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
