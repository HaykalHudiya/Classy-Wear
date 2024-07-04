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
            $table->string('inv_code');
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('price'); // Menggunakan integer untuk harga
            $table->char('size'); // Enum untuk ukuran baju
            $table->string('color'); // Kode warna biasanya berupa string
            $table->unsignedBigInteger('customer_id'); // Menggunakan unsignedBigInteger untuk foreign key
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
