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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('scheduleId', 255)->nullable();
            $table->string('screen_number', 255)->nullable();
            $table->string('duration', 255)->nullable();
            $table->string('cod_film', 255)->nullable();
            $table->string('id_film', 255)->nullable();
            $table->string('color', 255)->nullable();
            $table->string('date_start', 255)->nullable();
            $table->string('date_end', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('screen_name', 255)->nullable();
            $table->foreignId('screen_id')->constrained()->onDelete('cascade');
            $table->foreignId('spl_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
