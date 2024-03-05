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
        Schema::create('ingest_scan_errors', function (Blueprint $table) {

            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('content', 255)->nullable();
            $table->string('file_path', 255)->nullable();
            $table->string('id_server', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->date('date_time', 255)->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingest_scan_errors', function (Blueprint $table) {
            //
        });
    }
};
