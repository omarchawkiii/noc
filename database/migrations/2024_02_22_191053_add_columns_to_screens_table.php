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
        Schema::table('screens', function (Blueprint $table) {
            $table->string('serial_number', 255)->nullable();
            $table->string('jp2k_dnQualifier', 255)->nullable();
            $table->string('jp2k_cn', 255)->nullable();
            $table->string('dolby_audio_processor_dnQualifier', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screens', function (Blueprint $table) {
            //
        });
    }
};
