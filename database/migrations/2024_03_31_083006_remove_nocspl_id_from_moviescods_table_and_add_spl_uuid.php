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
        Schema::table('moviescods', function (Blueprint $table) {
            $table->dropForeign(['nocspl_id']);
            $table->dropColumn('nocspl_id');
            $table->string('spl_uuid', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moviescods', function (Blueprint $table) {
            //
        });
    }
};
