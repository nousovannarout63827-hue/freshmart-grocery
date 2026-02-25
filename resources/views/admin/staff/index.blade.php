@extends('layouts.admin')

@section('content')
@php
    $isOriginalAdmin = auth()->user()->id === 1 || auth()->user()->email === 'admin@grocery.com';
@endphp

<style>
.staff-page {
    padding: 30px;
    box-sizing: border-box;
}

@media (max-width: 768px) {
    .staff-page {
        padding: 16px !important;
    }

    .page-header {
        flex-direction: column !important;
        gap: 12px !important;
        align-items: stretch !important;
    }

    .page-header h1 {
        font-size: 20px !important;
    }

    .btn-primary {
        width: 100% !important;
        justify-content: center !important;
        text-align: center !important;
    }

    .filter-bar {
        padding: 16px !important;
    }

    .filter-bar form {
        flex-direction: column !important;
        gap: 12px !important;
    }

    .filter-bar input,
    .filter-bar select,
    .filter-bar button,
    .filter-bar a {
        width: 100% !important;
        min-width: auto !important;
    }

    .table-container {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
    }

    .data-table {
        min-width: 700px !important;
    }

    .table-container {
        border-radius: 12px !important;
    }
}

@media (max-width: 375px) {
    .staff-page {
        padding: 12px !important;
    }

    .page-header h1 {
        font-size: 18px !important;
    }

    .page-header p {
        font-size: 13px !important;
    }
}
</style>

