<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cause_id')->nullable()->constrained()->nullOnDelete();
            $table->string('donor_first_name');
            $table->string('donor_last_name');
            $table->string('donor_email');
            $table->string('donor_phone')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('online');
            $table->string('status')->default('pending');
            $table->string('transaction_id')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('donated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('donations'); }
};
