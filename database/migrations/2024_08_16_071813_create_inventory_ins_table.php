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
        Schema::create('inventory_ins', function (Blueprint $table) {
            $table->id();
            $table->string("description",255);
            $table->string("quantity",100);
            $table->string("serials",255);
            $table->string("po_reference",255);
            $table->string("do_reference",255);
            $table->foreignId('part_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('storage_location_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_ins');
    }
};
