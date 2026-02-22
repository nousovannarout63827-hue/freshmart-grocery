@extends('layouts.admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box;">

    <!-- Back Button & Header -->
    <div style="margin-bottom: 30px;">
        <a href="{{ route('admin.driver-performance.index') }}" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #64748b; font-weight: 600; margin-bottom: 16px;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#64748b'">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Driver Performance
        </a>
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 36px;">
                {{ strtoupper(substr($driver->name, 0, 1)) }}
            </div>
            <div>
                <h1 style="font-size: 28px; font-weight: 900; color: #1e293b; margin: 0;">{{ $driver->name }}</h1>
                <p style="font-size: 14px; color: #64748b; margin: 4px 0 0;">📞 {{ $driver->phone_number ?? 'N/A' }} | ✉️ {{ $driver->email }}</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px;">
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #10b981;">
            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; font-weight: 600;">Total Deliveries</div>
            <div style="font-size: 36px; font-weight: 800; color: #10b981;">{{ $stats['total_deliveries'] }}</div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; font-weight: 600;">Avg Delivery Time</div>
            <div style="font-size: 36px; font-weight: 800; color: #f59e0b;">{{ $stats['avg_delivery_time'] }}</div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6;">
            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; font-weight: 600;">Total Earnings</div>
            <div style="font-size: 36px; font-weight: 800; color: #3b82f6;">${{ number_format($stats['total_earnings'], 2) }}</div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #8b5cf6;">
            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; font-weight: 600;">Customer Rating</div>
            <div style="font-size: 36px; font-weight: 800; color: #8b5cf6;">⭐ {{ $stats['customer_rating'] }}</div>
        </div>
    </div>

    <!-- Recent Cancellations -->
    @if($cancellations->count() > 0)
    <div style="margin-bottom: 32px;">
        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">⚠️ Recent Cancellations</h2>
        <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #fee2e2;">
            @foreach($cancellations as $cancel)
                <div style="padding: 16px; border-bottom: 1px solid #fef2f2; display: flex; align-items: flex-start; gap: 16px;">
                    <span style="font-size: 24px;">🔴</span>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; color: #991b1b; margin-bottom: 4px;">Order #{{ $cancel->id }} - ${{ number_format($cancel->total_amount, 2) }}</div>
                        <div style="font-size: 13px; color: #7f1d1d;"><strong>Reason:</strong> {{ $cancel->cancellation_reason }}</div>
                        <div style="font-size: 11px; color: #991b1b; margin-top: 6px;">{{ $cancel->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Order History -->
    <div style="margin-bottom: 32px;">
        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">📦 Delivery History</h2>
        <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                    <tr>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Order ID</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Customer</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Amount</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Status</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($driverOrders as $order)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 15px 20px; font-weight: 700; color: #1e293b;">#{{ $order->id }}</td>
                            <td style="padding: 15px 20px; color: #475569;">{{ $order->customer->name ?? 'N/A' }}</td>
                            <td style="padding: 15px 20px; font-weight: 700; color: #10b981;">${{ number_format($order->total_amount, 2) }}</td>
                            <td style="padding: 15px 20px;">
                                @php
                                    $statusColors = [
                                        'delivered' => '#10b981',
                                        'out_for_delivery' => '#3b82f6',
                                        'arrived' => '#8b5cf6',
                                        'cancelled' => '#ef4444',
                                    ];
                                    $color = $statusColors[$order->status] ?? '#64748b';
                                @endphp
                                <span style="background: {{ $color }}15; color: {{ $color }}; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase;">
                                    {{ str_replace('_', ' ', $order->status) }}
                                </span>
                            </td>
                            <td style="padding: 15px 20px; color: #64748b; font-size: 13px;">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">No orders found for this driver.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($driverOrders->hasPages())
            <div style="margin-top: 20px;">{{ $driverOrders->links() }}</div>
        @endif
    </div>

    <!-- Activity Log -->
    <div>
        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">📋 Activity Log</h2>
        <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                    <tr>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Time</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Action</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($driverActivities as $activity)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 15px 20px; color: #64748b; font-size: 13px;">
                                {{ $activity->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td style="padding: 15px 20px;">
                                <span style="background: #3b82f615; color: #3b82f6; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase;">
                                    {{ $activity->action }}
                                </span>
                            </td>
                            <td style="padding: 15px 20px; color: #475569; font-size: 13px;">{{ $activity->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="padding: 40px; text-align: center; color: #94a3b8;">No activities recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($driverActivities->hasPages())
            <div style="margin-top: 20px;">{{ $driverActivities->links() }}</div>
        @endif
    </div>

</div>
@endsection
