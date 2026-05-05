@extends('layouts.app')

@section('title', 'Riwayat Pesanan')
@section('meta_description', 'Lihat riwayat dan salin token pesanan laundry Anda.')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Riwayat Pesanan</h1>
            <p class="text-gray-600 mt-2">Pantau status dan salin token pesanan laundry Anda.</p>
        </div>

        @if($orders->isEmpty())
        {{-- Empty State --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pesanan. Yuk, pesan layanan laundry sekarang!</p>
            <a href="{{ route('booking.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Pesanan Baru
            </a>
        </div>
        @else
        {{-- Orders List --}}
        <div class="space-y-4">
            @foreach($orders as $order)
            {{-- ✅ Tambahkan class opacity jika status delivered --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-all 
                {{ $order->status === 'delivered' ? 'opacity-60 hover:opacity-100' : '' }}">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                    {{-- Left: Order Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-2 flex-wrap">
                            <span class="font-bold text-gray-900 text-lg {{ $order->status === 'delivered' ? 'line-through' : '' }}">
                                {{ $order->order_number }}
                            </span>

                            @php
                            $statusConfig = [
                            'waiting' => ['label' => 'Menunggu', 'class' => 'bg-gray-100 text-gray-700'],
                            'washing' => ['label' => 'Dicuci', 'class' => 'bg-blue-100 text-blue-700'],
                            'ironing' => ['label' => 'Disetrika', 'class' => 'bg-indigo-100 text-indigo-700'],
                            'ready' => ['label' => 'Siap', 'class' => 'bg-green-100 text-green-700'],
                            'delivered' => ['label' => 'Selesai ✓', 'class' => 'bg-green-600 text-white'],
                            'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-700'],
                            ];
                            $status = $statusConfig[$order->status] ?? $statusConfig['waiting'];
                            @endphp

                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $status['class'] }}">
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                            <div>
                                <p class="text-gray-500 text-xs">Layanan</p>
                                <p class="font-medium text-gray-900 truncate">{{ $order->service->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs">Berat</p>
                                <p class="font-medium text-gray-900">{{ $order->total_weight }} kg</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs">Estimasi</p>
                                <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($order->estimated_completion)->format('d M') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs">Total</p>
                                <p class="font-bold text-blue-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Copy Token Button --}}
                    <div class="flex items-center gap-3 md:border-l md:pl-4 md:border-gray-200">
                        @if($order->status === 'delivered')
                        {{-- Button disabled untuk delivered --}}
                        <button disabled
                            class="flex items-center gap-2 px-4 py-2.5 bg-gray-300 text-gray-500 text-sm font-semibold rounded-lg cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Selesai</span>
                        </button>
                        @else
                        {{-- Button aktif untuk order belum delivered --}}
                        <button onclick="copyToken('{{ $order->order_number }}', this)"
                            class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                            </svg>
                            <span class="btn-text">Salin Token</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $orders->links() }}
        </div>
        @endif

        {{-- Back Button --}}
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

{{-- Toast Notification --}}
<div id="toast-copy" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 flex items-center gap-2 z-50">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span>Token berhasil disalin!</span>
</div>
@endsection

@push('scripts')
<script>
    function copyToken(token, button) {
        // Copy ke clipboard
        navigator.clipboard.writeText(token).then(function() {
            const btnText = button.querySelector('.btn-text');
            const originalText = btnText.innerText;
            const toast = document.getElementById('toast-copy');

            // Ubah text tombol
            btnText.innerText = 'Tersalin!';
            button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            button.classList.add('bg-green-600', 'hover:bg-green-700');

            // Tampilkan toast
            toast.classList.remove('translate-y-20', 'opacity-0');

            // Kembalikan setelah 2 detik
            setTimeout(function() {
                btnText.innerText = originalText;
                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2000);

        }).catch(function(err) {
            // Fallback untuk browser lama
            const textArea = document.createElement('textarea');
            textArea.value = token;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);

            // Tampilkan toast
            const toast = document.getElementById('toast-copy');
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(function() {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2000);
        });
    }
</script>
@endpush