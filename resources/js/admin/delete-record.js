function deleteRecord(id, route, message = "This action cannot be undone!") {
    Swal.fire({
        title: 'Are you sure?',
        text: message,
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

window.deleteRecord = deleteRecord; 