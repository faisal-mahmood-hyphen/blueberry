<?php

use App\Enums\PropertyFeatureEnum;
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
        Schema::table('properties', function (Blueprint $table) {
            foreach (PropertyFeatureEnum::values() as $value) {
                $columnName = strtolower(str_replace(' ', '_', str_replace('/', '_', $value)));
                if (!Schema::hasColumn('properties', $columnName)) {
                    $table->boolean($columnName)->default(false);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
