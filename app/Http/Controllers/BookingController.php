<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Tampilkan form booking
     */
    public function create(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan.');
        }

        $user = auth()->user();
        $estimatedDate = Carbon::now()->addDays(3);
        
        $order = null;
        if ($request->session()->has('last_order_id')) {
            $order = Order::with(['service', 'customer'])->find($request->session()->get('last_order_id'));
            $request->session()->forget('last_order_id');
        }
        
        return view('pages.booking', compact('order', 'user', 'estimatedDate'));
    }

    /**
     * Proses booking order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type' => 'required|in:reguler,premium',
            'total_weight' => 'required|numeric|min:0.1',
            'is_express' => 'nullable|boolean',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $user = auth()->user();

            // Cari atau buat customer berdasarkan WhatsApp
            $customer = Customer::firstOrCreate(
                ['whatsapp' => $user->phone], 
                [
                    'name' => $user->name,
                    'address' => 'Auto-generated from User Profile',
                ]
            );

            // Tentukan service_id dari database (mapping sederhana)
            $serviceSlug = $validated['service_type'] === 'premium' ? 'cuci-kiloan-premium' : 'cuci-kiloan';
            $service = Service::where('slug', $serviceSlug)->first();
            
            // Fallback jika service tidak ditemukan di DB (gunakan hardcoded)
            if (!$service) {
                $basePrice = $validated['service_type'] === 'premium' ? 12000 : 8000;
            } else {
                $basePrice = $service->base_price;
            }

            // Hitung harga
            $totalPrice = bcmul($validated['total_weight'], $basePrice, 2);

            // Tambah biaya express +50% jika dicentang
            if (!empty($validated['is_express'])) {
                $expressFee = bcmul($totalPrice, '0.5', 2);
                $totalPrice = bcadd($totalPrice, $expressFee, 2);
            }

            // Generate order number
            $orderNumber = $this->generateOrderNumber();

            // Estimasi: Reguler +3 hari, Express +1 hari
            $estimatedCompletion = !empty($validated['is_express']) 
                ? Carbon::now()->addDay() 
                : Carbon::now()->addDays(3);

            // Buat order
            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_id' => $customer->id,
                'service_id' => $service->id ?? 1, // Fallback ke ID 1 jika tidak ditemukan
                'status' => 'waiting',
                'progress_percentage' => 0,
                'total_weight' => $validated['total_weight'],
                'total_price' => $totalPrice,
                'notes' => $validated['notes'],
                'estimated_completion' => $estimatedCompletion,
                'assigned_staff_id' => null,
            ]);

            // Update cached stats customer
            $customer->increment('cached_total_orders');
            $customer->increment('cached_total_weight', $validated['total_weight']);

            DB::commit();

            $request->session()->put('last_order_id', $order->id);

            return redirect()->route('booking.create')->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    private function generateOrderNumber()
    {
        do {
            $orderNumber = 'LNDRY-' . strtoupper(str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
}