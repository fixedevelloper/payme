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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->string("account_number")->nullable();
            $table->string("routing_number")->nullable();
            $table->string("swift_code")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("postal_code")->nullable();
            $table->string("street_number")->nullable();
            $table->string("street_name")->nullable();
            $table->string("city")->nullable();
            $table->string("address")->nullable();
            $table->string("branch_code")->nullable()->comment("CFA account");
            $table->foreignId('customer_id')->nullable()->constrained("users",'id')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
