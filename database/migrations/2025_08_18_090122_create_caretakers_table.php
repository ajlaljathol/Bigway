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
        Schema::create('caretakers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('salary_id');
            $table->unsignedBigInteger('vehicle_id');

            //Foreign-Keys
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caretakers');
    }
};
