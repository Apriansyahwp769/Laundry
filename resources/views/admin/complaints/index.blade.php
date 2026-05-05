@extends('layouts.admin')

@section('title', 'Board Komplain')

@section('content')
<div class="h-screen flex flex-col bg-gray-50">
    {{-- Header --}}
    <div class="bg-white border-b border-gray-200 px-6 py-4 flex-shrink-0">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Board Komplain</h1>
                <p class="text-sm text-gray-600 mt-1">Drag & drop complaints to update their status.</p>
            </div>
            
            <div class="flex items-center gap-3">
                {{-- Search --}}
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" 
                           placeholder="Search ticket ID or name..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent w-64">
                </div>
                
                {{-- New Complaint Button --}}
                <a href="{{ route('admin.complaints.create') }}" 
                   class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Complaint
                </a>
            </div>
        </div>
    </div>

    {{-- Kanban Board --}}
    <div class="flex-1 overflow-x-auto overflow-y-hidden">
        <div class="h-full p-6">
            <div class="flex gap-6 h-full">
                
                {{-- Column 1: LAPORAN MASUK (New) --}}
                <div class="flex-shrink-0 w-80 flex flex-col bg-gray-100 rounded-xl" 
                     data-status="new"
                     ondragover="handleDragOver(event)"
                     ondragleave="handleDragLeave(event)"
                     ondrop="handleDrop(event, 'new')">
                    <div class="p-4 flex items-center justify-between flex-shrink-0">
                        <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide">Laporan Masuk</h3>
                        <span class="bg-gray-200 text-gray-700 text-xs font-bold px-2 py-1 rounded-full count-badge">
                            {{ $kanban['new']->count() }}
                        </span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto p-4 space-y-3 min-h-[200px]" id="column-new">
                        @forelse($kanban['new'] as $complaint)
                            @include('admin.complaints._complaint-card', ['complaint' => $complaint, 'statusColor' => 'gray'])
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm border-2 border-dashed border-gray-300 rounded-lg">
                                Tarik komplain ke sini
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Column 2: INVESTIGASI (Investigating) --}}
                <div class="flex-shrink-0 w-80 flex flex-col bg-blue-50 rounded-xl border-2 border-blue-200"
                     data-status="investigating"
                     ondragover="handleDragOver(event)"
                     ondragleave="handleDragLeave(event)"
                     ondrop="handleDrop(event, 'investigating')">
                    <div class="p-4 flex items-center justify-between flex-shrink-0">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide">Investigasi</h3>
                        </div>
                        <span class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full count-badge">
                            {{ $kanban['investigating']->count() }}
                        </span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto p-4 space-y-3 min-h-[200px]" id="column-investigating">
                        @forelse($kanban['investigating'] as $complaint)
                            @include('admin.complaints._complaint-card', ['complaint' => $complaint, 'statusColor' => 'blue'])
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm border-2 border-dashed border-blue-300 rounded-lg">
                                Tarik komplain ke sini
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Column 3: SELESAI (Resolved) --}}
                <div class="flex-shrink-0 w-80 flex flex-col bg-green-50 rounded-xl border-2 border-green-200"
                     data-status="resolved"
                     ondragover="handleDragOver(event)"
                     ondragleave="handleDragLeave(event)"
                     ondrop="handleDrop(event, 'resolved')">
                    <div class="p-4 flex items-center justify-between flex-shrink-0">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide">Selesai</h3>
                        </div>
                        <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full count-badge">
                            {{ $kanban['resolved']->count() }}
                        </span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto p-4 space-y-3 min-h-[200px]" id="column-resolved">
                        @forelse($kanban['resolved'] as $complaint)
                            @include('admin.complaints._complaint-card', ['complaint' => $complaint, 'statusColor' => 'green'])
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm border-2 border-dashed border-green-300 rounded-lg">
                                Tarik komplain ke sini
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Toast Notification Container --}}
<div id="toast-container" class="fixed bottom-6 right-6 z-50 space-y-2"></div>

