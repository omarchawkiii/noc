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
            $table->string("kdm_errors",100)->nullable();
            $table->string("nbr_sound_alert",100)->nullable();
            $table->decimal("nbr_projector_alert",8,2)->nullable();
            $table->string("nbr_server_alert",255)->nullable();
            $table->string("nbr_storage_errors",100)->nullable();
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
