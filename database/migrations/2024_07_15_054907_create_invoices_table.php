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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->enum('invoice_status', ['Unpaid','Paid', 'Partially_Paid','Overdue','Processing']);
            $table->string('status')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->enum('discount_type', ['Fixed', 'Percentage'])->default('Fixed');
            $table->decimal('total', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->text('term')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
