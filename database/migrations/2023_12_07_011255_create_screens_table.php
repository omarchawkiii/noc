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
            $table->string('name', 255);
            $table->unsignedBigInteger('seat');
            $table->string('api_namespace', 255);
            $table->string('type', 255);
            $table->string('masking_movement', 255);
            $table->unsignedDecimal('screen_h', 8, 2);
            $table->unsignedDecimal('screen_w', 8, 2);
            $table->unsignedDecimal('screen_d', 8, 2);
            $table->string('projector_brand', 255);
            $table->string('projector_model', 255);
            $table->string('projector_ip_lan', 255);
            $table->string('lens_model', 255);
            $table->boolean('installed');
            $table->string('server_brand', 255);
            $table->string('server_model', 255);
            $table->string('server_ip_lan', 255);
            $table->string('ingest_capabilities', 255);
            $table->string('3d_brand', 255)->nullable();
            $table->string('3d_model', 255)->nullable();
            $table->string('automation_brand', 255);
            $table->string('automation_model', 255);
            $table->string('automation_ip_lan', 255);
            $table->string('satelite_or_live', 255);
            $table->string('transmission_brand', 255);
            $table->string('transmission_model', 255);
            $table->string('transmission_ip_lan', 255);
            $table->string('processor_brand', 255);
            $table->string('processor_model', 255);
            $table->string('processor_ip_lan', 255);
            $table->string('audio_type', 255);
            $table->string('audio_brand', 255);
            $table->string('audio_model', 255);
            $table->string('audio_channel', 255);
            $table->string('audio_frequency', 255);
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
