<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\invoice;
use App\Models\invoiceitem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                DB::listen(function ($query) {
                    Log::info("Executing query: {$query->sql} with bindings: " . implode(", ", $query->bindings));
                });

                DB::beginTransaction();

                Log::info('Transaction started');

                // Generate unique customer code
                $customer = Customer::where('name', $request->name)->first();
                if ($customer) {
                    $customerCode = $customer->code;
                } else {
                    $lastCustomer = Customer::orderBy('id', 'desc')->first();
                    $lastCode = $lastCustomer ? (int)substr($lastCustomer->code, 2) : 0;
                    $customerCode = 'CS' . str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);

                    // Create customer
                    $customer = Customer::create([
                        'code' => $customerCode,
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'email' => $request->email,
                        'payment' => $request->payment,
                    ]);

                    Log::info('Customer created', ['customer' => $customer]);
                }

                // Generate unique invoice code with date and sequence number
                $date = Carbon::now()->format('dmy');
                $lastInvoice = Invoice::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
                $sequenceNumber = $lastInvoice ? ((int)substr($lastInvoice->inv_code, -4)) + 1 : 1;
                $invoiceCode = 'INV' . $date . str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT);

                // Create invoice
                $invoice = Invoice::create([
                    'inv_code' => $invoiceCode,
                    'status' => 'Unpaid',
                    'customer_id' => $customer->id,
                ]);

                Log::info('Invoice created', ['invoice' => $invoice]);

                // Create invoice items
                $cart = $request->session()->get('cart', []);
                foreach ($cart as $item) {
                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'product_code' => $item['product']->code,
                        'product_name' => $item['product']->name,
                        'price' => $item['product']->price,
                        'size' => $item['size'],
                        'color' => $item['color'],
                        'quantity' => $item['quantity'],
                    ]);

                    Log::info('Invoice item created', ['item' => $item]);
                }

                Log::info('Invoice items created');

                // Midtrans configuration
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                \Midtrans\Config::$isProduction = false;
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;

                // // Ensure unique order_id
                // $uniqueOrderID = $invoiceCode . '-' . time();

                $params = [
                    'transaction_details' => [
                        'order_id' => $invoiceCode,
                        'gross_amount' => collect($cart)->sum(function ($item) {
                            return $item['product']->price * $item['quantity'];
                        }),
                    ],
                    'customer_details' => [
                        'first_name' => $customer->name,
                        'email' => $customer->email,
                        'phone' => $customer->phone,
                    ],
                    'item_details' => collect($cart)->map(function ($item) {
                        return [
                            'id' => $item['product']->code,
                            'price' => $item['product']->price,
                            'quantity' => $item['quantity'],
                            'name' => $item['product']->name . " " . "Size " . $item['size'],
                        ];
                    })->toArray(),
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);
                Log::info('Snap token generated', ['snapToken' => $snapToken, 'cart' => $cart]);

                DB::commit();
                return view('components.cart_post', ['snapToken' => $snapToken]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Transaction failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                return back()->withErrors(['error' => 'Transaction failed, please try again.']);
            }
        } else {
            $cart = $request->session()->get('cart', []);
            return view('components.cart', ['cart' => $cart]);
        }
    }


    // public function index($snapToken)
    // {
    //     return view('components.cart_post', ['snapToken' => $snapToken]);
    // }

    public function callback(Request $request)
    {
        // Log permintaan yang masuk untuk debugging
        Log::info('Callback diterima', ['request' => $request->all()]);

        $serverKey = config('midtrans.server_key');
        $order_id = $request->order_id;
        $status_code = $request->status_code;
        $gross_amount = $request->gross_amount;
        $signature_key = $request->signature_key;

        // Generate hash lokal menggunakan data yang diterima
        $hashed = hash("SHA512", $order_id . $status_code . $gross_amount . $serverKey);

        // Log hash yang dihasilkan untuk perbandingan
        Log::info('Hash yang dihasilkan', ['hashed' => $hashed]);

        // Validasi signature key
        if ($hashed === $signature_key) {
            Log::info('Signature key sesuai');

            // Proses status transaksi
            if ($request->transaction_status == 'capture') {
                Log::info('Status transaksi adalah capture', ['order_id' => $order_id]);

                // Temukan invoice yang sesuai
                $invoice = Invoice::where('inv_code', $order_id)->first();

                if ($invoice) {
                    // Update status invoice menjadi Paid
                    $invoice->update(['status' => 'Paid']);
                    Log::info('Status invoice diperbarui menjadi Paid', ['invoice' => $invoice]);
                } else {
                    // Log jika invoice tidak ditemukan
                    Log::warning('Invoice tidak ditemukan', ['order_id' => $order_id]);
                }
            }
        } else {
            Log::error('Signature key tidak sesuai', [
                'expected' => $hashed,
                'received' => $signature_key,
            ]);
        }
    }

    public function clearSession(Request $request)
    {
        // Hapus semua data session terkait cart
        Session::forget('cart');
        return response()->json(['status' => 'Session cleared successfully']);
    }

    public function rollbackTransaction(Request $request)
    {
        $pendingPayment = $request->session()->get('pending_payment');
        if ($pendingPayment) {
            $invoiceId = $pendingPayment['invoice_id'];
            $customerId = $pendingPayment['customer_id'];

            DB::transaction(function () use ($invoiceId, $customerId) {
                InvoiceItem::where('invoice_id', $invoiceId)->delete();
                Invoice::where('id', $invoiceId)->delete();
                Customer::where('id', $customerId)->delete();
            });

            // Remove the pending payment session
            $request->session()->forget('pending_payment');
        }

        return redirect()->route('checkout');
    }
}
