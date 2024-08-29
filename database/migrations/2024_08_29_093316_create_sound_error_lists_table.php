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
        Schema::create('sound_error_lists', function (Blueprint $table) {
            $table->id();

            $table->string("alarm_id",100)->nullable();
            $table->string("date_saved",100)->nullable();
            $table->string("severity",100)->nullable();
            $table->string("title",100)->nullable();
            $table->string("clearable",100)->nullable();
            $table->string("hardware",100)->nullable();
            $table->string("screen",100)->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sound_error_lists');
    }
};
