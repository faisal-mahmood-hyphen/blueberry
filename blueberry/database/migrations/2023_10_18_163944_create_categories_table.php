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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feature_id')->nullable();
            $table->foreign('feature_id')->references('id')->on('features')->cascadeOnDelete();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('name'); // Name of the category
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',\App\Enums\StatusEnum::values())->nullable()->default(\App\Enums\StatusEnum::ACTIVE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
