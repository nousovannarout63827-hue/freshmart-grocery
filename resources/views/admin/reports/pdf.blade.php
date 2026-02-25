<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Financial and Driver Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #0f172a;
            margin: 20px;
        }

        .header {
            border-bottom: 2px solid #0f172a;
            padding-bottom: 10px;
            margin-bottom: 16px;
        }

        .title {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 6px 0;
        }

        .meta {
            font-size: 11px;
            color: #475569;
            margin: 2px 0;
        }

        .section {
            margin-top: 18px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            margin: 0 0 8px 0;
            padding-bottom: 4px;
            border-bottom: 1px solid #cbd5e1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f1f5f9;
            font-weight: 700;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .summary-table td.label {
            width: 45%;
            background: #f8fafc;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Financial and Driver Report</h1>
        <p class="meta">Period: {{ $dateFrom }} to {{ $dateTo }}</p>
        <p class="meta">Generated: {{ $generatedAt->format('Y-m-d H:i:s') }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">Summary</h2>
        <table class="summary-table">
            <tr>
                <td class="label">Total Orders</td>
                <td>{{ number_format($summary['total_orders']) }}</td>
            </tr>
            <tr>
                <td class="label">Delivered Orders</td>
                <td>{{ number_format($summary['delivered_orders']) }}</td>
            </tr>
            <tr>
                <td class="label">Delivered Revenue</td>
                <td>${{ number_format($summary['delivered_revenue'], 2) }}</td>
            </tr>
            <tr>
                <td class="label">Average Order Value</td>
                <td>${{ number_format($summary['average_order_value'], 2) }}</td>
            </tr>
            <tr>
                <td class="label">Total Drivers</td>
                <td>{{ number_format($summary['total_drivers']) }}</td>
            </tr>
            <tr>
                <td class="label">Total Deliveries</td>
                <td>{{ number_format($summary['total_deliveries']) }}</td>
            </tr>
            <tr>
                <td class="label">Total Driver Commission</td>
                <td>${{ number_format($summary['total_commission'], 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">Revenue by Payment Method</h2>
        <table>
            <thead>
                <tr>
                    <th>Payment Method</th>
                    <th class="center">Orders</th>
                    <th class="right">Revenue</th>
                </tr>
            </thead>
            <tbody>
                @forelse($revenueByPayment as $payment)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'Unknown')) }}</td>
                        <td class="center">{{ number_format($payment->count) }}</td>
                        <td class="right">${{ number_format((float) $payment->total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="center">No payment data found for this period.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">Top Driver Performance</h2>
        <table>
            <thead>
                <tr>
                    <th>Driver</th>
                    <th class="center">Deliveries</th>
                    <th class="right">Revenue</th>
                    <th class="right">Commission</th>
                    <th class="center">Success Rate</th>
                    <th class="center">Rating</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topDrivers as $driver)
                    <tr>
                        <td>{{ $driver['name'] }}</td>
                        <td class="center">{{ number_format($driver['total_deliveries']) }}</td>
                        <td class="right">${{ number_format((float) $driver['total_revenue'], 2) }}</td>
                        <td class="right">${{ number_format((float) $driver['commission_earned'], 2) }}</td>
                        <td class="center">{{ number_format((float) $driver['success_rate'], 1) }}%</td>
                        <td class="center">{{ number_format((float) $driver['rating'], 1) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="center">No driver data found for this period.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">Recent Orders (up to 40)</h2>
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ optional($order->created_at)->format('Y-m-d H:i') }}</td>
                        <td>{{ optional($order->customer)->name ?? 'N/A' }}</td>
                        <td>{{ optional($order->driver)->name ?? 'Unassigned' }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $order->status ?? 'unknown')) }}</td>
                        <td>{{ ucfirst($order->payment_method ?? 'N/A') }}</td>
                        <td class="right">${{ number_format((float) $order->total_amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="center">No orders found for this period.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
