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
        Schema::table('storage_locations', function (Blueprint $table) {

            $table->string("adress_1",255)->nullable();
            $table->string("adress_2",255)->nullable();
            $table->string("city",255)->nullable();
            $table->string("state",255)->nullable();
            $table->string("zip_code",255)->nullable();
            $table->string("country",255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('storage_location', function (Blueprint $table) {
            //
        });
    }
};
