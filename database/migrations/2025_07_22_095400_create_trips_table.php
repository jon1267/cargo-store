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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->nullOnDelete();
            $table->foreignId('auto_id')->nullable()->constrained('autos')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('place_from')->nullable();
            $table->string('place_to')->nullable();
            $table->integer('distance')->default(0);
            $table->dateTime('trip_start')->nullable();
            $table->dateTime('trip_end')->nullable();
            $table->json('data')->nullable(); //passengers_count, cargo_weight, cargo_volume.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
