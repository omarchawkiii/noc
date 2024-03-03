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
        Schema::create('ingests', function (Blueprint $table) {
            //
            $table->id();
             $table->string('cpl_id', 255)->nullable();
             $table->string('cpl_description', 255)->nullable();
             $table->string('is3D', 255)->nullable();
             $table->string('cpl_uri', 255)->nullable();
             $table->string('cpl_size', 255)->nullable();
             $table->string('cpl_progress', 255)->nullable();
             $table->string('pkl_id', 255)->nullable();
             $table->string('pkl_description', 255)->nullable();
             $table->string('pkl_uri', 255)->nullable();
             $table->string('pkl_size', 255)->nullable();
             $table->string('pkl_progress', 255)->nullable();
             $table->string('asset_id', 255)->nullable();
             $table->string('asset_description', 255)->nullable();
             $table->string('asset_uri', 255)->nullable();
             $table->string('asset_size', 255)->nullable();
             $table->string('asset_progress', 255)->nullable();
             $table->string('id_source', 255)->nullable();
             $table->string('name_source', 255)->nullable();
             $table->string('tms_dir', 255)->nullable();
             $table->string('date_create_ingest', 255)->nullable();
             $table->string('status', 255)->nullable();
             $table->string('action_on_status', 255)->nullable();
             $table->string('date_start_ingesting', 255)->nullable();
             $table->string('pid', 255)->nullable();
             $table->string('attempt', 255)->nullable();
             $table->string('order', 255)->nullable();
             $table->string('hasMxf', 255)->nullable();
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingests', function (Blueprint $table) {
            //
        });
    }
};
