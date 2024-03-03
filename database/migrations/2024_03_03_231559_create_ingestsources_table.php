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
        Schema::create('ingestsources', function (Blueprint $table) {
            $table->id();

            $table->string('defaultlocation_add_form',255)->nullable();
            $table->string('usb_content_add_form',255)->nullable();
            $table->string('defaultContent_add_form',255)->nullable();
            $table->string('serverName',255)->nullable();
            $table->string('server_ip',255)->nullable();
            $table->string('ingestProtocol',255)->nullable();
            $table->string('usernameServer',255)->nullable();
            $table->string('passwordServer',255)->nullable();
            $table->string('path',255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingestsources');
    }
};
