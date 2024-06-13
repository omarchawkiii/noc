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
        Schema::create('planners', function (Blueprint $table) {
            $table->id();
            $table->string("name",100)->nullable();
            $table->string("cpl_uuid",100)->nullable();
            $table->date("date_start")->nullable();
            $table->date("date_end")->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->string("screen_type",100)->nullable();
            $table->string("movies_id",100)->nullable();
            $table->string("spl_uuid",100)->nullable();
            $table->string("template_position",100)->nullable();
            $table->string("position",100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planners');
    }
};
