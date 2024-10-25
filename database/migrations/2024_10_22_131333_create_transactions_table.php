<?php

use App\Models\Transaction;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('currency');
            $table->float('raw_amount');
            $table->string('transaction_uuid')->unique();
            $table->string('payment_code')->nullable()->unique();
            $table->string('payment_token');
            $table->string('payment_url');
            $table->date('payment_date')->nullable();
            $table->string('designation');
            $table->enum('status', Transaction::TRANSACTION_STATUS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
