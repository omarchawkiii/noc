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
        Schema::create('diskusages', function (Blueprint $table) {
            $table->id();
            $table->string('session', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('totalSpaceFormatted', 255)->nullable();
            $table->string('usedSpaceFormatted', 255)->nullable();
            $table->string('cpls_complete', 255)->nullable();
            $table->string('cpls_incomplete', 255)->nullable();
            $table->string('Kdms_expired', 255)->nullable();
            $table->string('Kdms_not_valid', 255)->nullable();
            $table->string('Kdms_valid', 255)->nullable();
            $table->string('splCount', 255)->nullable();
            $table->string('free_space_percentage', 255)->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskusages');
    }
};
