@extends('layouts.admin')

@section('content')
<div style="padding: 32px; box-sizing: border-box; background: #f1f5f9; min-height: 100vh;">

    <!-- Page Header -->
    <div style="margin-bottom: 32px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="font-size: 28px; font-weight: 900; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 32px;">🚚</span>
                    Driver Performance & Activity
                </h1>
                <p style="font-size: 14px; color: #64748b; margin: 8px 0 0;">Track driver activities, deliveries, and performance metrics</p>
            </div>
            <button onclick="exportReport()" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)'">
                📥 Export Report
            </button>
        </div>
    </div>

    <!-- Overall Statistics -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px;">
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6;">
            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; font-weight: 600;">👥 Total Drivers</div>
            <div style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $overallStats['total_drivers'] }}</div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #10b981;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                <div style="font-size: 13px; color: #64748b; text-transform: uppercase; font-weight: 600;">🚚 Active</div>
                <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800;">Delivering</span>
            </div>
            <div style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $overallStats['active_drivers'] }}</div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; font-weight: 600;">📦 Today</div>
            <div style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $overallStats['total_deliveries_today'] }}</div>
            <div style="font-size: 12px; color: #10b981; margin-top: 4px;">+${{ number_format($overallStats['total_revenue_today'], 0) }} revenue</div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #8b5cf6;">
            <div style="font-size: 13px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; font-weight: 600;">📋 Activities</div>
            <div style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $overallStats['total_activities'] }}</div>
        </div>
    </div>

    <!-- Monthly Comparison & Charts -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 32px;">
        <!-- Weekly Chart -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 20px 0; font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                📊 Weekly Delivery Trend
            </h3>
            <div style="display: flex; align-items: flex-end; justify-content: space-around; height: 200px; padding: 20px 10px; background: linear-gradient(180deg, #f8fafc, #f1f5f9); border-radius: 12px;">
                @php
                    $deliveriesArray = array_column($weeklyData, 'deliveries');
                    $maxDeliveries = !empty($deliveriesArray) ? max($deliveriesArray) : 1;
                    if ($maxDeliveries == 0) $maxDeliveries = 1;
                @endphp
                @foreach($weeklyData as $day)
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 8px; flex: 1;">
                        <div style="width: 40px; height: {{ max(0, ($day['deliveries'] / $maxDeliveries) * 140) }}px; background: linear-gradient(180deg, #3b82f6, #2563eb); border-radius: 8px 8px 0 0; transition: all 0.3s; position: relative;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            @if($day['deliveries'] > 0)
                                <span style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); font-size: 11px; font-weight: 700; color: #1e293b;">{{ $day['deliveries'] }}</span>
                            @endif
                        </div>
                        <span style="font-size: 11px; font-weight: 600; color: #64748b;">{{ $day['day'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Monthly Comparison -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 20px 0; font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                📅 Monthly Comparison
            </h3>
            
            <div style="margin-bottom: 20px;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px;">Deliveries</div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="flex: 1;">
                        <div style="font-size: 24px; font-weight: 800; color: #3b82f6;">{{ $monthlyData['current_month_deliveries'] }}</div>
                        <div style="font-size: 11px; color: #64748b;">This Month</div>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 24px; font-weight: 800; color: #94a3b8;">{{ $monthlyData['last_month_deliveries'] }}</div>
                        <div style="font-size: 11px; color: #64748b;">Last Month</div>
                    </div>
                    <div style="text-align: right;">
                        @if($monthlyData['growth_percentage'] >= 0)
                            <div style="font-size: 18px; font-weight: 800; color: #10b981;">↑</div>
                            <div style="font-size: 11px; color: #10b981; font-weight: 700;">{{ abs($monthlyData['growth_percentage']) }}%</div>
                        @else
                            <div style="font-size: 18px; font-weight: 800; color: #ef4444;">↓</div>
                            <div style="font-size: 11px; color: #ef4444; font-weight: 700;">{{ abs($monthlyData['growth_percentage']) }}%</div>
                        @endif
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 16px;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px;">Revenue</div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="flex: 1;">
                        <div style="font-size: 20px; font-weight: 800; color: #10b981;">${{ number_format($monthlyData['current_month_revenue'], 0) }}</div>
                        <div style="font-size: 11px; color: #64748b;">This Month</div>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 20px; font-weight: 800; color: #94a3b8;">${{ number_format($monthlyData['last_month_revenue'], 0) }}</div>
                        <div style="font-size: 11px; color: #64748b;">Last Month</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Performers Leaderboard -->
    <div style="margin-bottom: 32px;">
        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            🏆 Top Performers This Month
        </h2>
        <div style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            @foreach($topPerformers as $index => $performer)
                <div style="display: flex; align-items: center; gap: 16px; padding: 16px; {{ $index < count($topPerformers) - 1 ? 'border-bottom: 1px solid #f1f5f9;' : '' }}; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                    <!-- Rank -->
                    <div style="width: 40px; text-align: center; font-size: 20px; font-weight: 800; color: {{ $index === 0 ? '#fbbf24' : ($index === 1 ? '#94a3b8' : ($index === 2 ? '#b45309' : '#64748b')) }};">
                        @if($index === 0)
                            🥇
                        @elseif($index === 1)
                            🥈
                        @elseif($index === 2)
                            🥉
                        @else
                            #{{ $index + 1 }}
                        @endif
                    </div>

                    <!-- Avatar -->
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 20px; flex-shrink: 0;">
                        {{ $performer['avatar_initial'] }}
                    </div>

                    <!-- Info -->
                    <div style="flex: 1;">
                        <div style="font-weight: 800; color: #1e293b; font-size: 15px;">{{ $performer['name'] }}</div>
                        <div style="display: flex; gap: 16px; margin-top: 4px;">
                            <span style="font-size: 12px; color: #64748b;">{{ $performer['deliveries'] }} deliveries</span>
                            <span style="font-size: 12px; color: #64748b;">⭐ {{ $performer['rating'] }}</span>
                            <span style="font-size: 12px; color: #10b981;">{{ $performer['success_rate'] }}% success</span>
                        </div>
                    </div>

                    <!-- Earnings -->
                    <div style="text-align: right;">
                        <div style="font-size: 20px; font-weight: 800; color: #10b981;">${{ number_format($performer['earnings'], 2) }}</div>
                        <div style="font-size: 11px; color: #64748b;">earnings</div>
                    </div>
                </div>
            @endforeach

            @if(count($topPerformers) === 0)
                <div style="padding: 40px; text-align: center; color: #94a3b8;">
                    <span style="font-size: 48px; display: block; margin-bottom: 16px;">🏆</span>
                    No driver performance data yet
                </div>
            @endif
        </div>
    </div>

    <!-- Driver Performance Cards -->
    <div style="margin-bottom: 32px;">
        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            📊 All Drivers Performance
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px;">
            @foreach($drivers as $driver)
                @php
                    $stats = $driverStats[$driver->id] ?? [];
                    $performanceColor = ($stats['deliveries_this_month'] ?? 0) > 20 ? '#10b981' : (($stats['deliveries_this_month'] ?? 0) > 10 ? '#f59e0b' : '#ef4444');
                @endphp
                <a href="{{ route('admin.driver-performance.show', $driver->id) }}" style="text-decoration: none; background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 2px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderColor='{{ $performanceColor }}'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.1)'" onmouseout="this.style.borderColor='transparent'; this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 24px; flex-shrink: 0;">
                            {{ strtoupper(substr($driver->name, 0, 1)) }}
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 800; color: #1e293b; font-size: 16px;">{{ $driver->name }}</div>
                            <div style="font-size: 12px; color: #64748b;">📞 {{ $driver->phone_number ?? 'N/A' }}</div>
                            <div style="display: flex; align-items: center; gap: 8px; margin-top: 6px;">
                                <span style="font-size: 11px; color: #64748b;">⭐ {{ $stats['customer_rating'] ?? 0 }}</span>
                                <span style="font-size: 11px; color: {{ $performanceColor }}; font-weight: 800;">{{ $stats['success_rate'] ?? 0 }}% success</span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 11px; color: #64748b;">Active</div>
                            <div style="font-size: 18px; font-weight: 800; color: {{ $performanceColor }}">{{ $stats['active_orders'] ?? 0 }}</div>
                        </div>
                    </div>

                    <!-- Earnings Breakdown -->
                    <div style="background: #f8fafc; border-radius: 10px; padding: 12px; margin-bottom: 12px;">
                        <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 8px;">💰 Earnings Breakdown</div>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                            <div>
                                <div style="font-size: 16px; font-weight: 800; color: #10b981;">${{ number_format($stats['total_earnings'] ?? 0, 2) }}</div>
                                <div style="font-size: 9px; color: #64748b;">Total</div>
                            </div>
                            <div>
                                <div style="font-size: 16px; font-weight: 800; color: #3b82f6;">${{ number_format(($stats['total_earnings'] ?? 0) / max($stats['total_deliveries'] ?? 1, 1), 2) }}</div>
                                <div style="font-size: 9px; color: #64748b;">Avg/Order</div>
                            </div>
                            <div>
                                <div style="font-size: 16px; font-weight: 800; color: #f59e0b;">{{ $stats['avg_delivery_time'] ?? 'N/A' }}</div>
                                <div style="font-size: 9px; color: #64748b;">Avg Time</div>
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                        <div style="text-align: center;">
                            <div style="font-size: 20px; font-weight: 800; color: #1e293b;">{{ $stats['total_deliveries'] ?? 0 }}</div>
                            <div style="font-size: 9px; color: #64748b; text-transform: uppercase;">Total</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 20px; font-weight: 800; color: #10b981;">{{ $stats['deliveries_this_month'] ?? 0 }}</div>
                            <div style="font-size: 9px; color: #64748b; text-transform: uppercase;">Month</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 20px; font-weight: 800; color: #3b82f6;">{{ $stats['deliveries_this_week'] ?? 0 }}</div>
                            <div style="font-size: 9px; color: #64748b; text-transform: uppercase;">Week</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 20px; font-weight: 800; color: #f59e0b;">{{ $stats['deliveries_today'] ?? 0 }}</div>
                            <div style="font-size: 9px; color: #64748b; text-transform: uppercase;">Today</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Activity Log Section -->
    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                📋 Driver Activity Timeline
            </h2>
        </div>

        <!-- Filters -->
        <div style="background: white; border-radius: 12px; padding: 16px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
            <form action="{{ route('admin.driver-performance.index') }}" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end;">
                <div style="flex: 0 0 120px;">
                    <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">📅 Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc;">
                </div>

                <div style="flex: 1; min-width: 150px;">
                    <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">👤 Driver</label>
                    <select name="driver_id" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc;">
                        <option value="">All Drivers</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ $selectedDriverId == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="flex: 0 0 110px;">
                    <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">⚡ Action</label>
                    <select name="action" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc;">
                        <option value="">All Actions</option>
                        @foreach($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>{{ $action }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: flex; gap: 6px; flex-shrink: 0;">
                    <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer;">🔍 Filter</button>
                    <a href="{{ route('admin.driver-performance.index') }}" style="background: white; color: #64748b; border: 1px solid #e2e8f0; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12px; text-decoration: none;">🔄 Reset</a>
                </div>
            </form>
        </div>

        <!-- Activity Table -->
        <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                    <tr>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Time</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Driver</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Action</th>
                        <th style="padding: 15px 20px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 15px 20px; color: #64748b; font-size: 13px;">
                                {{ $activity->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td style="padding: 15px 20px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px;">
                                        {{ strtoupper(substr($activity->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #1e293b; font-size: 13px;">{{ $activity->user->name ?? 'Unknown' }}</div>
                                        <div style="font-size: 10px; color: #64748b; text-transform: uppercase;">🚚 Driver</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 15px 20px;">
                                @php
                                    $actionColors = [
                                        'Accepted Order' => '#3b82f6',
                                        'Picked Up Order' => '#f59e0b',
                                        'Arrived at Customer' => '#8b5cf6',
                                        'Delivered Order' => '#10b981',
                                        'Cancelled' => '#ef4444',
                                    ];
                                    $color = $actionColors[$activity->action] ?? '#64748b';
                                @endphp
                                <span style="background: {{ $color }}15; color: {{ $color }}; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase;">
                                    {{ $activity->action }}
                                </span>
                            </td>
                            <td style="padding: 15px 20px; color: #475569; font-size: 13px;">{{ $activity->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 40px; text-align: center; color: #94a3b8;">
                                No driver activities found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($activities->hasPages())
            <div style="margin-top: 20px;">{{ $activities->links() }}</div>
        @endif
    </div>

</div>

<script>
    function exportReport() {
        const url = new URL('{{ route('admin.driver-performance.export') }}');
        const driverId = document.querySelector('select[name="driver_id"]')?.value;
        const dateFrom = document.querySelector('input[name="date_from"]')?.value;
        const dateTo = document.querySelector('input[name="date_to"]')?.value;

        if (driverId) url.searchParams.set('driver_id', driverId);
        if (dateFrom) url.searchParams.set('date_from', dateFrom);
        if (dateTo) url.searchParams.set('date_to', dateTo);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                alert('Report exported! Total activities: ' + data.total);
                console.log(data);
            })
            .catch(error => {
                alert('Error exporting report');
                console.error(error);
            });
    }
</script>
@endsection