<div class="staff-page" style="padding: 30px; box-sizing: border-box;">

    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 900; color: #1e293b; margin: 0;">
                👥 Staff Management
            </h1>
            <p style="font-size: 14px; color: #64748b; margin: 5px 0 0;">Manage your team roles and permissions</p>
        </div>

        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary" style="background: #3b82f6; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; white-space: nowrap;"
           onmouseover="this.style.background='#2563eb';"
           onmouseout="this.style.background='#3b82f6';">
            ➕ Add New Staff
        </a>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="filter-bar" style="background: white; border-radius: 15px; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.staff.index') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
            <input type="text" name="search" placeholder="🔍 Search by name or email..."
                   value="{{ request('search') }}"
                   style="flex: 1; min-width: 200px; padding: 10px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none;"
                   onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                   onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">

            <select name="role" style="flex: 1; min-width: 150px; padding: 10px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; cursor: pointer;"
                    onfocus="this.style.borderColor='#3b82f6';"
                    onblur="this.style.borderColor='#e2e8f0';">
                <option value="">All Roles</option>
                <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>🏬 Store Staff</option>
                <option value="driver" {{ request('role') == 'driver' ? 'selected' : '' }}>🚚 Delivery Driver</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>👑 Admin</option>
            </select>

            <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap;"
                    onmouseover="this.style.background='#2563eb';"
                    onmouseout="this.style.background='#3b82f6';">
                🔍 Filter
            </button>

            @if(request('search') || request('role'))
                <a href="{{ route('admin.staff.index') }}" style="background: #f1f5f9; color: #64748b; border: 2px solid #e2e8f0; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; white-space: nowrap;"
                   onmouseover="this.style.background='#e2e8f0'; this.style.borderColor='#cbd5e1';"
                   onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#e2e8f0';">
                    ✕ Clear
                </a>
            @endif
        </form>
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

    <div class="table-container" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <table class="data-table" style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                <tr>
                    <th style="padding: 15px 20px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Avatar</th>
                    <th style="padding: 15px 20px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Name & Email</th>
                    <th style="padding: 15px 20px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Role</th>
                    <th style="padding: 15px 20px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Joined Date</th>
                    <th style="padding: 15px 20px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Status</th>
                    <th style="padding: 15px 20px; text-align: right; color: #64748b; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($staffMembers as $member)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='white';">
                    <td style="padding: 15px 20px; vertical-align: middle;">
                        @if($member->avatar ?? $member->profile_photo_path)
                            <img src="{{ asset('storage/' . ($member->avatar ?? $member->profile_photo_path)) }}"
                                 alt="{{ $member->name }}"
                                 style="width: 45px; height: 45px; border-radius: 10px; object-fit: cover; border: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        @else
                            <div style="width: 45px; height: 45px; border-radius: 10px; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 18px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </div>
                        @endif
                    </td>

                    <td style="padding: 15px 20px; vertical-align: middle;">
                        <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $member->name }}</div>
                        <div style="font-size: 13px; color: #64748b;">{{ $member->email }}</div>
                    </td>

                    <td style="padding: 15px 20px; vertical-align: middle;">
                        @if($member->role == 'admin')
                            <span style="background: linear-gradient(135deg, #7c3aed, #5b21b6); color: white; padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: 700; display: inline-block; box-shadow: 0 2px 8px rgba(124,58,237,0.3);">
                                👑 Admin
                            </span>
                        @elseif($member->role == 'driver')
                            <span style="background: #fffbeb; color: #d97706; border: 1px solid #fde68a; padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block;">
                                🚚 Driver
                            </span>
                        @else
                            <span style="background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block;">
                                🏬 Store Staff
                            </span>
                        @endif
                    </td>

                    <td style="padding: 15px 20px; vertical-align: middle; color: #475569; font-weight: 500; font-size: 14px;">
                        {{ $member->created_at->format('M d, Y') }}
                    </td>

                    <td style="padding: 15px 20px; vertical-align: middle;">
                        @php
                            $statusColor = ($member->status === 'active' || $member->status === null) ? '#22c55e' : '#64748b';
                            $statusBg = ($member->status === 'active' || $member->status === null) ? '#dcfce7' : '#f1f5f9';
                            $statusBorder = ($member->status === 'active' || $member->status === null) ? '#86efac' : '#cbd5e1';
                        @endphp
                        <span style="background: {{ $statusBg }}; color: {{ $statusColor }}; border: 1px solid {{ $statusBorder }}; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; display: inline-block;">
                            {{ ($member->status === 'active' || $member->status === null) ? 'Active' : 'Disabled' }}
                        </span>
                    </td>

                    <td style="padding: 15px 20px; text-align: right; vertical-align: middle;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.staff.show', $member->id) }}"
                               style="background: #10b981; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s; text-decoration: none; white-space: nowrap;"
                               onmouseover="this.style.background='#059669'; this.style.transform='translateY(-1px)';"
                               onmouseout="this.style.background='#10b981'; this.style.transform='translateY(0)';">
                                👁️ View Info
                            </a>

                            <a href="{{ route('admin.staff.history', $member->id) }}"
                               style="background: #06b6d4; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s; text-decoration: none; white-space: nowrap;"
                               onmouseover="this.style.background='#0891b2'; this.style.transform='translateY(-1px)';"
                               onmouseout="this.style.background='#06b6d4'; this.style.transform='translateY(0)';">
                                📜 History
                            </a>

                            @if($member->role !== 'admin' || $isOriginalAdmin)
                                <button type="button" onclick="openRoleModal({{ $member->id }}, '{{ $member->name }}', '{{ $member->role }}')"
                                        style="background: #8b5cf6; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s; white-space: nowrap;"
                                        onmouseover="this.style.background='#7c3aed'; this.style.transform='translateY(-1px)';"
                                        onmouseout="this.style.background='#8b5cf6'; this.style.transform='translateY(0)';">
                                    🔄 Change Role
                                </button>
                            @endif

                            <a href="{{ route('admin.staff.edit', $member->id) }}"
                               style="background: #64748b; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s; text-decoration: none; white-space: nowrap;"
                               onmouseover="this.style.background='#475569'; this.style.transform='translateY(-1px)';"
                               onmouseout="this.style.background='#64748b'; this.style.transform='translateY(0)';">
                                ✏️ Edit
                            </a>

                            @if(($member->status === 'active' || $member->status === null) && ($member->role !== 'admin' || $isOriginalAdmin))
                                <button type="button" onclick="confirmDeactivate('{{ route('admin.staff.deactivate', $member->id) }}')"
                                        style="background: #f59e0b; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s; white-space: nowrap;"
                                        onmouseover="this.style.background='#d97706'; this.style.transform='translateY(-1px)';"
                                        onmouseout="this.style.background='#f59e0b'; this.style.transform='translateY(0)';">
                                    ⏸️ Deactivate
                                </button>
                            @elseif($member->status !== 'active' && ($member->role !== 'admin' || $isOriginalAdmin))
                                <button type="button" onclick="confirmDeactivate('{{ route('admin.staff.deactivate', $member->id) }}')"
                                        style="background: #22c55e; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s; white-space: nowrap;"
                                        onmouseover="this.style.background='#16a34a'; this.style.transform='translateY(-1px)';"
                                        onmouseout="this.style.background='#22c55e'; this.style.transform='translateY(0)';">
                                    ▶️ Activate
                                </button>
                            @endif

                            @if($member->role !== 'admin' || $isOriginalAdmin)
                                <button type="button" onclick="triggerDelete('{{ route('admin.staff.delete', $member->id) }}', '{{ addslashes($member->name) }}')"
                                        style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s; white-space: nowrap;"
                                        onmouseover="this.style.background='#dc2626'; this.style.transform='translateY(-1px)';"
                                        onmouseout="this.style.background='#ef4444'; this.style.transform='translateY(0)';">
                                    🗑️ Delete
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 60px 20px; text-align: center; color: #64748b; font-size: 14px;">
                        📭 No staff members found. Add your first staff member above!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Role Change Modal --}}
