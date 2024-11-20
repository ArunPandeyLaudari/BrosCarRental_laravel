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
        Schema::create('selectpayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key for users
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->string('email');
            $table->string('name');
            $table->integer('price');
            $table->string('photopath');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('car_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selectpayments');
    }
};
