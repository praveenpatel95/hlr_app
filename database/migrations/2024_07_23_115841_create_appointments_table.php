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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('practitioner_id');
            $table->unsignedBigInteger('schedule_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')->on('patients');
            $table->foreign('practitioner_id')
                ->references('id')->on('practitioners');
            $table->foreign('schedule_id')
                ->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
