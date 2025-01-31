<div class="form-check form-switch">
    <form action="{{ route('admin.admins.toggle-status', $row->id) }}" method="POST" class="status-form">
        @csrf
        @method('PATCH')
        <input type="checkbox" class="form-check-input" 
               onchange="this.form.submit()" 
               {{ $row->status ? 'checked' : '' }}>
    </form>
</div>
