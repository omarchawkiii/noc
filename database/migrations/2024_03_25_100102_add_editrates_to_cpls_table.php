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
        Schema::table('cpls', function (Blueprint $table) {
            $table->string('editRate_numerator', 255)->nullable();
            $table->string('editRate_denominator', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cpls', function (Blueprint $table) {
            //
        });
    }
};
