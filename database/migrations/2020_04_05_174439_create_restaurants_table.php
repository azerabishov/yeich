<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('average_price');
            $table->string('metro');
            $table->string('phone');
            $table->string('payment_method');
            $table->string('dress_code');
            $table->string('parking');
            $table->string('description');
            $table->time('open_time');
            $table->time('close_time');
            $table->integer('mainhall');
            $table->integer('room');
            $table->string('categories');
            $table->integer('status')->default(1)->comment('1-active,0-inactive');
            $table->integer('is_promoted')->default(0);

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
        Schema::dropIfExists('restaurants');
    }
}
