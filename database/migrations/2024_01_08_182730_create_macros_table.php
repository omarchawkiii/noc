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
        Schema::create('macros', function (Blueprint $table) {
            $table->id();
            $table->string('section_title', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('command', 255)->nullable();
            $table->string('idmacro_config', 255)->nullable();
            $table->string('idsections_macro',255)->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('macros');
    }
};
