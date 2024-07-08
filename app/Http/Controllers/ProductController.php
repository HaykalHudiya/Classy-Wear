<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('type', 'shirt')->get();

        // Kelompokkan produk berdasarkan 6 karakter pertama dari 'code'
        $groupedProducts = $products->groupBy(function ($product) {
            return substr($product->code, 0, 6);
        });

        // Urutan yang diinginkan untuk ukuran
        $sizeOrder = ['XS', 'S', 'M', 'L', 'XL'];

        // Gabungkan 'color' dan 'size' untuk produk dengan 'code' yang sama
        $finalProducts = $groupedProducts->map(function ($group) use ($sizeOrder) {
            $colors = [];
            $sizes = [];

            foreach ($group as $product) {
                $colors[] = $product->color;
                $sizes[] = $product->size;
            }

            // Menghapus duplikat dan mengurutkan ukuran
            $sizes = array_unique($sizes);
            usort($sizes, function ($a, $b) use ($sizeOrder) {
                return array_search($a, $sizeOrder) - array_search($b, $sizeOrder);
            });

            return [
                'id' => $group[0]->id,  // Assuming the 'id' field exists in the Product model
                'code' => substr($group[0]->code, 0, 6),
                'name' => $group[0]->name,
                'price' => $group[0]->price,
                'desc' => $group[0]->desc,
                'image' => $group[0]->image,
                'colors' => array_unique($colors),
                'sizes' => $sizes,
                'type' => $group[0]->type,
                'qty' => $group->count(),
            ];
        });

        return view('components.shirt', ['products' => $finalProducts, 'sizeOrder' => $sizeOrder]);
        // $products = Product::all();
        // return view('components.shirt', compact('products'));
    }

    public function detail($code)
    {
        // Ambil produk dengan kode yang dimulai dari enam karakter pertama dari $code
        $product = Product::where('code', 'like', substr($code, 0, 6) . '%')->firstOrFail();

        // Kelompokkan produk berdasarkan kode yang dimulai dari enam karakter pertama dari produk ini
        $groupedProducts = Product::where('code', 'like', substr($product->code, 0, 6) . '%')->get()->groupBy(function ($product) {
            return substr($product->code, 0, 6);
        });

        // Urutan yang diinginkan untuk ukuran
        $sizeOrder = ['XS', 'S', 'M', 'L', 'XL'];

        // Ambil grup produk untuk kode yang sama dengan produk yang ditemukan
        $group = $groupedProducts[substr($product->code, 0, 6)];

        // Inisialisasi array untuk warna dan ukuran
        $colors = [];
        $sizes = [];

        foreach ($group as $product) {
            $colors[] = $product->color;
            $sizes[] = $product->size;
        }

        // Menghapus duplikat dan mengurutkan ukuran
        $sizes = array_unique($sizes);
        usort($sizes, function ($a, $b) use ($sizeOrder) {
            return array_search($a, $sizeOrder) - array_search($b, $sizeOrder);
        });

        // Mengembalikan data produk beserta kelompok ukuran dan warna
        $finalProduct = [
            'id' => $group[0]->id,  // Assuming the 'id' field exists in the Product model
            'code' => substr($group[0]->code, 0, 6),
            'name' => $group[0]->name,
            'price' => $group[0]->price,
            'desc' => $group[0]->desc,
            'image' => $group[0]->image,
            'colors' => array_unique($colors),
            'sizes' => $sizes,
            'type' => $group[0]->type,
            'qty' => $group->count(),
        ];

        $sizeOrder = ['XS', 'S', 'M', 'L', 'XL'];
        return view('components.detail', compact('finalProduct', 'sizeOrder'));
    }

    public function cart(Request $request)
    {
        if ($request->isMethod('post')) {
            return view('components.cart');
        } else {
            try {
                $code = $request->query('code');
                $size = $request->query('size');
                $color = $request->query('color');

                $product = Product::where('code', 'like', substr($code, 0, 6) . '%')
                    ->where('size', $size)
                    ->where('color', '#' . $color)
                    ->firstOrFail();

                return view('components.cart', compact('product'));
            } catch (ModelNotFoundException $e) {
                return view('components.cart', ['product' => null]);
            }
        }
    }


    public function checkProductAvailability(Request $request)
    {
        $productCode = $request->query('code');
        $selectedSize = $request->query('size');
        $selectedColor = $request->query('color');

        // Lakukan query untuk memeriksa apakah ada produk dengan ukuran dan warna yang sesuai
        $product = Product::where('code', 'like', substr($productCode, 0, 6) . '%')
            ->where('size', $selectedSize)
            ->where('color', '#' . $selectedColor)
            ->first();

        if ($product) {
            // Produk tersedia, redirect ke halaman cart
            return redirect()->route('cart.index', [
                'code' => $productCode,
                'size' => $selectedSize,
                'color' => $selectedColor,
            ]);
        } else {
            // Produk tidak ditemukan atau tidak sesuai dengan ukuran dan warna yang dipilih
            return back()->with('error', 'Produk tidak tersedia.');
        }
    }


    // public function cart($code)
    // {
    //     $product = Product::where('code', 'like', substr($code, 0, 6) . '%')->firstOrFail();
    //     return view('components.cart', compact('product'));
    // }
}
