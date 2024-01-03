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
        Schema::create('playbacks', function (Blueprint $table) {
            $table->id();
            $table->string('id_server', 255)->nullable();
            $table->string("serverName",255)->nullable();
            $table->string("playback",255)->nullable();
            $table->string("managment_ip",255)->nullable();
            $table->string("usernameAdmin",255)->nullable();
            $table->string("passwordAdmin",255)->nullable();
            $table->string("serverType",255)->nullable();
            $table->string("storage_configuration",255)->nullable();
            $table->string("storage_ip",255)->nullable();
            $table->string("enable_power_control",255)->nullable();
            $table->string("projector_ip",255)->nullable();
            $table->string("sound_ip",255)->nullable();
            $table->string("id_auditorium",255)->nullable();
            $table->string("number_auditorium",255)->nullable();
            $table->string("sound_model",255)->nullable();
            $table->string("ip_management_server_status",255)->nullable();
            $table->string("storage_generale_status",255)->nullable();
            $table->string("schedule_mode",255)->nullable();
            $table->string("hardware",255)->nullable();
            $table->string("securityManager",255)->nullable();
            $table->string("total_server_status",255)->nullable();
            $table->string("schedule_generale_status",255)->nullable();
            $table->string("projector_status",255)->nullable();
            $table->string("projector_lamp_stat",255)->nullable();
            $table->string("spl_title",255)->nullable();
            $table->string("cpl_title",255)->nullable();
            $table->string("playback_status",255)->nullable();
            $table->string("elapsed_runtime",255)->nullable();
            $table->string("remaining_runtime",255)->nullable();
            $table->string("progress_bar",255)->nullable();
            $table->string("lamp_status",255)->nullable();
            $table->string("dowser_status",255)->nullable();
            $table->foreignId('screen_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playbacks');
    }
};
