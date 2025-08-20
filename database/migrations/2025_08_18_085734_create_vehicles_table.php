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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('num_seats');
            $table->unsignedBigInteger('school_id');
            $table->string('ownership');
            $table->unsignedBigInteger('caretaker_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('route_id');
            $table->string('reg_number');
            $table->decimal('rent', 10, 2);
            $table->string('vehicle_type');

            //Foreign-Keys
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('caretaker_id')->references('id')->on('caretakers')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
