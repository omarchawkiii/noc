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
        Schema::create('lmskdms', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 255);
            $table->string('name', 255);
            $table->string('idkdm_files', 255)->nullable();
            $table->string('AnnotationText', 255)->nullable();
            $table->string('ContentKeysNotValidBefore', 255)->nullable();
            $table->string('ContentKeysNotValidAfter', 255)->nullable();
            $table->string('SubjectName', 255)->nullable();
            $table->string('DeviceListDescription', 255)->nullable();
            $table->string('path_file', 255)->nullable();
            $table->string('server_name', 255)->nullable();
            $table->string('file_type', 255)->nullable();
            $table->string('id_server', 255)->nullable();
            $table->string('file_size', 255)->nullable();
            $table->string('file_progress', 255)->nullable();
            $table->string('tms_path', 255)->nullable();
            $table->string('last_update', 255)->nullable();
            $table->string('device_target', 255)->nullable();
            $table->string('serverName_by_serial', 255)->nullable();
            $table->string('kdm_installed', 255);
            $table->string('content_present', 255);
            $table->foreignId('screen_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('lmscpl_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lmskdms');
    }
};
