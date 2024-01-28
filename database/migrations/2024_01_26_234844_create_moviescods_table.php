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
        Schema::create('moviescods', function (Blueprint $table) {
            $table->id();
            $table->string('moviescods_id', 255)->nullable();
            $table->string('code', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('titleShort', 255)->nullable();
            $table->string('last_update', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('nocspl_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moviescods');
    }
};
