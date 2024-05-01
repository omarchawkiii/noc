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
        Schema::create('error_lists', function (Blueprint $table) {
            $table->id();
            $table->integer("kdm_errors")->nullable();
            $table->integer("nbr_sound_alert")->nullable();
            $table->integer("nbr_projector_alert")->nullable();
            $table->integer("nbr_server_alert")->nullable();
            $table->integer("nbr_storage_errors")->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_lists');
    }
};
