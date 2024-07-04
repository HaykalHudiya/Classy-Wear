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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('price'); // Menggunakan integer untuk harga
            $table->text('desc'); // Menggunakan text untuk deskripsi panjang
            $table->enum('size', ['XS', 'S', 'M', 'L', 'XL']); // Enum untuk ukuran baju
            $table->string('color'); // Kode warna biasanya berupa string
            $table->string('image'); // Nama file gambar
            $table->enum('type', ['shirt', 'outwear', 't-shirt', 'pants']); // Enum untuk tipe produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
