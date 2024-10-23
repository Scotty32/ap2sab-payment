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
        Schema::create('participants', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->foreignUuid('transaction_id')->constrained();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('promotion');
            $table->string('profession')->default('--');
            $table->string('country');
            $table->string('city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
