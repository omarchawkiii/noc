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
        Schema::create('ingest_dcp_large', function (Blueprint $table) {
            $table->id();
            $table->string('id_file', 255)->nullable();
//            $table->string('Id', 255)->nullable();
            $table->string('Hash', 255)->nullable();
            $table->string('Size', 255)->nullable();
            $table->string('progress', 255)->nullable();
            $table->string('Type', 255)->nullable();
            $table->string('OriginalFileName', 255)->nullable();
            $table->string('tms_dir', 255)->nullable();
            $table->string('id_ingests', 255)->nullable();
            $table->string('id_cpl', 255)->nullable();
            $table->string('id_server', 255)->nullable();
            $table->string('date_create_ingest', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->string('action_on_status', 255)->nullable();
            $table->string('hash_verified', 255)->nullable();
            $table->string('hasMxf', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingest_dcp_large', function (Blueprint $table) {
            //
        });
    }
};
