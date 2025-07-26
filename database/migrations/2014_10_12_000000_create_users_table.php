<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->default('uploads/users/default.png');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            //$table->json('location')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('otp')->nullable();
            $table->longText('fcm_device_token')->nullable();
            $table->integer('status')->default(0);
            $table->tinyInteger('badge')->nullable();
            $table->string('prefered_language', 4)->default('ar');
            $table->foreignId('city_id')->references('id')->on('cities')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('area_id')->references('id')->on('areas')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('login_count')->default(0);
            $table->integer('logout_count')->default(0);
            $table->string('last_login_date')->nullable();
            $table->string('last_logout_date')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
