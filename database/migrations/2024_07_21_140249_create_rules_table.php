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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->date("date_start")->nullable();
            $table->date("date_end")->nullable();
            $table->string("target_screen_type",100)->nullable();
            $table->string("movies_id",100)->nullable();
            $table->string("marker",100)->nullable();
            $table->string("template_selection",100)->nullable();
            $table->integer('priority')->nullable();;
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
