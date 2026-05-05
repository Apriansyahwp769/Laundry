@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
<div class="p-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Overview</h1>
            <p class="text-gray-600 mt-1">Today's operational pulse at a glance.</p>
        </div>
        <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="font-semibold">{{ now()->format('M d, Y') }}</span>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Processed --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    +12%
                </span>
            </div>
            <div class="mb-1">
                <span class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_processed_today'], 0) }}</span>
                <span class="text-sm text-gray-500 ml-1">kg</span>
            </div>
            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Total Processed Today</p>
        </div>

        {{-- Orders in Queue --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-cyan-50 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 text-xs font-semibold px-2 py-1 rounded-full">
                    Stable
                </span>
            </div>
            <div class="mb-1">
                <span class="text-3xl font-bold text-gray-900">{{ number_format($stats['orders_in_queue']) }}</span>
            </div>
            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Orders in Queue</p>
        </div>

        {{-- Unhandled Complaints --}}
        <div class="bg-red-50 rounded-xl border border-red-200 p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded-full">
                    Action Required
                </span>
            </div>
            <div class="mb-1">
                <span class="text-3xl font-bold text-red-700">{{ number_format($stats['unhandled_complaints']) }}</span>
            </div>
            <p class="text-xs text-red-600 font-semibold uppercase tracking-wide">Unhandled Complaints</p>
        </div>
    </div>

    {{-- Charts & Alerts Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Weekly Revenue Chart --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Weekly Revenue</h3>
                    <p class="text-sm text-gray-500">Last 7 days performance</p>
                </div>
                <div class="text-2xl font-bold text-blue-600">
                    ${{ number_format($stats['weekly_revenue'], 0) }}
                </div>
            </div>
            
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        {{-- Attention Required --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Attention Required</h3>
                <a href="{{ route('admin.complaints.index') }}" class="text-blue-600 hover:text-blue-700 text-xs font-semibold">
                    VIEW ALL
                </a>
            </div>
            
            <div class="divide-y divide-gray-100">
                @forelse($attentionRequired as $item)
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5">
                                @if($item->priority == 'high')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01" />
                                    </svg>
                                @elseif($item->priority == 'medium')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs font-semibold text-gray-900">{{ $item->order_number }}</span>
                                    <span class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-gray-500">No issues requiring attention</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stats['chart_labels']) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($stats['chart_data']) !!},
                backgroundColor: function(context) {
                    const chart = context.chart;
                    const {ctx, chartArea} = chart;
                    if (!chartArea) return '#3b82f6';
                    
                    const index = context.dataIndex;
                    const maxIndex = chart.data.datasets[0].data.indexOf(Math.max(...chart.data.datasets[0].data));
                    
                    return index === maxIndex ? '#1d4ed8' : '#dbeafe';
                },
                borderRadius: 4,
                borderSkipped: false,
                barThickness: 40,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return '$' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        },
                        font: { size: 11, weight: '500' },
                        color: '#64748b'
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: { size: 11, weight: '500' },
                        color: '#64748b'
                    },
                    border: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush