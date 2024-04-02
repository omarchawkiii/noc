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
        Schema::create('assetinfos', function (Blueprint $table) {
            $table->id();

            $table->string("screen_status",100)->nullable();
            $table->string("screen_number",100)->nullable();
            $table->string("screen_name",100)->nullable();
            $table->string("server_product_name",100)->nullable();
            $table->string("server_esn",100)->nullable();
            $table->string("server_software",100)->nullable();
            $table->string("projector_model_number",100)->nullable();
            $table->string("projector_serial_number",100)->nullable();
            $table->string("sound_model",100)->nullable();
            $table->string("sound_chasis_serial",100)->nullable();
            $table->string("sound_esn",100)->nullable();

            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('screen_id')->constrained()->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assetinfos');
    }
};
