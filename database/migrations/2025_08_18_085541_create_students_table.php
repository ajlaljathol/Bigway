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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->string('name');
            $table->string('emergency_contact'); // changed from emerg_contact for consistency
            $table->string('blood_group');       // changed from blood_grp for clarity
            $table->string('address');

            // Foreign keys
            $table->unsignedBigInteger('guardian_id');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('vehicle_id'); // fixed naming (singular)

            $table->timestamps();

            // Constraints
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
