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
        Schema::table('users', function (Blueprint $table) {
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('role')->nullable();
            $table->integer('otp')->nullable();
            $table->enum('company_role', \App\Enums\CompanyStatusEnum::values())->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
