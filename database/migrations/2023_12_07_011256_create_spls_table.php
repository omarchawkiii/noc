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
        Schema::disableForeignKeyConstraints();

        Schema::create('spls', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('uuid', 255);
            $table->string('annotation', 255);
            $table->string('issue_date', 255);
            $table->string('creator', 255);
            $table->string('path_file', 255);
            $table->string('server_name', 255);
            $table->dateTime('last_update');
            $table->string('file_type', 255);
            $table->integer('duration');
            $table->integer('is_downloaded');
            $table->string('tms_path', 255);
            $table->string('id_server', 255);
            $table->integer('id_local_server');
            $table->unsignedDecimal('file_size', 8, 2);
            $table->unsignedDecimal('file_progress', 8, 2);
            $table->string('spl_type', 255);
            $table->foreignId('location_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spls');
    }
};
