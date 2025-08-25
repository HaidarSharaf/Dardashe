<div class="container mx-auto px-4 py-8 mt-20">

    <div class="bg-white/20 backdrop-blur-sm rounded-xl shadow-lg p-6 max-w-4xl mx-auto">
        <h2 class="text-xl font-semibold text-white text-center mb-6 border-b border-white/20 pb-2">
            My Friends
        </h2>

        <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1 max-h-[600px] overflow-y-auto">
            @forelse($friends as $friend)
                <div
                    wire:key="$friend->id"
                    class="flex items-center justify-between gap-4 p-3 bg-white/10 rounded-lg hover:bg-white/20 transition-colors"
                >
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <img
                            src="{{ asset('storage/users_avatars/' . $friend->avatar) }}"
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover flex-shrink-0"
                        >
                        <h3 class="font-medium text-white text-sm sm:text-base truncate">{{ $friend->display_name }}</h3>
                    </div>

                    <a
                        wire:navigate
                        href="{{ route('chat', $friend) }}"
                        class="flex font-semibold items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-white bg-blue-500 hover:bg-blue-600 rounded-lg transition-colors flex-shrink-0">
                        <span class="hidden sm:inline">Send Message</span>
                        <span class="sm:hidden">Message</span>
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.4376 15.3703L12.3042 19.5292C11.9326 20.2537 10.8971 20.254 10.525 19.5297L4.24059 7.2971C3.81571 6.47007 4.65077 5.56156 5.51061 5.91537L18.5216 11.2692C19.2984 11.5889 19.3588 12.6658 18.6227 13.0704L14.4376 15.3703ZM14.4376 15.3703L5.09594 6.90886" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                    </a>

                    <button
                        wire:click="removeFriend({{ $friend->id }})"
                        wire:confirm="Are you sure you want to remove this friend?"
                        wire:loading.class="opacity-50 pointer-events-none"
                        wire:target="removeFriend({{ $friend->id }})"
                        class="font-semibold cursor-pointer px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-white bg-red-500 hover:bg-red-600 rounded-lg transition-colors flex-shrink-0"
                    >
                        Remove
                    </button>

                </div>
            @empty
                <p class="text-lg font-bold text-center grid-cols-12 text-white">
                    No friends found! Add some friends
                    <a
                        wire:navigate
                        href="{{ route('add-friends') }}"
                        class="text-blue-500 hover:underline"
                    >
                        here
                    </a>
                    .
                </p>

            @endforelse
        </div>
    </div>
</div>
