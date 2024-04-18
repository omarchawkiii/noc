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
        Schema::table('nockdms', function (Blueprint $table) {
            $table->boolean("tms_ingested",255)->default(0)->nullable();
            $table->string("error",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nockdms', function (Blueprint $table) {
            //
        });
    }
};
