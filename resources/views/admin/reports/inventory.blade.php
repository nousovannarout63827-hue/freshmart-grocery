<h1 style="font-family: sans-serif; text-align: center;">Inventory Report</h1>
<p style="text-align: center;">Total Products: {{ $products->count() }}</p>

<table style="width: 100%; border-collapse: collapse; font-family: sans-serif;">
    <thead>
        <tr style="background: #f3f4f6;">
            <th style="border: 1px solid #ddd; padding: 8px;">Product Name</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Category</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Stock</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->name }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->category->name }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->quantity }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">${{ number_format($product->price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
