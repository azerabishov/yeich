<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('website')->nullable();
            $table->dateTime('ended_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
