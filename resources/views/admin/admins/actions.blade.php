@php
    $editUrl = route('admin.admins.edit', $row->id);
    $isActive = $row->status;
@endphp

<div class="flex items-center justify-center space-x-2">
    {{-- Edit Button --}}
    <a href="{{ $editUrl }}" class="action-btn action-btn-edit" title="Edit Admin">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        <span class="sr-only">Edit</span>
    </a>

    {{-- Toggle Status Button --}}
    <button onclick="toggleStatus({{ $row->id }}, {{ $isActive }})" 
            class="action-btn action-btn-status"
            title="{{ $isActive ? 'Deactivate' : 'Activate' }} Admin">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="{{ $isActive 
                    ? 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' 
                    : 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
        </svg>
        <span class="sr-only">{{ $isActive ? 'Deactivate' : 'Activate' }}</span>
    </button>

    {{-- Delete Button --}}
    <button onclick="deleteAdmin({{ $row->id }})" 
            class="action-btn action-btn-delete"
            title="Delete Admin">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        <span class="sr-only">Delete</span>
    </button>
</div>

@push('scripts')
<script>
    function toggleStatus(adminId, isActive) {
        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to ${isActive ? 'deactivate' : 'activate'} this admin?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                axios.patch(`/admin/admins/${adminId}/toggle-status`, {}, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    Swal.fire('Success!', response.data.message, 'success');
                    if (window.LaravelDataTables && window.LaravelDataTables['admins-table']) {
                        window.LaravelDataTables['admins-table'].ajax.reload(null, false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', error.response?.data?.message || 'Something went wrong!', 'error');
                });
            }
        });
    }

    function deleteAdmin(adminId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/admin/admins/${adminId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    Swal.fire('Deleted!', response.data.message, 'success');
                    if (window.LaravelDataTables && window.LaravelDataTables['admins-table']) {
                        window.LaravelDataTables['admins-table'].ajax.reload(null, false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', error.response?.data?.message || 'Something went wrong!', 'error');
                });
            }
        });
    }
</script>
@endpush