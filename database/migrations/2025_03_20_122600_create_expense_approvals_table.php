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
        Schema::create('expense_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_id')->references('id')->on('expenses')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->text('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_approvals');
    }
};
