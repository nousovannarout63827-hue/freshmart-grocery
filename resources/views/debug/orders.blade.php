<!DOCTYPE html>
<html>
<head>
    <title>Debug Orders</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #f5f5f5; }
        .card { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #1e293b; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #f8fafc; font-weight: 700; }
        .status { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 700; }
        .pending { background: #fef3c7; color: #b45309; }
        .delivered { background: #dcfce7; color: #15803d; }
        .cancelled { background: #fee2e2; color: #dc2626; }
        .default { background: #e2e8f0; color: #475569; }
    </style>
</head>
<body>
    <h1>🔍 Database Debug - Orders & Drivers</h1>

    <div class="card">
        <h2>📊 Database Connection</h2>
        <p><strong>Database:</strong> {{ DB::connection()->getDatabaseName() }}</p>
        <p><strong>Status:</strong> ✅ Connected</p>
    </div>

    <div class="card">
        <h2>🚚 Drivers in System ({{ $drivers->count() }})</h2>
        @if($drivers->count() > 0)
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>
            @foreach($drivers as $driver)
            <tr>
                <td>{{ $driver->id }}</td>
                <td>{{ $driver->name }}</td>
                <td>{{ $driver->email }}</td>
                <td>{{ $driver->role }}</td>
            </tr>
            @endforeach
        </table>
        @else
        <p>No drivers found in the database!</p>
        @endif
    </div>

    <div class="card">
        <h2>📦 Available Orders for Drivers ({{ $availableOrders->count() }})</h2>
        <p>Orders without driver_id that are: pending, ready_for_pickup, or out for delivery</p>
        @if($availableOrders->count() > 0)
        <table>
            <tr><th>ID</th><th>Status</th><th>Customer</th><th>Items</th><th>Total</th><th>Created</th></tr>
            @foreach($availableOrders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td><span class="status {{ in_array($order->status, ['pending', 'ready_for_pickup', 'out for delivery']) ? 'pending' : 'default' }}">{{ $order->status }}</span></td>
                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                <td>{{ $order->orderItems->count() }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </table>
        @else
        <p>No available orders at this time.</p>
        @endif
    </div>

    <div class="card">
        <h2>📋 All Orders ({{ $allOrders->count() }})</h2>
        <table>
            <tr><th>ID</th><th>Status</th><th>Customer</th><th>Driver ID</th><th>Driver</th><th>Total</th></tr>
            @foreach($allOrders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td><span class="status {{ $order->status }}">{{ $order->status }}</span></td>
                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                <td>{{ $order->driver_id ?? 'NULL' }}</td>
                <td>{{ $order->driver ? $order->driver->name : 'Not Assigned' }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="card">
        <h2>🔗 Test Links</h2>
        <ul>
            <li><a href="/login">Login Page</a></li>
            <li><a href="/driver/dashboard">Driver Dashboard</a> (requires driver login)</li>
        </ul>
    </div>
</body>
</html>
