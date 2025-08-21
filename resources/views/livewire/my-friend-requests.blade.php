<div class="bg-white/20 backdrop-blur-sm rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-semibold text-white text-center mb-6 border-b border-white/20 pb-2">
        My Friend Requests
    </h2>

    <div class="max-h-36 overflow-y-auto space-y-3">
        @forelse($my_requests as $request)
            <div wire:key="$request->id" class="flex items-center justify-between gap-4 p-2">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <img
                        src="{{ asset('storage/users_avatars/' . $request->getUser2AvatarAttribute()) }}"
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover flex-shrink-0"
                    >
                    <h3 class="font-medium text-white text-sm sm:text-base truncate">{{ $request->getUser2DisplayNameAttribute() }}</h3>
                </div>
                <button
                    class="font-semibold bg-amber-500 px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-white rounded-lg transition-colors flex-shrink-0"
                >
                    Pending
                </button>
            </div>
        @empty
            <p class="text-base text-white text-center font-semibold mt-2">No requests found.</p>
        @endforelse
    </div>
</div>
