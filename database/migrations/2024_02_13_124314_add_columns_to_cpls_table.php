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
        Schema::table('cpls', function (Blueprint $table) {
            $table->string('pictureEncodingAlgorithm', 255)->nullable();
            $table->string('pictureEncryptionAlgorithm', 255)->nullable();
            $table->string('soundQuantizationBits', 255)->nullable();
            $table->string('soundEncodingAlgorithm', 255)->nullable();
            $table->string('soundEncryptionAlgorithm', 255)->nullable();
            $table->string('markersCount', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cpls', function (Blueprint $table) {
            //
        });
    }
};
