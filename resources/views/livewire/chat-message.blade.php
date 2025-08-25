<div
    @class([
        'justify-end' => $isSentByMe,
        'items-start space-x-3' => !$isSentByMe,
        'flex' => true
    ])
>
    @if(!$isSentByMe)
        <img
            src="{{ asset('storage/users_avatars/' . $message->getMessageSenderAvatarAttribute()) }}"
            class="size-8 rounded-full object-cover mt-1"
        >
    @endif

    <div class="flex flex-col space-y-1 max-w-sm">

        <div
            @class([
                'bg-sky-600 text-white rounded-tr-md' => $isSentByMe,
                'bg-gray-100 rounded-tl-md' => !$isSentByMe,
                'rounded-2xl px-4 py-3 shadow-sm' => true,
            ])
        >
            <p
                class="md:text-base text-sm"
                @class([
                    'text-gray-800' => !$isSentByMe,
                    'text-white' => $isSentByMe
                ])
            >
                @if($message->hasMedia())
                    @if($message->latestMedia?->media_type === 'image')
                        <img src="{{ asset('storage/message_medias/images/' . $message->latestMedia?->media_path) }}" class="p-2 md:size-48 sm:size-36 size:32 rounded-xl">
                    @elseif($message->latestMedia?->media_type === 'video')
                        <video class="p-2 md:size-48 sm:size-36 size:32 rounded-xl" controls>
                            <source
                                src="{{ asset('storage/message_medias/videos/' . $message->latestMedia?->media_path) }}"
                                type="video/mp4"
                            />
                        </video>
                    @else
                        <div class="flex justify-end mb-3">
                            <div class="bg-sky-100 rounded-xl shadow p-3 max-w-xs flex flex-col items-center space-x-3">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 truncate mb-2">{{ $message->latestMedia?->media_path }}</p>
                                </div>

                                <a href="/storage/files/Project-Plan.pdf"
                                   class="text-sky-600 hover:text-sky-800 transition">
                                    Download ⬇️
                                </a>
                            </div>
                        </div>
                    @endif
                @endif

                {{ $message->text }}
            </p>
        </div>

        <span
            @class([
                'text-right' => $isSentByMe,
                'text-left' => !$isSentByMe,
                'text-xs text-gray-500 px-2' => true
            ])
        >
            {{ $message->created_at->format('H:i') }}
        </span>

    </div>
</div>
