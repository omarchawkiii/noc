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
        Schema::create('snmps', function (Blueprint $table) {
            $table->id();
            $table->string('id_snmp', 255)->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->text('trap_data')->nullable();
            $table->string('snmp_created_at', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('severity', 255)->nullable();
            $table->string('serverName', 255)->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snmps');
    }
};
