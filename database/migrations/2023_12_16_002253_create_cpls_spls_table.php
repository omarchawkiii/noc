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
        Schema::create('cpls_spls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cpl_id');
            $table->foreign('cpl_id')->references('id')->on('cpls')->onDelete('cascade');

            $table->unsignedBigInteger('spl_id');
            $table->foreign('spl_id')->references('id')->on('spls')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpls_spls');
    }
};
