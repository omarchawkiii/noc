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
        Schema::create('splcomponents', function (Blueprint $table) {
            $table->id();
            $table->string('id_splcomponent', 255)->nullable();
            $table->string('CompositionPlaylistId', 255)->nullable();
            $table->string('AnnotationText', 255)->nullable();
            $table->string('EditRate', 255)->nullable();
            $table->string('editRate_numerator', 255)->nullable();
            $table->string('editRate_denominator', 255)->nullable();
            $table->string('uuid_spl', 255)->nullable();
            $table->unsignedBigInteger('spl_id');
            $table->foreign('spl_id')->references('id')->on('spls')->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('splcomponents');
    }
};
