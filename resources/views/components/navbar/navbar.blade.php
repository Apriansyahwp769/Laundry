<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between gap-8">

        {{-- Brand / Logo --}}
        <a href="{{ route('home') }}" class="text-blue-600 font-bold text-xl tracking-tight shrink-0">
            LinenFresh
        </a>

        {{-- Navigation Links (Center) --}}
        <ul class="hidden md:flex items-center gap-1 flex-1 justify-center list-none m-0 p-0">
            @php
                $navLinks = [
                    ['label' => 'Services',     'route' => 'services'],
                    ['label' => 'Pricing',       'route' => 'pricing'],
                    ['label' => 'Track Order',   'route' => 'track-order'],
                    ['label' => 'Support',       'route' => 'support'],
                ];
            @endphp

            @foreach ($navLinks as $link)
                <li>
                    <a href="{{ route($link['route']) }}"
                       class="text-sm font-medium px-3 py-1.5 rounded-md transition-colors duration-150
                              {{ request()->routeIs($link['route'])
                                  ? 'text-blue-600 font-semibold'
                                  : 'text-gray-500 hover:text-blue-600' }}">
                        {{ $link['label'] }}

                        {{-- Active underline --}}
                        @if (request()->routeIs($link['route']))
                            <span class="block h-0.5 bg-blue-600 rounded mt-0.5 -mb-[22px]"></span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Auth Actions (Right) --}}
        <div class="hidden md:flex items-center gap-3 shrink-0">
            
            {{-- Guest State --}}
            @guest
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors px-3 py-2">
                    Sign In
                </a>
                <a href="{{ route('booking.create') }}"
                   class="text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-95 px-5 py-2.5 rounded-lg transition-all duration-150">
                    Book Now
                </a>
            @endguest

            {{-- Auth State: Profile Dropdown --}}
            @auth
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    
                    {{-- Profile Trigger Button --}}
                    <button @click="open = !open"
                            class="flex items-center gap-2 p-1.5 rounded-full hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        
                        {{-- Avatar Initial --}}
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-semibold text-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        
                        {{-- Dropdown Arrow --}}
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="h-4 w-4 text-gray-500 transition-transform duration-150"
                             :class="{'rotate-180': open}"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-1.5 z-50"
                         style="display: none;">
                        
                        {{-- User Info Header --}}
                        <div class="px-3 py-2 border-b border-gray-100">
                            <p class="text-xs font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        {{-- Menu Items --}}
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </a>
                        
                        <a href="{{ route('orders.my') }}" 
                           class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Riwayat Order
                        </a>

                        {{-- Divider --}}
                        <div class="my-1 border-t border-gray-100"></div>

                        {{-- Logout --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Book Now Button (for logged in users) --}}
                <a href="{{ route('booking.create') }}"
                   class="text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-95 px-5 py-2.5 rounded-lg transition-all duration-150">
                    Book Now
                </a>
            @endauth
        </div>

        {{-- Mobile Hamburger --}}
        <button id="navToggle"
                aria-label="Toggle menu"
                class="md:hidden flex flex-col justify-center gap-[5px] p-1 bg-transparent border-none cursor-pointer">
            <span class="block w-[22px] h-0.5 bg-gray-600 rounded transition-all duration-300"></span>
            <span class="block w-[22px] h-0.5 bg-gray-600 rounded transition-all duration-300"></span>
            <span class="block w-[22px] h-0.5 bg-gray-600 rounded transition-all duration-300"></span>
        </button>

    </div>

    {{-- Mobile Dropdown Menu --}}
    <div id="mobileMenu"
         class="hidden border-t border-gray-100 bg-white px-6 pb-6 pt-4 flex-col gap-4">
        
        {{-- Navigation Links --}}
        <ul class="list-none m-0 p-0 flex flex-col">
            <li><a href="{{ route('services') }}"    class="block text-sm font-medium text-gray-700 py-3 border-b border-gray-100 hover:text-blue-600 transition-colors">Services</a></li>
            <li><a href="{{ route('pricing') }}"     class="block text-sm font-medium text-gray-700 py-3 border-b border-gray-100 hover:text-blue-600 transition-colors">Pricing</a></li>
            <li><a href="{{ route('track-order') }}" class="block text-sm font-medium text-gray-700 py-3 border-b border-gray-100 hover:text-blue-600 transition-colors">Track Order</a></li>
            <li><a href="{{ route('support') }}"     class="block text-sm font-medium text-gray-700 py-3 hover:text-blue-600 transition-colors">Support</a></li>
        </ul>

        {{-- Auth Section for Mobile --}}
        <div class="flex flex-col gap-3 mt-2 pt-4 border-t border-gray-100">
            @auth
                {{-- User Info --}}
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-semibold text-xs">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                {{-- Mobile Menu Items --}}
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-sm text-gray-700 py-2 hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>
                <a href="{{ route('orders.my') }}" class="flex items-center gap-2 text-sm text-gray-700 py-2 hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Riwayat Order
                </a>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-sm text-red-600 py-2 hover:text-red-700 text-left w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>

                <a href="{{ route('booking.create') }}"
                   class="text-center text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-lg transition-colors mt-1">
                    Book Now
                </a>
            @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}"
                       class="flex-1 text-center text-sm font-medium text-gray-600 hover:text-blue-600 py-2.5 border border-gray-300 rounded-lg transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('booking.create') }}"
                       class="flex-1 text-center text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-lg transition-colors">
                        Book Now
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- Alpine.js for dropdown (if not already loaded) --}}
@push('scripts')
<script>
    // Only load Alpine if not already present
    if (typeof Alpine === 'undefined') {
        document.write('<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer><\/script>');
    }
</script>
@endpush