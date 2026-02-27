@extends('layouts.admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box;">
    
    <div class="page-header">
        <h1>🗑️ Trash Bin</h1>
        <div class="header-actions">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">← Back to Active Inventory</a>
            @if($trashedProducts->count() > 0)
                <button id="bulk-restore-btn" class="btn btn-primary">♻️ Restore Selected</button>
                <button id="bulk-force-delete-btn" class="btn btn-danger">🗑️ Delete Selected Forever</button>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="alert-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all-checkbox" style="width: 18px; height: 18px; cursor: pointer;"></th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Deleted On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trashedProducts as $product)
                    <tr>
                        <td style="vertical-align: middle;">
                            <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-checkbox" style="width: 18px; height: 18px; cursor: pointer;">
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="img-thumbnail" style="opacity: 0.5;">
                                @if($product->productImages && $product->productImages->count() > 0)
                                    <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="{{ $product->translated_name }}" style="width: 100%; height: 100%; border-radius: 8px; object-fit: cover;">
                                @else
                                    📦
                                @endif
                            </div>
                        </td>
                        <td style="vertical-align: middle;"><strong>{{ $product->translated_name }}</strong></td>
                        <td style="vertical-align: middle;">{{ $product->category ? $product->category->name : 'No Category' }}</td>
                        <td style="vertical-align: middle;">
                            <strong>${{ number_format($product->price, 2) }}</strong>
                            <span style="font-size: 12px; color: #64748b; font-weight: normal; margin-left: 2px;">
                                / {{ $product->unit ?? 'piece' }}
                            </span>
                        </td>
                        <td style="vertical-align: middle;">{{ $product->deleted_at->format('M d, Y') }}</td>
                        <td style="vertical-align: middle;">
                            <div style="display: flex; align-items: center; gap: 10px;">

                                <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="padding: 6px 15px; font-size: 12px; border-radius: 20px; font-weight: 600;">
                                        ♻️ Restore
                                    </button>
                                </form>

                                <form action="{{ route('admin.products.force-delete', $product->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('This will permanently delete the product. Continue?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 6px 15px; font-size: 12px; border-radius: 20px; font-weight: 600;">
                                        🗑️ Delete Forever
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                            Trash is empty.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $trashedProducts->links() }}
        </div>
    </div>
</div>

<script>
    // Select All Checkbox Logic
    const selectAllCheckbox = document.getElementById('select-all-checkbox');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    const bulkRestoreBtn = document.getElementById('bulk-restore-btn');
    const bulkForceDeleteBtn = document.getElementById('bulk-force-delete-btn');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            productCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    }

    // Bulk Restore Logic
    if (bulkRestoreBtn) {
        bulkRestoreBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.product-checkbox:checked'))
                                     .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Selection',
                    text: 'Please select at least one product to restore.',
                    confirmButtonColor: '#16a34a'
                });
                return;
            }

            Swal.fire({
                title: 'Restore Selected?',
                text: `You are about to restore ${selectedIds.length} product(s) from the trash.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, restore them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Restoring...',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Send restore request
                    fetch('{{ route("admin.products.bulk-restore") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ ids: selectedIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Restored!',
                                text: `${selectedIds.length} product(s) have been restored.`,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong.',
                            confirmButtonColor: '#ef4444'
                        });
                    });
                }
            });
        });
    }

    // Bulk Force Delete Logic
    if (bulkForceDeleteBtn) {
        bulkForceDeleteBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.product-checkbox:checked'))
                                     .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Selection',
                    text: 'Please select at least one product to delete.',
                    confirmButtonColor: '#ef4444'
                });
                return;
            }

            Swal.fire({
                title: 'Delete Forever?',
                text: `WARNING: You are about to permanently delete ${selectedIds.length} product(s). This cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete forever!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Deleting...',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Send delete request
                    fetch('{{ route("admin.products.bulk-force-delete") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ ids: selectedIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: `${selectedIds.length} product(s) have been permanently deleted.`,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong.',
                            confirmButtonColor: '#ef4444'
                        });
                    });
                }
            });
        });
    }

    // Individual checkbox change - update select all state
    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (selectAllCheckbox) {
                const allChecked = Array.from(productCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(productCheckboxes).some(cb => cb.checked);
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }
        });
    });
</script>
@endsection
