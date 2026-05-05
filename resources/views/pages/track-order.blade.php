@extends('layouts.app')

@section('title', 'Track Order')
@section('meta_description', 'Track your laundry order in real-time. Enter your receipt number to see the current status.')

@section('content')

<!-- Header Section -->
<section class="max-w-4xl mx-auto px-6 py-12 text-center">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Track Your Laundry</h1>
    <p class="text-gray-600 text-lg">Enter your receipt number to see the real-time status of your items.</p>
</section>

<!-- Search Section -->
<section class="max-w-2xl mx-auto px-6 mb-12">
    {{-- Show error if order not found --}}
    @if ($errors->has('order_number'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-center">
        {{ $errors->first('order_number') }}
    </div>
    @endif

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-center">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->has('order_number'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-center">
            {{ $errors->first('order_number') }}
        </div>
    @endif

    <form action="{{ route('track-order.process') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-2">
        @csrf
        <div class="flex gap-2">
            <div class="flex-1 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text"
                    name="order_number"
                    id="receiptInput"
                    placeholder="LNDRY-0001"
                    value="{{ old('order_number') }}"
                    class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 placeholder-gray-400">
            </div>
            <button type="submit"
                class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-xl font-semibold transition-colors">
                Track
            </button>
        </div>
    </form>
</section>

{{-- Show tracking result if order found --}}
@if(isset($order) && $order)
<!-- Tracking Result -->
<section class="max-w-4xl mx-auto px-6 mb-16">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <!-- Order Header -->
        <div class="p-6 md:p-8 border-b border-gray-100 bg-gray-50">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Order #{{ $order->order_number }}</h2>
                    <p class="text-gray-600 text-sm mt-1">
                        Dropped off on {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y \a\t H:i') }}
                    </p>
                </div>

                {{-- Status Badge --}}
                @php
                $statusConfig = [
                'waiting' => ['label' => 'Waiting Pickup', 'color' => 'bg-gray-100 text-gray-700', 'pulse' => false],
                'washing' => ['label' => 'Washing in Progress', 'color' => 'bg-blue-100 text-blue-700', 'pulse' => true],
                'ironing' => ['label' => 'Ironing in Progress', 'color' => 'bg-indigo-100 text-indigo-700', 'pulse' => true],
                'ready' => ['label' => 'Ready for Pickup', 'color' => 'bg-green-100 text-green-700', 'pulse' => false],
                'delivered' => ['label' => 'Delivered ✓', 'color' => 'bg-green-600 text-white', 'pulse' => false],
                'cancelled' => ['label' => 'Cancelled', 'color' => 'bg-red-100 text-red-700', 'pulse' => false],
                ];
                $config = $statusConfig[$order->status] ?? $statusConfig['waiting'];
                @endphp

                <div class="flex items-center gap-2 {{ $config['color'] }} px-4 py-2 rounded-full">
                    @if($config['pulse'])
                    <div class="w-2 h-2 bg-current rounded-full animate-pulse"></div>
                    @endif
                    <span class="font-semibold text-sm">{{ $config['label'] }}</span>
                </div>
            </div>
        </div>

        <!-- Progress Timeline -->
        <div class="p-6 md:p-8 border-b border-gray-100">
            <div class="relative">
                {{-- Progress Bar Background --}}
                <div class="absolute top-6 left-0 right-0 h-1 bg-gray-200 rounded-full">
                    <div class="h-full bg-blue-600 rounded-full transition-all duration-500"
                        style="width: {{ $order->progress_percentage }}%"></div>
                </div>

                <div class="relative grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4">
                    @php
                    $steps = [
                    ['key' => 'waiting', 'label' => 'Menunggu<br>Dijemput', 'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />'],
                    ['key' => 'washing', 'label' => 'Sedang<br>Dicuci', 'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />'],
                    ['key' => 'ironing', 'label' => 'Sedang<br>Disetrika', 'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />'],
                    ['key' => 'ready', 'label' => 'Siap Diambil /<br>Diantar', 'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />'],
                    ];

                    $statusOrder = ['waiting' => 0, 'washing' => 1, 'ironing' => 2, 'ready' => 3, 'delivered' => 3, 'cancelled' => -1];
                    $currentStep = $statusOrder[$order->status] ?? 0;
                    @endphp

                    @foreach($steps as $index => $step)
                    <div class="text-center">
                        @php
                        $isCompleted = $index < $currentStep || $order->status === 'delivered';
                            $isCurrent = $index == $currentStep && $order->status !== 'delivered' && $order->status !== 'cancelled';
                            $isCancelled = $order->status === 'cancelled';
                            @endphp

                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center mx-auto mb-2 md:mb-3 relative z-10 transition-all
                                    {{ $isCancelled ? 'bg-red-100' : ($isCompleted ? 'bg-green-600' : ($isCurrent ? 'bg-blue-600 ring-4 ring-blue-100' : 'bg-gray-200')) }}">

                                @if($isCancelled && $index == 0)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                @elseif($isCompleted)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 {{ $isCurrent ? 'text-white' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $step['icon'] !!}
                                </svg>
                                @endif
                            </div>
                            <p class="text-xs md:text-sm {{ $isCancelled ? 'text-red-600' : ($isCompleted || $isCurrent ? 'font-bold text-gray-900' : 'font-semibold text-gray-500') }}">
                                {!! $step['label'] !!}
                            </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-100">

            <!-- Service Details -->
            <div class="p-6 md:p-8">
                <div class="flex items-center gap-2 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Service Details</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Service Type</p>
                        <p class="text-gray-900 font-medium">{{ $order->service->name }}</p>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Weight</p>
                        <p class="text-gray-900 font-medium">{{ $order->total_weight }} kg</p>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Price</p>
                        <p class="text-xl font-bold text-blue-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>

                    @if($order->notes)
                    <div class="border-t border-gray-100 pt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Special Instructions</p>
                        <p class="text-gray-700 text-sm">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Customer & Delivery Info -->
            <div class="p-6 md:p-8">
                <div class="flex items-center gap-2 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Customer Info</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Customer Name</p>
                        <p class="text-gray-900 font-medium">{{ $order->customer->name }}</p>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">WhatsApp</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer->whatsapp) }}"
                            target="_blank"
                            class="text-blue-600 hover:underline font-medium">
                            {{ $order->customer->whatsapp }}
                        </a>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Est. Completion</p>
                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                            <p class="text-gray-900 font-semibold">
                                {{ \Carbon\Carbon::parse($order->estimated_completion)->format('d M Y, H:i') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($order->estimated_completion)->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    @if($order->status === 'delivered' && $order->completed_at)
                    <div class="border-t border-gray-100 pt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Completed At</p>
                        <p class="text-gray-900 font-medium">
                            {{ \Carbon\Carbon::parse($order->completed_at)->format('d M Y, H:i') }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="p-6 md:p-8 border-t border-gray-100 bg-gray-50 flex flex-wrap gap-3">
            <a href="{{ route('home') }}" class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition-colors">
                ← Back to Home
            </a>

            {{-- ✅ Complete Order Button (Only shows when status = ready) --}}
            @if($order->status === 'ready')
            <button type="button"
                id="btnCompleteOrder"
                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors flex items-center gap-2 shadow-md shadow-green-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Complete Order
            </button>
            @endif

            <a href="{{ route('support') }}" class="px-6 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 rounded-lg font-medium transition-colors">
                Need Help? Contact Support
            </a>
        </div>

        {{-- ✅ Hidden Form for Complete Order --}}
        @if($order->status === 'ready')
        <form id="formCompleteOrder" action="{{ route('orders.complete', $order->id) }}" method="POST" class="hidden">
            @csrf
            @method('POST')
        </form>
        @endif
    </div>
</section>

{{-- ✅ MODAL: Konfirmasi Complete Order --}}
<div id="completeModal" class="fixed inset-0 z-[100] hidden" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" id="modalBackdrop"></div>

    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-95 opacity-0" id="modalContent">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">Konfirmasi Penerimaan</h3>
                <button type="button" id="btnCloseModal" class="p-1 hover:bg-gray-200 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Pesanan Sudah Diterima?</h4>
                <p class="text-gray-600 text-sm mb-6">
                    Konfirmasi bahwa Anda telah menerima pesanan <strong id="modalOrderNumber">{{ $order->order_number }}</strong> dalam kondisi baik.
                </p>

                <div class="bg-blue-50 rounded-lg px-4 py-3 text-left">
                    <p class="text-xs text-blue-600 uppercase font-semibold mb-1">Detail Pesanan</p>
                    <p class="text-sm text-gray-700">
                        <span class="font-medium">Total:</span> Rp {{ number_format($order->total_price, 0, ',', '.') }}<br>
                        <span class="font-medium">Estimasi:</span> {{ \Carbon\Carbon::parse($order->estimated_completion)->format('d M Y') }}
                    </p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 bg-gray-50 flex gap-3">
                <button type="button" id="btnCancelComplete" class="flex-1 px-4 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 rounded-lg font-medium transition-colors">
                    Batal
                </button>
                <button type="button" id="btnConfirmComplete" class="flex-1 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Ya, Sudah Diterima
                </button>
            </div>
        </div>
    </div>
</div>

@else
<!-- Default State - Information (Show when no order found) -->
<section class="max-w-4xl mx-auto px-6 mb-16">
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 md:p-12 border border-blue-100">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">How to Track Your Order</h2>
            <p class="text-gray-600">Follow these simple steps to track your laundry</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3">1</div>
                <h3 class="font-bold text-gray-900 mb-2">Find Your Receipt</h3>
                <p class="text-gray-600 text-sm">Check your booking confirmation for the receipt number (e.g., LNDRY-0001)</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3">2</div>
                <h3 class="font-bold text-gray-900 mb-2">Enter Number</h3>
                <p class="text-gray-600 text-sm">Type your receipt number in the search box above</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3">3</div>
                <h3 class="font-bold text-gray-900 mb-2">Track Status</h3>
                <p class="text-gray-600 text-sm">View real-time updates on your laundry progress</p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm">Need help? <a href="{{ route('support') }}" class="text-blue-600 hover:underline font-semibold">Contact our support team</a></p>
        </div>
    </div>
</section>
@endif


@if(isset($order) && $order)
@push('scripts')
<script>
    // Modal Elements
    const modal = document.getElementById('completeModal');
    const modalContent = document.getElementById('modalContent');
    const btnComplete = document.getElementById('btnCompleteOrder');
    const btnCloseModal = document.getElementById('btnCloseModal');
    const btnCancelComplete = document.getElementById('btnCancelComplete');
    const btnConfirmComplete = document.getElementById('btnConfirmComplete');

    // Show Modal
    function showCompleteModal(orderNumber) {
        document.getElementById('modalOrderNumber').textContent = orderNumber;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    // Hide Modal
    function hideCompleteModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 200);
    }

    // Event Listeners - Only run if button exists
    if (btnComplete) {
        btnComplete.addEventListener('click', () => {
            showCompleteModal('{{ $order->order_number }}');
        });
    }

    if (btnCloseModal) btnCloseModal.addEventListener('click', hideCompleteModal);
    if (btnCancelComplete) btnCancelComplete.addEventListener('click', hideCompleteModal);
    if (btnConfirmComplete) {
        btnConfirmComplete.addEventListener('click', () => {
            document.getElementById('formCompleteOrder')?.submit();
        });
    }

    // Close with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal?.classList.contains('hidden') === false) {
            hideCompleteModal();
        }
    });
</script>
@endpush
@endif

@push('scripts')
<script>
    // Auto-focus search input (always run)
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('receiptInput');
        if (input && !input.value) input.focus();
    });
</script>
@endpush
@endsection
