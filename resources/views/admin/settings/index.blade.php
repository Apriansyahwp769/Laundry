@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="h-screen flex flex-col bg-gray-50 overflow-hidden">
    {{-- Header --}}
    <div class="bg-white border-b border-gray-200 px-6 py-4 flex-shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
            <p class="text-sm text-gray-600 mt-1">Manage system configurations and operational parameters.</p>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-4xl mx-auto">
            
            {{-- Tabs --}}
            <div class="bg-white border border-gray-200 rounded-t-xl">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button class="px-6 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition-colors">
                            General
                        </button>
                        <button class="px-6 py-3 text-sm font-medium text-blue-600 border-b-2 border-blue-600 transition-colors">
                            Pricing Management
                        </button>
                        <button class="px-6 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition-colors">
                            Staff
                        </button>
                        <button class="px-6 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition-colors">
                            Business Info
                        </button>
                    </nav>
                </div>
            </div>

            {{-- Content Area --}}
            <div class="bg-white border border-t-0 border-gray-200 rounded-b-xl p-6">
                
                {{-- Service Pricing Section --}}
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-1">Service Pricing</h2>
                    <p class="text-sm text-gray-600 mb-6">Update base rates for core laundry services.</p>

                    <form action="{{ route('admin.settings.updatePricing') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        @foreach($services as $service)
                            <div class="border border-gray-200 rounded-xl p-4 flex items-center gap-4 hover:border-blue-300 transition-colors">
                                {{-- Icon --}}
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0
                                    @if($service->slug === 'cuci-kiloan') bg-blue-100
                                    @elseif($service->slug === 'cuci-satuan') bg-cyan-100
                                    @else bg-green-100 @endif">
                                    @if($service->slug === 'cuci-kiloan')
                                        {{-- Scale Icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                        </svg>
                                    @elseif($service->slug === 'cuci-satuan')
                                        {{-- Hanger Icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @else
                                        {{-- Lightning Icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @endif
                                </div>

                                {{-- Service Info --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-900">{{ $service->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $service->description }}</p>
                                </div>

                                {{-- Price Input --}}
                                <div class="flex items-center gap-2">
                                    @if($service->slug !== 'layanan-kilat')
                                        <span class="text-sm text-gray-600">Rp</span>
                                    @else
                                        <span class="text-sm text-gray-600">+ Rp</span>
                                    @endif
                                    
                                    <input type="number" 
                                           name="services[{{ $service->id }}][base_price]"
                                           value="{{ old('services.' . $service->id . '.base_price', $service->base_price) }}"
                                           class="w-28 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           min="0"
                                           step="100">
                                    
                                    <span class="text-sm text-gray-600">
                                        @if($service->slug === 'cuci-kiloan')
                                            / kg
                                        @elseif($service->slug === 'cuci-satuan')
                                            / pc
                                        @else
                                            / order
                                        @endif
                                    </span>
                                </div>

                                {{-- Hidden ID --}}
                                <input type="hidden" name="services[{{ $service->id }}][id]" value="{{ $service->id }}">
                            </div>
                        @endforeach
                    </form>
                </div>

                {{-- Save Button --}}
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" form="pricingForm" 
                            class="px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold rounded-lg transition-colors">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add form ID to the first form
    document.querySelector('form').id = 'pricingForm';
</script>
@endsection