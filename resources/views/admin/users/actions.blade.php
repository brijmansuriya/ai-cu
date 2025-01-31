@php
    $editUrl = route('admin.users.edit', $row->id);
@endphp

<div class="flex items-center justify-center space-x-2">
    {{-- Edit Button --}}
    <a href="{{ $editUrl }}" 
       class="inline-flex items-center px-3 py-2 rounded-lg text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors duration-150 relative group">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        <span class="text-sm font-medium">Edit</span>
    </a>

    {{-- Toggle Status Button --}}
    <button type="button"
            onclick="toggleStatus({{ $row->id }}, {{ $row->status ? 'true' : 'false' }}, '/admin/users')" 
            class="inline-flex items-center px-3 py-2 rounded-lg transition-colors duration-150
                   {{ $row->status 
                      ? 'text-red-700 bg-red-100 hover:bg-red-200' 
                      : 'text-green-700 bg-green-100 hover:bg-green-200' }}">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="{{ $row->status 
                      ? 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' 
                      : 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
        </svg>
        <span class="text-sm font-medium">{{ $row->status ? 'Deactivate' : 'Activate' }}</span>
    </button>

    {{-- Delete Button --}}
    <button type="button"
            onclick="deleteRecord({{ $row->id }}, '/admin/users', 'Are you sure you want to delete this user?')" 
            class="inline-flex items-center px-3 py-2 rounded-lg text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-150">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        <span class="text-sm font-medium">Delete</span>
    </button>
</div>

@push('scripts')
<script>
function toggleStatus(userId, currentStatus, route) {
    const action = currentStatus ? 'deactivate' : 'activate';
    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to ${action} this record?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: currentStatus ? '#dc3545' : '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: `Yes, ${action} it!`,
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(`${route}/${userId}/toggle-status`, {
                status: !currentStatus
            })
            .then(response => {
                if (response.data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data.message,
                        icon: 'success',
                        timer: 1500
                    });
                    // Refresh the DataTable
                    $('.dataTable').DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire('Error!', response.data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Something went wrong!', 'error');
            });
        }
    });
}

function deleteRecord(id, route, customMessage) {
    Swal.fire({
        title: 'Are you sure?',
        text: customMessage,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`${route}/${id}`)
            .then(response => {
                if (response.data.success) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: response.data.message,
                        icon: 'success',
                        timer: 1500
                    });
                    // Refresh the DataTable
                    $('.dataTable').DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire('Error!', response.data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Something went wrong!', 'error');
            });
        }
    });
}
</script>
@endpush
