<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migravtions.
     */
    public function up(): void
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->decimal('amount', 12, 2);
            $table->enum('types', ['Income', 'Expense']);
            $table->decimal('nominal', 12, 2);
            $table->string('payment_proof');
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->date('financial_date')->default(now());
            $table->date('has_paid_until');
            $table->decimal('total_income', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financials');
    }
};
