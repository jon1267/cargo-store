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
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['bus', 'truck', 'long_vehicle']);
            $table->string('car_number', 20)->unique();
            $table->text('description')->nullable();
            $table->integer('fuel_consumption')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('data')->nullable();//bus_places, 'cargo_weight', 'cargo_volume'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
