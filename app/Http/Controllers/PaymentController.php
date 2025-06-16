<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'gross_amount' => 'required|numeric|min:1000',
            'items' => 'required|array',
            'items.*.id' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.name' => 'required|string',
        ]);

        $user = Auth::user();
        $orderId = 'ORD-' . uniqid();

        // Create order
        $order = Order::create([
            'user_id' => $user->user_id,
            'order_id' => $orderId,
            'gross_amount' => $request->gross_amount,
            'payment_status' => 'pending',
        ]);

        // Prepare transaction details
        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $request->gross_amount,
        ];

        // Customer details
        $customer_details = [
            'first_name' => $user->user_name,
            'email' => $user->user_email,
            'phone' => $user->user_telp,
            'billing_address' => [
                'first_name' => $user->user_name,
                'address' => $user->user_alamat ?? 'Unknown',
                'city' => 'Unknown',
                'postal_code' => '00000',
                'country_code' => 'IDN',
            ],
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $request->items,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction_data);
            $order->update(['snap_token' => $snapToken]);

            return view('payments.checkout', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    public function handleCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        $order->update([
            'payment_status' => $request->transaction_status,
            'transaction_details' => $request->all(),
        ]);

        // Update stock if payment is successful
        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            // Assuming you have an order_items table linking orders to products
            // Update stok_keluar and produk.stok here
            // Example:
            // \App\Models\StokKeluar::create([...]);
            // \App\Models\Produk::where('kode_produk', $item->kode_produk)->decrement('stok', $item->quantity);
        }

        return response()->json(['status' => 'success']);
    }
}
