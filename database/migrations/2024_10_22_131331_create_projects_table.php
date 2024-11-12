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
        Schema::create('projects', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('required_amount_currency')->default('XOF');
            $table->float('required_amount_amount')->default(0);
            $table->string('is_done')->default(0);
            $table->string('image_url')->default('default-image.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
