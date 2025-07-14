<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sold_products', function (Blueprint $table) {
            $table->enum('warranty_status', ['active', 'expired', 'voided', 'maintenance'])->default('active')->after('notes');
        });

        // Update existing records based on their current state
        DB::table('sold_products')->where('warranty_voided', true)->update(['warranty_status' => 'voided']);
        DB::table('sold_products')->where('warranty_voided', false)->where('warranty_end_date', '<', now())->update(['warranty_status' => 'expired']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sold_products', function (Blueprint $table) {
            $table->dropColumn('warranty_status');
        });
    }
};
