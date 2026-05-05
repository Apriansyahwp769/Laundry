<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    /**
     * Display Kanban board
     */
    public function index()
    {
        $complaints = Complaint::with(['customer', 'order'])
            ->latest()
            ->get();

        $kanban = [
            'new'            => $complaints->where('status', 'new'),
            'investigating'  => $complaints->where('status', 'investigating'),
            'resolved'       => $complaints->where('status', 'resolved'),
        ];

        return view('admin.complaints.index', compact('kanban'));
    }

    /**
     * Show form to create new complaint
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $orders = Order::whereIn('status', ['ready', 'delivered'])->latest()->get();
        return view('admin.complaints.create', compact('customers', 'orders'));
    }

    /**
     * Store new complaint
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_id' => 'nullable|exists:orders,id',
            'category' => 'required|in:luntur,tertukar,hilang,kualitas,kerusakan,lainnya',
            'priority' => 'required|in:low,medium,high',
            'description' => 'required|string|min:20|max:1000',
        ]);

        $ticketNumber = 'TKT-' . strtoupper(Str::random(3));

        Complaint::create([
            'ticket_number' => $ticketNumber,
            'customer_id' => $validated['customer_id'],
            'order_id' => $validated['order_id'] ?? null,
            'category' => $validated['category'],
            'priority' => $validated['priority'],
            'status' => 'new',
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.complaints.index')
            ->with('success', "Komplain {$ticketNumber} berhasil dibuat.");
    }

    /**
     * Update complaint status via AJAX (Drag & Drop)
     */
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,investigating,resolved,rejected',
        ]);

        $complaint->update(['status' => $validated['status']]);

        // Jika resolved, catat siapa yang resolve
        if ($validated['status'] === 'resolved' && auth()->check()) {
            $complaint->update([
                'resolved_by' => auth()->id(),
                'resolution_note' => $complaint->resolution_note ?? 'Diselesaikan via Kanban Board',
            ]);
        }

        return response()->json([
            'success' => true,
            'complaint' => [
                'id' => $complaint->id,
                'ticket_number' => $complaint->ticket_number,
                'status' => $complaint->status,
            ]
        ]);
    }

    /**
     * Show complaint detail
     */
    public function show(Complaint $complaint)
    {
        $complaint->load(['customer', 'order', 'resolver']);
        return view('admin.complaints.show', compact('complaint'));
    }
}