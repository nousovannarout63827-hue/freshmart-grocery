@extends('layouts.admin')

@section('content')
<div style="padding: 30px; max-width: 1200px; margin: 0 auto;">

    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <a href="{{ route('admin.staff.index') }}" style="text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px; display: inline-block; margin-bottom: 8px;">← Back to Staff List</a>
            <h2 style="font-weight: 800; color: #1e293b; margin: 0;">👤 Staff Information</h2>
            <p style="color: #64748b; margin: 4px 0 0 0; font-size: 14px;">Complete overview of team member details and activity</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.staff.edit', $staff->id) }}" style="background: #64748b; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; transition: 0.2s;" onmouseover="this.style.background='#475569'" onmouseout="this.style.background='#64748b'">
                ✏️ Edit Profile
            </a>
            <a href="{{ route('admin.staff.history', $staff->id) }}" style="background: #06b6d4; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; transition: 0.2s;" onmouseover="this.style.background='#0891b2'" onmouseout="this.style.background='#06b6d4'">
                📜 View History
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #059669; padding: 16px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 24px;">✅</span>
            <span style="font-weight: 600;">{{ session('success') }}</span>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px;">
        
        <!-- Left Sidebar - Profile Card -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <!-- Profile Photo -->
                <div style="text-align: center; margin-bottom: 24px;">
                    @if($staff->avatar ?? $staff->profile_photo_path)
                        <img src="{{ asset('storage/' . ($staff->avatar ?? $staff->profile_photo_path)) }}" alt="{{ $staff->name }}" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    @else
                        <div style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 48px; margin: 0 auto; border: 4px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            {{ strtoupper(substr($staff->name, 0, 1)) }}
                        </div>
                    @endif
                    <h3 style="margin: 16px 0 4px 0; font-size: 20px; font-weight: 800; color: #1e293b;">{{ $staff->name }}</h3>
                    <p style="margin: 0; color: #64748b; font-size: 14px;">{{ $staff->email }}</p>
                </div>

                <!-- Role Badge -->
                <div style="text-align: center; margin-bottom: 24px;">
                    @php
                        $roleColors = [
                            'admin' => '#7c3aed',
                            'super_user' => '#dc2626',
                            'staff' => '#2563eb',
                            'driver' => '#ea580c'
                        ];
                        $roleIcons = [
                            'admin' => '👑',
                            'super_user' => '🔥',
                            'staff' => '🏬',
                            'driver' => '🚚'
                        ];
                    @endphp
                    <span style="background: {{ $roleColors[$staff->role] ?? '#64748b' }}; color: white; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; gap: 6px;">
                        {{ $roleIcons[$staff->role] ?? '👤' }} {{ ucfirst(str_replace('_', ' ', $staff->role)) }}
                    </span>
                </div>

                <!-- Status -->
                <div style="background: {{ ($staff->status === 'active' || $staff->status === null) ? '#ecfdf5' : '#f1f5f9' }}; border-radius: 12px; padding: 16px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background: {{ ($staff->status === 'active' || $staff->status === null) ? '#10b981' : '#64748b' }}; display: inline-block;"></span>
                        <div>
                            <p style="margin: 0; font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: 700;">Account Status</p>
                            <p style="margin: 4px 0 0 0; font-weight: 700; color: {{ ($staff->status === 'active' || $staff->status === null) ? '#059669' : '#475569' }};">
                                {{ ($staff->status === 'active' || $staff->status === null) ? 'Active' : 'Disabled' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Quick Info -->
                <div style="border-top: 1px solid #f1f5f9; padding-top: 20px;">
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700;">📞 Phone</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->phone_number ?? 'Not provided' }}</p>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700;">👥 Gender</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->gender ?? 'Not specified' }}</p>
                    </div>
                    @if($staff->dob)
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700;">🎂 Date of Birth</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->dob->format('M d, Y') }}</p>
                    </div>
                    @endif
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700;">📍 Joined Date</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- Personal Information -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; font-size: 18px; display: flex; align-items: center; gap: 10px;">
                    <span>📋</span> Personal Information
                </h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                    <div>
                        <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Full Name</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->name }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Email Address</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->email }}</p>
                    </div>
                    @if($staff->phone_number)
                    <div>
                        <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Phone Number</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->phone_number }}</p>
                    </div>
                    @endif
                    @if($staff->gender)
                    <div>
                        <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Gender</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->gender }}</p>
                    </div>
                    @endif
                    @if($staff->dob)
                    <div>
                        <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Date of Birth</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->dob->format('F d, Y') }}</p>
                    </div>
                    @endif
                    @if($staff->pob)
                    <div>
                        <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Place of Birth</p>
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $staff->pob }}</p>
                    </div>
                    @endif
                </div>
                @if($staff->current_address)
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Current Address</p>
                    <p style="margin: 0; font-weight: 500; color: #1e293b; line-height: 1.6;">{{ $staff->current_address }}</p>
                </div>
                @endif
                @if($staff->bio)
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600;">Bio / Description</p>
                    <p style="margin: 0; font-weight: 500; color: #1e293b; line-height: 1.6;">{{ $staff->bio }}</p>
                </div>
                @endif
            </div>

            @if($staff->role === 'driver' && $assignedOrders)
            <!-- Driver's Assigned Orders -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; font-size: 18px; display: flex; align-items: center; gap: 10px;">
                    <span>🚚</span> Assigned Orders ({{ $assignedOrders->total() }})
                </h3>
                @if($assignedOrders->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8fafc;">
                            <tr>
                                <th style="padding: 12px 16px; text-align: left; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Order ID</th>
                                <th style="padding: 12px 16px; text-align: left; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Customer</th>
                                <th style="padding: 12px 16px; text-align: left; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Status</th>
                                <th style="padding: 12px 16px; text-align: right; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedOrders as $order)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #1e293b;">#{{ $order->id }}</td>
                                <td style="padding: 12px 16px; color: #64748b;">{{ $order->customer->name ?? 'Guest' }}</td>
                                <td style="padding: 12px 16px;">
                                    @php
                                        $statusColors = [
                                            'pending' => '#fbbf24',
                                            'confirmed' => '#3b82f6',
                                            'preparing' => '#8b5cf6',
                                            'shipped' => '#6366f1',
                                            'out for delivery' => '#06b6d4',
                                            'delivered' => '#10b981',
                                            'cancelled' => '#ef4444',
                                        ];
                                    @endphp
                                    <span style="background: {{ $statusColors[$order->status] ?? '#f1f5f9' }}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td style="padding: 12px 16px; text-align: right; font-weight: 700; color: #10b981;">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($assignedOrders->hasPages())
                <div style="margin-top: 16px;">{{ $assignedOrders->links() }}</div>
                @endif
                @else
                <p style="text-align: center; color: #94a3b8; padding: 40px 0;">No orders assigned yet.</p>
                @endif
            </div>
            @endif

            <!-- Recent Activity -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; font-size: 18px; display: flex; align-items: center; gap: 10px;">
                    <span>📝</span> Recent Activity
                </h3>
                @if($activityLogs->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($activityLogs as $log)
                    <div style="display: flex; align-items: flex-start; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 12px;">
                        @php
                            $actionIcons = [
                                'Created' => '➕',
                                'Updated' => '✏️',
                                'Deleted' => '🗑️',
                                'Restored' => '↩️',
                            ];
                        @endphp
                        <span style="font-size: 20px;">{{ $actionIcons[$log->action] ?? '📝' }}</span>
                        <div style="flex: 1;">
                            <p style="margin: 0; font-size: 13px; color: #1e293b; font-weight: 600;">
                                {{ $log->action }} {{ $log->module }}
                            </p>
                            <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">{{ $log->description }}</p>
                            <p style="margin: 8px 0 0 0; font-size: 11px; color: #94a3b8;">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="text-align: center; color: #94a3b8; padding: 40px 0;">No recent activity found.</p>
                @endif
            </div>

        </div>
    </div>

</div>
@endsection
