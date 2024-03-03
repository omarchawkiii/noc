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
        Schema::create('scanned_libraries', function (Blueprint $table) {
            $table->id();
            $table->string('id_file', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('cpl_id_pack', 255)->nullable();
            //$table->string('id', 255)->nullable();
            $table->string('is3D', 255)->nullable();
            $table->string('isAlreadyIngested', 255)->nullable();
            $table->string('isComplete', 255)->nullable();
            $table->string('level', 255)->nullable();
            $table->string('parent_id', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('uri', 255)->nullable();
            $table->string('id_server', 255)->nullable();
            $table->string('date_scan', 255)->nullable();
            $table->string('multiple_asset', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scanned_libraries', function (Blueprint $table) {
            //
        });
    }
};
