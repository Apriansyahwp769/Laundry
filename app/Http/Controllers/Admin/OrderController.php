<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display Kanban board
     */
    public function index()
    {
        $orders = Order::with(['customer', 'assignedStaff', 'service'])
            ->latest()
            ->get();

        // Group by status for Kanban columns
        $kanban = [
            'waiting' => $orders->where('status', 'waiting'),
            'washing' => $orders->where('status', 'washing'),
            'ironing' => $orders->where('status', 'ironing'),
            'ready'   => $orders->where('status', 'ready'),
        ];

        return view('admin.orders.index', compact('kanban'));
    }

    /**
     * Show form to create new order
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $services = Service::where('is_active', true)->get();
        $staff = User::whereIn('role', ['staff', 'driver'])->where('is_active', true)->get();
        
        return view('admin.orders.create', compact('customers', 'services', 'staff'));
    }

    /**
     * Store new order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'assigned_staff_id' => 'nullable|exists:users,id',
            'total_weight' => 'required|numeric|min:0.1',
            'notes' => 'nullable|string',
            'estimated_completion' => 'required|date|after:now',
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $totalPrice = bcmul($validated['total_weight'], $service->base_price, 2);

        $orderNumber = 'ORD-' . strtoupper(Str::random(5));

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_id' => $validated['customer_id'],
            'service_id' => $validated['service_id'],
            'assigned_staff_id' => $validated['assigned_staff_id'],
            'total_weight' => $validated['total_weight'],
            'total_price' => $totalPrice,
            'notes' => $validated['notes'],
            'estimated_completion' => $validated['estimated_completion'],
            'status' => 'waiting',
            'progress_percentage' => 0,
        ]);

        // Update customer cached stats
        $customer = Customer::find($validated['customer_id']);
        $customer->increment('cached_total_orders');
        $customer->increment('cached_total_weight', $validated['total_weight']);
        $customer->increment('cached_lifetime_value', $totalPrice);

        return redirect()->route('admin.orders.index')
            ->with('success', "Pesanan {$orderNumber} berhasil dibuat.");
    }

    /**
     * Update order status via AJAX (Drag & Drop)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:waiting,washing,ironing,ready,delivered,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',
        ]);

        $order->update([
            'status' => $validated['status'],
            'progress_percentage' => $validated['progress_percentage'] ?? $order->progress_percentage,
        ]);

        // Set completed_at when delivered
        if ($validated['status'] === 'delivered') {
            $order->update(['completed_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'order' => [
                'id' => $order->id,
                'status' => $order->status,
                'progress_percentage' => $order->progress_percentage,
            ]
        ]);
    }

    /**
     * Show order detail
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'assignedStaff', 'service', 'complaints']);
        return view('admin.orders.show', compact('order'));
    }
}