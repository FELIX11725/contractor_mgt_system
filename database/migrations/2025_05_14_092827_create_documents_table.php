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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
             $table->foreignId('staff_id')->references('id')->on('staff');
             $table->string('name');
             $table->string('file_path');
             $table->string('original_name');
             $table->date('issue_date')->nullable();
             $table->date('expiry_date')->nullable();
             $table->foreignId('uploaded_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
