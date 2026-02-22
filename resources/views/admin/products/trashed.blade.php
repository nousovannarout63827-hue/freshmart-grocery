<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Trashed Products ({{ $products->count() }})</h1>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-indigo-600 hover:underline">Back to All Products</a>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.products.bulk-restore') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-bold rounded hover:bg-green-700 transition">
                        Restore Selected
                    </button>
                </div>

                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-4"><input type="checkbox" id="selectAll"></th>
                            <th class="px-6 py-4">Product Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4 text-center">Price</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <input type="checkbox" name="ids[]" value="{{ $product->id }}" class="product-checkbox">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $product->category->name }}</td>
                            <td class="px-6 py-4 text-center font-mono text-gray-800">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white text-xs font-bold rounded hover:bg-green-700 transition">
                                        Restore
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                The trash is empty! Great job maintaining your inventory.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
