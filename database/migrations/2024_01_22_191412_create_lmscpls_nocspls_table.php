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
        Schema::create('lmscpls_nocspls', function (Blueprint $table) {
            $table->unsignedBigInteger('lmscpl_id');
            $table->foreign('lmscpl_id')->references('id')->on('lmscpls')->onDelete('cascade');

            $table->unsignedBigInteger('nocspl_id');
            $table->foreign('nocspl_id')->references('id')->on('nocspls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lmscpls_nocspls', function (Blueprint $table) {
            //
        });
    }
};
