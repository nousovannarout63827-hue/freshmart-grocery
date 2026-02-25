@extends('layouts.driver')

@section('page-title', 'Driver Profile')
@section('page-subtitle', 'Manage your information, photo, and earnings history')

@php
    $avatarPath = $user->avatar ?? $user->profile_photo_path;
    $avatarUrl = $avatarPath ? asset('storage/' . $avatarPath) : null;
@endphp

@push('styles')
<style>
    .driver-profile-page {
        display: grid;
        gap: 14px;
    }

    .profile-alert {
        border-radius: 12px;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #991b1b;
        padding: 10px 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .profile-hero {
        border-radius: 18px;
        padding: 14px;
        background:
            radial-gradient(90% 100% at 100% -10%, rgba(249, 115, 22, 0.28), transparent 60%),
            linear-gradient(155deg, #1e3f8b 0%, #245cc1 82%);
        color: #ffffff;
        display: grid;
        gap: 12px;
        border: 1px solid rgba(255, 255, 255, 0.16);
        box-shadow: 0 18px 30px -24px rgba(14, 36, 81, 0.75);
    }

    .profile-hero-main {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-avatar {
        width: 64px;
        height: 64px;
        border-radius: 14px;
        overflow: hidden;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.18);
        display: grid;
        place-items: center;
        border: 1px solid rgba(255, 255, 255, 0.36);
        font-size: 24px;
        font-weight: 800;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .profile-name {
        margin: 0;
        font-size: 21px;
        font-weight: 800;
        letter-spacing: -0.2px;
    }

    .profile-role {
        margin: 4px 0 0;
        font-size: 12px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.82);
        text-transform: uppercase;
        letter-spacing: 0.45px;
    }

    .profile-meta {
        margin: 5px 0 0;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.82);
        line-height: 1.4;
    }

    .profile-kpis {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .profile-kpi {
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.28);
        background: rgba(255, 255, 255, 0.12);
        padding: 9px 10px;
    }

    .profile-kpi-label {
        margin: 0;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.35px;
        color: rgba(255, 255, 255, 0.76);
        font-weight: 700;
    }

    .profile-kpi-value {
        margin: 3px 0 0;
        font-size: 18px;
        line-height: 1.2;
        font-weight: 800;
    }

    .profile-grid {
        display: grid;
        gap: 12px;
    }

    .profile-card {
        border-radius: 14px;
        border: 1px solid #dce6f8;
        background: #ffffff;
        box-shadow: 0 16px 28px -28px rgba(19, 56, 117, 0.78);
        padding: 12px;
    }

    .profile-card-title {
        margin: 0 0 10px;
        font-size: 15px;
        color: #123266;
        font-weight: 800;
    }

    .profile-form {
        display: grid;
        gap: 10px;
    }

    .field-grid {
        display: grid;
        gap: 9px;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .field {
        display: grid;
        gap: 5px;
    }

    .field--full {
        grid-column: 1 / -1;
    }

    .field label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.35px;
        color: #51678f;
        font-weight: 700;
    }

    .field input,
    .field select,
    .field textarea {
        width: 100%;
        border: 1px solid #cedbf1;
        border-radius: 10px;
        padding: 9px 10px;
        font-size: 13px;
        color: #12284f;
        background: #f8fbff;
        outline: none;
    }

    .field textarea {
        resize: vertical;
        min-height: 80px;
    }

    .field input:focus,
    .field select:focus,
    .field textarea:focus {
        border-color: #89ade8;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    .btn-save {
        border: 1px solid transparent;
        border-radius: 10px;
        padding: 10px 12px;
        background: linear-gradient(135deg, #1f5ec6, #2563eb);
        color: #ffffff;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        width: 100%;
    }

    .photo-box {
        display: grid;
        gap: 10px;
    }

    .photo-preview {
        width: 110px;
        height: 110px;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #cfe0fb;
        background: #eff5ff;
        display: grid;
        place-items: center;
        font-size: 34px;
        color: #4769a7;
        font-weight: 800;
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .photo-input {
        font-size: 12px;
    }

    .earnings-list {
        display: grid;
        gap: 8px;
    }

    .earnings-row {
        border-radius: 10px;
        border: 1px solid #dce7fa;
        background: #f8fbff;
        padding: 9px 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .earnings-label {
        margin: 0;
        font-size: 11px;
        color: #4d648d;
        font-weight: 700;
    }

    .earnings-value {
        margin: 2px 0 0;
        font-size: 14px;
        color: #122a53;
        font-weight: 800;
    }

    .history-wrap {
        border: 1px solid #dce7f8;
        border-radius: 12px;
        padding: 10px;
        background: #fbfdff;
    }

    .history-scroll {
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .history-bars {
        min-width: 320px;
        display: grid;
        grid-template-columns: repeat(var(--bars), minmax(34px, 1fr));
        align-items: end;
        gap: 8px;
        height: 180px;
    }

    .history-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .history-bar {
        width: 100%;
        min-height: 5px;
        border-radius: 8px 8px 4px 4px;
        background: linear-gradient(180deg, #10b981, #0f766e);
        position: relative;
    }

    .history-amount {
        position: absolute;
        top: -17px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 9px;
        font-weight: 800;
        color: #0f5a51;
        white-space: nowrap;
    }

    .history-label {
        font-size: 10px;
        color: #4b648f;
        font-weight: 700;
        white-space: nowrap;
    }

    .recent-list {
        display: grid;
        gap: 8px;
    }

    .recent-item {
        border-radius: 10px;
        border: 1px solid #dce7fa;
        background: #f8fbff;
        padding: 9px 10px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: flex-start;
    }

    .recent-title {
        margin: 0;
        font-size: 12px;
        color: #122a53;
        font-weight: 800;
    }

    .recent-meta {
        margin: 2px 0 0;
        font-size: 10px;
        color: #5c7398;
        line-height: 1.35;
    }

    .recent-value {
        margin: 0;
        font-size: 13px;
        color: #0f766e;
        font-weight: 800;
        white-space: nowrap;
    }

    @media (min-width: 900px) {
        .profile-grid {
            grid-template-columns: 1.3fr 1fr;
            align-items: start;
        }
    }

    @media (max-width: 640px) {
        .profile-hero {
            border-radius: 14px;
            padding: 12px;
        }

        .profile-name {
            font-size: 18px;
        }

        .profile-kpis {
            grid-template-columns: 1fr;
        }

        .field-grid {
            grid-template-columns: 1fr;
        }

        .history-bars {
            min-width: 100%;
            grid-template-columns: repeat(var(--bars), minmax(20px, 1fr));
            height: 140px;
            gap: 5px;
        }

        .history-amount {
            display: none;
        }

        .history-label {
            font-size: 9px;
        }

        .recent-value {
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="driver-profile-page">
    @if($errors->any())
        <div class="profile-alert">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="profile-hero">
        <div class="profile-hero-main">
            <div class="profile-avatar" id="profile-photo-preview">
                @if($avatarUrl)
                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <h2 class="profile-name">{{ $user->name }}</h2>
                <p class="profile-role">Delivery Driver</p>
                <p class="profile-meta">{{ $user->email }}{{ $user->phone_number ? ' | ' . $user->phone_number : '' }}</p>
            </div>
        </div>

        <div class="profile-kpis">
            <div class="profile-kpi">
                <p class="profile-kpi-label">Today Earnings</p>
                <p class="profile-kpi-value">${{ number_format($stats['today_earnings'], 2) }}</p>
            </div>
            <div class="profile-kpi">
                <p class="profile-kpi-label">This Month</p>
                <p class="profile-kpi-value">${{ number_format($stats['month_earnings'], 2) }}</p>
            </div>
            <div class="profile-kpi">
                <p class="profile-kpi-label">Total Earnings</p>
                <p class="profile-kpi-value">${{ number_format($stats['total_earnings'], 2) }}</p>
            </div>
        </div>
    </section>

    <div class="profile-grid">
        <section class="profile-card">
            <h3 class="profile-card-title">Edit Information</h3>
            <form action="{{ route('driver.profile.update') }}" method="POST" class="profile-form">
                @csrf
                @method('PUT')
                <div class="field-grid">
                    <div class="field">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="field">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone_number) }}">
                    </div>
                    <div class="field">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender">
                            <option value="">Select</option>
                            <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="field field--full">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="{{ old('dob', $user->dob) }}">
                    </div>
                    <div class="field field--full">
                        <label for="current_address">Current Address</label>
                        <textarea id="current_address" name="current_address">{{ old('current_address', $user->current_address) }}</textarea>
                    </div>
                    <div class="field field--full">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn-save">Save Information</button>
            </form>
        </section>

        <div style="display: grid; gap: 12px;">
            <section class="profile-card">
                <h3 class="profile-card-title">Profile Photo</h3>
                <form action="{{ route('driver.profile.photo') }}" method="POST" enctype="multipart/form-data" class="photo-box">
                    @csrf
                    <div class="photo-preview" id="photo-preview">
                        @if($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>
                    <input type="file" name="photo" id="photo" class="photo-input" accept="image/*" required>
                    <button type="submit" class="btn-save">Upload Photo</button>
                </form>
            </section>

            <section class="profile-card">
                <h3 class="profile-card-title">Earnings Summary</h3>
                <div class="earnings-list">
                    <div class="earnings-row">
                        <div>
                            <p class="earnings-label">Total Deliveries</p>
                            <p class="earnings-value">{{ $stats['total_deliveries'] }}</p>
                        </div>
                    </div>
                    <div class="earnings-row">
                        <div>
                            <p class="earnings-label">Week Earnings</p>
                            <p class="earnings-value">${{ number_format($stats['week_earnings'], 2) }}</p>
                        </div>
                    </div>
                    <div class="earnings-row">
                        <div>
                            <p class="earnings-label">Average per Delivery</p>
                            <p class="earnings-value">${{ number_format($stats['avg_earnings_per_delivery'], 2) }}</p>
                        </div>
                    </div>
                    <div class="earnings-row">
                        <div>
                            <p class="earnings-label">Commission Rate</p>
                            <p class="earnings-value">{{ number_format($commissionRate * 100, 0) }}%</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <section class="profile-card">
        <h3 class="profile-card-title">Earning History (Last 6 Months)</h3>
        <div class="history-wrap">
            <div class="history-scroll">
                <div class="history-bars" style="--bars: {{ count($earningsHistory) }};">
                    @foreach($earningsHistory as $point)
                        @php
                            $height = max(5, (int) round((($point['earnings'] ?? 0) / $maxHistoryEarnings) * 140));
                        @endphp
                        <div class="history-col">
                            <div class="history-bar" style="height: {{ $height }}px;">
                                @if(($point['earnings'] ?? 0) > 0)
                                    <span class="history-amount">${{ number_format($point['earnings'], 0) }}</span>
                                @endif
                            </div>
                            <span class="history-label">{{ $point['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="profile-card">
        <h3 class="profile-card-title">Recent Earning History</h3>
        <div class="recent-list">
            @forelse($recentEarnings as $order)
                @php
                    $earning = (float) $order->total_amount * $commissionRate;
                @endphp
                <article class="recent-item">
                    <div>
                        <p class="recent-title">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
                        <p class="recent-meta">
                            {{ $order->customer->name ?? 'Guest Customer' }}<br>
                            {{ $order->updated_at->format('M d, Y h:i A') }}
                        </p>
                    </div>
                    <p class="recent-value">${{ number_format($earning, 2) }}</p>
                </article>
            @empty
                <div class="earnings-row">
                    <div>
                        <p class="earnings-label">No earnings yet</p>
                        <p class="earnings-value">Complete deliveries to build your history.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('photo')?.addEventListener('change', function(event) {
        const file = event.target.files?.[0];
        if (!file) {
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const photoPreview = document.getElementById('photo-preview');
            const profilePreview = document.getElementById('profile-photo-preview');
            if (!photoPreview || !profilePreview) {
                return;
            }

            const previewHtml = '<img src="' + e.target.result + '" alt="Profile preview">';
            photoPreview.innerHTML = previewHtml;
            profilePreview.innerHTML = previewHtml;
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
