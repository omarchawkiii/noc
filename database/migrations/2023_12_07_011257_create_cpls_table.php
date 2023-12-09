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

        Schema::create('cpls', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 255);
            $table->string('durationEdits', 255);
            $table->string('storageKind', 255);
            $table->string('name', 255);
            $table->string('contentKind', 255);
            $table->string('editRate_numerator', 255);
            $table->string('editRate_denominator', 255);
            $table->string('editRateFPS', 255);
            $table->unsignedDecimal('pictureWidth', 8, 2);
            $table->unsignedDecimal('pictureHeight', 8, 2);
            $table->string('pictureEncodingAlgorithm', 255);
            $table->string('pictureEncryptionAlgorithm', 255);
            $table->unsignedDecimal('soundChannelCount', 8, 2);
            $table->unsignedDecimal('soundQuantizationBits', 8, 2);
            $table->string('soundEncodingAlgorithm', 255);
            $table->string('soundEncryptionAlgorithm', 255);
            $table->unsignedDecimal('encryptionKeysCount', 8, 2);
            $table->unsignedDecimal('framesPerEdit', 8, 2);
            $table->boolean('is3D');
            $table->string('standardCompliance', 255);
            $table->string('soundSamplingRate_numerator', 255);
            $table->string('soundSamplingRate_denominator', 255);
            $table->unsignedDecimal('assets', 8, 2);
            $table->unsignedDecimal('cplSizeInBytes', 8, 2);
            $table->unsignedDecimal('packageSizeInBytes', 8, 2);
            $table->string('markersCount', 255);
            $table->string('playable', 255);
            $table->dateTime('last_update');
            $table->string('cpl_list_uuivd', 255);
            $table->unsignedDecimal('id_auditorium', 8, 2);
            $table->string('id_server', 255);
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
        Schema::dropIfExists('cpls');
    }
};
