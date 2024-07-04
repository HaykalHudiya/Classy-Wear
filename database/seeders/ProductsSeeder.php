<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'code' => 'PSH001AMM001',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'M',
                'color' => '#A6B9B7',
                'image' => 'Group_17.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH001ELL001',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'L',
                'color' => '#E6B9A6',
                'image' => 'Group_17.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH001ELL004',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'L',
                'color' => '#E6B9A6',
                'image' => 'Group_17.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH001AXL001',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'XL',
                'color' => '#A6B9B7',
                'image' => 'Group_17.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH0028SS001',
                'name' => 'Polo Shirt',
                'price' => 153000,
                'desc' => 'Kaos lengan pendek dengan yang nyaman saat di gunakan.',
                'size' => 'S',
                'color' => '#858374',
                'image' => 'Group_18.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH002FLL001',
                'name' => 'Polo Shirt',
                'price' => 153000,
                'desc' => 'Kaos lengan pendek dengan yang nyaman saat di gunakan.',
                'size' => 'L',
                'color' => '#FF4191',
                'image' => 'Group_18.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH0029XL001',
                'name' => 'Polo Shirt',
                'price' => 153000,
                'desc' => 'Kaos lengan pendek dengan yang nyaman saat di gunakan.',
                'size' => 'XL',
                'color' => '#96C9F4',
                'image' => 'Group_18.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH001AMM002',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'M',
                'color' => '#A6B9B7',
                'image' => 'casual_shirt.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH001ELL002',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'L',
                'color' => '#E6B9A6',
                'image' => 'casual_shirt.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH0028SS002',
                'name' => 'Polo Shirt',
                'price' => 153000,
                'desc' => 'Kaos lengan pendek dengan yang nyaman saat di gunakan.',
                'size' => 'S',
                'color' => '#858374',
                'image' => 'Group_18.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH002FLL002',
                'name' => 'Polo Shirt',
                'price' => 153000,
                'desc' => 'Kaos lengan pendek dengan yang nyaman saat di gunakan.',
                'size' => 'L',
                'color' => '#FF4191',
                'image' => 'Group_18.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH003AXL001',
                'name' => 'Sport Shirt',
                'price' => 120000,
                'desc' => 'Sport shirt dengan breathable fabric.',
                'size' => 'XL',
                'color' => '#A6B9B7',
                'image' => 'Group_19.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH003BXS001',
                'name' => 'Sport Shirt',
                'price' => 120000,
                'desc' => 'Sport shirt dengan breathable fabric.',
                'size' => 'XS',
                'color' => '#E6B9A6',
                'image' => 'Group_19.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH002CSS001',
                'name' => 'Polo Shirt',
                'price' => 153000,
                'desc' => 'Kaos lengan pendek dengan yang nyaman saat di gunakan.',
                'size' => 'S',
                'color' => '#96C9F4',
                'image' => 'Group_18.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH002DMM001',
                'name' => 'Polo Shirt',
                'price' => 153000,
                'desc' => 'Kaos lengan pendek dengan yang nyaman saat di gunakan.',
                'size' => 'M',
                'color' => '#FF4191',
                'image' => 'Group_18.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH001ELL003',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'L',
                'color' => '#858374',
                'image' => 'casual_shirt.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PSH001AXL002',
                'name' => 'Oversize Shirt',
                'price' => 125000,
                'desc' => 'Kaos polos dengan bahan katun yang enak di pakai.',
                'size' => 'XL',
                'color' => '#A6B9B7',
                'image' => 'casual_shirt.png',
                'type' => 'shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel products
        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
