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
        Schema::table('splcomponents', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['spl_id']);
            $table->dropColumn('location_id');
            $table->dropColumn('spl_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('splcomponents', function (Blueprint $table) {
            //
        });
    }
};
