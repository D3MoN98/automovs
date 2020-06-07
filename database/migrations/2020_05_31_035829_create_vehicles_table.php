<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('brand');
            $table->string('model');
            $table->string('variant');
            $table->string('registration_number');
            $table->string('type');
            $table->integer('driven');
            $table->string('color');
            $table->year('year_bought');
            $table->year('insurance');
            $table->integer('location');
            $table->foreign('location')->references('id')->on('cities')->onDelete('cascade');
            $table->longText('images');
            $table->integer('price');
            $table->tinyInteger('is_verified')->default(0);
            $table->dateTime('verified_at')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
