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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_id')->references('id')->on('phases')->nullable();
            $table->string('budget_name');
            $table->text('description');
            $table->decimal('estimated_amount', 10, 2)->nullable();
            $table->foreignId('milestone_id')->nullable()->references('id')->on('milestones');
            $table->boolean('approved')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
