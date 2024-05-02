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
        Schema::create('projector_errors_lists', function (Blueprint $table) {
            $table->id();
            $table->string("code",255)->nullable();
            $table->string("id_projector_errors",255)->nullable();
            $table->string("id_screen",255)->nullable();
            $table->string("ip_projector",255)->nullable();
            $table->string("message",255)->nullable();
            $table->integer("number")->nullable();
            $table->string("serverName",255)->nullable();
            $table->string("severity",255)->nullable();
            $table->dateTime("time_saved")->nullable();
            $table->string("title",255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projector_errors_lists');
    }
};
