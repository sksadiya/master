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
        Schema::create('invoice_item_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_item_id')->constrained();
            $table->foreignId('tax_id')->constrained();
            $table->decimal('tax_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_item_taxes');
    }
};
