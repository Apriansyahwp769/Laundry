@extends('layouts.guest')

@section('title', 'Admin Console - Sign In')

@section('content')
<div class="h-screen flex overflow-hidden">
    {{-- Left Side - Image --}}
    <div class="hidden lg:flex lg:w-1/2 relative">
        <img
            src="{{ asset('img/login.png') }}"
            alt="Laundry Facility"
            class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 to-blue-800/10"></div>

    </div>

    {{-- Right Side - Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6">
        <div class="w-full max-w-md py-8">
            {{-- Logo Section --}}
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 rounded-2xl mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 mb-1">LinenFresh</h1>
                <h2 class="text-2xl font-semibold text-gray-900 mb-1">Admin Console</h2>
                <p class="text-gray-600 text-sm">Sign in to manage operations and staff workflows.</p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                {{-- Error Messages --}}
                @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-600 text-sm rounded-lg px-4 py-3 mb-4">
                    {{ $errors->first() }}
                </div>
                @endif

                {{-- Session Status --}}
                @if (session('status'))
                <div class="bg-green-50 border border-green-100 text-green-600 text-sm rounded-lg px-4 py-3 mb-4">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Username or Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Username or Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="admin@linenfresh.com"
                                class="w-full pl-10 pr-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-colors duration-150 outline-none">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-colors duration-150 outline-none">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-150 flex items-center justify-center gap-2">
                        Sign In
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                    {{-- Register Link --}}
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun admin?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-gray-500 mt-4">
                &copy; 2024 LinenFresh. Systematic Trust in Every Wash.
            </p>
        </div>
    </div>
</div>
@endsection