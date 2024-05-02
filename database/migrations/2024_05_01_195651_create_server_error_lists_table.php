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
        Schema::create('server_error_lists', function (Blueprint $table) {
            $table->id();
            $table->string("class",255)->nullable();
            $table->string("criticity",255)->nullable();
            $table->date("date")->nullable();
            $table->string("errorCode",255)->nullable();
            $table->string("eventId",255)->nullable();
            $table->string("id_server_error",255)->nullable();
            $table->string("id_screen",255)->nullable();
            $table->integer("number")->nullable();
            $table->string("serverName",255)->nullable();
            $table->string("subType",255)->nullable();
            $table->string("type",255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_error_lists');
    }
};
