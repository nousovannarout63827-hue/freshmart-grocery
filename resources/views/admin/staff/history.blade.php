@extends('layouts.admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box;">

    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 900; color: #1e293b; margin: 0;">
                📜 Role History
            </h1>
            <p style="font-size: 14px; color: #64748b; margin: 5px 0 0;">
                Activity log for: <strong style="color: #1e293b;">{{ $user->name }}</strong> ({{ $user->email }})
            </p>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.staff.index') }}" 
               style="background: #f1f5f9; color: #64748b; border: 2px solid #e2e8f0; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;"
               onmouseover="this.style.background='#e2e8f0'; this.style.borderColor='#cbd5e1';"
               onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#e2e8f0';">
                ← Back to Staff
            </a>
        </div>
    </div>

    {{-- User Info Card --}}
    <div style="background: white; border-radius: 15px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; gap: 20px;">
            @if($user->avatar ?? $user->profile_photo_path)
                <img src="{{ asset('storage/' . ($user->avatar ?? $user->profile_photo_path)) }}" alt="{{ $user->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #e2e8f0;">
            @else
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 32px; border: 3px solid #e2e8f0;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div style="flex: 1;">
                <h2 style="margin: 0; font-size: 20px; font-weight: 900; color: #1e293b;">{{ $user->name }}</h2>
                <p style="margin: 5px 0 0; color: #64748b; font-size: 14px;">{{ $user->email }}</p>
                <div style="margin-top: 10px;">
                    <span style="background: {{ $user->role == 'driver' ? '#fffbeb' : '#eff6ff' }}; color: {{ $user->role == 'driver' ? '#d97706' : '#2563eb' }}; padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1px solid {{ $user->role == 'driver' ? '#fde68a' : '#bfdbfe' }};">
                        {{ $user->role == 'driver' ? '🚚 Delivery Driver' : '🏬 Store Staff' }}
                    </span>
                    <span style="margin-left: 10px; color: #64748b; font-size: 13px;">
                        📅 Joined {{ $user->created_at->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Activity Timeline --}}
    @if($histories->count() > 0)
        <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 20px; font-size: 18px; font-weight: 900; color: #1e293b; display: flex; align-items: center; gap: 10px;">
                📋 Role Change History
                <span style="background: #06b6d4; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">{{ $histories->count() }}</span>
            </h3>
            
            <div style="position: relative;">
                {{-- Timeline line --}}
                <div style="position: absolute; left: 20px; top: 0; bottom: 0; width: 2px; background: #e2e8f0;"></div>
                
                @foreach($histories as $history)
                    <div style="position: relative; padding-left: 60px; margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #f1f5f9;">
                        {{-- Timeline dot --}}
                        <div style="position: absolute; left: 12px; top: 5px; width: 18px; height: 18px; border-radius: 50%; background: #06b6d4; border: 3px solid white; box-shadow: 0 0 0 2px #06b6d4;"></div>
                        
                        <div style="background: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                                <div>
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                        <span style="background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                                            {{ ucwords(str_replace('_', ' ', $history->old_role)) }}
                                        </span>
                                        <span style="color: #94a3b8; font-size: 16px;">→</span>
                                        <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                                            {{ ucwords(str_replace('_', ' ', $history->new_role)) }}
                                        </span>
                                    </div>
                                    
                                    @if($history->reason)
                                        <p style="margin: 0; color: #64748b; font-size: 14px; font-style: italic;">
                                            "📝 {{ $history->reason }}"
                                        </p>
                                    @endif
                                </div>
                                
                                <div style="text-align: right;">
                                    <div style="font-size: 12px; color: #64748b; margin-bottom: 5px;">
                                        {{ $history->created_at->format('M d, Y') }}
                                    </div>
                                    <div style="font-size: 11px; color: #94a3b8;">
                                        {{ $history->created_at->format('h:i A') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div style="display: flex; align-items: center; gap: 10px; padding-top: 15px; border-top: 1px solid #e2e8f0;">
                                <span style="font-size: 12px; color: #64748b;">Changed by:</span>
                                @if($history->changedBy)
                                    <span style="font-weight: 600; color: #1e293b; font-size: 13px;">
                                        {{ $history->changedBy->name }}
                                    </span>
                                    <span style="background: #dbeafe; color: #1e40af; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">
                                        👤 Admin
                                    </span>
                                @else
                                    <span style="font-size: 12px; color: #94a3b8;">Unknown Admin</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div style="background: white; border-radius: 15px; padding: 60px 20px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div style="font-size: 64px; margin-bottom: 20px;">📭</div>
            <h3 style="margin: 0 0 10px; font-size: 18px; font-weight: 900; color: #1e293b;">No Role Changes Yet</h3>
            <p style="color: #64748b; font-size: 14px; margin: 0;">This staff member hasn't had any role changes recorded.</p>
            <a href="{{ route('admin.staff.index') }}" 
               style="display: inline-block; margin-top: 20px; background: #3b82f6; color: white; padding: 12px 25px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.2s;"
               onmouseover="this.style.background='#2563eb';"
               onmouseout="this.style.background='#3b82f6';">
                ← Back to Staff List
            </a>
        </div>
    @endif
</div>
@endsection
