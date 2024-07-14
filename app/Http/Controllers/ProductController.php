<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index($category, Request $request)
    {
        $cart = session()->get('cart', []);
        $cartCount = count($cart);
        $sizeOrder = ['XS', 'S', 'M', 'L', 'XL'];
        $products = [];
        switch ($category) {
            case 'newarrival':
                $products = Product::where('type', 'newarrival')->get();
                break;
            case 'shirt':
                $products = Product::where('type', 'shirt')->get();
                break;
            case 'outerwear':
                $products = Product::where('type', 'outerwear')->get();
                break;
            case 'tshirt':
                $products = Product::where('type', 'tshirt')->get();
                break;
            case 'pants':
                $products = Product::where('type', 'pants')->get();
                break;
        }
        // Group products by the first 6 characters of 'code'
        $groupedProducts = $products->groupBy(function ($product) {
            return substr($product->code, 0, 6);
        });

        // Combine 'color' and 'size' for products with the same 'code'
        $finalProducts = $groupedProducts->map(function ($group) use ($sizeOrder) {
            $colors = [];
            $sizes = [];

            foreach ($group as $product) {
                $colors[] = $product->color;
                $sizes[] = $product->size;
            }

            // Remove duplicates and sort sizes
            $sizes = array_unique($sizes);
            usort($sizes, function ($a, $b) use ($sizeOrder) {
                return array_search($a, $sizeOrder) - array_search($b, $sizeOrder);
            });

            return [
                'id' => $group[0]->id,
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

        if ($request->ajax()) {
            if ($request->search) {
                $searchTerm = $request->search;
                $finalProducts = $finalProducts->filter(function ($product) use ($searchTerm) {
                    return stripos($product['name'], $searchTerm) !== false;
                });
            }
            return view("components.shirts", [
                'products' => $finalProducts,
                'sizeOrder' => $sizeOrder,
                'cart' => $cartCount
            ])->render();
        }

        return view("components.{$category}", [
            'products' => $finalProducts,
            'sizeOrder' => $sizeOrder,
            'cart' => $cartCount,
            'category' => $category
        ]);
    }



    public function detail($code, Request $request)
    {
        $category = $request->query('category');
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
        return view('components.detail', compact('finalProduct', 'sizeOrder', 'category'));
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

                $productCode = $product->code;

                // Simpan data produk ke dalam sesi
                $cart = $request->session()->get('cart', []);
                $cart[] = [
                    'code' => $code,
                    'size' => $size,
                    'color' => $color,
                    'product' => $product,
                    'quantity' => 1,
                ];
                $request->session()->put('cart', $cart);

                // dd($cart);
                // dd($product->code);
                return view('components.cart', compact('cart'));
            } catch (ModelNotFoundException $e) {
                return view('components.cart', ['product' => null]);
            }
        }
    }

    // public function carts(Request $request)
    // {
    //     $cart = $request->session()->get('cart', []);
    //     return view('components.cart', ['cart' => $cart]);
    // }

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

    public function addToCart(Request $request)
    {
        try {
            $code = $request->input('code');
            $size = $request->input('size');
            $color = $request->input('color');
            $quantity = $request->input('quantity', 1);

            $product = Product::where('code', 'like', substr($code, 0, 6) . '%')
                ->where('size', $size)
                ->where('color', '#' . $color)
                ->firstOrFail();

            // Simpan data produk ke dalam sesi
            $cart = $request->session()->get('cart', []);
            $cart[] = [
                'code' => $code,
                'size' => $size,
                'color' => $color,
                'quantity' => $quantity,
                'product' => $product,
            ];
            $request->session()->put('cart', $cart);
            return response()->json(['success' => true, 'message' => 'Product added to cart successfully', 'cart' => $cart]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            $code = $request->input('code');
            $code = substr($code, 0, -6);
            $size = $request->input('size');
            $color = $request->input('color');

            Log::info("Removing item from cart: Code={$code}, Size={$size}, Color={$color}");

            // Ambil data cart dari sesi
            $cart = $request->session()->get('cart', []);

            // Filter data cart untuk menghapus item yang sesuai
            $updatedCart = array_filter($cart, function ($item) use ($code, $size, $color) {
                return !($item['code'] === $code && $item['size'] === $size && $item['color'] === $color);
            });

            Log::info('Updated cart:', $updatedCart);

            // Simpan cart yang sudah diperbarui ke sesi
            $request->session()->put('cart', array_values($updatedCart));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error removing item from cart: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error removing item from cart']);
        }
    }



    // public function cart($code)
    // {
    //     $product = Product::where('code', 'like', substr($code, 0, 6) . '%')->firstOrFail();
    //     return view('components.cart', compact('product'));
    // }
}
