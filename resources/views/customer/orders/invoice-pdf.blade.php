<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        @font-face {
            font-family: 'Khmer';
            src: url('https://fonts.gstatic.com/s/battambang/v15/uk-mEGe9raE9-BwAyIuV.ttf') format('truetype');
            unicode-range: U+1780-17FF;
        }
        
        body {
            font-family: 'DejaVu Sans', 'Khmer', Arial, sans-serif;
            color: #334155;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .header {
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 3px solid #16a34a;
            padding-bottom: 20px;
        }
        
        .header table {
            width: 100%;
        }
        
        .title {
            color: #16a34a;
            font-size: 32px;
            font-weight: bold;
            margin: 0;
        }
        
        .invoice-title {
            color: #1e293b;
            font-size: 24px;
            font-weight: bold;
            text-align: right;
            margin: 0;
        }
        
        .details-table {
            width: 100%;
            margin-bottom: 30px;
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 8px;
        }
        
        .details-table td {
            padding: 10px;
            vertical-align: top;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .items-table th {
            background-color: #16a34a;
            color: white;
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 13px;
        }
        
        .items-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 10px;
        }
        
        .items-table tr:last-child td {
            border-bottom: 2px solid #16a34a;
        }
        
        .total-row {
            background-color: #f0fdf4;
            font-weight: bold;
            font-size: 16px;
        }
        
        .total-row td {
            padding: 15px 10px;
            border-top: 2px solid #16a34a;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-preparing { background-color: #dbeafe; color: #1e40af; }
        .status-picked_up { background-color: #e0e7ff; color: #3730a3; }
        .status-out_for_delivery { background-color: #cffafe; color: #0e7490; }
        .status-arrived { background-color: #f0fdf4; color: #166534; }
        .status-delivered { background-color: #dcfce7; color: #166534; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <!-- Header -->
    <table class="header">
        <tr>
            <td>
                <h1 class="title">🛒 FreshMart</h1>
                <p style="margin: 5px 0; color: #64748b;">Premium Organic Groceries</p>
                <p style="margin: 5px 0; color: #64748b; font-size: 12px;">
                    123 Organic Street, Phnom Penh, Cambodia<br>
                    Phone: +855 12 345 678 | Email: hello@freshmart.kh
                </p>
            </td>
            <td style="text-align: right;">
                <h2 class="invoice-title">INVOICE</h2>
                <p style="margin: 5px 0;">
                    <strong>Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong><br>
                    Date: {{ $order->created_at->format('M d, Y') }}<br>
                    Time: {{ $order->created_at->format('h:i A') }}
                </p>
                <span class="status-badge status-{{ $order->status }}">
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </span>
            </td>
        </tr>
    </table>

    <!-- Order Details -->
    <table class="details-table">
        <tr>
            <td style="width: 50%;">
                <strong style="color: #16a34a; font-size: 14px;">👤 Customer Information</strong>
                <p style="margin: 8px 0;">
                    <strong>{{ $order->customer->name ?? 'Customer' }}</strong><br>
                    @if($order->customer->email)
                        📧 {{ $order->customer->email }}<br>
                    @endif
                    @if($order->phone)
                        📱 {{ $order->phone }}<br>
                    @endif
                </p>
            </td>
            <td>
                <strong style="color: #16a34a; font-size: 14px;">📍 Delivery Address</strong>
                <p style="margin: 8px 0;">
                    {{ $order->delivery_address ?? 'No delivery address provided' }}
                </p>
                @if($order->delivery_notes)
                    <p style="margin: 8px 0; font-size: 12px; color: #64748b;">
                        <strong>📝 Delivery Instructions:</strong><br>
                        {{ $order->delivery_notes }}
                    </p>
                @endif
            </td>
        </tr>
    </table>

    <!-- Order Items -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%;">Item</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: right;">Price</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>
                    {{ $item->product->translated_name ?? 'Product' }}
                    @if($item->product && $item->product->category)
                        <br><small style="color: #64748b;">{{ $item->product->category->name }}</small>
                    @endif
                </td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: right;">${{ number_format($item->price, 2) }}</td>
                <td style="text-align: right;">${{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
            @endforeach
            
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Grand Total:</td>
                <td style="text-align: right; color: #16a34a;">${{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Payment Information -->
    <table class="details-table">
        <tr>
            <td style="width: 50%;">
                <strong style="color: #16a34a; font-size: 14px;">💳 Payment Method</strong>
                <p style="margin: 8px 0;">
                    @if($order->payment_method === 'cash')
                        💵 Cash on Delivery
                    @else
                        💳 Card Payment
                    @endif
                    <br>
                    <strong style="color: {{ $order->payment_status === 'paid' ? '#16a34a' : '#d97706' }};">
                        Status: {{ ucfirst($order->payment_status ?? 'unknown') }}
                    </strong>
                </p>
            </td>
            <td>
                <strong style="color: #16a34a; font-size: 14px;">🚚 Shipping Method</strong>
                <p style="margin: 8px 0;">
                    {{ $order->shipping_method ?? 'Standard Delivery' }}
                </p>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p style="margin: 5px 0;"><strong>Thank you for shopping with FreshMart!</strong></p>
        <p style="margin: 5px 0;">For questions or support, contact us at support@freshmart.kh</p>
        <p style="margin: 5px 0; font-size: 11px;">
            This is a computer-generated invoice. No signature required.
        </p>
        <p style="margin: 10px 0 0 0; font-size: 10px; color: #94a3b8;">
            Generated on {{ now()->format('M d, Y \a\t h:i A') }}
        </p>
    </div>
</body>
</html>
