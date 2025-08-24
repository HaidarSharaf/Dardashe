<div class="py-8 px-4">
    <div class="max-w-3xl mx-auto">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-4 underline">Profile Settings</h1>
            <p class="text-white">Manage your account information</p>
        </div>

        <div class="overflow-hidden">
            <div class="flex flex-col items-center">
                <div class="relative mb-4">
                    <input wire:model="avatar" type="file" id="profilePicture" accept="image/*" class="hidden">
                    <label for="profilePicture" class="md:size-24 size-20 bg-white rounded-full flex items-center justify-center shadow-lg cursor-pointer hover:bg-gray-50 transition-colors">
                        @if($avatar)
                            <img
                                src="{{ $avatar->temporaryUrl() }}"
                                class="size-full object-cover rounded-full shadow-xl"
                            >
                        @else
                            <img
                                src="{{ asset('storage/users_avatars/' . $user->avatar) }}"
                                 class="size-full object-cover rounded-full shadow-xl"
                            >
                        @endif
                    </label>
                </div>


                <h2 class="text-xl font-semibold text-white">{{ $user->display_name }}</h2>
                <label for="profilePicture" class="text-blue-100 text-sm cursor-pointer hover:text-white transition-colors">
                    Click here or on the profile picture to change it.
                </label>

                <button
                    wire:show="avatar"
                    wire:click.prevent="updateProfile"
                    wire:loading.class="opacity-50 pointer-events-none"
                    wire:target="updateProfile"
                    type="button"

                    class="cursor-pointer mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Save
                </button>

                <p
                    wire:loading
                    wire:change="avatar"
                    class="text-sm text-white font-bold mb-2"
                >
                    Uploading...
                </p>
            </div>

            <div class="p-6">
                <livewire:auth.update-password />
            </div>
        </div>
    </div>
</div>
