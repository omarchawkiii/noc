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
        Schema::create('storage_errors_lists', function (Blueprint $table) {
            $table->id();
            $table->string("screen_number",255)->nullable();
            $table->string("storage_generale_status",255)->nullable();
            $table->string("serverName",255)->nullable();

            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_errors_lists');
    }
};
