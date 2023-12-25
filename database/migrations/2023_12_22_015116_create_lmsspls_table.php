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
        Schema::create('lmsspls', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)->nullable();
            $table->string('uuid', 255)->nullable();
            $table->string('annotation', 255)->nullable();
            $table->string('issue_date', 255)->nullable();
            $table->string('creator', 255)->nullable();
            $table->string('path_file', 255)->nullable();
            $table->string('server_name', 255)->nullable();
            $table->dateTime('last_update')->nullable();
            $table->string('file_type', 255)->nullable();
            $table->string('duration')->nullable();
            $table->integer('is_downloaded')->nullable();
            $table->string('tms_path', 255)->nullable();
            $table->string('id_server', 255)->nullable();
            $table->integer('id_local_server')->nullable();
            $table->unsignedDecimal('file_size', 8, 2)->nullable();
            $table->unsignedDecimal('file_progress', 8, 2)->nullable();
            $table->string('spl_type', 255)->nullable();
            $table->string('available_on', 255)->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lmsspls');
    }
};
