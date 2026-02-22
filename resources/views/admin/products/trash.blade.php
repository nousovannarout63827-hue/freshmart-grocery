@extends('layouts.admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box;">
    
    <div class="page-header">
        <h1>🗑️ Trash Bin</h1>
        <div class="header-actions">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">← Back to Active Inventory</a>
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
                            <div class="img-thumbnail" style="opacity: 0.5;">
                                @if($product->productImages && $product->productImages->count() > 0)
                                    <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; border-radius: 8px; object-fit: cover;">
                                @else
                                    📦
                                @endif
                            </div>
                        </td>
                        <td style="vertical-align: middle;"><strong>{{ $product->name }}</strong></td>
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
                        <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
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
    // Force Delete Confirmation (Permanent Delete from Trash)
    function confirmForceDelete(url) {
        Swal.fire({
            title: 'Delete Forever?',
            text: "WARNING: This will permanently erase the product and its image. This cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete forever!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
