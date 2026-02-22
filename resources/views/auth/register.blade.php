<div class="min-h-screen flex items-center justify-center bg-gray-50 font-['Instrument_Sans']">
    <div class="max-w-md w-full p-8 bg-white rounded-2xl shadow-xl border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create Account</h2>
            <p class="text-gray-500 mt-2 italic">Join the Grocery Management Team</p>
        </div>

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Profile Photo</label>
                <div class="flex items-center gap-4">
                    <div id="preview-container" class="w-16 h-16 rounded-full bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                        <span id="placeholder" class="text-gray-400 text-xs">NO IMG</span>
                        <img id="avatar-preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                    </div>
                    <input type="file" name="avatar" id="avatar-input" accept="image/*" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">User Role</label>
                <select name="role" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all font-bold text-indigo-600">
                    <option value="driver">🚚 Driver (e.g., Rout Driver)</option>
                    <option value="admin">🛡️ Administrator</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
            </div>

            <button type="submit" class="w-full py-4 bg-indigo-600 text-white font-black rounded-xl shadow-lg hover:bg-indigo-700 transform transition-all active:scale-[0.98]">
                REGISTER NEW USER
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('avatar-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('placeholder');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
