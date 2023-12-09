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

        Schema::create('kdms', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 255);
            $table->string('name', 255);
            $table->string('AnnotationText', 255);
            $table->string('ContentKeysNotValidBefore', 255);
            $table->string('ContentKeysNotValidAfter', 255);
            $table->string('SubjectName', 255);
            $table->string('DeviceListDescription', 255);
            $table->string('SerialNumber', 255);
            $table->string('path_file', 255);
            $table->string('server_name', 255);
            $table->string('file_type', 255);
            $table->string('id_server', 255);
            $table->unsignedDecimal('file_size', 8, 2);
            $table->unsignedDecimal('file_progress', 8, 2);
            $table->string('tms_path', 255);
            $table->dateTime('last_update');
            $table->foreignId('screen_id')->constrained();
            $table->foreignId('cpl_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kdms');
    }
};
