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
        Schema::disableForeignKeyConstraints();

        Schema::create('kdms', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 255);
            $table->string('name', 255);
            $table->string('ContentKeysNotValidBefore', 255);
            $table->string('ContentKeysNotValidAfter', 255);
            $table->string('kdm_installed', 255);
            $table->string('content_present', 255);
            $table->string('serverName_by_serial', 255);
            $table->foreignId('screen_id')->constrained();
            $table->foreignId('cpl_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kdms');
    }
};
