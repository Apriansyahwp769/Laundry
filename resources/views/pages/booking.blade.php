@extends('layouts.app')

@section('title', 'Book Service')
@section('meta_description', 'Book your laundry service now.')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Left Side - Image & Confirmation --}}
            <div class="space-y-6">
                {{-- Hero Image --}}
                <div class="relative h-64 rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('img/booking.jpg') }}"
                        alt="Laundry Facility"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h2 class="text-3xl font-bold">Effortless Hygiene.</h2>
                        <p class="text-gray-200 mt-1">Professional care for your clothes</p>
                    </div>
                </div>

                {{-- Order Success Card (Muncul jika ada order di session) --}}
                @if(isset($order) && $order)
                <div class="bg-white rounded-2xl shadow-lg border border-blue-200 p-6 animate-fade-in">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-green-200 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Order Successful</h3>
                            <p class="text-sm text-gray-600">Your transaction details.</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-xs text-blue-600 uppercase font-bold tracking-wide">Receipt Number</p>
                                <p class="text-2xl font-bold text-blue-800 mt-1">{{ $order->order_number }}</p>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full uppercase border border-yellow-200">
                                {{ str_replace('_', ' ', strtoupper($order->status)) }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-3 border-b border-blue-200">
                                <span class="text-sm text-gray-600">Service:</span>
                                <span class="font-semibold text-gray-900">{{ $order->service->name }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-blue-200">
                                <span class="text-sm text-gray-600">Weight:</span>
                                <span class="font-semibold text-gray-900">{{ $order->total_weight }} kg</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-blue-200">
                                <span class="text-sm text-gray-600">Est. Completion:</span>
                                <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($order->estimated_completion)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-1">
                                <span class="text-sm font-bold text-gray-700">Total Price:</span>
                                <span class="text-xl font-bold text-blue-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3">
                        <div class="flex gap-3">
                            <a href="{{ route('track-order') }}"
                                class="flex-1 bg-blue-700 hover:bg-blue-800 text-white text-center py-3 rounded-lg font-semibold transition-colors shadow-md">
                                Track Order
                            </a>
                            <button onclick="copyOrderCode('{{ $order->order_number }}')"
                                id="btn-copy"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                                <span id="copy-text">Salin Kode</span>
                            </button>
                        </div>
                        <a href="{{ route('orders.my') }}"
                            class="w-full text-center text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center justify-center gap-1 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Lihat Riwayat Pesanan Saya
                        </a>
                    </div>

                    {{-- Toast Notification --}}
                    <div id="toast-copy" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 flex items-center gap-2 z-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Kode berhasil disalin!</span>
                    </div>
                </div>
                @else
                {{-- Empty State --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Ready to Order?</h3>
                        <p class="text-gray-600 text-sm">Fill out the form on the right to submit your request.</p>
                        <a href="{{ route('orders.my') }}"
                            class="w-full text-center text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center justify-center gap-1 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Lihat Riwayat Pesanan Saya
                        </a>
                    </div>
                </div>
                @endif
            </div>

            {{-- Right Side - Form --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Service Request</h2>
                    <p class="text-gray-600">Submit a new order regarding a previous service.</p>
                </div>

                {{-- User Info Summary (Otomatis dari Login) --}}
                <div class="bg-gray-50 rounded-xl p-4 mb-6 border border-gray-200">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->phone ?? 'No Phone' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-blue-700 bg-blue-50 px-3 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Estimasi Selesai: <strong>{{ $estimatedDate->format('d M Y') }}</strong> (+3 Hari)</span>
                    </div>
                </div>

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-5" id="bookingForm">
                    @csrf

                    {{-- Service Type - Only 2 Options --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Service Type *</label>
                        <select name="service_type" id="serviceType" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white">
                            <option value="">-- Pilih Layanan --</option>
                            <option value="reguler" data-price="8000" {{ old('service_type') == 'reguler' ? 'selected' : '' }}>
                                Reguler Wash - Rp 8.000/kg
                            </option>
                            <option value="premium" data-price="12000" {{ old('service_type') == 'premium' ? 'selected' : '' }}>
                                Premium Wash - Rp 12.000/kg
                            </option>
                        </select>
                    </div>

                    {{-- Estimated Weight --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Estimated Weight (kg) *</label>
                        <input type="number" 
                               name="total_weight" 
                               id="totalWeight"
                               value="{{ old('total_weight') }}"
                               step="0.1" 
                               min="0.1"
                               required
                               placeholder="e.g. 3.5"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <p class="text-xs text-gray-500 mt-1">Minimal 3 kg untuk cuci kiloan</p>
                    </div>

                    {{-- Express Service Checkbox --}}
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="is_express" 
                                   id="isExpress"
                                   value="1"
                                   {{ old('is_express') ? 'checked' : '' }}
                                   class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-0.5">
                            <div class="flex-1">
                                <span class="font-semibold text-gray-900">Layanan Kilat (24 Jam)</span>
                                <p class="text-sm text-gray-600 mt-1">Pakaian siap lebih cepat. <span class="font-bold text-red-600">Biaya tambahan +50%</span> dari total harga.</p>
                            </div>
                        </label>
                    </div>

                    {{-- Price Summary (Live Calculator) --}}
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Harga Dasar</span>
                            <span class="font-medium text-gray-900" id="basePrice">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center mb-2 hidden" id="expressRow">
                            <span class="text-sm text-gray-600">Biaya Kilat (+50%)</span>
                            <span class="font-medium text-red-600" id="expressFee">+ Rp 0</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 mt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-gray-700">Total Estimasi</span>
                                <span class="text-xl font-bold text-blue-700" id="totalPrice">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Additional Notes</label>
                        <textarea name="notes" 
                                  rows="3" 
                                  placeholder="Any special instructions..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">{{ old('notes') }}</textarea>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-lg shadow-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        Submit Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Price Calculator (Live)
    const serviceType = document.getElementById('serviceType');
    const totalWeight = document.getElementById('totalWeight');
    const isExpress = document.getElementById('isExpress');
    const basePriceEl = document.getElementById('basePrice');
    const expressRow = document.getElementById('expressRow');
    const expressFeeEl = document.getElementById('expressFee');
    const totalPriceEl = document.getElementById('totalPrice');

    function formatRupiah(amount) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
    }

    function calculatePrice() {
        const pricePerKg = parseInt(serviceType.options[serviceType.selectedIndex]?.dataset.price || 0);
        const weight = parseFloat(totalWeight.value) || 0;
        const isExpressChecked = isExpress.checked;

        if (!pricePerKg || !weight) {
            basePriceEl.textContent = 'Rp 0';
            expressFeeEl.textContent = '+ Rp 0';
            totalPriceEl.textContent = 'Rp 0';
            expressRow.classList.add('hidden');
            return;
        }

        const base = pricePerKg * weight;
        const expressFee = isExpressChecked ? base * 0.5 : 0;
        const total = base + expressFee;

        basePriceEl.textContent = formatRupiah(base);
        expressFeeEl.textContent = '+ ' + formatRupiah(expressFee);
        totalPriceEl.textContent = formatRupiah(total);
        
        expressRow.classList.toggle('hidden', !isExpressChecked);
    }

    // Event listeners
    serviceType?.addEventListener('change', calculatePrice);
    totalWeight?.addEventListener('input', calculatePrice);
    isExpress?.addEventListener('change', calculatePrice);

    // Initial calculation
    calculatePrice();

    // Copy Order Code Function
    function copyOrderCode(orderNumber) {
        navigator.clipboard.writeText(orderNumber).then(function() {
            const btn = document.getElementById('btn-copy');
            const text = document.getElementById('copy-text');
            const toast = document.getElementById('toast-copy');
            
            const originalText = text.innerText;
            text.innerText = 'Tersalin!';
            btn.classList.remove('bg-gray-100', 'hover:bg-gray-200');
            btn.classList.add('bg-green-100', 'text-green-800');
            toast.classList.remove('translate-y-20', 'opacity-0');
            
            setTimeout(function() {
                text.innerText = originalText;
                btn.classList.remove('bg-green-100', 'text-green-800');
                btn.classList.add('bg-gray-100', 'hover:bg-gray-200');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2000);
        }).catch(function(err) {
            const textArea = document.createElement('textarea');
            textArea.value = orderNumber;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            
            const toast = document.getElementById('toast-copy');
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(function() {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2000);
        });
    }
</script>
@endpush
@endsection