@forelse($products as $product)
    <tr>
        @if(auth()->user()->isAdmin())
            <td><input type="checkbox" name="ids[]" value="{{ $product->id }}"></td>
        @endif
        <td>
            <div class="img-thumbnail">
                @if($product->productImages && $product->productImages->isNotEmpty())
                    <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; border-radius: 8px; object-fit: cover;">
                @else
                    📦
                @endif
            </div>
        </td>
        <td><strong>{{ $product->name }}</strong></td>
        <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>
        <td>
            <span style="font-size: 11px; color: #94a3b8; display: block; margin-bottom: 3px;">SKU: {{ $product->sku ?? 'N/A' }}</span>
            <strong>${{ number_format($product->price, 2) }}</strong>
            <span style="font-size: 12px; color: #64748b; font-weight: normal; margin-left: 2px;">
                / {{ $product->unit ?? 'piece' }}
            </span>
        </td>
        <td>
            <span style="font-weight: 600; color: {{ $product->stock == 0 ? '#ef4444' : ($product->stock <= 10 ? '#f59e0b' : '#64748b') }};">
                {{ $product->stock }} 
            </span>
            <span style="color: #94a3b8; font-size: 0.9em;">
                {{ $product->unit ?? 'piece' }}(s)
            </span>
        </td>
        <td>
            @if($product->stock == 0)
                <span class="status-badge out-of-stock">OUT OF STOCK</span>
            @elseif($product->stock <= 10)
                <span class="status-badge low-stock">LOW STOCK</span>
            @else
                <span class="status-badge in-stock">IN STOCK</span>
            @endif
        </td>
        <td style="vertical-align: middle;">
            <div style="display: flex; align-items: center; gap: 15px;">
                
                <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn edit">Edit</a>

                @if(auth()->user()->isAdmin())
                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="delete-form" style="margin: 0; display: flex; align-items: center;">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="action-btn delete" style="background: none; border: none; padding: 0; cursor: pointer; text-decoration: none;">
                            Delete
                        </button>
                    </form>
                @endif
                
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="{{ auth()->user()->isAdmin() ? '9' : '8' }}" style="text-align: center; padding: 40px; color: #64748b;">
            No products match your search.
        </td>
    </tr>
@endforelse
