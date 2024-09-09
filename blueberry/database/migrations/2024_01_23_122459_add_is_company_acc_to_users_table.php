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
            $table->boolean('is_company_account')->default(false);
            $table->enum('requested_status', ['Pending', 'Approved', 'Rejected'])->nullable();
            $table->longText('rejection_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_company_account');
            $table->dropColumn('requested_status');
            $table->dropColumn('rejection_reason');
        });
    }
};
