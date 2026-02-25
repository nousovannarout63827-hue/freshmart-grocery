@extends('layouts.admin')

@section('content')
<style>
.activity-logs-page {
    padding: 32px;
    box-sizing: border-box;
    background: #f1f5f9;
    min-height: 100vh;
}

@media (max-width: 768px) {
    .activity-logs-page {
        padding: 16px !important;
    }

    .activity-logs-header {
        flex-direction: column !important;
        gap: 12px !important;
    }

    .activity-logs-header h1 {
        font-size: 20px !important;
    }

    .activity-logs-header p {
        font-size: 13px !important;
    }

    .filter-form {
        flex-direction: column !important;
        gap: 12px !important;
    }

    .filter-form > div {
        width: 100% !important;
        flex: none !important;
        min-width: auto !important;
    }

    .filter-form input,
    .filter-form select {
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .filter-buttons {
        width: 100% !important;
        justify-content: stretch !important;
        margin-left: 0 !important;
    }

    .filter-buttons button,
    .filter-buttons a {
        flex: 1 !important;
        justify-content: center !important;
    }

    .table-wrapper {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
    }

    .activity-logs-table {
        min-width: 900px !important;
    }

    .logs-card {
        border-radius: 12px !important;
    }
}

@media (max-width: 375px) {
    .activity-logs-page {
        padding: 12px !important;
    }

    .activity-logs-header h1 {
        font-size: 18px !important;
    }

    .filter-form label {
        font-size: 10px !important;
    }

    .filter-form input,
    .filter-form select {
        font-size: 12px !important;
        padding: 8px 10px !important;
    }
}
</style>

<div class="activity-logs-page" style="padding: 32px; box-sizing: border-box; background: #f1f5f9; min-height: 100vh;">

    <!-- Page Header -->
    <div class="activity-logs-header" style="margin-bottom: 32px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 900; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 32px;">👁️</span>
                    System Audit Logs
                </h1>
                <p style="font-size: 14px; color: #64748b; margin: 8px 0 0;">Track and monitor all user activities across the system</p>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div style="background: white; border-radius: 16px; padding: 20px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <form class="filter-form" action="{{ route('admin.activity_logs.index') }}" method="GET" style="display: flex; gap: 24px; flex-wrap: wrap; align-items: flex-end;">

            <div style="flex: 0 0 120px;">
                <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">📅 Date</label>
                <input type="date" name="date" value="{{ request('date') }}" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='white'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
            </div>

            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">👤 User</label>
                <select name="user_id" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc; cursor: pointer;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='white'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="flex: 0 0 100px;">
                <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">🎭 Role</label>
                <select name="role" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc; cursor: pointer;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='white'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <option value="">All</option>
                    <option value="driver" {{ request('role') == 'driver' ? 'selected' : '' }}>Driver</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
            </div>

            <div style="flex: 0 0 110px;">
                <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">📁 Module</label>
                <select name="module" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc; cursor: pointer;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='white'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <option value="">All</option>
                    @if(isset($modules))
                        @foreach($modules as $mod)
                            <option value="{{ $mod }}" {{ request('module') == $mod ? 'selected' : '' }}>{{ $mod }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div style="flex: 0 0 110px;">
                <label style="display: block; font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">⚡ Action</label>
                <select name="action" style="width: 100%; padding: 8px 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; background: #f8fafc; cursor: pointer;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='white'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <option value="">All</option>
                    @if(isset($actions))
                        @foreach($actions as $act)
                            <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ $act }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div style="display: flex; gap: 6px; flex-shrink: 0; margin-left: auto;">
                <button type="submit" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                    🔍 Filter
                </button>
                <a href="{{ route('admin.activity_logs.index') }}" style="background: white; color: #64748b; border: 1px solid #e2e8f0; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12px; text-decoration: none; display: flex; align-items: center; gap: 4px; transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                    🔄 Reset
                </a>
            </div>

        </form>
    </div>

    <!-- Activity Table -->
    <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div class="table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table class="activity-logs-table" style="width: 100%; border-collapse: collapse;">
            <thead style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); border-bottom: 2px solid #e2e8f0;">
                <tr>
                    <th style="padding: 18px 24px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline; vertical-align: middle; margin-right: 6px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Timestamp
                    </th>
                    <th style="padding: 18px 24px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline; vertical-align: middle; margin-right: 6px;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        User
                    </th>
                    <th style="padding: 18px 24px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline; vertical-align: middle; margin-right: 6px;">
                            <polyline points="13 2 13 9 20 9"></polyline>
                            <path d="M13 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                        </svg>
                        Action
                    </th>
                    <th style="padding: 18px 24px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline; vertical-align: middle; margin-right: 6px;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Description
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                        <td style="padding: 18px 24px; vertical-align: top;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $log->created_at->format('M d, Y') }}</div>
                            <div style="font-size: 12px; color: #94a3b8; margin-top: 4px; display: flex; align-items: center; gap: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {{ $log->created_at->format('h:i A') }}
                            </div>
                        </td>

                        <td style="padding: 18px 24px; vertical-align: top;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                @if($log->user && ($log->user->avatar ?? $log->user->profile_photo_path))
                                    <img src="{{ asset('storage/' . ($log->user->avatar ?? $log->user->profile_photo_path)) }}"
                                         alt="{{ $log->user->name ?? 'User' }}"
                                         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); flex-shrink: 0;">
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, {{ $log->user && $log->user->role === 'driver' ? '#3b82f6, #2563eb' : '#10b981, #059669' }}); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); flex-shrink: 0;">
                                        {{ strtoupper(substr($log->user->name ?? '?', 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div style="font-weight: 700; color: #334155; font-size: 14px;">
                                        {{ $log->user->name ?? 'Unknown User' }}
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 6px; margin-top: 4px;">
                                        @php
                                            $roleBadge = [
                                                'driver' => ['bg' => '#dbeafe', 'text' => '#1d4ed8', 'icon' => '🚚'],
                                                'admin' => ['bg' => '#fee2e2', 'text' => '#991b1b', 'icon' => '👤'],
                                                'staff' => ['bg' => '#fef3c7', 'text' => '#92400e', 'icon' => '📦'],
                                            ];
                                            $role = strtolower($log->user->role ?? 'system');
                                            $badge = $roleBadge[$role] ?? ['bg' => '#f1f5f9', 'text' => '#64748b', 'icon' => '👤'];
                                        @endphp
                                        <span style="background: {{ $badge['bg'] }}; color: {{ $badge['text'] }}; padding: 3px 8px; border-radius: 6px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                                            {{ $badge['icon'] }} {{ ucfirst($log->user->role ?? 'System') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td style="padding: 18px 24px; vertical-align: top;">
                            @php
                                $actionColors = [
                                    'Created' => '#10b981',
                                    'Updated' => '#3b82f6',
                                    'Deleted' => '#ef4444',
                                    'Restored' => '#8b5cf6',
                                    'Accepted Order' => '#3b82f6',
                                    'Picked Up Order' => '#f59e0b',
                                    'Arrived at Customer' => '#8b5cf6',
                                    'Delivered Order' => '#10b981',
                                    'Cancelled' => '#ef4444',
                                ];
                                $color = $actionColors[$log->action] ?? '#64748b';
                            @endphp
                            <span style="background: {{ $color }}15; color: {{ $color }}; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">
                                {{ $log->action }}
                            </span>
                            @if($log->module)
                                <div style="margin-top: 8px;">
                                    <span style="background: #f1f5f9; color: #64748b; padding: 3px 8px; border-radius: 6px; font-size: 10px; font-weight: 600; text-transform: uppercase;">
                                        {{ $log->module }}
                                    </span>
                                </div>
                            @endif
                        </td>

                        <td style="padding: 18px 24px; vertical-align: top;">
                            <div style="font-size: 13px; color: #475569; line-height: 1.6;">{{ $log->description }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 60px 24px; text-align: center;">
                            <div style="font-size: 48px; margin-bottom: 16px;">📋</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 16px; margin-bottom: 8px;">No Activity Logs Found</div>
                            <div style="color: #94a3b8; font-size: 14px;">No activities match your current filters</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    @if($logs->hasPages())
        <div style="margin-top: 24px; display: flex; justify-content: center;">
            {{ $logs->links() }}
        </div>
    @endif

</div>
@endsection
