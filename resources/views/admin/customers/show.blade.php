@extends('layouts.admin')

@section('content')
<style>
.customers-show-page {
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

@media (max-width: 768px) {
    .customers-show-page {
        padding: 16px !important;
    }

    .customer-header {
        flex-direction: column !important;
        gap: 16px !important;
        align-items: center !important;
    }

    .customer-info {
        flex-direction: column !important;
        text-align: center !important;
        gap: 12px !important;
    }

    .customer-avatar {
        width: 60px !important;
        height: 60px !important;
    }

    .customer-header h2 {
        font-size: 20px !important;
    }

    .back-btn {
        width: 100% !important;
        justify-content: center !important;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 12px !important;
    }

    .stat-card {
        padding: 16px !important;
    }

    .stat-value {
        font-size: 24px !important;
    }

    .content-grid {
        grid-template-columns: 1fr !important;
    }

    .table-wrapper {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
    }

    .orders-table {
        min-width: 600px !important;
    }
}

@media (max-width: 375px) {
    .customers-show-page {
        padding: 12px !important;
    }

    .customer-header h2 {
        font-size: 18px !important;
    }

    .stats-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>

<div class="customers-show-page" style="padding: 24px; background: #f8fafc; min-height: 100vh;">
    <!-- Header -->
    <div class="customer-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; flex-wrap: wrap; gap: 16px;">

        <div class="customer-info" style="display: flex; align-items: center; gap: 20px;">
            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #10b981; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            @else
                <div style="width: 80px; height: 80px; border-radius: 50%; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; border: 3px solid #10b981; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div>
                <h2 style="font-weight: 800; color: #1e293b; margin: 0 0 4px 0; font-size: 28px;">{{ $user->name }}</h2>
                <span style="background: #1e293b; color: white; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Registered Customer</span>
            </div>
        </div>

        <a href="{{ route('admin.customers.index') }}" class="back-btn" style="text-decoration: none; color: #475569; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background: white; border-radius: 8px; border: 1px solid #e2e8f0; transition: all 0.2s; white-space: nowrap;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to List
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #059669; padding: 16px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: white; padding: 24px; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #eff6ff; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 20px; height: 20px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <p style="color: #64748b; font-size: 12px; font-weight: 700; margin: 0; text-transform: uppercase;">Total Orders</p>
            </div>
            <h3 style="font-size: 32px; margin: 0; color: #1e293b; font-weight: 800;">{{ $totalOrders }}</h3>
        </div>
        
        <div style="background: white; padding: 24px; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #e0f2fe; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 20px; height: 20px; color: #0284c7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p style="color: #0284c7; font-size: 12px; font-weight: 700; margin: 0; text-transform: uppercase;">Pending Orders</p>
            </div>
            <h3 style="font-size: 32px; margin: 0; color: #0284c7; font-weight: 800;">{{ $pendingOrders }}</h3>
        </div>
        
        <div style="background: white; padding: 24px; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 20px; height: 20px; color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p style="color: #059669; font-size: 12px; font-weight: 700; margin: 0; text-transform: uppercase;">Completed</p>
            </div>
            <h3 style="font-size: 32px; margin: 0; color: #059669; font-weight: 800;">{{ $completedOrders }}</h3>
        </div>
        
        <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 24px; border-radius: 16px; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p style="font-size: 12px; font-weight: 700; margin: 0; text-transform: uppercase; opacity: 0.9;">Total Spent</p>
            </div>
            <h3 style="font-size: 32px; margin: 0; font-weight: 800;">${{ number_format($totalSpent, 2) }}</h3>
        </div>
    </div>

    <div class="content-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        <!-- Order History -->
        <div style="background: white; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden;">
            <div style="padding: 20px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 20px;">📜</span>
                    <span style="font-weight: 700; color: #1e293b; font-size: 18px;">Order History</span>
                </div>
            </div>
            <div class="table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="orders-table" style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc;">
                    <tr>
                        <th style="padding: 15px 24px; text-align: left; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Order ID</th>
                        <th style="padding: 15px 24px; text-align: left; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Date</th>
                        <th style="padding: 15px 24px; text-align: left; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Status</th>
                        <th style="padding: 15px 24px; text-align: right; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 15px 24px; font-weight: 700; color: #1e293b;">#{{ $order->id }}</td>
                        <td style="padding: 15px 24px; color: #64748b;">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                        <td style="padding: 15px 24px;">
                            @php
                                $statusColors = [
                                    'pending' => '#fbbf24',
                                    'confirmed' => '#3b82f6',
                                    'preparing' => '#8b5cf6',
                                    'shipped' => '#6366f1',
                                    'delivered' => '#10b981',
                                    'cancelled' => '#ef4444',
                                    'arrived' => '#d800b4',
                                    'ready_for_pickup' => '#f97316',
                                ];
                            @endphp
                            <span style="padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 700; background: {{ $statusColors[$order->status] ?? '#f1f5f9' }}; color: white; text-transform: uppercase;">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td style="padding: 15px 24px; text-align: right; font-weight: 700; color: #10b981;">${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 48px 24px; text-align: center;">
                            <div style="font-size: 48px; margin-bottom: 12px;">📦</div>
                            <p style="color: #94a3b8; font-size: 16px; margin: 0;">This customer has not placed any orders yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            @if($orders->hasPages())
            <div style="padding: 20px 24px; border-top: 1px solid #f1f5f9;">
                {{ $orders->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>

        <!-- Customer Info Sidebar -->
        <div style="background: white; border-radius: 16px; border: 1px solid #f1f5f9; padding: 24px;">
            <h3 style="font-weight: 700; color: #1e293b; margin-bottom: 20px; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                <span>📋</span> Customer Information
            </h3>
            
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #10b981; flex-shrink: 0;">
                @else
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 24px; flex-shrink: 0;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div style="font-weight: 700; color: #1e293b; font-size: 18px;">{{ $user->name }}</div>
                    <div style="color: #64748b; font-size: 14px;">{{ $user->email }}</div>
                </div>
            </div>

            <div style="display: grid; gap: 16px;">
                <div>
                    <div style="font-size: 12px; color: #94a3b8; margin-bottom: 6px; text-transform: uppercase; font-weight: 700;">Email Address</div>
                    <div style="color: #1e293b; font-weight: 500;">{{ $user->email }}</div>
                </div>
                
                @if($user->phone_number)
                <div>
                    <div style="font-size: 12px; color: #94a3b8; margin-bottom: 6px; text-transform: uppercase; font-weight: 700;">Phone Number</div>
                    <div style="color: #1e293b; font-weight: 500;">{{ $user->phone_number }}</div>
                </div>
                @endif

                @if($user->current_address)
                <div>
                    <div style="font-size: 12px; color: #94a3b8; margin-bottom: 6px; text-transform: uppercase; font-weight: 700;">Address</div>
                    <div style="color: #1e293b; font-weight: 500;">{{ $user->current_address }}</div>
                </div>
                @endif

                <div>
                    <div style="font-size: 12px; color: #94a3b8; margin-bottom: 6px; text-transform: uppercase; font-weight: 700;">Customer Since</div>
                    <div style="color: #1e293b; font-weight: 500;">{{ $user->created_at->format('F d, Y') }}</div>
                </div>

                <div>
                    <div style="font-size: 12px; color: #94a3b8; margin-bottom: 6px; text-transform: uppercase; font-weight: 700;">Account Status</div>
                    @if($user->status === 'active')
                        <span style="background: #ecfdf5; color: #059669; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                            <span style="width: 8px; height: 8px; background: #059669; border-radius: 50%;"></span>
                            ACTIVE
                        </span>
                    @else
                        <span style="background: #fef2f2; color: #dc2626; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                            <span style="width: 8px; height: 8px; background: #dc2626; border-radius: 50%;"></span>
                            SUSPENDED
                        </span>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 12px; font-size: 14px;">Quick Actions</h4>

                <button type="button" onclick="openResetPasswordModal()"
                        style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; background: #dbeafe; color: #1e40af; margin-bottom: 10px;"
                        onmouseover="this.style.background='#bfdbfe'"
                        onmouseout="this.style.background='#dbeafe'">
                    🔑 Reset Password
                </button>

                <form action="{{ route('admin.customers.toggle', $user->id) }}" method="POST" style="margin-bottom: 10px;">
                    @csrf
                    <button type="submit"
                            style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; background: {{ $user->status === 'active' ? '#fef2f2' : '#ecfdf5' }}; color: {{ $user->status === 'active' ? '#dc2626' : '#059669' }};"
                            onmouseover="this.style.background='{{ $user->status === 'active' ? '#fee2e2' : '#d1fae5' }}'"
                            onmouseout="this.style.background='{{ $user->status === 'active' ? '#fef2f2' : '#ecfdf5' }}'">
                        {{ $user->status === 'active' ? '🚫 Suspend Account' : '✅ Activate Account' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div id="resetPasswordModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 16px; padding: 32px; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="margin: 0; font-weight: 800; color: #1e293b; font-size: 20px;">🔑 Reset Password</h3>
                <button type="button" onclick="closeResetPasswordModal()" style="background: none; border: none; font-size: 24px; color: #64748b; cursor: pointer; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='none'">✕</button>
            </div>

            <div style="background: #fef3c7; border: 1px solid #fcd34d; border-left: 4px solid #f59e0b; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                <p style="margin: 0; font-size: 14px; color: #92400e; line-height: 1.6;">
                    <strong>⚠️ Important:</strong> This will immediately reset the password for <strong>{{ $user->name }}</strong>. The customer will need to use the new password to log in.
                </p>
            </div>

            <form action="{{ route('admin.customers.reset-password', $user->id) }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 8px; font-size: 14px;">
                        New Password <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="password" name="password" required minlength="8"
                           placeholder="Enter new password (min 8 characters)"
                           style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 8px; font-size: 14px;">
                        Confirm Password <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="password" name="password_confirmation" required minlength="8"
                           placeholder="Confirm new password"
                           style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" onclick="closeResetPasswordModal()" style="background: #f1f5f9; color: #475569; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; border: none;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                        Cancel
                    </button>
                    <button type="submit" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; border: none; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'">
                        🔑 Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openResetPasswordModal() {
            document.getElementById('resetPasswordModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeResetPasswordModal() {
            document.getElementById('resetPasswordModal').style.display = 'none';
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        document.getElementById('resetPasswordModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeResetPasswordModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeResetPasswordModal();
            }
        });
    </script>
</div>
@endsection
