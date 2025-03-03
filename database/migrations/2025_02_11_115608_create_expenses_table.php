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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->nullable();
            $table->foreignId('budget_id')->references('id')->on('budgets')->nullable();
            $table->foreignId('project_plan_id')->references('id')->on('projectplans')->nullable();
            $table->decimal('amount_paid', 10, 2);
            $table->string('payment_method');
            $table->date('payment_date');
            $table->string('expense_status');
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
