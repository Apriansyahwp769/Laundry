<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   public function index(Request $request)
{
    $query = Customer::query();

    // Filter Search
    if ($request->has('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('whatsapp', 'like', "%{$search}%");
    }

    // Filter VIP
    if ($request->has('vip') && $request->vip == 1) {
        $query->where('is_vip', true);
    }

    $customers = $query->orderBy('cached_lifetime_value', 'desc')->paginate(15);

    // Get selected customer for sidebar
    $selectedCustomer = null;
    if ($request->has('customer')) {
        $selectedCustomer = Customer::with(['orders.service'])->findOrFail($request->customer);
    }

    return view('admin.customers.index', compact('customers', 'selectedCustomer'));
}

    public function show(Customer $customer)
    {
        // Load recent activity (orders)
        $recentOrders = Order::where('customer_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.customers.show', compact('customer', 'recentOrders'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'address' => 'nullable|string',
            'is_vip' => 'boolean',
            'loyalty_points' => 'integer|min:0',
        ]);

        $customer->update($validated);
        return redirect()->route('admin.customers.show', $customer)->with('success', 'Data pelanggan berhasil diperbarui.');
    }
}