@extends('layouts.admin')

@section('content')
<div style="padding: 24px; max-width: 1000px; margin: 0 auto;">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
        <div>
            <a href="{{ route('admin.staff.index') }}" style="text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px; display: inline-block; margin-bottom: 8px;">← Back to List</a>
            <h2 style="font-weight: 800; color: #1e293b; margin: 0;">➕ Add New Team Member</h2>
            <p style="color: #64748b; margin: 4px 0 0 0; font-size: 14px;">Create a new account and assign system permissions.</p>
        </div>
    </div>

    @if ($errors->any())
        <div style="background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; padding: 16px; border-radius: 12px; margin-bottom: 24px;">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 24px;">
            <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">1. Profile Photo & Role</h3>

            <div style="display: flex; gap: 40px; align-items: center; flex-wrap: wrap;">

                <div style="text-align: center; flex-shrink: 0;">
                    <div style="width: 120px; height: 120px; border-radius: 50%; background: #f8fafc; border: 2px dashed #cbd5e1; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto; overflow: hidden;">
                        <img id="photo-preview" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                        <span id="photo-placeholder" style="font-size: 48px; color: #cbd5e1;">📷</span>
                    </div>
                    <label style="background: #1e293b; color: white; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 8px;"
                           onmouseover="this.style.background='#0f172a'"
                           onmouseout="this.style.background='#1e293b'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Upload Photo
                        <input type="file" name="photo" accept="image/*" style="display: none;" onchange="previewImage(event)">
                    </label>
                    <p style="font-size: 11px; color: #94a3b8; margin-top: 8px;">JPEG, PNG, GIF • Max 2MB</p>
                </div>

                <div style="flex: 1; min-width: 280px;">
                    <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Assign Role <span style="color: #ef4444;">*</span></label>
                    <select name="role" required style="width: 100%; max-width: 400px; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; color: #1e293b; background: #f8fafc; outline: none; cursor: pointer;">
                        <option value="staff">🏬 Store Staff</option>
                        <option value="driver">🚚 Delivery Driver</option>
                        <option value="admin">👑 Admin</option>
                    </select>
                    <p style="margin: 8px 0 0 0; font-size: 12px; color: #64748b;">Admins have unrestricted access to the entire dashboard.</p>
                </div>
            </div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 24px;">
            <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">2. Personal Details</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Full Name <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" placeholder="e.g. John Doe" required style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Email Address <span style="color: #ef4444;">*</span></label>
                    <input type="email" name="email" placeholder="staff@grocery.com" required style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Phone Number</label>
                    <input type="text" name="phone_number" placeholder="e.g. 012 345 678" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Temporary Password <span style="color: #ef4444;">*</span></label>
                    <input type="password" name="password" placeholder="Minimum 8 characters" required style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Gender</label>
                    <select name="gender" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 500; color: #1e293b; background: white; outline: none; box-sizing: border-box; font-size: 14px;">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Date of Birth</label>
                    <input type="date" name="dob" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 14px;">
                </div>
            </div>

            <div style="margin-top: 20px;">
                <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Place of Birth</label>
                <input type="text" name="pob" placeholder="e.g. Phnom Penh, Cambodia" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 14px;">
            </div>

            <div style="margin-top: 20px;">
                <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Current Address</label>
                <textarea name="current_address" rows="3" placeholder="Enter full address..." style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; resize: vertical; font-size: 14px;"></textarea>
            </div>

            <div style="margin-top: 20px;">
                <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Bio / Description</label>
                <textarea name="bio" rows="3" placeholder="Brief background or notes about this staff member..." style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; resize: vertical; font-size: 14px;"></textarea>
            </div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">3. Access Permissions</h3>
            <p style="color: #64748b; margin-bottom: 20px; font-size: 13px;">Select the permissions this team member should have. Admins have unrestricted access.</p>

            <!-- Permission Categories -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-bottom: 24px;">
                
                <!-- Product Management -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                        📦 Product Management
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_inventory" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Inventory</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Add, edit, and trash products</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_categories" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Categories</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Create and manage product categories</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_products" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Products</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Full product CRUD operations</small>
                    </div>
                </div>

                <!-- Order Management -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                        🛒 Order Management
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_orders" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Orders</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">View and update customer orders</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="process_orders" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Process Orders</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Confirm, prepare, and ship orders</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="assign_drivers" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Assign Drivers</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Assign drivers to delivery orders</small>
                    </div>
                </div>

                <!-- Staff & User Management -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                        👥 Staff & Users
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_staff" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Staff</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Add users and change roles</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_customers" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Customers</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">View and manage customer accounts</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_drivers" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Drivers</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Manage driver accounts and assignments</small>
                    </div>
                </div>

                <!-- Marketing & Promotions -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                        🎉 Marketing & Promotions
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_coupons" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Coupons</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Create and manage discount codes</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_reviews" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Reviews</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Approve, edit, or remove reviews</small>
                    </div>
                </div>

                <!-- Reports & Analytics -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                        📊 Reports & Analytics
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="view_reports" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>View Reports</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Access analytics and reports</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="export_data" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Export Data</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Export reports to Excel/PDF</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="view_activity_logs" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>View Activity Logs</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">View system activity logs</small>
                    </div>
                </div>

                <!-- System Settings -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                        ⚙️ System Settings
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_settings" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Settings</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Modify system configurations</small>
                        
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #1e293b; font-weight: 600;">
                            <input type="checkbox" name="permissions[]" value="manage_roles" style="width: 18px; height: 18px; accent-color: #10b981;">
                            <span>Manage Roles</span>
                        </label>
                        <small style="color: #94a3b8; font-size: 11px; margin-left: 28px;">Create and edit user roles</small>
                    </div>
                </div>

            </div>

            <!-- Quick Select Buttons -->
            <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; padding-top: 20px; border-top: 1px dashed #e2e8f0;">
                <span style="font-size: 13px; color: #64748b; font-weight: 600;">Quick Select:</span>
                <button type="button" onclick="selectAllPermissions()" style="background: #10b981; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 12px; cursor: pointer; transition: 0.2s;">
                    ✅ Select All
                </button>
                <button type="button" onclick="selectEssentialPermissions()" style="background: #3b82f6; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 12px; cursor: pointer; transition: 0.2s;">
                    📋 Essential Only
                </button>
                <button type="button" onclick="clearAllPermissions()" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 12px; cursor: pointer; transition: 0.2s;">
                    ❌ Clear All
                </button>
            </div>

            <div style="text-align: right; border-top: 1px solid #f1f5f9; padding-top: 24px;">
                <button type="submit" style="background: #10b981; color: white; border: none; padding: 14px 32px; border-radius: 8px; font-size: 16px; font-weight: 800; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3); transition: 0.2s;">
                    ✅ CREATE ACCOUNT
                </button>
            </div>
        </div>

        <script>
            function selectAllPermissions() {
                document.querySelectorAll('input[name="permissions[]"]').forEach(cb => cb.checked = true);
            }
            
            function selectEssentialPermissions() {
                const essential = ['manage_inventory', 'manage_orders', 'process_orders'];
                document.querySelectorAll('input[name="permissions[]"]').forEach(cb => {
                    cb.checked = essential.includes(cb.value);
                });
            }
            
            function clearAllPermissions() {
                document.querySelectorAll('input[name="permissions[]"]').forEach(cb => cb.checked = false);
            }
        </script>

    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const img = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            img.src = reader.result;
            img.style.display = 'block';
            placeholder.style.display = 'none';
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection
