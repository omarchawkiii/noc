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
        Schema::create('kdm_error_lists', function (Blueprint $table) {
            $table->id();
            $table->string("annotationText",255)->nullable();
            $table->string("cpl_id",255)->nullable();
            $table->date("date_time")->nullable();
            $table->string("details",255)->nullable();
            $table->string("screen_id",255)->nullable();
            $table->string("serverName",255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kdm_error_lists');
    }
};
