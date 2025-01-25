function toggleStatus(id, currentStatus, route) {
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
            axios.post(`${route}/${id}/toggle-status`, {
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

window.toggleStatus = toggleStatus; 