<?php

namespace App\Http\Controllers;

// ✅ IMPORT MODEL YANG DIPERLUKAN
use App\Models\Order;
use App\Models\Customer;  // ← Ini yang tadi kurang!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackOrderController extends Controller
{
    /**
     * Show public tracking form
     */
    public function showForm()
    {
        return view('pages.track-order');
    }

    /**
     * Process public tracking
     */
    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:255'
        ], [
            'order_number.required' => 'Please enter your receipt number.',
        ]);

        $order = Order::with(['customer', 'service'])
            ->where('order_number', $request->order_number)
            ->first();

        if (!$order) {
            return back()
                ->withInput()
                ->withErrors(['order_number' => 'Receipt number not found. Please check and try again.']);
        }

        return view('pages.track-order', compact('order'));
    }

    /**
     * Show authenticated user's order history
     */
    public function myOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your orders.');
        }

        $customer = Customer::where('whatsapp', Auth::user()->phone)->first();

        if (!$customer) {
            return view('pages.my-orders', ['orders' => collect([]), 'customer' => null]);
        }

        $orders = Order::with(['service'])
            ->where('customer_id', $customer->id)
            ->latest()
            ->paginate(10);
        // ✅ SORTING: Delivered di bawah, lainnya di atas + terbaru di atas
        $orders = Order::with(['service'])
            ->where('customer_id', $customer->id)
            ->orderByRaw("CASE WHEN status = 'delivered' THEN 1 ELSE 0 END ASC")  // Delivered = 1 (bawah)
            ->orderBy('created_at', 'desc')  // Terbaru di atas
            ->paginate(10);

        return view('pages.my-orders', compact('orders', 'customer'));
    }

    /**
     * Show order detail for authenticated user
     */
    public function showDetail($orderNumber)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $customer = Customer::where('whatsapp', Auth::user()->phone)->first();

        if (!$customer) {
            abort(404);
        }

        $order = Order::with(['service', 'customer'])
            ->where('order_number', $orderNumber)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        return view('pages.order-detail', compact('order'));
    }

    /**
     * Complete order - Simple POST method
     */
    public function complete(Request $request, Order $order)
    {
        // Validasi ownership: hanya customer pemilik yang bisa complete
        $customer = Customer::where('whatsapp', auth()->user()?->phone)->first();

        if (!$customer || $order->customer_id !== $customer->id) {
            abort(403, 'Unauthorized');
        }

        // Hanya bisa complete jika status 'ready'
        if ($order->status !== 'ready') {
            return back()->with('error', 'Pesanan belum siap untuk dikonfirmasi.');
        }

        // Update ke delivered
        $order->update([
            'status' => 'delivered',
            'completed_at' => now(),
            'progress_percentage' => 100,
        ]);

        return back()->with('success', '✅ Pesanan #' . $order->order_number . ' berhasil ditandai sebagai DITERIMA!');
    }
}
