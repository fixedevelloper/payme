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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double("amount")->default(0.0);
            $table->double("costs")->default(0.0);
            $table->double("total")->default(0.0);
            $table->string("mode")->comment("mobile_money,bank,wallet");
            $table->string("status")->default("PENDING");
            $table->string("transaction_type")->comment("withdraw,deposit,transfer");
            $table->string("phone_withdraw")->nullable();
            $table->string("name_withdraw")->nullable();
            $table->string("email_withdraw")->nullable();
            $table->foreignId('sender_id')->nullable()->constrained("users",'id')->nullOnDelete();
            $table->foreignId('receiver_id')->nullable()->constrained("users",'id')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('payment_operator_id')->nullable()->constrained()->nullOnDelete();
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
