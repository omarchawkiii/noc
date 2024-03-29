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
        Schema::table('playbacks', function (Blueprint $table) {
            $table->string("ip_sound_status",100)->nullable();
            $table->string("sound_status",100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('playbacks', function (Blueprint $table) {
            //
        });
    }
};
