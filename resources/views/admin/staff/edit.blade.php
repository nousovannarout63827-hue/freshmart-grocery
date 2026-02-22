@extends('layouts.admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box;">

    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 900; color: #1e293b; margin: 0;">
                ✏️ Edit Team Member
            </h1>
            <p style="font-size: 14px; color: #64748b; margin: 5px 0 0;">Update staff information and role</p>
        </div>
        
        <a href="{{ route('admin.staff.index') }}" 
           style="background: #f1f5f9; color: #64748b; border: 2px solid #e2e8f0; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;"
           onmouseover="this.style.background='#e2e8f0'; this.style.borderColor='#cbd5e1';"
           onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#e2e8f0';">
            ← Back to List
        </a>
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

    @if(session('error'))
        <div class="alert-error" style="background: #fef2f2; border: 2px solid #ef4444; color: #dc2626; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 14px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span>{{ session('error') }}</span>
            <button type="button" onclick="this.parentElement.style.display='none';" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 18px; color: #dc2626;">&times;</button>
        </div>
    @endif

    {{-- Validation Errors Display --}}
    @if ($errors->any())
        <div class="alert-validation" style="background: #fef2f2; border: 2px solid #ef4444; color: #b91c1c; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            <strong style="display: block; margin-bottom: 8px; font-weight: 700;">⚠️ Wait! The server rejected the save:</strong>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom: 4px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px;">
        <div class="card-body" style="padding: 40px;">
            
            <div style="text-align: center; margin-bottom: 30px;">
                <div style="width: 100px; height: 100px; border-radius: 50%; background: {{ $user->role == 'driver' ? '#fef3c7' : '#dbeafe' }}; color: {{ $user->role == 'driver' ? '#92400e' : '#1e40af' }}; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 36px; margin: 0 auto 15px; overflow: hidden; border: 4px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0;">

                    @if($user->avatar ?? $user->profile_photo_path)
                        <img src="{{ asset('storage/' . ($user->avatar ?? $user->profile_photo_path)) }}"
                             alt="{{ $user->name }}"
                             style="width: 100%; height: 100%; object-fit: cover;"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    @endif

                    <div class="fallback-letter" style="display: {{ ($user->avatar ?? $user->profile_photo_path) ? 'none' : 'flex' }}; width: 100%; height: 100%; align-items: center; justify-content: center;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
                <h3 style="margin: 0; color: #1e293b; font-size: 20px; font-weight: 700;">{{ $user->name }}</h3>
                <p style="margin: 5px 0 0; color: #64748b; font-size: 14px;">{{ $user->email }}</p>
            </div>

            <form action="{{ route('admin.staff.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Full Name
                    </label>
                    <input type="text" name="name" value="{{ $user->name }}" 
                           style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                           required>
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Email Address
                    </label>
                    <input type="email" value="{{ $user->email }}" disabled
                           style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #f8fafc; color: #94a3b8; cursor: not-allowed;">
                    <small style="color: #64748b; font-size: 12px; margin-top: 5px; display: block;">
                        🔒 Email cannot be changed for security reasons.
                    </small>
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Assign Role
                    </label>
                    <select name="role"
                            style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; cursor: pointer;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>🏬 Store Staff</option>
                        <option value="driver" {{ $user->role == 'driver' ? 'selected' : '' }}>🚚 Delivery Driver</option>
                    </select>
                </div>

                {{-- Access Permissions Section --}}
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 800; color: #1e293b; margin-bottom: 8px; font-size: 15px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
                        🔐 Access Permissions
                    </label>
                    <p style="font-size: 13px; color: #64748b; margin: 5px 0 15px;">Modify the specific modules this user can access.</p>

                    @php
                        $userPerms = is_array($user->permissions) ? $user->permissions : [];
                    @endphp

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px;">
                        {{-- Manage Inventory --}}
                        <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 15px; background: #f8fafc; transition: all 0.2s; cursor: pointer;"
                             onmouseover="this.style.borderColor='#3b82f6'; this.style.background='#eff6ff';"
                             onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <input type="checkbox" name="permissions[]" value="manage_inventory" id="perm_inventory"
                                       style="width: 18px; height: 18px; cursor: pointer; accent-color: #3b82f6;"
                                       {{ in_array('manage_inventory', $userPerms) ? 'checked' : '' }}>
                                <label for="perm_inventory" style="font-weight: 700; color: #334155; cursor: pointer; margin: 0; flex: 1;">
                                    📦 Manage Inventory
                                </label>
                            </div>
                            <div style="font-size: 12px; color: #64748b; margin-left: 30px;">Can add, edit, and trash products.</div>
                        </div>

                        {{-- Manage Categories --}}
                        <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 15px; background: #f8fafc; transition: all 0.2s; cursor: pointer;"
                             onmouseover="this.style.borderColor='#3b82f6'; this.style.background='#eff6ff';"
                             onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <input type="checkbox" name="permissions[]" value="manage_categories" id="perm_categories"
                                       style="width: 18px; height: 18px; cursor: pointer; accent-color: #3b82f6;"
                                       {{ in_array('manage_categories', $userPerms) ? 'checked' : '' }}>
                                <label for="perm_categories" style="font-weight: 700; color: #334155; cursor: pointer; margin: 0; flex: 1;">
                                    📁 Manage Categories
                                </label>
                            </div>
                            <div style="font-size: 12px; color: #64748b; margin-left: 30px;">Can create and rename categories.</div>
                        </div>

                        {{-- Manage Staff --}}
                        <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 15px; background: #f8fafc; transition: all 0.2s; cursor: pointer;"
                             onmouseover="this.style.borderColor='#3b82f6'; this.style.background='#eff6ff';"
                             onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <input type="checkbox" name="permissions[]" value="manage_staff" id="perm_staff"
                                       style="width: 18px; height: 18px; cursor: pointer; accent-color: #3b82f6;"
                                       {{ in_array('manage_staff', $userPerms) ? 'checked' : '' }}>
                                <label for="perm_staff" style="font-weight: 700; color: #334155; cursor: pointer; margin: 0; flex: 1;">
                                    👥 Manage Staff
                                </label>
                            </div>
                            <div style="font-size: 12px; color: #64748b; margin-left: 30px;">Can add users and change roles.</div>
                        </div>

                        {{-- Manage Orders --}}
                        <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 15px; background: #f8fafc; transition: all 0.2s; cursor: pointer;"
                             onmouseover="this.style.borderColor='#3b82f6'; this.style.background='#eff6ff';"
                             onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <input type="checkbox" name="permissions[]" value="manage_orders" id="perm_orders"
                                       style="width: 18px; height: 18px; cursor: pointer; accent-color: #3b82f6;"
                                       {{ in_array('manage_orders', $userPerms) ? 'checked' : '' }}>
                                <label for="perm_orders" style="font-weight: 700; color: #334155; cursor: pointer; margin: 0; flex: 1;">
                                    🛒 Manage Orders
                                </label>
                            </div>
                            <div style="font-size: 12px; color: #64748b; margin-left: 30px;">Can view and update customer orders.</div>
                        </div>
                    </div>
                </div>

                {{-- Emergency Password Reset Section --}}
                <div style="background: #fffbeb; border: 2px solid #fde68a; border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                    <h4 style="font-weight: 800; color: #b45309; margin: 0 0 8px 0; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                        🔐 Emergency Password Reset
                    </h4>
                    <p style="font-size: 13px; color: #d97706; margin: 0 0 15px 0; line-height: 1.5;">
                        Only use this if the staff member has forgotten their password. Leave it blank to keep their current password.
                    </p>
                    
                    <input type="password" name="password" placeholder="Type new temporary password here (min 8 characters)..."
                           style="width: 100%; padding: 12px 15px; border: 2px solid #fcd34d; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.1)';"
                           onblur="this.style.borderColor='#fcd34d'; this.style.boxShadow='none';">
                    
                    <small style="color: #92400e; font-size: 12px; margin-top: 8px; display: block; font-weight: 600;">
                        💡 The staff member can change this password later in their profile settings.
                    </small>
                </div>

                <div class="form-actions" style="display: flex; flex-direction: column; gap: 10px;">
                    <button type="submit" 
                            style="width: 100%; background: #3b82f6; color: white; border: none; padding: 14px 20px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; text-transform: uppercase; letter-spacing: 0.5px;"
                            onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)';"
                            onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        💾 Update Member Details
                    </button>
                    
                    <a href="{{ route('admin.staff.index') }}" 
                       style="text-align: center; background: #f1f5f9; color: #64748b; border: 2px solid #e2e8f0; padding: 12px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s; text-decoration: none;"
                       onmouseover="this.style.background='#e2e8f0'; this.style.borderColor='#cbd5e1';"
                       onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#e2e8f0';">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
