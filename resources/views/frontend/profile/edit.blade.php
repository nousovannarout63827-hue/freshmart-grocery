@extends('frontend.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
            <h2 class="text-2xl font-bold text-slate-800">⚙️ Edit Profile</h2>
            <p class="text-slate-500">Update your personal information and profile photo.</p>
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col md:flex-row gap-8">
                    <div class="flex-shrink-0 text-center">
                        <div class="relative inline-block">
                            <img id="profile-preview" 
                                 src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0D8ABC&color=fff&size=128' }}" 
                                 class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md"
                                 alt="Profile Photo">
                            
                            <input type="file" id="image-input" name="avatar" accept="image/*" class="hidden">
                            
                            <label for="image-input" class="absolute bottom-0 right-0 bg-green-600 text-white p-2 rounded-full hover:bg-green-700 cursor-pointer shadow-sm transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                </svg>
                            </label>
                        </div>
                        <p class="text-xs text-slate-400 mt-3">Allowed *.jpeg, *.jpg, *.png, *.gif<br>Max size of 2 MB</p>
                    </div>

                    <div class="flex-1 space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border-slate-200 rounded-lg px-4 py-3 focus:ring-green-500 focus:border-green-500">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-slate-200 rounded-lg px-4 py-3 focus:ring-green-500 focus:border-green-500">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-between items-center">
                    <a href="{{ route('customer.orders') }}" class="text-slate-600 hover:text-slate-800 font-medium">
                        ← View My Orders
                    </a>
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-700 transition shadow-sm shadow-green-600/20">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type.match('image.*')) {
            // Check file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size exceeds 2MB. Please choose a smaller image.');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update the source of the preview image circle
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
