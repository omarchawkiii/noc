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
        Schema::table('planners', function (Blueprint $table) {
            $table->string("marker",100)->nullable();
            $table->string("priority",100)->nullable();
            $table->string("feature",100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planners', function (Blueprint $table) {
            //
        });
    }
};
