<div class="container mx-auto px-4 py-8 mt-20">

    <div class="grid lg:grid-cols-2 gap-6 mb-8">
        <livewire:my-friend-requests />
        <livewire:incoming-requests />
    </div>


    <div class="flex justify-center mb-8">
        <div class="relative w-full sm:max-w-lg max-w-md">
            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 z-10" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488.4 488.4" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6 s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2 S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7 S381.9,104.65,381.9,203.25z"></path> </g> </g> </g></svg>

            <input
                wire:model.live="search"
                type="text"
                placeholder="Search by name or email..."
                class="w-full pl-12 pr-4 py-3 bg-white/90 backdrop-blur-sm border-0 rounded-full text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-sky-600 focus:bg-white transition-all"
            >
        </div>
    </div>

    <div class="bg-white/20 backdrop-blur-sm rounded-xl shadow-lg p-6 max-w-4xl mx-auto">
        <h2 class="text-xl font-semibold text-white text-center mb-6 border-b border-white/20 pb-2">
            Add Friends
        </h2>

        <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1">
            @forelse($suggestions as $suggestion)
                <div
                    wire:key="$suggestion->id"
                    class="flex items-center justify-between gap-4 p-3 bg-white/10 rounded-lg hover:bg-white/20 transition-colors"
                >
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <img
                            src="{{ asset('storage/users_avatars/' . $suggestion->avatar) }}"
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover flex-shrink-0"
                        >
                        <h3 class="font-medium text-white text-sm sm:text-base truncate">{{ $suggestion->display_name }}</h3>
                    </div>

                    <button
                        wire:click="addFriend({{ $suggestion->id }})"
                        wire:loading.class="opacity-50 pointer-events-none"
                        wire:target="addFriend({{ $suggestion->id }})"
                        class="text-center font-semibold cursor-pointer gap-2 px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-white bg-blue-500 hover:bg-blue-600 rounded-lg transition-colors flex-shrink-0"
                    >
                        Add Friend +
                    </button>
                </div>
            @empty
                <p class="text-base text-white text-center font-semibold mt-2">No users found.</p>
            @endforelse

        </div>
    </div>
</div>
