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
            //$table->id();
            $table->string('id', 255)->nullable();
            $table->string('uuid', 255)->nullable();
            $table->string('id_dcp', 255)->nullable();
            $table->string('contentTitleText', 255)->nullable();
            $table->string('contentKind', 255)->nullable();
            $table->string('EditRate', 255)->nullable();
            $table->string('is_3D', 255)->nullable();
            $table->string('totalSize', 255)->nullable();
            $table->string('soundChannelCount', 255)->nullable();
            $table->string('durationEdits', 255)->nullable();
            $table->string('ScreenAspectRatio', 255)->nullable();
            $table->string('available_on', 255)->nullable();
            $table->string('serverName', 255)->nullable();
            $table->boolean('cpl_is_linked')->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('screen_id')->constrained()->onDelete('cascade');
            $table->primary(['id', 'location_id']);
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
