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
        //contractors table
        Schema::table('contractors', function (Blueprint $table) {
           $table->foreignId('staff_id')->nullable()->references('id')->on('staff')->after('work_experience');
           $table->foreignId('business_id')->nullable()->references('id')->on('businesses')->after('staff_id');
           $table->foreignId('branch_id')->nullable()->references('id')->on('branches')->after('business_id');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
