<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('title')->nullable();
            $table->string('make_n_modal')->nullable();
            $table->string('price')->nullable();
            $table->string('year')->nullable();
            $table->string('mileage')->nullable();
            $table->string('box')->nullable();
            $table->string('credit')->nullable();
            $table->string('exchange')->nullable();
            $table->string('body')->nullable();
            $table->string('motor')->nullable();
            $table->string('color')->nullable();
            $table->string('date')->nullable();
            $table->string('location')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('detail_page')->nullable();
            $table->longText('image')->nullable();
            $table->longText('images')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
