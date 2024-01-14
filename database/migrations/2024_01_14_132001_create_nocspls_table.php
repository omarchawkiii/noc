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
        Schema::create('nocspls', function (Blueprint $table) {
            $table->id();
            $table->string('spl_title', 255)->nullable();
            $table->string('display_mode', 255)->nullable();
            $table->string('spl_properties_hfr', 255)->nullable();
            $table->string('xmlpath', 255)->nullable();
            $table->string('duration', 255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nocspls');
    }
};
