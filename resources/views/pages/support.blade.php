@extends('layouts.app')

@section('title', 'Bantuan & Dukungan')
@section('meta_description', 'Butuh bantuan terkait pesanan, pembayaran, kualitas layanan, atau akun Anda? Temukan jawaban di FAQ atau hubungi tim support kami.')

@section('content')

    <!-- Header Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Ada yang Bisa Kami Bantu?</h1>
            <p class="text-gray-600 text-lg mb-4">
                Temukan solusi untuk pertanyaan seputar layanan laundry, pembayaran, atau status pesanan Anda.
            </p>
        </div>
    </section>

    <!-- Help Categories -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pesanan & Pelacakan -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Pesanan & Pelacakan</h3>
                <p class="text-gray-600 text-sm">Informasi status penjemputan, proses pencucian, hingga pengantaran pakaian Anda.</p>
            </div>

            <!-- Pembayaran & Harga -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Pembayaran & Harga</h3>
                <p class="text-gray-600 text-sm">Detail tagihan, metode pembayaran yang diterima, dan penjelasan harga paket layanan.</p>
            </div>

            <!-- Kualitas Layanan -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Kualitas Layanan</h3>
                <p class="text-gray-600 text-sm">Standar kebersihan, penanganan noda khusus, dan jaminan kepuasan layanan kami.</p>
            </div>

            <!-- Akun & Privasi -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Akun & Privasi</h3>
                <p class="text-gray-600 text-sm">Pengaturan profil, perubahan alamat, dan kebijakan privasi data pribadi Anda.</p>
            </div>
        </div>
    </section>

    <!-- Service Guarantee Alert -->
    <section class="max-w-5xl mx-auto px-6 mb-16">
        <div class="bg-red-50 border border-red-200 rounded-2xl p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="text-red-800 font-bold text-sm uppercase tracking-wide">Jaminan Layanan</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Mengalami Kendala dengan Pesanan?</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Kami berkomitmen pada Kualitas Sistematis. Jika pakaian Anda kurang bersih, rusak, atau hilang, 
                        segera laporkan melalui portal pengaduan kami agar tim kami dapat menanganinya dengan cepat.
                    </p>
                </div>
                
                {{-- Tombol yang memicu modal --}}
                <div class="flex-shrink-0">
                    <button type="button" id="btnOpenModal"
                            class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-lg font-semibold flex items-center gap-2 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Laporkan Masalah
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="max-w-4xl mx-auto px-6 mb-16">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-10">Pertanyaan yang Sering Diajukan (FAQ)</h2>
        
        <div class="space-y-4">
            <!-- FAQ Item 1 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <button type="button" class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors" onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Berapa lama proses pencucian reguler?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="hidden px-6 pb-4 text-gray-600 text-sm leading-relaxed">
                    Layanan Cuci Lipat Reguler kami membutuhkan waktu 48 jam (2 hari) sejak kurir menjemput pakaian Anda. 
                    Untuk layanan Ekspres, pesanan dapat selesai dalam 24 jam dengan biaya tambahan.
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <button type="button" class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors" onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Apakah pakaian saya dicampur dengan pelanggan lain?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="hidden px-6 pb-4 text-gray-600 text-sm leading-relaxed">
                    Tidak, kami tidak pernah mencampur pakaian dari pelanggan berbeda. Setiap pesanan diproses secara terpisah 
                    dengan penandaan dan penanganan individu untuk memastikan pakaian Anda tetap terpisah sepanjang proses pencucian dan pengeringan.
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <button type="button" class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors" onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Bagaimana sistem penimbangan berat bekerja?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="hidden px-6 pb-4 text-gray-600 text-sm leading-relaxed">
                    Kami menggunakan timbangan digital terkalibrasi untuk menimbang pakaian Anda sebelum dicuci. 
                    Berat dihitung berdasarkan berat kering sebelum pencucian. Untuk pesanan di bawah 3 kg, berlaku minimum charge sebesar 3 kg.
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <button type="button" class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors" onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Bagaimana jika ada pakaian yang rusak atau hilang?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="hidden px-6 pb-4 text-gray-600 text-sm leading-relaxed">
                    Kami memiliki SOP ketat untuk mencegah hal tersebut. Namun jika terjadi kerusakan atau kehilangan akibat proses kami, 
                    kami memberikan garansi penggantian maksimal 10x biaya cuci untuk barang tersebut.
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm inline-flex items-center gap-1">
                Lihat Semua FAQ
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="max-w-7xl mx-auto px-6 mb-16">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-10">Masih Butuh Bantuan? Hubungi Kami</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- WhatsApp -->
            <div class="bg-white rounded-xl p-8 border border-gray-200 hover:shadow-lg transition-shadow text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Chat WhatsApp</h3>
                <p class="text-gray-600 text-sm mb-3">Respon cepat (08:00 - 20:00 WIB)</p>
                <a href="https://wa.me/6281234567890" class="text-green-600 font-semibold text-sm hover:underline">+62 812-3456-7890</a>
            </div>

            <!-- Email Support -->
            <div class="bg-white rounded-xl p-8 border border-gray-200 hover:shadow-lg transition-shadow text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Email Support</h3>
                <p class="text-gray-600 text-sm mb-3">Untuk pertanyaan detail & lampiran foto</p>
                <a href="mailto:support@linenfresh.id" class="text-blue-600 font-semibold text-sm hover:underline">support@linenfresh.id</a>
            </div>

            <!-- Call Center -->
            <div class="bg-white rounded-xl p-8 border border-gray-200 hover:shadow-lg transition-shadow text-center">
                <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Call Center</h3>
                <p class="text-gray-600 text-sm mb-3">Senin - Jumat (09:00 - 17:00 WIB)</p>
                <a href="tel:0218889999" class="text-cyan-600 font-semibold text-sm hover:underline">021-888-9999</a>
            </div>
        </div>
    </section>

    {{-- MODAL: Laporkan Masalah (Vanilla JS Version) --}}
    <div id="modalReport" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all duration-200 scale-95 opacity-0" id="modalContent">
            
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">Laporkan Masalah</h3>
                <button type="button" id="btnCloseModal" class="p-1 hover:bg-gray-200 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-6">
                
                {{-- Success State --}}
                <div id="modalSuccess" class="hidden text-center py-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Laporan Terkirim!</h4>
                    <p class="text-gray-600 text-sm mb-4">Tim kami akan menindaklanjuti laporan Anda secepatnya.</p>
                    <div class="bg-blue-50 rounded-lg px-4 py-3 mb-6 space-y-2">
                        <p class="text-xs text-blue-600 uppercase font-semibold">Nomor Tiket</p>
                        <p class="text-lg font-bold text-blue-800" id="successTicketNumber"></p>
                        
                        {{-- Priority Badge --}}
                        <div class="mt-2 pt-2 border-t border-blue-200 hidden" id="successPriorityContainer">
                            <p class="text-xs text-blue-600 uppercase font-semibold">Prioritas</p>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full mt-1" id="successPriorityBadge"></span>
                        </div>
                    </div>
                    <button type="button" id="btnCloseSuccess" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2.5 rounded-lg transition-colors">
                        Tutup
                    </button>
                </div>

                {{-- Form State --}}
                <form id="complaintForm" class="space-y-4">
                    @csrf
                    
                    {{-- Customer Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                            <input type="text" name="customer_name" value="{{ auth()->check() ? auth()->user()->name : old('customer_name') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp *</label>
                            <input type="text" name="customer_whatsapp" value="{{ auth()->check() ? auth()->user()->phone : old('customer_whatsapp') }}" required placeholder="+62 812..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                    </div>

                    {{-- Order Number (Optional) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pesanan (Opsional)</label>
                        <input type="text" name="order_number" placeholder="LNDRY-0001" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Masalah *</label>
                        <select name="category" id="categorySelect" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            <option value="">Pilih Kategori</option>
                            <option value="luntur">Luntur / Warna Pudar</option>
                            <option value="tertukar">Pakaian Tertukar</option>
                            <option value="hilang">Pakaian Hilang</option>
                            <option value="kualitas">Kualitas Cucian</option>
                            <option value="kerusakan">Kerusakan Pakaian</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        
                        {{-- Priority Hint (Read-Only) --}}
                        <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Prioritas ditentukan otomatis berdasarkan kategori yang dipilih</span>
                        </p>
                        <p id="priorityHint" class="text-xs font-medium mt-1 hidden">
                            <span class="px-2 py-0.5 rounded-full" id="priorityBadge"></span>
                        </p>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Masalah *</label>
                        <textarea name="description" rows="4" required placeholder="Jelaskan masalah yang Anda alami secara detail..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"></textarea>
                    </div>

                    {{-- Error Message --}}
                    <div id="formError" class="bg-red-50 text-red-700 text-sm px-4 py-3 rounded-lg hidden"></div>

                    {{-- Submit Button --}}
                    <button type="submit" id="btnSubmit" class="w-full bg-red-700 hover:bg-red-800 disabled:bg-red-400 text-white font-semibold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg id="spinner" class="animate-spin h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span id="btnText">Kirim Laporan</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // FAQ Toggle
    function toggleFaq(button) {
        const content = button.nextElementSibling;
        const arrow = button.querySelector('svg');
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    // Priority mapping
    const priorityMap = {
        'hilang': { label: 'High', class: 'bg-red-100 text-red-700', emoji: '🔴' },
        'kerusakan': { label: 'High', class: 'bg-red-100 text-red-700', emoji: '🔴' },
        'tertukar': { label: 'Medium', class: 'bg-yellow-100 text-yellow-700', emoji: '🟡' },
        'kualitas': { label: 'Medium', class: 'bg-yellow-100 text-yellow-700', emoji: '🟡' },
        'luntur': { label: 'Medium', class: 'bg-yellow-100 text-yellow-700', emoji: '🟡' },
        'lainnya': { label: 'Low', class: 'bg-gray-100 text-gray-700', emoji: '⚪' },
    };

    // Show priority hint
    function updatePriorityHint() {
        const category = document.getElementById('categorySelect').value;
        const hint = document.getElementById('priorityHint');
        const badge = document.getElementById('priorityBadge');
        if (category && priorityMap[category]) {
            const p = priorityMap[category];
            badge.textContent = `${p.emoji} Prioritas: ${p.label}`;
            badge.className = `px-2.5 py-1 text-xs font-semibold rounded-full ${p.class}`;
            hint.classList.remove('hidden');
        } else {
            hint.classList.add('hidden');
        }
    }

    // Modal functions
    const modal = document.getElementById('modalReport');
    const modalContent = document.getElementById('modalContent');
    const btnOpen = document.getElementById('btnOpenModal');
    const btnClose = document.getElementById('btnCloseModal');
    const btnCloseSuccess = document.getElementById('btnCloseSuccess');
    const form = document.getElementById('complaintForm');
    const formState = form;
    const successState = document.getElementById('modalSuccess');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnText = document.getElementById('btnText');
    const spinner = document.getElementById('spinner');
    const formError = document.getElementById('formError');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            resetModal();
        }, 200);
        document.body.style.overflow = '';
    }

    function resetModal() {
        formState.classList.remove('hidden');
        successState.classList.add('hidden');
        form.reset();
        document.getElementById('priorityHint').classList.add('hidden');
        formError.classList.add('hidden');
        btnSubmit.disabled = false;
        btnText.textContent = 'Kirim Laporan';
        spinner.classList.add('hidden');
    }

    function showSuccess(ticketNumber, priority) {
        formState.classList.add('hidden');
        successState.classList.remove('hidden');
        document.getElementById('successTicketNumber').textContent = ticketNumber;
        
        const priorityContainer = document.getElementById('successPriorityContainer');
        const priorityBadge = document.getElementById('successPriorityBadge');
        if (priority && priorityMap[priority]) {
            const p = priorityMap[priority];
            priorityBadge.textContent = `${p.emoji} ${p.label}`;
            priorityBadge.className = `inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full mt-1 ${p.class}`;
            priorityContainer.classList.remove('hidden');
        } else {
            priorityContainer.classList.add('hidden');
        }
    }

    // Event Listeners
    if (btnOpen) btnOpen.addEventListener('click', openModal);
    if (btnClose) btnClose.addEventListener('click', closeModal);
    if (btnCloseSuccess) btnCloseSuccess.addEventListener('click', closeModal);
    
    modal?.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal?.classList.contains('hidden')) closeModal();
    });

    document.getElementById('categorySelect')?.addEventListener('change', updatePriorityHint);

    // Form submission
    form?.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        btnSubmit.disabled = true;
        btnText.textContent = 'Mengirim...';
        spinner.classList.remove('hidden');
        formError.classList.add('hidden');

        try {
            const formData = new FormData(form);
            const response = await fetch("{{ route('complaints.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                showSuccess(result.ticket_number, result.priority);
            } else {
                formError.textContent = result.message || 'Terjadi kesalahan. Silakan coba lagi.';
                formError.classList.remove('hidden');
            }
        } catch (error) {
            formError.textContent = 'Koneksi error. Periksa koneksi internet Anda.';
            formError.classList.remove('hidden');
            console.error('Error:', error);
        } finally {
            btnSubmit.disabled = false;
            btnText.textContent = 'Kirim Laporan';
            spinner.classList.add('hidden');
        }
    });
</script>
@endpush