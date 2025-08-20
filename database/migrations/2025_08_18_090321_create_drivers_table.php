<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Foreign Keys
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('salary_id')->nullable();

            $table->timestamps();

            // Define Foreign Key Constraints
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
