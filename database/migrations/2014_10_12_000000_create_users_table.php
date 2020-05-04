<?php

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
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable()->default(public_path('images').'salam.png');
            $table->string('activation_key');
            $table->timestamp('activation_key_expire')->nullable();
            $table->integer('bonus')->default(0);
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
