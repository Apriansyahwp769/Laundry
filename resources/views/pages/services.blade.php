@extends('layouts.app')

@section('title', 'Services')
@section('meta_description', 'Explore our professional laundry services — by weight, per piece, carpets, and express.')

@section('content')

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div>
                <h1 class="text-4xl lg:text-5xl font-bold text-blue-700 leading-tight">
                    Systematic Trust in Every Wash.
                </h1>
                <p class="text-gray-600 mt-6 text-lg leading-relaxed">
                    Professional laundry services designed for busy urbanites. Effortless hygiene, delivered with clarity and care.
                </p>
                
                <div class="flex flex-wrap gap-4 mt-10">
                    {{-- Tombol Pesan/Pickup - Link ke booking --}}
                    <a href="{{ route('booking.create') }}" 
                       class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-lg font-semibold flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                        Pesan / Pickup Cucian
                    </a>
                    
                    {{-- Tombol Cek Status - Link ke track order --}}
                    <a href="{{ route('track-order') }}" 
                       class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cek Status Cucian
                    </a>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-300 rounded-2xl transform rotate-3"></div>
                <img src="{{ asset('img/towel.png') }}" 
                     alt="Fresh folded towels" 
                     class="relative rounded-2xl shadow-2xl w-full object-cover h-96">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Our Services</h2>
                <p class="text-gray-600 mt-3">Clear pricing, impeccable results.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Cuci Kiloan -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Cuci Kiloan</h3>
                    <p class="text-gray-600 text-sm mb-6">Ideal for daily wear. Washed, dried, and perfectly folded.</p>
                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Starting at</span>
                        <span class="text-blue-700 font-bold">Rp 15.000 / kg</span>
                    </div>
                </div>

                <!-- Cuci Satuan -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Cuci Satuan</h3>
                    <p class="text-gray-600 text-sm mb-6">Premium care for delicate fabrics, suits, and formal wear.</p>
                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Starting at</span>
                        <span class="text-blue-700 font-bold">Rp 25.000 / pc</span>
                    </div>
                </div>

                <!-- Cuci Karpet/Sepatu -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Cuci Karpet/Sepatu</h3>
                    <p class="text-gray-600 text-sm mb-6">Deep cleaning for heavy items and footwear.</p>
                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Starting at</span>
                        <span class="text-blue-700 font-bold">Rp 50.000 / item</span>
                    </div>
                </div>

                <!-- Layanan Kilat -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan Kilat</h3>
                    <p class="text-gray-600 text-sm mb-6">Express 6-hour turnaround for urgent laundry needs.</p>
                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Surcharge</span>
                        <span class="text-blue-700 font-bold">+ Rp 20.000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Support Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="bg-gray-100 rounded-2xl p-8 md:p-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Keluhan Pelanggan</h3>
                        <p class="text-gray-600 mt-1">We value your feedback. Let us know how we can improve our service.</p>
                    </div>
                </div>
                {{-- Tombol Contact Support - Link ke halaman support --}}
                <a href="{{ route('support') }}" 
                   class="bg-white hover:bg-gray-50 text-gray-900 px-8 py-3 rounded-lg font-semibold shadow-sm border border-gray-200 transition-colors whitespace-nowrap inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Contact Support
                </a>
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