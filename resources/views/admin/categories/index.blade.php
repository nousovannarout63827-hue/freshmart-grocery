@extends('layouts.admin')

@section('content')
<div class="category-container">
    
    <div style="margin-bottom: 24px;">
        <h2 style="font-weight: 800; color: #1e293b; margin: 0 0 8px 0; font-size: 28px;">📁 Manage Categories</h2>
        <p style="color: #64748b; margin: 0; font-size: 15px;">Organize your grocery store aisles.</p>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 16px; border-radius: 12px; border: 1px solid #bbf7d0; margin-bottom: 24px; font-weight: 600;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="split-layout">
        
        <div class="layout-sidebar">
            <h5 style="font-weight: 800; color: #1e293b; margin: 0 0 20px 0; font-size: 18px;">Add New Category</h5>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: 700; font-size: 12px; color: #64748b; margin-bottom: 8px;">CATEGORY NAME <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" placeholder="e.g. Fresh Produce" required style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box;">
                    @error('name') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px;">
                        🌟 Category Icon (Choose One)
                    </label>
                    <div style="background: #f8fafc; padding: 16px; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-weight: 600; font-size: 13px; color: #64748b; margin-bottom: 6px;">Option 1: Upload Image</label>
                            <input type="file" name="icon" id="icon_input" accept="image/*" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; background: white; font-size: 14px; box-sizing: border-box;" onchange="previewImage(this)">
                            
                            {{-- Preview container for newly selected image --}}
                            <div id="icon_preview_container" style="display: none; margin-top: 12px; padding: 12px; background: white; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <p style="font-size: 12px; color: #94a3b8; margin-bottom: 8px;">Image Preview:</p>
                                <img id="icon_preview" src="" style="width: 64px; height: 64px; object-fit: contain; background: #f8fafc; padding: 8px; border-radius: 12px; border: 1px solid #e2e8f0;">
                            </div>
                        </div>
                        <div style="text-align: center; margin: 10px 0; color: #94a3b8;">— OR —</div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 13px; color: #64748b; margin-bottom: 6px;">Option 2: Enter Emoji</label>
                            <input type="text" name="emoji" placeholder="🍎 🥬 🥩 🍞" maxlength="10" style="width: 100%; padding: 14px 16px; border-radius: 8px; border: 1px solid #e2e8f0; background: white; font-size: 28px; text-align: center; line-height: 1.4; height: 60px; box-sizing: border-box;">
                        </div>
                    </div>
                    <small style="color: #94a3b8; margin-top: 5px; display: block;">Use an uploaded image OR an emoji. If both are provided, the image will be used.</small>
                    @error('icon') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                    @error('emoji') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 700; font-size: 12px; color: #64748b; margin-bottom: 8px;">DESCRIPTION</label>
                    <textarea name="description" rows="3" placeholder="Brief description..." style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box; resize: vertical;"></textarea>
                </div>

                <button type="submit" style="width: 100%; padding: 14px; border-radius: 10px; background: #3b82f6; color: white; border: none; font-weight: 700; font-size: 15px; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);" onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
                    ➕ Create Category
                </button>
            </form>
        </div>

        <div class="layout-main">
            <div style="overflow-x: auto;">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>CATEGORY NAME</th>
                            <th>ITEMS</th>
                            <th>SLUG</th>
                            <th>STATUS</th>
                            <th style="text-align: right;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="font-weight: 700; color: #334155; font-size: 15px;">{{ $category->name }}</td>
                                <td>
                                    <span style="background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                        📦 {{ $category->products_count }} items
                                    </span>
                                </td>
                                <td>
                                    <span style="background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-family: monospace; border: 1px solid #e2e8f0;">{{ $category->slug }}</span>
                                </td>
                                <td>
                                    <span style="background: {{ $category->is_active ? '#dcfce7' : '#f1f5f9' }}; color: {{ $category->is_active ? '#166534' : '#64748b' }}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                        {{ $category->is_active ? '✓ ACTIVE' : 'HIDDEN' }}
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" style="padding: 6px 14px; border-radius: 8px; border: 1px solid #e2e8f0; background: white; color: #475569; text-decoration: none; font-size: 13px; font-weight: 600; cursor: pointer;">✏️ Edit</a>

                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="margin: 0;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 6px 14px; border-radius: 8px; border: 1px solid #fecaca; background: #fef2f2; color: #ef4444; font-size: 13px; font-weight: 600; cursor: pointer;">🗑️ Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">No categories created yet. Add one on the left!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($categories, 'hasPages') && $categories->hasPages())
                <div style="padding: 16px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert2 Delete Confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Deleting this category might affect the products inside it. You cannot undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                borderRadius: '16px',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    });

    // Success Message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    // Image preview function
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('icon_preview').src = e.target.result;
                document.getElementById('icon_preview_container').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
