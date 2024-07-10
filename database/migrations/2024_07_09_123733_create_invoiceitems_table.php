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
        Schema::create('invoiceitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id'); // Foreign key to invoices table
            $table->string('product_code');
            $table->string('product_name');
            $table->integer('price');
            $table->char('size');
            $table->string('color');
            $table->integer('quantity');
            $table->timestamps();

            // Adding foreign key constraint
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoiceitems');
    }
};
