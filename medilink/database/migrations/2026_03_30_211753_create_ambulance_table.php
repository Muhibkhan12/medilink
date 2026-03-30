<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Enum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ambulance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->on('User')->onDelete('cascade');
            $table->string('vehicle_number')->unique();
            $table->enum('status',['available','busy','maintainence']);
            $table->enum('type',['Basic','advanced','ICU']);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance');
    }
};
