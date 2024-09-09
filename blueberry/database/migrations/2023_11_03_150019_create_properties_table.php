<?php

use App\Enums\PropertyPurposeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tour_360_url')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('price')->nullable();
            $table->longText('description')->nullable();
            $table->string('size')->nullable();
            $table->date('ready_by_date')->nullable();
            $table->integer('total_closing_fee')->nullable();
            $table->string('developer_name')->nullable();
            $table->integer('annual_community_fee')->nullable();
            $table->boolean('is_it_furnished')->nullable();
            $table->integer('seller_transfer_fee')->nullable();
            $table->integer('buyer_transfer_fee')->nullable();
            $table->integer('maintenance_fee')->nullable();
            $table->string('occupancy_status')->nullable();
            $table->string('an_agent')->nullable();
            $table->string('landlord_name')->nullable();
            $table->string('neighbourhood')->nullable();
            $table->string('location')->nullable();
            $table->string('integrate_the_map')->nullable();
            $table->string('property_reference_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->cascadeOnDelete();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
