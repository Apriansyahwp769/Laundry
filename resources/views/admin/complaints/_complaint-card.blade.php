<div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md transition-shadow cursor-move relative" 
    draggable="true"
     ondragstart="handleDragStart(event, {{ $complaint->id }})" 
     ondragend="handleDragEnd(event)"
     id="complaint-{{ $complaint->id }}"  
     onclick="window.location.href='{{ route('admin.complaints.show', $complaint) }}'">
    {{-- Ticket Number & Priority --}}
    <div class="flex items-center justify-between mb-2">
        <span class="text-sm font-medium text-gray-500">{{ $complaint->ticket_number }}</span>
        
        @php
            $priorityColors = [
                'high' => 'bg-red-100 text-red-700',
                'medium' => 'bg-blue-100 text-blue-700',
                'low' => 'bg-gray-100 text-gray-600',
            ];
            $priorityLabels = [
                'high' => 'High',
                'medium' => 'Medium',
                'low' => 'Low',
            ];
        @endphp
        
        <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $priorityColors[$complaint->priority] ?? 'bg-gray-100 text-gray-600' }}">
            {{ $priorityLabels[$complaint->priority] ?? ucfirst($complaint->priority) }}
        </span>
    </div>

    {{-- Customer Name --}}
    <h4 class="font-bold text-gray-900 mb-1 truncate">{{ $complaint->customer->name }}</h4>
    
    {{-- Description (Truncated) --}}
    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $complaint->description }}</p>

    {{-- Footer: Category Icon & Status --}}
    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
        {{-- Category --}}
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
            <span>
                @switch($complaint->category)
                    @case('luntur') Luntur @break
                    @case('tertukar') Tertukar @break
                    @case('hilang') Hilang @break
                    @case('kualitas') Kualitas @break
                    @case('kerusakan') Kerusakan @break
                    @default Lainnya
                @endswitch
            </span>
        </div>

        {{-- Resolved Checkmark --}}
        @if($complaint->status == 'resolved')
            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        @endif
    </div>

    {{-- Drag Handle Indicator --}}
    <div class="absolute top-2 right-2 text-gray-300 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
        </svg>
    </div>
</div>