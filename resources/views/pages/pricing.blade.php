@extends('layouts.app')

@section('title', 'Pricing')
@section('meta_description', 'Transparent pricing for our professional laundry services. Choose from various packages tailored to your needs.')

@section('content')

    <!-- Header Section -->
    <section class="max-w-7xl mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl font-bold text-gray-900">Transparansi Harga, Kualitas Terjaga</h1>
        <p class="text-gray-600 mt-4 max-w-2xl mx-auto leading-relaxed">
            Pilih layanan yang sesuai dengan kebutuhan Anda. Dari cucian harian hingga perawatan khusus, 
            kami memberikan hasil terbaik dengan sistem yang sistematis.
        </p>
    </section>

    <!-- Express Service Banner -->
    <section class="max-w-3xl mx-auto px-6 mb-16">
        <div class="bg-gray-100 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-400 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Layanan Kilat (24 Jam)</h3>
                    <p class="text-gray-600 text-sm">Pakaian Anda siap lebih cepat. Sempurna untuk kebutuhan mendesak.</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-blue-600 text-sm font-semibold">BIAYA TAMBAHAN</p>
                <p class="text-2xl font-bold text-gray-900">+50% <span class="text-sm font-normal text-gray-600">dari total</span></p>
            </div>
        </div>
    </section>

    <!-- Cuci Kiloan Section -->
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900">Cuci Kiloan</h2>
            </div>
            <p class="text-gray-600">Solusi harian untuk pakaian keluarga dengan minimal berat 3 kg.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Reguler Wash -->
            <div class="bg-white rounded-xl p-8 border border-gray-200 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Reguler Wash</h3>
                        <p class="text-gray-600 text-sm mt-1">Selesai dalam 3 hari kerja</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">Rp 8.000 <span class="text-sm text-gray-600 font-normal">/kg</span></p>
                    </div>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm">Deterjen standar premium</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm">Softener tahan lama</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm">Setrika uap higienis</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm">Packing rapi anti lecek</span>
                    </li>
                </ul>

                <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg transition-colors">
                    Pilih Reguler
                </button>
            </div>

            <!-- Premium Care -->
            <div class="bg-white rounded-xl p-8 border-2 border-blue-600 relative hover:shadow-lg transition-shadow">
                <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg rounded-tr-lg">
                    Paling Populer
                </div>
                
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Premium Care</h3>
                        <p class="text-gray-600 text-sm mt-1">Pemisahan warna & perlakuan khusus</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">Rp 12.000 <span class="text-sm text-gray-600 font-normal">/kg</span></p>
                    </div>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Semua fitur Reguler</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Pemisahan warna ketat</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Spot cleaning untuk noda ringan</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Parfum eksklusif LinenFresh</span>
                    </li>
                </ul>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors">
                    Pilih Premium
                </button>
            </div>
        </div>
    </section>

    <!-- Cuci Satuan Section -->
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900">Cuci Satuan</h2>
            </div>
            <p class="text-gray-600">Perawatan detail untuk pakaian kerja, gaun, dan jas dengan teknik dry clean atau wet clean khusus.</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                <!-- Pakaian & Kemeja -->
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Pakaian & Kemeja</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Kemeja Kerja</span>
                            <span class="font-semibold text-gray-900">Rp 20.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Celana Panjang / Jeans</span>
                            <span class="font-semibold text-gray-900">Rp 25.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Blus / Tunik</span>
                            <span class="font-semibold text-gray-900">Rp 22.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Kaos / Polo</span>
                            <span class="font-semibold text-gray-900">Rp 15.000</span>
                        </li>
                    </ul>
                </div>

                <!-- Formal & Outerwear -->
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Formal & Outerwear</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Jas / Blazer (Atasan)</span>
                            <span class="font-semibold text-gray-900">Rp 45.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Setelan Jas (2 pcs)</span>
                            <span class="font-semibold text-gray-900">Rp 70.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Gaun Pesta</span>
                            <span class="font-semibold text-gray-900">Mulai Rp 60.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Jaket Kulit / Bulu</span>
                            <span class="font-semibold text-gray-900">Mulai Rp 80.000</span>
                        </li>
                    </ul>
                </div>

                <!-- Perlengkapan Tidur -->
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Perlengkapan Tidur</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Bedcover (Single)</span>
                            <span class="font-semibold text-gray-900">Rp 35.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Bedcover (Double/King)</span>
                            <span class="font-semibold text-gray-900">Rp 45.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Selimut / Blanket</span>
                            <span class="font-semibold text-gray-900">Rp 30.000</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Sprei Set</span>
                            <span class="font-semibold text-gray-900">Rp 25.000</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Special Treatments Section -->
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900">Special Treatments</h2>
            </div>
            <p class="text-gray-600">Pembersihan mendalam untuk barang-barang khusus yang membutuhkan keahlian ekstra.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Deep Clean Sepatu -->
            <div class="bg-gray-100 rounded-xl overflow-hidden flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?w=400&h=300&fit=crop" 
                         alt="Sepatu putih bersih" 
                         class="w-full h-48 md:h-full object-cover">
                </div>
                <div class="p-6 md:w-2/3 flex flex-col justify-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Deep Clean Sepatu</h3>
                    <p class="text-gray-600 text-sm mb-4">Pembersihan insole, outsole, dan upper material. Menghilangkan noda membandel dan bau tidak sedap.</p>
                    <div>
                        <p class="text-blue-600 text-sm font-semibold">Mulai dari</p>
                        <p class="text-2xl font-bold text-gray-900">Rp 50.000 <span class="text-sm text-gray-600 font-normal">/pasang</span></p>
                    </div>
                </div>
            </div>

            <!-- Pencucian Karpet -->
            <div class="bg-gray-100 rounded-xl overflow-hidden flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    <img src="https://images.unsplash.com/photo-1558317374-067fb5f30001?w=400&h=300&fit=crop" 
                         alt="Pencucian karpet" 
                         class="w-full h-48 md:h-full object-cover">
                </div>
                <div class="p-6 md:w-2/3 flex flex-col justify-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pencucian Karpet</h3>
                    <p class="text-gray-600 text-sm mb-4">Ekstraksi debu tungau, pencucian basah dengan sampo khusus, dan pengeringan optimal anti bau apek.</p>
                    <div>
                        <p class="text-blue-600 text-sm font-semibold">Berdasarkan ukuran</p>
                        <p class="text-2xl font-bold text-gray-900">Rp 15.000 <span class="text-sm text-gray-600 font-normal">/meter persegi</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="bg-gray-100 rounded-2xl p-8 md:p-12">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Pertanyaan Umum</h2>
                <p class="text-gray-600 mt-2">Informasi tambahan mengenai layanan dan harga kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Question 1 -->
                <div class="bg-white rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Apakah ada minimum berat untuk cuci kiloan?</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Ya, minimum transaksi untuk cuci kiloan adalah 3 kg. Jika cucian kurang dari 3 kg, maka akan tetap dihitung senilai harga 3 kg.</p>
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="bg-white rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Apakah ada biaya antar-jemput?</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Gratis antar-jemput untuk radius maksimal 5 km dari outlet terdekat kami dengan minimum transaksi Rp 50.000. Di luar itu dikenakan flat rate Rp 15.000.</p>
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="bg-white rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Berapa lama proses layanan kilat?</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Layanan kilat dijamin selesai dalam 24 jam sejak pakaian kami terima atau diambil oleh kurir kami.</p>
                        </div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="bg-white rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Bagaimana jika pakaian rusak / luntur?</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Kami memiliki SOP ketat. Namun jika terjadi kerusakan akibat proses kami, kami memberikan garansi penggantian maksimal 10x biaya cuci barang tersebut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

{{-- CSS tambahan khusus halaman ini (opsional) --}}
@push('styles')
    <style>
        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
@endpush

{{-- JS tambahan khusus halaman ini (opsional) --}}
@push('scripts')
    <script>
        // Add any page-specific JavaScript here
    </script>
@endpush