{{-- ✅ MODAL KONFIRMASI DRAG & DROP --}}
<div id="confirmModal" class="fixed inset-0 z-[200] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" aria-hidden="true" id="modalBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900" id="modal-title">Konfirmasi Perubahan Status</h3>
                    <button type="button" id="modalCloseBtn" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Anda akan memindahkan komplain:</p>
                            <p class="text-base font-bold text-gray-900 mb-3" id="confirmTicketNumber">TKT-XXX</p>
                            <div class="flex items-center gap-2 text-sm bg-gray-50 rounded-lg p-3 border border-gray-200">
                                <span class="text-gray-500">Dari:</span>
                                <span class="font-semibold px-2 py-1 rounded bg-gray-200 text-gray-700" id="confirmFromStatus">New</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                                <span class="text-gray-500">Ke:</span>
                                <span class="font-semibold px-2 py-1 rounded bg-blue-100 text-blue-700" id="confirmToStatus">Investigating</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex flex-row-reverse gap-3">
                    <button type="button" id="modalConfirmBtn" class="inline-flex w-full justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition-colors sm:w-auto">
                        Ya, Pindahkan
                    </button>
                    <button type="button" id="modalCancelBtn" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // State Management
    let draggedComplaintId = null;
    let pendingDropData = null;

    // --- Drag Events ---
    function handleDragStart(e, complaintId) {
        draggedComplaintId = complaintId;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', complaintId);
        const card = document.getElementById(`complaint-${complaintId}`);
        card?.classList.add('opacity-50', 'scale-95', 'cursor-grabbing');
    }

    function handleDragEnd(e) {
        const card = document.getElementById(`complaint-${draggedComplaintId}`);
        card?.classList.remove('opacity-50', 'scale-95', 'cursor-grabbing');
        draggedComplaintId = null;
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        e.currentTarget.classList.add('ring-2', 'ring-blue-400', 'ring-inset', 'bg-opacity-70');
    }

    function handleDragLeave(e) {
        e.currentTarget.classList.remove('ring-2', 'ring-blue-400', 'ring-inset', 'bg-opacity-70');
    }

    // --- Drop: Show Confirmation Modal ---
    function handleDrop(e, newStatus) {
        e.preventDefault();
        const column = e.currentTarget;
        column.classList.remove('ring-2', 'ring-blue-400', 'ring-inset', 'bg-opacity-70');

        if (!draggedComplaintId) return;
        const complaintId = draggedComplaintId;
        const card = document.getElementById(`complaint-${complaintId}`);
        if (!card) return;

        const oldColumn = card.closest('[data-status]');
        const oldStatus = oldColumn?.dataset.status || 'new';

        pendingDropData = {
            complaintId,
            oldStatus,
            newStatus,
            cardElement: card,
            targetColumnId: `column-${newStatus}`
        };

        showConfirmModal(complaintId, oldStatus, newStatus);
    }

    // --- Modal Functions ---
    function showConfirmModal(complaintId, fromStatus, toStatus) {
        document.getElementById('confirmTicketNumber').textContent = complaintId;
        const format = (s) => s.charAt(0).toUpperCase() + s.slice(1);
        document.getElementById('confirmFromStatus').textContent = format(fromStatus);
        document.getElementById('confirmToStatus').textContent = format(toStatus);
        
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('hidden');
    }

    function hideConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        pendingDropData = null;
    }

    // --- CORE: Process Confirmed Drop (AJAX Save + UI Update) ---
    async function processConfirmedDrop() {
        if (!pendingDropData) return;
        
        const { complaintId, oldStatus, newStatus, cardElement, targetColumnId } = pendingDropData;

        try {
            const response = await fetch(`/admin/complaints/${complaintId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            });

            const result = await response.json();

            if (!response.ok) throw new Error(result.message || 'Server error');

            // ✅ SUCCESS: Update UI
            const targetColumn = document.getElementById(targetColumnId);
            if (targetColumn && cardElement) {
                const emptyMsg = targetColumn.querySelector('.border-dashed');
                if (emptyMsg) emptyMsg.remove();
                targetColumn.appendChild(cardElement);
            }

            // Update status badge color
            const badge = cardElement.querySelector('span[class*="bg-"][class*="rounded-full"]');
            if (badge) {
                const colors = { 'new':'bg-gray-100 text-gray-700','investigating':'bg-blue-100 text-blue-700','resolved':'bg-green-100 text-green-700' };
                const labels = { 'new':'New','investigating':'Investigating','resolved':'Resolved' };
                badge.textContent = labels[newStatus] || newStatus;
                badge.className = `text-xs font-semibold px-2 py-0.5 rounded-full ${colors[newStatus] || 'bg-gray-100 text-gray-700'}`;
            }

            // Update checkmark for resolved
            const checkmark = cardElement.querySelector('[class*="bg-green-500"]');
            if (newStatus === 'resolved' && !checkmark) {
                const footer = cardElement.querySelector('.border-t');
                if (footer) {
                    const check = document.createElement('div');
                    check.className = 'w-6 h-6 bg-green-500 rounded-full flex items-center justify-center';
                    check.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';
                    footer.appendChild(check);
                }
            } else if (newStatus !== 'resolved' && checkmark) {
                checkmark.remove();
            }

            // Update counter badges
            updateColumnCount(oldStatus);
            updateColumnCount(newStatus);

            showToast(`✅ Komplain #${complaintId} diperbarui ke "${newStatus}"`, 'success');

        } catch (error) {
            console.error('Error:', error);
            showToast(`❌ Gagal: ${error.message}. Silakan coba lagi.`, 'error');
        } finally {
            hideConfirmModal();
        }
    }

    function cancelDrop() {
        showToast('⚠️ Perubahan dibatalkan', 'error');
        hideConfirmModal();
    }

    function updateColumnCount(status) {
        const column = document.querySelector(`[data-status="${status}"]`);
        if (!column) return;
        const badge = column.querySelector('.count-badge');
        const cards = column.querySelectorAll('[id^="complaint-"]');
        if (badge) badge.textContent = cards.length;
        
        const emptyMsg = column.querySelector('.border-dashed');
        if (cards.length === 0 && !emptyMsg) {
            const placeholder = document.createElement('div');
            placeholder.className = 'text-center py-8 text-gray-400 text-sm border-2 border-dashed border-gray-300 rounded-lg';
            placeholder.textContent = 'Tarik komplain ke sini';
            column.appendChild(placeholder);
        } else if (cards.length > 0 && emptyMsg) {
            emptyMsg.remove();
        }
    }

    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        const colors = type === 'success' ? 'bg-green-600' : 'bg-red-600';
        toast.className = `${colors} text-white px-5 py-3 rounded-lg shadow-lg font-medium transform transition-all duration-300 translate-y-4 opacity-0`;
        toast.textContent = message;
        container.appendChild(toast);
        requestAnimationFrame(() => toast.classList.remove('translate-y-4', 'opacity-0'));
        setTimeout(() => {
            toast.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // --- Event Listeners ---
    document.getElementById('modalConfirmBtn')?.addEventListener('click', processConfirmedDrop);
    document.getElementById('modalCancelBtn')?.addEventListener('click', cancelDrop);
    document.getElementById('modalCloseBtn')?.addEventListener('click', cancelDrop);
    document.getElementById('modalBackdrop')?.addEventListener('click', cancelDrop);
    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !document.getElementById('confirmModal').classList.contains('hidden')) {
            cancelDrop();
        }
    });
</script>
@endpush
@endsection