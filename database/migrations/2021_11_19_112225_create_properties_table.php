<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('price', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->unique();
            $table->string('property_type', 255)->nullable();
            $table->string('bedrooms', 255)->nullable();
            $table->string('bathrooms', 255)->nullable();
            $table->string('area', 255)->nullable();
            $table->string('property_tag', 255)->nullable();
            $table->string('brocker_image', 255)->nullable();
            $table->text('location')->nullable();
            $table->string('sub_title', 255)->nullable();
            $table->longText('complition_status')->nullable();
            $table->string('property_review_link', 255)->nullable();
            $table->string('agent_slug', 255)->nullable();
            $table->string('company_slug', 255)->nullable();
            $table->text('amenities', 255)->nullable();
            $table->longText('property_description')->nullable();
            $table->string('is_verified', 255)->nullable();
            $table->longText('property_references', 255)->nullable();
            $table->string('sale_type', 255)->nullable();
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
        Schema::dropIfExists('properties');
    }
}
