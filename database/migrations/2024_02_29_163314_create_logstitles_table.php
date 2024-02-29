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
        Schema::create('logstitles', function (Blueprint $table) {
            $table->id();
            $table->string('propertyValue', 255)->nullable();
            $table->string('recKeywords', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logstitles');
    }
};
