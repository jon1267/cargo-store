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
        Schema::create('auto_driver', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            //$table->id();
            //$table->foreignIdFor(\App\Models\Auto::class)->constrained()->cascadeOnDelete();
            //$table->foreignIdFor(\App\Models\Driver::class)->constrained()->cascadeOnDelete();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_driver');
    }
};
