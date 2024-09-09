<?php

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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('year')->nullable();
            $table->string('mileage')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->cascadeOnDelete();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
//            $table->unsignedBigInteger('model_id')->nullable();
//            $table->foreign('model_id')->references('id')->on('models')->cascadeOnDelete();
//            $table->unsignedBigInteger('trim_id')->nullable();
//            $table->foreign('trim_id')->references('id')->on('trims')->cascadeOnDelete();

            $table->string('regional_specs')->nullable();
            $table->string('steering_side')->nullable();
            $table->boolean('is_car_insured')->nullable();
            $table->string('image')->nullable();
            $table->string('view_360_url')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('body_condition')->nullable();
            $table->string('mechanical_condition')->nullable();
            $table->string('exterior_color')->nullable();
            $table->string('interior_color')->nullable();
            $table->string('warranty')->nullable();
            $table->integer('doors')->nullable();
            $table->integer('cylinders')->nullable();
            $table->string('transmission_type')->nullable();
            $table->integer('seating_capacity')->nullable();
            $table->string('horse_power')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->boolean('climate_control')->default(false);
            $table->boolean('cooled_seats')->default(false);
            $table->boolean('dvd_player')->default(false);
            $table->boolean('front_wheel_drive')->default(false);
            $table->boolean('keyless_entry')->default(false);
            $table->boolean('leather_seats')->default(false);
            $table->boolean('navigation_system')->default(false);
            $table->boolean('parking_sensors')->default(false);
            $table->boolean('premium_sound_system')->default(false);
            $table->boolean('rear_view_camera')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
