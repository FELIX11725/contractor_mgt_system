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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->references('id')->on('businesses');
            $table->string('branch_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('branch_status')->nullable();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->foreignId('created_by')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
