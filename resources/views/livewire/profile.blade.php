<div class="py-8 px-4">
    <div class="max-w-3xl mx-auto">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Profile Settings</h1>
            <p class="text-white">Manage your account information</p>
        </div>

        <div class="overflow-hidden">
            <div class="flex flex-col items-center">
                <div class="relative mb-4">
                    <input type="file" id="profilePicture" accept="image/*" class="hidden">
                    <label for="profilePicture" class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg cursor-pointer hover:bg-gray-50 transition-colors">
                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </label>
                </div>
                <h2 class="text-xl font-semibold text-white">John Doe</h2>
                <label for="profilePicture" class="text-blue-100 text-sm cursor-pointer hover:text-white transition-colors">
                    Click here or on the profile picture to change it.
                </label>
            </div>

            <!-- Form Section -->
            <div class="p-6">
                <livewire:auth.update-password />
            </div>
        </div>
    </div>
</div>
