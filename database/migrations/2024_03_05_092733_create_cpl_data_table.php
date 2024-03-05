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
        Schema::create('cpl_data', function (Blueprint $table) {
            $table->id();

            $table->string('uuid', 255)->nullable();
            $table->string('ContentKind', 255)->nullable();
            $table->string('Creator', 255)->nullable();
            $table->string('EditRate', 255)->nullable();
            $table->string('editRate_numerator', 255)->nullable();
            $table->string('editRate_denominator', 255)->nullable();
            $table->string('FrameRate', 255)->nullable();
            $table->string('FrameRate_String', 255)->nullable();
            $table->string('FrameCount', 255)->nullable();
            $table->string('edit_rate_duration', 255)->nullable();
            $table->string('Duration_seconds', 255)->nullable();
            $table->string('Duration', 255)->nullable();
            $table->string('soundChannelCount', 255)->nullable();
            $table->string('ScreenAspectRatio', 255)->nullable();
            $table->string('Width', 255)->nullable();
            $table->string('Height', 255)->nullable();
            $table->string('is_3D', 255)->nullable();
            $table->string('kdm_required', 255)->nullable();


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cpl_data', function (Blueprint $table) {
            //
        });
    }
};
