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
        Schema::table('assetinfos', function (Blueprint $table) {
            $table->string("server_firmware_version",255)->nullable();
            $table->string("projector_version",255)->nullable();
            $table->string("sound_software_version",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assetinfos', function (Blueprint $table) {
            //
        });
    }
};
