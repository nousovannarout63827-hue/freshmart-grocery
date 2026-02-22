@extends('layouts.admin')

@section('content')
<div style="padding: 24px; background: #f8fafc; min-height: 100vh;">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; font-size: 28px; margin-bottom: 8px;">👥 Customer Management</h2>
            <p style="color: #64748b; font-size: 14px;">Manage registered customers and their access</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 12px 20px; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                <div style="font-size: 12px; opacity: 0.9;">Total Customers</div>
                <div style="font-size: 24px;">{{ $totalCustomers }}</div>
            </div>
            <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 12px 20px; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                <div style="font-size: 12px; opacity: 0.9;">Active</div>
                <div style="font-size: 24px;">{{ $activeCustomers }}</div>
            </div>
        </div>
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

    @if(session('error'))
        <div style="background: #fef2f2; border: 1px solid #ef4444; color: #dc2626; padding: 16px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Customers Table -->
    <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #f1f5f9;">
        <!-- Filter Bar -->
        <div style="padding: 20px; border-bottom: 1px solid #f1f5f9; background: #f8fafc;">
            <form action="{{ route('admin.customers.index') }}" method="GET" style="display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 150px;">
                    <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">Customer ID</label>
                    <input type="number" name="id" value="{{ request('id') }}" placeholder="e.g. 5" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 14px; box-sizing: border-box;">
                </div>
                <div style="flex: 2; min-width: 200px;">
                    <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">Name or Email</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 14px; box-sizing: border-box;">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">Status</label>
                    <select name="status" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 14px; background: white; cursor: pointer; box-sizing: border-box;">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="disabled" {{ request('status') == 'disabled' ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button type="submit" style="background: #1e293b; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 14px; transition: 0.2s;" onmouseover="this.style.background='#0f172a'" onmouseout="this.style.background='#1e293b'">
                        🔍 Search
                    </button>
                    <a href="{{ route('admin.customers.index') }}" style="background: white; color: #475569; text-decoration: none; padding: 10px 16px; border-radius: 8px; font-weight: 700; font-size: 14px; transition: 0.2s; border: 1px solid #cbd5e1; display: inline-flex; align-items: center;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">
                        ✕ Clear
                    </a>
                </div>
            </form>
        </div>

        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                <tr>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">ID</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Customer</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Email</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Phone</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Joined Date</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Status</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 16px 24px;">
                        <span style="font-weight: 800; color: #64748b; font-size: 13px;">#{{ $customer->id }}</span>
                    </td>
                    <td style="padding: 16px 24px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            @if($customer->avatar)
                                <img src="{{ asset('storage/' . $customer->avatar) }}" alt="{{ $customer->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #e2e8f0;">
                            @else
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; flex-shrink: 0;">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div style="font-weight: 600; color: #1e293b;">{{ $customer->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 16px 24px; color: #64748b;">{{ $customer->email }}</td>
                    <td style="padding: 16px 24px; color: #64748b;">{{ $customer->phone_number ?? '-' }}</td>
                    <td style="padding: 16px 24px; color: #64748b;">{{ $customer->created_at->format('M d, Y') }}</td>
                    <td style="padding: 16px 24px;">
                        @if($customer->status === 'active')
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
                    </td>
                    <td style="padding: 16px 24px; text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
                            <a href="{{ route('admin.customers.show', $customer->id) }}" 
                               style="text-decoration: none; color: #2563eb; font-weight: 600; font-size: 13px; padding: 8px 12px; background: #eff6ff; border-radius: 8px; transition: background 0.2s;"
                               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                                View
                            </a>
                            
                            <form action="{{ route('admin.customers.toggle', $customer->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" 
                                        style="background: none; border: none; color: {{ $customer->status === 'active' ? '#dc2626' : '#059669' }}; font-weight: 700; font-size: 13px; padding: 8px 12px; border-radius: 8px; cursor: pointer; transition: background 0.2s;"
                                        onmouseover="this.style.background='{{ $customer->status === 'active' ? '#fef2f2' : '#ecfdf5' }}'" 
                                        onmouseout="this.style.background='transparent'">
                                    {{ $customer->status === 'active' ? 'Suspend' : 'Activate' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 48px 24px; text-align: center;">
                        <div style="color: #94a3b8; font-size: 16px;">No customers found</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($customers->hasPages())
    <div style="margin-top: 24px;">
        {{ $customers->links('vendor.pagination.tailwind') }}
    </div>
    @endif
</div>
@endsection
