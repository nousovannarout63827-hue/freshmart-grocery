@extends('layouts.admin')

@section('title', 'My Profile - Admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box;">

    <!-- Page Header -->
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 900; color: #1e293b; margin: 0 0 8px 0;">👤 My Profile</h1>
        <p style="margin: 0; color: #64748b; font-size: 14px;">Update your personal information and security settings.</p>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <svg style="width: 24px; height: 24px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px;">
            <p style="font-weight: 700; margin: 0 0 8px 0;">⚠️ Please fix the following errors:</p>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 1400px;">

        <!-- Profile Information Card -->
        <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
            <h2 style="font-size: 20px; font-weight: 800; color: #1e293b; margin: 0 0 24px 0;">📝 Profile Information</h2>

            <!-- Profile Photo Section -->
            <div style="margin-bottom: 30px; padding-bottom: 24px; border-bottom: 1px solid #f1f5f9;">
                <label style="display: block; font-size: 14px; font-weight: 700; color: #475569; margin-bottom: 16px;">Profile Photo</label>
                
                <div style="display: flex; align-items: center; gap: 20px;">
                    @if(auth()->user()->profile_photo_path)
                        <img id="profile-preview" src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" 
                             alt="{{ auth()->user()->name }}" 
                             style="width: 100px; height: 100px; border-radius: 16px; object-fit: cover; border: 4px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    @else
                        <div id="profile-preview" style="width: 100px; height: 100px; border-radius: 16px; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 900; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <form action="{{ route('admin.profile.photo') }}" method="POST" enctype="multipart/form-data" id="photo-form">
                            @csrf
                            <input type="file" name="photo" id="photo-input" accept="image/*" style="display: none;" onchange="submitPhotoForm(this)">
                            <label for="photo-input" id="upload-btn" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #10b981; color: white; border-radius: 10px; font-weight: 700; font-size: 13px; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                </svg>
                                Upload Photo
                            </label>
                        </form>
                        <p id="upload-status" style="font-size: 12px; color: #94a3b8; margin: 8px 0 0 0;">Allowed: JPEG, PNG, GIF • Max 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: grid; gap: 20px;">
                    <div>
                        <label for="name" style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label for="email" style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label for="phone" style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone_number) }}"
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label for="current_address" style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Address</label>
                        <textarea id="current_address" name="current_address" rows="3"
                                  style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s; resize: vertical; box-sizing: border-box;">{{ old('current_address', auth()->user()->current_address) }}</textarea>
                    </div>

                    <div style="display: flex; gap: 12px; padding-top: 8px;">
                        <button type="submit" style="flex: 1; padding: 14px 24px; background: #10b981; color: white; border: none; border-radius: 12px; font-weight: 800; font-size: 14px; cursor: pointer; transition: background 0.2s; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);" onmouseover="this.style.background='#059669'; this.style.boxShadow='0 6px 15px rgba(5, 150, 105, 0.3)'" onmouseout="this.style.background='#10b981'; this.style.boxShadow='0 4px 10px rgba(16, 185, 129, 0.2)'">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.dashboard') }}" style="flex: 1; padding: 14px 24px; background: #f1f5f9; color: #475569; text-align: center; text-decoration: none; border-radius: 12px; font-weight: 800; font-size: 14px; transition: background 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Change Password Card -->
        <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; height: fit-content;">
            <h2 style="font-size: 20px; font-weight: 800; color: #1e293b; margin: 0 0 24px 0;">🔒 Change Password</h2>

            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: grid; gap: 20px;">
                    <div>
                        <label for="current_password" style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        @error('current_password')
                            <p style="font-size: 12px; color: #ef4444; margin: 4px 0 0 0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">New Password</label>
                        <input type="password" id="password" name="password" required minlength="8"
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        @error('password')
                            <p style="font-size: 12px; color: #ef4444; margin: 4px 0 0 0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div style="padding-top: 8px;">
                        <button type="submit" style="width: 100%; padding: 14px 24px; background: #10b981; color: white; border: none; border-radius: 12px; font-weight: 800; font-size: 14px; cursor: pointer; transition: background 0.2s; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);" onmouseover="this.style.background='#059669'; this.style.boxShadow='0 6px 15px rgba(5, 150, 105, 0.3)'" onmouseout="this.style.background='#10b981'; this.style.boxShadow='0 4px 10px rgba(16, 185, 129, 0.2)'">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>

            <!-- Account Info Section -->
            <div style="margin-top: 30px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
                <h3 style="font-size: 16px; font-weight: 800; color: #1e293b; margin: 0 0 16px 0;">📊 Account Information</h3>
                
                <div style="display: grid; gap: 12px;">
                    <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8fafc; border-radius: 10px;">
                        <span style="font-size: 13px; color: #64748b; font-weight: 600;">Role</span>
                        <span style="font-size: 13px; color: #1e293b; font-weight: 800; text-transform: uppercase;">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8fafc; border-radius: 10px;">
                        <span style="font-size: 13px; color: #64748b; font-weight: 600;">Member Since</span>
                        <span style="font-size: 13px; color: #1e293b; font-weight: 700;">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8fafc; border-radius: 10px;">
                        <span style="font-size: 13px; color: #64748b; font-weight: 600;">Last Login</span>
                        <span style="font-size: 13px; color: #1e293b; font-weight: 700;">{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->diffForHumans() : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    // Submit photo form with AJAX
    function submitPhotoForm(input) {
        const file = input.files[0];
        const statusEl = document.getElementById('upload-status');
        const uploadBtn = document.getElementById('upload-btn');
        
        if (!file) return;
        
        // Validate file type
        if (!file.type.match('image.*')) {
            statusEl.style.color = '#ef4444';
            statusEl.textContent = '❌ Please select an image file (JPEG, PNG, GIF)';
            return;
        }
        
        // Validate file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            statusEl.style.color = '#ef4444';
            statusEl.textContent = '❌ File size exceeds 2MB. Please choose a smaller image.';
            return;
        }
        
        // Show loading state
        statusEl.style.color = '#3b82f6';
        statusEl.textContent = '⏳ Uploading...';
        uploadBtn.style.pointerEvents = 'none';
        uploadBtn.style.opacity = '0.6';
        
        const form = document.getElementById('photo-form');
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update preview
                const preview = document.getElementById('profile-preview');
                if (preview) {
                    preview.src = data.photo_url + '?t=' + new Date().getTime();
                }
                statusEl.style.color = '#10b981';
                statusEl.textContent = '✅ Photo uploaded successfully!';
                setTimeout(() => {
                    statusEl.style.color = '#94a3b8';
                    statusEl.textContent = 'Allowed: JPEG, PNG, GIF • Max 2MB';
                }, 3000);
            } else {
                statusEl.style.color = '#ef4444';
                statusEl.textContent = '❌ ' + (data.message || 'Upload failed');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            statusEl.style.color = '#ef4444';
            statusEl.textContent = '❌ Upload failed. Please try again.';
        })
        .finally(() => {
            uploadBtn.style.pointerEvents = 'auto';
            uploadBtn.style.opacity = '1';
            input.value = ''; // Reset file input
        });
    }
</script>
@endsection