<div id="roleModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 15px; padding: 40px; max-width: 500px; width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        <h2 style="font-size: 20px; font-weight: 900; color: #1e293b; margin-bottom: 10px;">🔄 Change Role</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Update role for: <strong id="modalUserName" style="color: #1e293b;"></strong></p>
        
        <form id="roleChangeForm" method="POST">
            @csrf
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase;">New Role</label>
                <select name="new_role" id="newRole" style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; cursor: pointer;"
                        onfocus="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 0 0 3px rgba(139,92,246,0.1)';"
                        onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                    <option value="staff">🏬 Store Staff</option>
                    <option value="driver">🚚 Delivery Driver</option>
                    <option value="admin">👑 Admin</option>
                </select>
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px; text-transform: uppercase;">Reason (Optional)</label>
                <textarea name="reason" rows="3" placeholder="e.g., Promotion, Role reassignment..." style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; resize: vertical; font-family: inherit;"
                          onfocus="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 0 0 3px rgba(139,92,246,0.1)';"
                          onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"></textarea>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="flex: 1; background: #8b5cf6; color: white; border: none; padding: 14px 20px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; text-transform: uppercase;"
                        onmouseover="this.style.background='#7c3aed'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(139,92,246,0.3)';"
                        onmouseout="this.style.background='#8b5cf6'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    ✅ Confirm Change
                </button>
                <button type="button" onclick="closeRoleModal()" style="flex: 1; background: #f1f5f9; color: #64748b; border: 2px solid #e2e8f0; padding: 14px 20px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; text-transform: uppercase;"
                        onmouseover="this.style.background='#e2e8f0'; this.style.borderColor='#cbd5e1';"
                        onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#e2e8f0';">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Deactivate Account Modal --}}
