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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('recId', 255)->nullable();
            $table->date('converted_rec_date')->nullable();
            $table->string('recType', 255)->nullable();
            $table->string('recSubtype', 255)->nullable();
            $table->string('recPriority', 255)->nullable();
            $table->string('recKeywords', 255)->nullable();
            $table->string('screen_number', 255)->nullable();
            $table->string('Abbreviation', 255)->nullable();
            $table->string('serverName', 255)->nullable();

            $table->foreignId('screen_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
