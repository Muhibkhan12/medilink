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
        Schema::create('_ambulance_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambulance_id')->on('Ambulance')->onDelete('cascade');
            $table->foreignId('user_id')->on('User')->onDelete('cascade');
            $table->enum('status',['pending','accepted','rejected','On the Way','arrived','cancelled'])->default('pending');
            $table->string('pickup_address');
            $table->string('destination_address');
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_ambulance_request');
    }
};
