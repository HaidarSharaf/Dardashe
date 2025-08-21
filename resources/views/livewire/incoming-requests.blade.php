<div class="bg-white/20 backdrop-blur-sm rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-white text-center mb-6 border-b border-white/20 pb-2">
            Incoming Requests
        </h2>

        <div class="max-h-36 overflow-y-auto space-y-3">
            @forelse($incoming_requests as $request)
                <div wire:key="$request->id" class="flex items-center justify-between gap-4 p-2">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <img
                            src="{{ asset('storage/users_avatars/' . $request->getUser1AvatarAttribute()) }}"
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover flex-shrink-0"
                        >
                        <h3 class="font-medium text-white text-sm sm:text-base truncate">{{ $request->getUser1DisplayNameAttribute() }}</h3>
                    </div>

                    <button
                        wire:click="acceptRequest({{ $request->id }})"
                        wire:loading.class="opacity-50 pointer-events-none"
                        wire:target="acceptRequest({{ $request->id }})"
                        class="font-semibold cursor-pointer px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-white bg-green-500 hover:bg-green-600 rounded-lg transition-colors flex-shrink-0"
                    >
                        Accept
                    </button>

                    <button
                        wire:click="rejectRequest({{ $request->id }})"
                        wire:confirm="Are you sure you want to reject this request?"
                        wire:loading.class="opacity-50 pointer-events-none"
                        wire:target="rejectRequest({{ $request->id }})"
                        class="font-semibold cursor-pointer px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-white bg-red-500 hover:bg-red-600 rounded-lg transition-colors flex-shrink-0"
                    >
                        Reject
                    </button>

                </div>
            @empty
                <p class="text-base text-white text-center font-semibold mt-2">No requests found.</p>
            @endforelse
        </div>
    </div>

