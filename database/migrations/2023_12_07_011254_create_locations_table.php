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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('folder_title', 255);
            $table->string('connection_ip', 255);
            $table->string('tms_system', 255);
            $table->string('rentrak_id', 255);
            $table->string('type', 255)->nullable();
            $table->string('hostname', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('port', 255)->nullable();
            $table->string('location_email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('support_email', 255)->nullable();
            $table->string('modem', 255);
            $table->string('internet', 255);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->string('zip', 255);
            $table->string('country', 255);
            $table->string('state', 255);
            $table->string('company', 255)->nullable();
            $table->string('language', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
