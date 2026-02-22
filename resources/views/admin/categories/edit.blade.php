@extends('layouts.admin')

@section('content')
<div class="category-container">
    
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.categories.index') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; margin-bottom: 12px;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#64748b'">
            ← Back to Categories
        </a>
        <h2 style="font-weight: 800; color: #1e293b; margin: 0 0 8px 0; font-size: 28px;">✏️ Edit Category</h2>
        <p style="color: #64748b; margin: 0; font-size: 15px;">Update category information.</p>
    </div>

    <div class="layout-sidebar" style="max-width: 100%; min-width: auto;">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 700; font-size: 12px; color: #64748b; margin-bottom: 8px;">CATEGORY NAME <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box;">
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
                            <p style="font-size: 12px; color: #94a3b8; margin-bottom: 8px;">New Image Preview:</p>
                            <img id="icon_preview" src="" style="width: 64px; height: 64px; object-fit: contain; background: #f8fafc; padding: 8px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        </div>
                        
                        @if($category->icon)
                            <div id="current_image_container" style="margin-top: 12px; padding: 12px; background: white; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <p style="font-size: 12px; color: #94a3b8; margin-bottom: 8px;">Current Image:</p>
                                <img src="{{ asset('storage/' . $category->icon) }}" style="width: 64px; height: 64px; object-fit: contain; background: #f8fafc; padding: 8px; border-radius: 12px; border: 1px solid #e2e8f0;">
                                
                                <div style="margin-top: 12px; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="remove_image" id="remove_image" value="1" style="width: 18px; height: 18px; cursor: pointer;">
                                    <label for="remove_image" style="font-weight: 600; font-size: 13px; color: #ef4444; cursor: pointer;">
                                        🗑️ Remove this image (so I can use emoji instead)
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div style="text-align: center; margin: 10px 0; color: #94a3b8;">— OR —</div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #64748b; margin-bottom: 6px;">Option 2: Enter Emoji</label>
                        <input type="text" name="emoji" value="{{ old('emoji', $category->emoji) }}" placeholder="🍎 🥬 🥩 🍞" maxlength="10" style="width: 100%; padding: 14px 16px; border-radius: 8px; border: 1px solid #e2e8f0; background: white; font-size: 28px; text-align: center; line-height: 1.4; height: 60px; box-sizing: border-box;">
                        @if($category->emoji && !$category->icon)
                            <p style="font-size: 12px; color: #94a3b8; margin-top: 8px; text-align: center;">Current Emoji: <strong>{{ $category->emoji }}</strong></p>
                        @endif
                    </div>
                </div>
                <small style="color: #94a3b8; margin-top: 5px; display: block;">Use an uploaded image OR an emoji. If both are provided, the image will be used.</small>
                @error('icon') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                @error('emoji') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; font-size: 12px; color: #64748b; margin-bottom: 8px;">DESCRIPTION</label>
                <textarea name="description" rows="3" style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box; resize: vertical;">{{ old('description', $category->description) }}</textarea>
            </div>

            <div style="margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    <label for="is_active" style="font-weight: 600; font-size: 14px; color: #334155; cursor: pointer;">Active (Show in store)</label>
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="flex: 1; padding: 14px; border-radius: 10px; background: #3b82f6; color: white; border: none; font-weight: 700; font-size: 15px; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);" onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
                    💾 Save Changes
                </button>
                <a href="{{ route('admin.categories.index') }}" style="flex: 1; padding: 14px; border-radius: 10px; background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; text-align: center; text-decoration: none; font-weight: 700; font-size: 15px; transition: 0.2s;" onmouseover="this.style.backgroundColor='#e2e8f0'" onmouseout="this.style.backgroundColor='#f1f5f9'">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
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
