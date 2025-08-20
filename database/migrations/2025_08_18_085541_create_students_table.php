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
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('emerg_contact');
            $table->string('blood_grp');
            $table->string('address');
            $table->unsignedBigInteger('guardian_id');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('vehicles_id');

            //Foreign-Keys
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('vehicles_id')->references('id')->on('vehicles')->onDelete('cascade');
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
