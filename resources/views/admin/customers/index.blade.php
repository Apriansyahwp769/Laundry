@extends('layouts.admin')

@section('title', 'Customer Database')

@section('content')
<div class="h-screen flex flex-col bg-gray-50">
    {{-- Header --}}
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Customer Database</h1>
                <p class="text-sm text-gray-600 mt-1">Manage and view detailed client profiles and service history.</p>
            </div>
            
            <div class="flex items-center gap-3">
                {{-- Search --}}
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search by WhatsApp..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent w-64">
                </div>
                
                {{-- Export CSV --}}
                <button class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export CSV
                </button>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="flex-1 flex overflow-hidden">
        
        {{-- Customer Table --}}
        <div class="flex-1 p-6 overflow-auto">
            <div class="bg-white rounded-xl border border-gray-200">
                {{-- Filters --}}
                <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Filter by Status:</span>
                        <button class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">
                            All Clients
                        </button>
                        <button class="px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg hover:bg-gray-200">
                            VIP Only
                        </button>
                        <button class="px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg hover:bg-gray-200">
                            Needs Attention
                        </button>
                    </div>
                    
                    <span class="text-sm text-gray-500">
                        Showing 1-12 of {{ $customers->total() }}
                    </span>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Customer Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    WhatsApp Index
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Total Visits
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Total Weight
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Loyalty Points
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Complaint History
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($customers as $customer)
                                <tr class="hover:bg-gray-50 cursor-pointer {{ isset($selectedCustomer) && $selectedCustomer->id == $customer->id ? 'bg-blue-50 border-l-4 border-blue-600' : '' }}"
                                    onclick="selectCustomer({{ $customer->id }})">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                                                {{ strtoupper(substr($customer->name, 0, 2)) }}
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $customer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-700">{{ $customer->whatsapp }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-900">{{ $customer->cached_total_orders }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-700">{{ number_format($customer->cached_total_weight, 0, ',', '.') }} Kg</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($customer->loyalty_points > 1000)
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                </svg>
                                                {{ number_format($customer->loyalty_points) }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-700">{{ $customer->loyalty_points }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $complaintCount = $customer->complaints()->whereIn('status', ['new', 'investigating'])->count();
                                        @endphp
                                        @if($complaintCount == 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Zero (Perfect)
                                            </span>
                                        @elseif($complaintCount == 1)
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                                                1 Minor
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">
                                                {{ $complaintCount }} Resolved
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p>No customers found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-4 border-t border-gray-200">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>

        {{-- Customer Detail Sidebar --}}
        <div class="w-96 bg-white border-l border-gray-200 p-6 overflow-y-auto" id="customerSidebar">
            @if(isset($selectedCustomer))
                {{-- Customer Header --}}
                <div class="text-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-gray-200 mx-auto mb-3 flex items-center justify-center text-2xl font-bold text-gray-600">
                        {{ strtoupper(substr($selectedCustomer->name, 0, 2)) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $selectedCustomer->name }}</h2>
                    <div class="flex items-center justify-center gap-1 mt-1 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-sm">{{ $selectedCustomer->whatsapp }}</span>
                    </div>
                    
                    {{-- Badges --}}
                    <div class="flex items-center justify-center gap-2 mt-3">
                        @if($selectedCustomer->is_vip)
                            <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded">
                                VIP Member
                            </span>
                        @endif
                        @if($selectedCustomer->preferences && in_array('eco-wash', $selectedCustomer->preferences))
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded">
                                Eco-Wash Pref.
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Lifetime Metrics --}}
                <div class="mb-6">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">LIFETIME METRICS</h3>
                    
                    {{-- Est. Lifetime Value --}}
                    <div class="bg-gray-50 rounded-lg p-4 mb-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Est. Lifetime Value</span>
                            <button class="text-blue-600 hover:text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-2xl font-bold text-gray-900 mt-1">
                            Rp {{ number_format($selectedCustomer->cached_lifetime_value, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Visits</p>
                            <p class="text-lg font-bold text-gray-900">{{ $selectedCustomer->cached_total_orders }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Volume (Kg)</p>
                            <p class="text-lg font-bold text-gray-900">{{ number_format($selectedCustomer->cached_total_weight, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Recent Activity --}}
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide">RECENT ACTIVITY</h3>
                        <a href="{{ route('admin.orders.index', ['customer' => $selectedCustomer->id]) }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">
                            View All
                        </a>
                    </div>
                    
                    <div class="space-y-3">
                        @php
                            $recentOrders = $selectedCustomer->orders()->latest()->take(2)->get();
                        @endphp
                        @forelse($recentOrders as $order)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{{ $order->service->name }}</p>
                                    <p class="text-xs text-gray-600">{{ $order->total_weight }} Kg • Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 text-center py-4">No recent activity</p>
                        @endforelse
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3 mt-6">
                    <a href="{{ route('admin.orders.create', ['customer' => $selectedCustomer->id]) }}" 
                       class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 rounded-lg transition-colors text-center">
                        New Order
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $selectedCustomer->whatsapp) }}" 
                       target="_blank"
                       class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold py-2.5 rounded-lg transition-colors text-center">
                        Send Message
                    </a>
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <p class="text-gray-500 text-sm">Select a customer to view details</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function selectCustomer(customerId) {
        // Redirect ke halaman yang sama dengan parameter customer
        const url = new URL(window.location.href);
        url.searchParams.set('customer', customerId);
        window.location.href = url.toString();
    }

    // Search functionality
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const url = new URL(window.location.href);
        if (e.target.value) {
            url.searchParams.set('search', e.target.value);
        } else {
            url.searchParams.delete('search');
        }
        window.location.href = url.toString();
    });
</script>
@endsection