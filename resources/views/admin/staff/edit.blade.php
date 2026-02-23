@extends('layouts.admin')

@section('content')
<style>
    .staff-edit-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 32px;
        background: #f8fafc;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 2px solid #e2e8f0;
    }

    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-subtitle {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #475569;
    }

    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 600;
        font-size: 14px;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert-success {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border: 2px solid #22c55e;
        color: #15803d;
    }

    .alert-error {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border: 2px solid #ef4444;
        color: #dc2626;
    }

    .alert-validation {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border: 2px solid #ef4444;
        color: #b91c1c;
    }

    .alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 20px;
        opacity: 0.6;
        transition: opacity 0.2s;
    }

    .alert-close:hover {
        opacity: 1;
    }

    .edit-grid {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 24px;
    }

    @media (max-width: 900px) {
        .edit-grid {
            grid-template-columns: 1fr;
        }
    }

    .profile-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        border: 1px solid #e2e8f0;
    }

    .profile-header {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        padding: 32px 24px;
        text-align: center;
    }

    .profile-avatar-container {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        margin: 0 auto 16px;
        border: 5px solid white;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        overflow: hidden;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .profile-avatar-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-avatar-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 800;
        color: white;
        background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
    }

    .profile-avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
        cursor: pointer;
    }

    .profile-avatar-container:hover .profile-avatar-overlay {
        opacity: 1;
    }

    .profile-avatar-overlay-text {
        color: white;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        padding: 0 10px;
    }

    .profile-name {
        font-size: 22px;
        font-weight: 700;
        color: white;
        margin: 0 0 6px 0;
    }

    .profile-email {
        font-size: 14px;
        color: rgba(255,255,255,0.9);
        margin: 0 0 12px 0;
    }

    .profile-role-badge {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .profile-body {
        padding: 24px;
    }

    .profile-stat {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .profile-stat:last-child {
        border-bottom: none;
    }

    .profile-stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    .profile-stat-value {
        font-size: 13px;
        color: #1e293b;
        font-weight: 700;
        text-align: right;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        border: 1px solid #e2e8f0;
    }

    .form-section {
        margin-bottom: 32px;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 16px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e2e8f0;
    }

    .form-section-description {
        font-size: 13px;
        color: #64748b;
        margin: 5px 0 15px 0;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    @media (max-width: 600px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
        box-sizing: border-box;
        font-family: inherit;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    .form-input:disabled {
        background: #f8fafc;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .form-select {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 20px;
        padding-right: 44px;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .permissions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
    }

    .permission-card {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px;
        background: #f8fafc;
        transition: all 0.2s;
        cursor: pointer;
    }

    .permission-card:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .permission-card.checked {
        border-color: #3b82f6;
        background: #dbeafe;
    }

    .permission-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .permission-checkbox {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #3b82f6;
    }

    .permission-label {
        font-weight: 700;
        color: #334155;
        cursor: pointer;
        margin: 0;
        flex: 1;
        font-size: 14px;
    }

    .permission-description {
        font-size: 12px;
        color: #64748b;
        margin-left: 32px;
        line-height: 1.4;
    }

    .password-reset-card {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border: 2px solid #fde68a;
        border-radius: 14px;
        padding: 24px;
        margin-top: 24px;
    }

    .password-reset-title {
        font-weight: 800;
        color: #b45309;
        margin: 0 0 8px 0;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .password-reset-description {
        font-size: 13px;
        color: #d97706;
        margin: 0 0 16px 0;
        line-height: 1.5;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 2px solid #e2e8f0;
    }

    .btn-primary {
        flex: 1;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(59,130,246,0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59,130,246,0.4);
    }

    .btn-secondary {
        flex: 1;
        background: #f1f5f9;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        border-color: #cbd5e1;
        color: #475569;
    }

    .photo-upload-container {
        text-align: center;
        margin-bottom: 24px;
    }

    .photo-upload-wrapper {
        position: relative;
        display: inline-block;
    }

    .photo-preview {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 4px solid #e2e8f0;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview-placeholder {
        font-size: 48px;
        color: #cbd5e1;
    }

    .photo-upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #1e293b;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .photo-upload-btn:hover {
        background: #0f172a;
        transform: translateY(-1px);
    }

    .photo-upload-hint {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 8px;
    }
</style>

<div class="staff-edit-container" enctype="multipart/form-data">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <span>✏️</span> Edit Team Member
            </h1>
            <p class="page-subtitle">Update staff information, role, and permissions</p>
        </div>

        <a href="{{ route('admin.staff.index') }}" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to List
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 22px; height: 22px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.style.display='none';" class="alert-close">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 22px; height: 22px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span>{{ session('error') }}</span>
            <button type="button" onclick="this.parentElement.style.display='none';" class="alert-close">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-validation">
            <div style="flex: 1;">
                <strong style="display: block; margin-bottom: 8px; font-weight: 700;">⚠️ Validation Errors:</strong>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom: 4px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" onclick="this.parentElement.style.display='none';" class="alert-close">&times;</button>
        </div>
    @endif

    <form action="{{ route('admin.staff.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="edit-grid">

            <!-- Profile Photo Card (Left Sidebar) -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar-container">
                        @if($user->avatar ?? $user->profile_photo_path)
                            <img id="avatar-preview" src="{{ asset('storage/' . ($user->avatar ?? $user->profile_photo_path)) }}"
                                 alt="{{ $user->name }}"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif
                        <div class="profile-avatar-placeholder" id="avatar-placeholder" style="display: {{ ($user->avatar ?? $user->profile_photo_path) ? 'none' : 'flex' }};">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <label for="photo-upload" class="profile-avatar-overlay">
                            <span class="profile-avatar-overlay-text">📷<br>Change Photo</span>
                        </label>
                    </div>
                    <h2 class="profile-name" id="name-display">{{ $user->name }}</h2>
                    <p class="profile-email">{{ $user->email }}</p>
                    <span class="profile-role-badge" id="role-badge">
                        {{ $user->role == 'driver' ? '🚚 Driver' : '🏬 Store Staff' }}
                    </span>
                </div>

                <div class="profile-body">
                    <div class="profile-stat">
                        <span class="profile-stat-label">Member Since</span>
                        <span class="profile-stat-value">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="profile-stat">
                        <span class="profile-stat-label">Last Login</span>
                        <span class="profile-stat-value">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</span>
                    </div>
                    <div class="profile-stat">
                        <span class="profile-stat-label">Status</span>
                        <span class="profile-stat-value" style="color: {{ $user->status === 'active' ? '#16a34a' : '#dc2626' }};">
                            {{ ucfirst($user->status ?? 'active') }}
                        </span>
                    </div>
                    <div class="profile-stat">
                        <span class="profile-stat-label">Phone</span>
                        <span class="profile-stat-value" id="phone-display">{{ $user->phone_number ?? 'Not set' }}</span>
                    </div>
                </div>
            </div>

            <!-- Main Form (Right Side) -->
            <div class="form-card">

                <!-- Profile Photo Upload Section -->
                <div class="photo-upload-container">
                    <div class="photo-upload-wrapper">
                        <div class="photo-preview">
                            @if($user->avatar ?? $user->profile_photo_path)
                                <img id="photo-preview-img" src="{{ asset('storage/' . ($user->avatar ?? $user->profile_photo_path)) }}" alt="Profile Photo">
                            @else
                                <span class="photo-preview-placeholder">📷</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <label for="photo-upload" class="photo-upload-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Upload Profile Photo
                    </label>
                    <input type="file" name="photo" id="photo-upload" accept="image/*" style="display: none;" onchange="previewPhoto(event)">
                    <p class="photo-upload-hint">JPEG, PNG, GIF • Max 2MB</p>
                </div>

                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <span>👤</span> Basic Information
                    </h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Full Name <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-input" required onchange="updateNameDisplay(this.value)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email" value="{{ $user->email }}" disabled class="form-input">
                            <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">
                                🔒 Email cannot be changed for security reasons.
                            </small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-input" placeholder="e.g. 012 345 678" onchange="updatePhoneDisplay(this.value)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Assign Role <span class="required">*</span></label>
                            <select name="role" class="form-input form-select" onchange="updateRoleBadge(this.value)">
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>🏬 Store Staff</option>
                                <option value="driver" {{ $user->role == 'driver' ? 'selected' : '' }}>🚚 Delivery Driver</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-input form-select">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" value="{{ $user->dob }}" class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Place of Birth</label>
                        <input type="text" name="pob" value="{{ $user->pob }}" class="form-input" placeholder="e.g. Phnom Penh, Cambodia">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Current Address</label>
                        <textarea name="current_address" class="form-textarea" placeholder="Enter full address...">{{ $user->current_address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bio / Description</label>
                        <textarea name="bio" class="form-textarea" placeholder="Brief background or notes about this staff member...">{{ $user->bio }}</textarea>
                    </div>
                </div>

                <!-- Access Permissions -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <span>🔐</span> Access Permissions
                    </h3>
                    <p class="form-section-description">Control which modules this staff member can access</p>

                    @php
                        $userPerms = is_array($user->permissions) ? $user->permissions : [];
                    @endphp

                    <div class="permissions-grid">
                        @php
                            $permissions = [
                                ['value' => 'manage_inventory', 'label' => '📦 Manage Inventory', 'desc' => 'Can add, edit, and trash products'],
                                ['value' => 'manage_categories', 'label' => '📁 Manage Categories', 'desc' => 'Can create and rename categories'],
                                ['value' => 'manage_staff', 'label' => '👥 Manage Staff', 'desc' => 'Can add users and change roles'],
                                ['value' => 'manage_orders', 'label' => '🛒 Manage Orders', 'desc' => 'Can view and update customer orders'],
                                ['value' => 'view_reports', 'label' => '📊 View Reports', 'desc' => 'Can access analytics and reports'],
                                ['value' => 'manage_coupons', 'label' => '🎫 Manage Coupons', 'desc' => 'Can create and manage discount codes'],
                            ];
                        @endphp

                        @foreach($permissions as $perm)
                            <label class="permission-card {{ in_array($perm['value'], $userPerms) ? 'checked' : '' }}">
                                <div class="permission-header">
                                    <input type="checkbox" name="permissions[]" value="{{ $perm['value'] }}"
                                           class="permission-checkbox"
                                           {{ in_array($perm['value'], $userPerms) ? 'checked' : '' }}
                                           onchange="this.closest('.permission-card').classList.toggle('checked', this.checked)">
                                    <span class="permission-label">{{ $perm['label'] }}</span>
                                </div>
                                <div class="permission-description">{{ $perm['desc'] }}</div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Password Reset Section -->
                <div class="password-reset-card">
                    <h4 class="password-reset-title">
                        <span>🔑</span> Emergency Password Reset
                    </h4>
                    <p class="password-reset-description">
                        Only use this if the staff member has forgotten their password. Leave blank to keep current password.
                    </p>

                    <input type="password" name="password" placeholder="Enter new temporary password (minimum 8 characters)..." class="form-input" minlength="8">

                    <small style="color: #92400e; font-size: 12px; margin-top: 10px; display: block; font-weight: 600;">
                        💡 The staff member can change this password later in their profile settings.
                    </small>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        💾 Update Staff Details
                    </button>
                    <a href="{{ route('admin.staff.index') }}" class="btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </form>

</div>

<script>
    // Preview photo before upload
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size exceeds 2MB. Please choose a smaller image.');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const imageUrl = e.target.result;
                
                // Update preview in photo upload section
                const photoPreviewContainer = document.querySelector('.photo-preview');
                if (photoPreviewContainer) {
                    // Remove existing img or placeholder
                    photoPreviewContainer.innerHTML = '';
                    // Create new img element
                    const newImg = document.createElement('img');
                    newImg.id = 'photo-preview-img';
                    newImg.src = imageUrl;
                    newImg.alt = 'Profile Photo';
                    newImg.style.cssText = 'width: 100%; height: 100%; object-fit: cover;';
                    photoPreviewContainer.appendChild(newImg);
                }

                // Update avatar in profile card
                const avatarContainer = document.querySelector('.profile-avatar-container');
                if (avatarContainer) {
                    // Remove existing img or placeholder (but keep overlay)
                    const existingImg = document.getElementById('avatar-preview');
                    const existingPlaceholder = document.getElementById('avatar-placeholder');
                    if (existingImg) existingImg.remove();
                    if (existingPlaceholder) existingPlaceholder.remove();
                    
                    // Create new img element
                    const newAvatarImg = document.createElement('img');
                    newAvatarImg.id = 'avatar-preview';
                    newAvatarImg.src = imageUrl;
                    newAvatarImg.alt = '{{ $user->name }}';
                    newAvatarImg.style.cssText = 'width: 100%; height: 100%; object-fit: cover;';
                    newAvatarImg.onerror = function() {
                        this.style.display = 'none';
                        this.nextElementSibling.style.display = 'flex';
                    };
                    
                    // Insert before the overlay
                    const overlay = document.querySelector('.profile-avatar-overlay');
                    avatarContainer.insertBefore(newAvatarImg, overlay);
                }
            }
            reader.readAsDataURL(file);
        }
    }

    // Update name display in profile card
    function updateNameDisplay(name) {
        const nameDisplay = document.getElementById('name-display');
        if (nameDisplay) {
            nameDisplay.textContent = name;
        }
    }

    // Update phone display in profile card
    function updatePhoneDisplay(phone) {
        const phoneDisplay = document.getElementById('phone-display');
        if (phoneDisplay) {
            phoneDisplay.textContent = phone || 'Not set';
        }
    }

    // Update role badge in profile card
    function updateRoleBadge(role) {
        const roleBadge = document.getElementById('role-badge');
        if (roleBadge) {
            const badges = {
                'staff': '🏬 Store Staff',
                'driver': '🚚 Driver',
                'admin': '👑 Admin'
            };
            roleBadge.textContent = badges[role] || '🏬 Store Staff';
        }
    }
</script>
@endsection
