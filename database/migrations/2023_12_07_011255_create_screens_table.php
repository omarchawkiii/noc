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
        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->string('screen_name', 255);
            $table->string('id_server', 255)->nullable();
            $table->string('screen_number', 255)->nullable();
            $table->string('screenModel', 255)->nullable();
            $table->string('playback', 255)->nullable();
            $table->string('sound', 255)->nullable();
            $table->string('server_ip', 255)->nullable();
            $table->string('ingestProtocol_server', 255)->nullable();
            $table->string('remotPath', 255)->nullable();
            $table->string('managment_ip', 255)->nullable();
            $table->string('projector_enable', 255)->nullable();
            $table->string('projector_ip', 255)->nullable();
            $table->string('projector_brand', 255)->nullable();
            $table->string('projector_model', 255)->nullable();
            $table->string('sound_enable', 255)->nullable();
            $table->string('sound_ip', 255)->nullable();
            $table->string('sound_brand', 255)->nullable();
            $table->string('sound_model', 255)->nullable();
            $table->string('audio_enable', 255)->nullable();
            $table->string('audio_ip', 255)->nullable();
            $table->string('audio_brand', 255)->nullable();
            $table->string('audio_model', 255)->nullable();
            $table->string('automation_enable', 255)->nullable();
            $table->string('automation_ip', 255)->nullable();
            $table->string('automation_brand', 255)->nullable();
            $table->string('automation_model', 255)->nullable();
            $table->string('automation_username', 255)->nullable();
            $table->string('automation_password', 255)->nullable();
            $table->string('enable_power_control', 255)->nullable();
            $table->foreignId('location_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screens');
    }
};
