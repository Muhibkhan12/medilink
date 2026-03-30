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
        Schema::create('_ambulance_location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambulance_id')->on('Ambulance')->onDelete('cascade');
            $table->decimal('lat',10,7);
            $table->decimal('long',10,7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_ambulance_location');
    }
};
