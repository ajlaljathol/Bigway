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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('school_id')->nullable(); // Optional if needed
            $table->date('date');
            $table->string('home_pickup')->nullable();
            $table->string('school_pickup')->nullable();
            $table->string('home_drop')->nullable();
            $table->string('school_drop')->nullable();
            $table->enum('status', ['present', 'absent'])->default('absent'); // Track presence

            // Foreign-keys
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
