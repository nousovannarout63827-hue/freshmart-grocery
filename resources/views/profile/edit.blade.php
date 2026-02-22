@extends('layouts.admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 24px; font-weight: 900; color: #1e293b; margin: 0;">
            ⚙️ My Account Settings
        </h1>
        <p style="font-size: 14px; color: #64748b; margin: 5px 0 0;">Manage your profile details and security preferences.</p>
    </div>

    @if(session('success'))
        <div class="alert-success" style="background: #f0fdf4; border: 2px solid #22c55e; color: #15803d; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 14px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.style.display='none';" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 18px; color: #15803d;">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error" style="background: #fef2f2; border: 2px solid #ef4444; color: #dc2626; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 14px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            <button type="button" onclick="this.parentElement.style.display='none';" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 18px; color: #dc2626;">&times;</button>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 25px;">
        
        {{-- Profile Information Card --}}
        <div class="profile-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div class="card-header" style="background: white; border-bottom: 1px solid #f1f5f9; padding: 20px 25px;">
                <h2 style="font-size: 18px; font-weight: 900; color: #1e293b; margin: 0;">👤 Profile Information</h2>
            </div>
            <div class="card-body" style="padding: 30px 25px;">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Profile Photo Upload --}}
                    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 25px;">
                        <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 3px solid #e2e8f0; flex-shrink: 0;">
                            @if($user->avatar ?? $user->profile_photo_path)
                                <img src="{{ asset('storage/' . ($user->avatar ?? $user->profile_photo_path)) }}" alt="{{ $user->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 36px; color: #94a3b8; font-weight: 800;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="photo-upload" class="btn-upload" 
                                   style="background: #3b82f6; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-block;"
                                   onmouseover="this.style.background='#2563eb';"
                                   onmouseout="this.style.background='#3b82f6';">
                                📸 Change Photo
                            </label>
                            <input type="file" name="photo" id="photo-upload" style="display: none;" accept="image/*" onchange="this.form.submit()">
                            <p style="font-size: 12px; color: #94a3b8; margin: 8px 0 0;">Click to choose image. Max 2MB.</p>
                        </div>
                    </div>

                    {{-- Full Name --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Full Name
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                               onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                               required>
                    </div>

                    {{-- Email Address --}}
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Email Address
                        </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                               onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                               required>
                    </div>

                    <button type="submit" 
                            style="width: 100%; background: #3b82f6; color: white; border: none; padding: 14px 20px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; text-transform: uppercase; letter-spacing: 0.5px;"
                            onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)';"
                            onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        💾 Save Profile Info
                    </button>
                </form>
            </div>
        </div>

        {{-- Password Change Card --}}
        <div class="profile-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div class="card-header" style="background: white; border-bottom: 1px solid #f1f5f9; padding: 20px 25px;">
                <h2 style="font-size: 18px; font-weight: 900; color: #1e293b; margin: 0;">🔐 Update Password</h2>
            </div>
            <div class="card-body" style="padding: 30px 25px;">
                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Current Password --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Current Password
                        </label>
                        <input type="password" name="current_password" 
                               style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                               onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                               required>
                        @error('current_password')
                            <p style="color: #ef4444; font-size: 12px; margin: 5px 0 0;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                            New Password
                        </label>
                        <input type="password" name="password" 
                               style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                               onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                               required>
                        @error('password')
                            <p style="color: #ef4444; font-size: 12px; margin: 5px 0 0;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Confirm New Password
                        </label>
                        <input type="password" name="password_confirmation" 
                               style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                               onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                               required>
                    </div>

                    <button type="submit" 
                            style="width: 100%; background: #1e293b; color: white; border: none; padding: 14px 20px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; text-transform: uppercase; letter-spacing: 0.5px;"
                            onmouseover="this.style.background='#0f172a'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(30,41,59,0.3)';"
                            onmouseout="this.style.background='#1e293b'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        🔒 Update Password
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- My Recent Activity Section --}}
    @if(isset($recentActivities) && $recentActivities->count() > 0)
        <div class="activity-section" style="margin-top: 30px;">
            <div class="card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: white; border-bottom: 1px solid #f1f5f9; padding: 20px 25px;">
                    <h2 style="font-size: 18px; font-weight: 900; color: #1e293b; margin: 0;">📜 My Recent Activity</h2>
                    <p style="font-size: 13px; color: #64748b; margin: 5px 0 0;">Your last 10 actions in the system.</p>
                </div>
                <div class="card-body" style="padding: 0;">
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <tr>
                                    <th style="padding: 15px 25px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Timestamp</th>
                                    <th style="padding: 15px 25px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Action</th>
                                    <th style="padding: 15px 25px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentActivities as $log)
                                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='white';">
                                        <td style="padding: 15px 25px; font-size: 13px; color: #64748b; white-space: nowrap;">
                                            {{ $log->created_at->format('M d, Y h:i A') }}
                                        </td>
                                        <td style="padding: 15px 25px;">
                                            @php
                                                $badgeColor = match($log->action) {
                                                    'Created' => '#22c55e',
                                                    'Updated' => '#3b82f6',
                                                    'Deleted' => '#ef4444',
                                                    default => '#64748b'
                                                };
                                            @endphp
                                            <span style="background: {{ $badgeColor }}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; display: inline-block; min-width: 70px; text-align: center;">
                                                {{ $log->action }}
                                            </span>
                                            <span style="background: #f1f5f9; color: #475569; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; display: inline-block; margin-left: 8px;">
                                                {{ $log->module }}
                                            </span>
                                        </td>
                                        <td style="padding: 15px 25px; font-size: 14px; color: #334155; font-weight: 500;">
                                            {{ $log->description }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