<div id="deactivateModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; width: 100%; max-width: 400px; padding: 30px; border-radius: 16px; text-align: center; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); animation: modalSlideIn 0.3s ease-out;">
        
        <div style="width: 70px; height: 70px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 30px;">
            ⚠️
        </div>

        <h3 style="font-weight: 800; color: #1e293b; margin-bottom: 10px; font-size: 20px;">Deactivate Account?</h3>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px; line-height: 1.6;">This user will lose all access to the dashboard immediately. You can reactivate them later if needed.</p>

        <div style="display: flex; gap: 10px;">
            <button onclick="closeDeactivateModal()" style="flex: 1; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0; background: white; font-weight: 600; color: #64748b; cursor: pointer; transition: all 0.2s;"
                    onmouseover="this.style.background='#f8fafc';"
                    onmouseout="this.style.background='white';">
                Cancel
            </button>
            
            <form id="deactivateForm" method="POST" style="flex: 1;">
                @csrf
                <button type="submit" style="width: 100%; padding: 12px; border-radius: 8px; background: #ef4444; color: white; border: none; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                        onmouseover="this.style.background='#dc2626'; this.style.transform='translateY(-1px)';"
                        onmouseout="this.style.background='#ef4444'; this.style.transform='translateY(0)';">
                    Confirm
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Role Change Modal Functions
function openRoleModal(userId, userName, currentRole) {
    document.getElementById('modalUserName').textContent = userName;
    document.getElementById('roleChangeForm').action = '/admin/staff/' + userId + '/change-role';
    document.getElementById('newRole').value = currentRole;
    document.getElementById('roleModal').style.display = 'flex';
}

function closeRoleModal() {
    document.getElementById('roleModal').style.display = 'none';
}

// Close role modal when clicking outside
document.getElementById('roleModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRoleModal();
    }
});

// Deactivate Modal Functions
function confirmDeactivate(actionUrl) {
    // 1. Find the modal and the form
    const modal = document.getElementById('deactivateModal');
    const form = document.getElementById('deactivateForm');

    // 2. Set the form's action to the correct user's URL
    form.action = actionUrl;

    // 3. Show the modal with a flex display
    modal.style.display = 'flex';
}

function closeDeactivateModal() {
    document.getElementById('deactivateModal').style.display = 'none';
}

// Close deactivate modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('deactivateModal');
    if (event.target == modal) {
        closeDeactivateModal();
    }
}

// Delete Confirmation Function
function confirmDelete(actionUrl) {
    if (confirm('⚠️ Are you absolutely sure? This will PERMANENTLY delete this user account and cannot be undone!')) {
        // Create a form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = actionUrl;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Trigger Delete Modal
function triggerDelete(actionUrl, userName) {
    const modal = document.getElementById('permanentDeleteModal');
    const form = document.getElementById('permanentDeleteForm');
    const nameSpan = document.getElementById('deleteUserName');

    // 1. Set the correct route and name
    form.action = actionUrl;
    nameSpan.innerText = userName;

    // 2. Show the modal
    modal.style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('permanentDeleteModal').style.display = 'none';
}

// Close if clicking the dark background
window.onclick = function(event) {
    const modal = document.getElementById('permanentDeleteModal');
    if (event.target == modal) {
        closeDeleteModal();
    }
}
</script>

{{-- Permanent Delete Modal --}}
<div id="permanentDeleteModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; width: 100%; max-width: 440px; padding: 40px 30px; border-radius: 24px; text-align: center; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); border: 1px solid rgba(0,0,0,0.05);">
        
        <div style="width: 80px; height: 80px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px; animation: pulse 2s infinite;">
            🛑
        </div>

        <h3 style="font-weight: 800; color: #0f172a; margin-bottom: 12px; font-size: 22px; letter-spacing: -0.5px;">Permanent Delete?</h3>
        <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 30px;">
            You are about to erase <strong id="deleteUserName" style="color: #1e293b;">this user</strong>. This action is <span style="color: #ef4444; font-weight: 700;">irreversible</span> and will wipe all their data from the system.
        </p>

        <div style="display: flex; gap: 12px;">
            <button onclick="closeDeleteModal()" style="flex: 1; padding: 14px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-weight: 700; color: #64748b; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                No, Keep it
            </button>
            
            <form id="permanentDeleteForm" method="POST" style="flex: 1;">
                @csrf
                @method('DELETE')
                <button type="submit" style="width: 100%; padding: 14px; border-radius: 12px; background: #ef4444; color: white; border: none; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2); transition: 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 15px rgba(239, 68, 68, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.2)'">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
    70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(239, 68, 68, 0); }
    100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
}
</style>
@endsection
