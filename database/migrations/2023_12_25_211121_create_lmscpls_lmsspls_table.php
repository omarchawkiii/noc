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
        Schema::create('lmscpls_lmsspls', function (Blueprint $table) {

            $table->unsignedBigInteger('lmscpl_id');
            $table->foreign('lmscpl_id')->references('id')->on('lmscpls')->onDelete('cascade');

            $table->unsignedBigInteger('lmsspl_id');
            $table->foreign('lmsspl_id')->references('id')->on('lmsspls')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lmscpls_lmsspls', function (Blueprint $table) {
            //
        });
    }
};
