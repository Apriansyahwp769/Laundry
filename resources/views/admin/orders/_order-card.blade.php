<div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md transition-shadow cursor-move relative" 
     draggable="true"
     ondragstart="handleDragStart(event, {{ $order->id }})"
     ondragend="handleDragEnd(event)"
     id="order-{{ $order->id }}"
     onclick="window.location.href='{{ route('admin.orders.show', $order) }}'">
    
    {{-- Order Number & Status Badge --}}
    <div class="flex items-center justify-between mb-2">
        <span class="text-xs font-semibold text-gray-500">{{ $order->order_number }}</span>
        
        @if(isset($statusColor))
            @php
                $statusLabels = [
                    'waiting' => 'Waiting',
                    'washing' => 'Washing',
                    'ironing' => 'Ironing',
                    'ready' => 'Ready',
                ];
                $statusColors = [
                    'gray' => 'bg-gray-100 text-gray-700',
                    'blue' => 'bg-blue-100 text-blue-700',
                    'indigo' => 'bg-indigo-100 text-indigo-700',
                    'green' => 'bg-green-100 text-green-700',
                ];
            @endphp
            <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $statusColors[$statusColor] ?? 'bg-gray-100 text-gray-700' }}">
                {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
            </span>
        @endif
    </div>

    {{-- Customer Name --}}
    <h4 class="font-bold text-gray-900 mb-1 truncate">{{ $order->customer->name }}</h4>
    
    {{-- Service Info --}}
    <p class="text-sm text-gray-600 mb-2 truncate">
        {{ $order->service->name }} • {{ $order->total_weight }} {{ $order->service->unit }}
    </p>

    {{-- Progress Bar (for washing) --}}
    @if(isset($showProgress) && $showProgress)
        <div class="mt-3">
            <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                <span>Progress</span>
                <span class="font-semibold text-blue-600">{{ $order->progress_percentage }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5">
                <div class="bg-blue-500 h-1.5 rounded-full transition-all duration-300" 
                     style="width: {{ $order->progress_percentage }}%"></div>
            </div>
        </div>
    @endif

    {{-- Assigned Staff (for ironing) --}}
    @if(isset($showAssigned) && $showAssigned && $order->assignedStaff)
        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-xs text-gray-600 truncate">Assigned: {{ $order->assignedStaff->name }}</span>
        </div>
    @endif

    {{-- Price & Notify (for ready) --}}
    @if(isset($showPrice) && $showPrice)
        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
            <span class="font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            <button class="text-xs text-blue-600 hover:text-blue-700 font-medium" onclick="event.stopPropagation()">
                Notify
            </button>
        </div>
    @endif

    {{-- Due Time (for waiting) --}}
    @if($order->status === 'waiting')
        <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Due: {{ \Carbon\Carbon::parse($order->estimated_completion)->format('H:i') }}</span>
        </div>
    @endif

    {{-- Drag Handle Indicator --}}
    <div class="absolute top-2 right-2 text-gray-300 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
        </svg>
    </div>
</div>