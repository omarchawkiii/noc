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
        Schema::create('dcp_trensfers', function (Blueprint $table) {
            $table->id();
            $table->string("status",100)->nullable();
            $table->string("torrent_path",100)->nullable();
            $table->decimal("progress",8,2)->nullable();
            $table->string("id_ingest",255)->nullable();
            $table->string("id_cpl",100)->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_trensfers');
    }
};
