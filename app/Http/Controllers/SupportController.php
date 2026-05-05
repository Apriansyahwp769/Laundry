<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupportController extends Controller
{
    public function index()
    {
        return view('pages.support');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_whatsapp' => 'required|string|max:20',
            'order_number' => 'nullable|string|exists:orders,order_number',
            'category' => 'required|in:luntur,tertukar,hilang,kualitas,kerusakan,lainnya',
            'description' => 'required|string|min:20|max:1000',
        ], [
            'customer_name.required' => 'Nama lengkap harus diisi.',
            'customer_whatsapp.required' => 'Nomor WhatsApp harus diisi.',
            'category.required' => 'Kategori keluhan harus dipilih.',
            'description.required' => 'Detail keluhan harus diisi.',
            'description.min' => 'Detail keluhan minimal 20 karakter.',
            'description.max' => 'Detail keluhan maksimal 1000 karakter.',
            'order_number.exists' => 'Nomor pesanan tidak ditemukan.',
        ]);

        try {
            DB::beginTransaction();

            $customer = Customer::firstOrCreate(
                ['whatsapp' => $validated['customer_whatsapp']],
                ['name' => $validated['customer_name']]
            );

            $orderId = null;
            if (!empty($validated['order_number'])) {
                $order = Order::where('order_number', $validated['order_number'])->first();
                if ($order && $order->customer_id === $customer->id) {
                    $orderId = $order->id;
                }
            }

            $priority = $this->getPriorityByCategory($validated['category']);
            $ticketNumber = $this->generateTicketNumber();

            $complaint = Complaint::create([
                'ticket_number' => $ticketNumber,
                'customer_id' => $customer->id,
                'order_id' => $orderId,
                'category' => $validated['category'],
                'priority' => $priority,
                'status' => 'new',
                'description' => $validated['description'],
            ]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'ticket_number' => $ticketNumber,
                    'priority' => $priority,
                    'message' => 'Laporan berhasil dikirim.'
                ], 201);
            }

            return redirect()->route('support')->with('success', 'Laporan berhasil dikirim! Tiket #' . $ticketNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
            }
            
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    private function getPriorityByCategory($category)
    {
        return match ($category) {
            'hilang', 'kerusakan' => 'high',
            'tertukar', 'kualitas', 'luntur' => 'medium',
            'lainnya' => 'low',
            default => 'low',
        };
    }

    private function generateTicketNumber()
    {
        do {
            $ticketNumber = 'TKT-' . strtoupper(Str::random(3));
        } while (Complaint::where('ticket_number', $ticketNumber)->exists());
        return $ticketNumber;
    }
}