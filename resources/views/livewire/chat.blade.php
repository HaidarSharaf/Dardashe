<div class="w-full sm:min-h-full min-h-96 flex flex-col">
    <div class="bg-gray-100 py-3 flex items-center justify-center shadow-sm">
        <div class="flex items-center space-x-4">
            <img
                src="{{ asset('storage/users_avatars/' . $friend->avatar) }}"
                 class="lg:size-12 md:size-11 sm:size-10 size-8 rounded-full object-cover"
            >
            <div>
                <h2 class="font-semibold md:text-base text-sm text-gray-900">{{ $friend->display_name }}</h2>
            </div>
        </div>
    </div>

    <div
        class="flex-1 overflow-y-auto p-6 space-y-4 bg-white"
        x-data
        x-ref="messagesContainer"
        x-init="() => {
            $nextTick(() => {
                const el = $refs.messagesContainer;
                el.scrollTop = el.scrollHeight;
                // Use MutationObserver to detect message list changes and auto-scroll
                const observer = new MutationObserver(() => {
                    el.scrollTop = el.scrollHeight;
                });
                observer.observe(el, { childList: true, subtree: true });
            });
        }"
    >

        @foreach($messages as $date => $groupedMessages)
            <x-date :date="$date"/>

            @foreach($groupedMessages as $message)
                <livewire:chat-message
                    :message="$message"
                    :isSentByMe="$message->sender_id === $this->user->id"
                    :key="$message->id"
                />
            @endforeach
        @endforeach

    </div>

    @can('send-message', $friend)
        <div class="bg-gray-200 px-6 py-4" x-data="{ openMedia: false, openWithKeyboard: false }">


                <div
                    x-cloak
                    x-show="openMedia || openWithKeyboard"
                    x-transition.opacity
                    x-trap="openWithKeyboard"
                    x-on:click.outside="openMedia = false; openWithKeyboard = false"
                    x-on:keydown.down.prevent="$focus.wrap().next()"
                    x-on:keydown.up.prevent="$focus.wrap().previous()"
                    class="w-full z-40 mb-2 bg-white rounded-lg p-4"
                    x-data
                >

                    <div class="w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center py-9 w-full border border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-100 ">
                            <div class="mb-2 flex items-center justify-center">
                                <svg class="w-8 h-8 text-sky-700" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 486.3 486.3" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M395.5,135.8c-5.2-30.9-20.5-59.1-43.9-80.5c-26-23.8-59.8-36.9-95-36.9c-27.2,0-53.7,7.8-76.4,22.5 c-18.9,12.2-34.6,28.7-45.7,48.1c-4.8-0.9-9.8-1.4-14.8-1.4c-42.5,0-77.1,34.6-77.1,77.1c0,5.5,0.6,10.8,1.6,16 C16.7,200.7,0,232.9,0,267.2c0,27.7,10.3,54.6,29.1,75.9c19.3,21.8,44.8,34.7,72,36.2c0.3,0,0.5,0,0.8,0h86 c7.5,0,13.5-6,13.5-13.5s-6-13.5-13.5-13.5h-85.6C61.4,349.8,27,310.9,27,267.1c0-28.3,15.2-54.7,39.7-69 c5.7-3.3,8.1-10.2,5.9-16.4c-2-5.4-3-11.1-3-17.2c0-27.6,22.5-50.1,50.1-50.1c5.9,0,11.7,1,17.1,3c6.6,2.4,13.9-0.6,16.9-6.9 c18.7-39.7,59.1-65.3,103-65.3c59,0,107.7,44.2,113.3,102.8c0.6,6.1,5.2,11,11.2,12c44.5,7.6,78.1,48.7,78.1,95.6 c0,49.7-39.1,92.9-87.3,96.6h-73.7c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5h74.2c0.3,0,0.6,0,1,0c30.5-2.2,59-16.2,80.2-39.6 c21.1-23.2,32.6-53,32.6-84C486.2,199.5,447.9,149.6,395.5,135.8z"></path> <path d="M324.2,280c5.3-5.3,5.3-13.8,0-19.1l-71.5-71.5c-2.5-2.5-6-4-9.5-4s-7,1.4-9.5,4l-71.5,71.5c-5.3,5.3-5.3,13.8,0,19.1 c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l48.5-48.5v222.9c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5V231.5l48.5,48.5 C310.4,285.3,318.9,285.3,324.2,280z"></path> </g> </g> </g></svg>
                            </div>
                            <h2 class="text-center text-gray-400   text-xs font-normal leading-4 mb-1">Upload images, videos, documents...(Max 5MB)</h2>
                            <h4 class="text-center text-gray-700 text-sm font-medium leading-snug">Drag and Drop your file here or</h4>
                            <input
                                wire:model.live="media"
                                x-ref="fileInput"
                                x-on:change="openMedia = false; openWithKeyboard = false"
                                id="dropzone-file"
                                type="file"
                                class="hidden"
                            />
                        </label>
                    </div>
                </div>

                <div class="flex items-center space-x-4">

                    <button
                        type="button"
                        x-on:click="openMedia = !openMedia"
                        x-bind:aria-expanded="openMedia"
                        x-on:keydown.space.prevent="openWithKeyboard = true"
                        x-on:keydown.down.prevent="openWithKeyboard = true"
                        class="p-2 rounded-full"
                        :class="{'bg-sky-300': openMedia || openWithKeyboard,
                                 'hover:bg-sky-300 transition-colors cursor-pointer': $wire.media === null,
                                 'opacity-50': $wire.media !== null
                                }"
                    >
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                    </button>


                    <div class="flex-1 relative">

                        <div>
                            @if($media)

                                @php
                                    $mime = $this->getMimeType($media)
                                @endphp

                                @if($mime === 'image')
                                    <img src="{{ $media->temporaryUrl() }}" class="p-2 md:size-24 sm:size-16 size-12 rounded-xl">
                                @elseif($mime === 'video')
                                    <video class="p-2 md:size-24 sm:size-16 size-12 rounded-xl">
                                        <source
                                            src="{{ $media->temporaryUrl() }}"
                                            type="video/mp4"
                                        />
                                    </video>
                                @else
                                    <div class="flex-1 bg-white min-h-12 w-fit mb-2 items-center rounded-lg">
                                        <p class="font-medium h-full flex gap-2 pt-2 px-2 items-center justify-center text-gray-800 truncate mb-2">
                                            <svg class="size-5 text-gray-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13 3L13.7071 2.29289C13.5196 2.10536 13.2652 2 13 2V3ZM19 9H20C20 8.73478 19.8946 8.48043 19.7071 8.29289L19 9ZM13.109 8.45399L14 8V8L13.109 8.45399ZM13.546 8.89101L14 8L13.546 8.89101ZM10 13C10 12.4477 9.55228 12 9 12C8.44772 12 8 12.4477 8 13H10ZM8 16C8 16.5523 8.44772 17 9 17C9.55228 17 10 16.5523 10 16H8ZM8.5 9C7.94772 9 7.5 9.44772 7.5 10C7.5 10.5523 7.94772 11 8.5 11V9ZM9.5 11C10.0523 11 10.5 10.5523 10.5 10C10.5 9.44772 10.0523 9 9.5 9V11ZM8.5 6C7.94772 6 7.5 6.44772 7.5 7C7.5 7.55228 7.94772 8 8.5 8V6ZM9.5 8C10.0523 8 10.5 7.55228 10.5 7C10.5 6.44772 10.0523 6 9.5 6V8ZM17.908 20.782L17.454 19.891L17.454 19.891L17.908 20.782ZM18.782 19.908L19.673 20.362L18.782 19.908ZM5.21799 19.908L4.32698 20.362H4.32698L5.21799 19.908ZM6.09202 20.782L6.54601 19.891L6.54601 19.891L6.09202 20.782ZM6.09202 3.21799L5.63803 2.32698L5.63803 2.32698L6.09202 3.21799ZM5.21799 4.09202L4.32698 3.63803L4.32698 3.63803L5.21799 4.09202ZM12 3V7.4H14V3H12ZM14.6 10H19V8H14.6V10ZM12 7.4C12 7.66353 11.9992 7.92131 12.0169 8.13823C12.0356 8.36682 12.0797 8.63656 12.218 8.90798L14 8C14.0293 8.05751 14.0189 8.08028 14.0103 7.97537C14.0008 7.85878 14 7.69653 14 7.4H12ZM14.6 8C14.3035 8 14.1412 7.99922 14.0246 7.9897C13.9197 7.98113 13.9425 7.9707 14 8L13.092 9.78201C13.3634 9.92031 13.6332 9.96438 13.8618 9.98305C14.0787 10.0008 14.3365 10 14.6 10V8ZM12.218 8.90798C12.4097 9.2843 12.7157 9.59027 13.092 9.78201L14 8V8L12.218 8.90798ZM8 13V16H10V13H8ZM8.5 11H9.5V9H8.5V11ZM8.5 8H9.5V6H8.5V8ZM13 2H8.2V4H13V2ZM4 6.2V17.8H6V6.2H4ZM8.2 22H15.8V20H8.2V22ZM20 17.8V9H18V17.8H20ZM19.7071 8.29289L13.7071 2.29289L12.2929 3.70711L18.2929 9.70711L19.7071 8.29289ZM15.8 22C16.3436 22 16.8114 22.0008 17.195 21.9694C17.5904 21.9371 17.9836 21.8658 18.362 21.673L17.454 19.891C17.4045 19.9162 17.3038 19.9539 17.0322 19.9761C16.7488 19.9992 16.3766 20 15.8 20V22ZM18 17.8C18 18.3766 17.9992 18.7488 17.9761 19.0322C17.9539 19.3038 17.9162 19.4045 17.891 19.454L19.673 20.362C19.8658 19.9836 19.9371 19.5904 19.9694 19.195C20.0008 18.8114 20 18.3436 20 17.8H18ZM18.362 21.673C18.9265 21.3854 19.3854 20.9265 19.673 20.362L17.891 19.454C17.7951 19.6422 17.6422 19.7951 17.454 19.891L18.362 21.673ZM4 17.8C4 18.3436 3.99922 18.8114 4.03057 19.195C4.06287 19.5904 4.13419 19.9836 4.32698 20.362L6.10899 19.454C6.0838 19.4045 6.04612 19.3038 6.02393 19.0322C6.00078 18.7488 6 18.3766 6 17.8H4ZM8.2 20C7.62345 20 7.25117 19.9992 6.96784 19.9761C6.69617 19.9539 6.59545 19.9162 6.54601 19.891L5.63803 21.673C6.01641 21.8658 6.40963 21.9371 6.80497 21.9694C7.18864 22.0008 7.65645 22 8.2 22V20ZM4.32698 20.362C4.6146 20.9265 5.07354 21.3854 5.63803 21.673L6.54601 19.891C6.35785 19.7951 6.20487 19.6422 6.10899 19.454L4.32698 20.362ZM8.2 2C7.65645 2 7.18864 1.99922 6.80497 2.03057C6.40963 2.06287 6.01641 2.13419 5.63803 2.32698L6.54601 4.10899C6.59545 4.0838 6.69617 4.04612 6.96784 4.02393C7.25117 4.00078 7.62345 4 8.2 4V2ZM6 6.2C6 5.62345 6.00078 5.25117 6.02393 4.96784C6.04612 4.69617 6.0838 4.59545 6.10899 4.54601L4.32698 3.63803C4.13419 4.01641 4.06287 4.40963 4.03057 4.80497C3.99922 5.18864 4 5.65645 4 6.2H6ZM5.63803 2.32698C5.07354 2.6146 4.6146 3.07354 4.32698 3.63803L6.10899 4.54601C6.20487 4.35785 6.35785 4.20487 6.54601 4.10899L5.63803 2.32698Z" fill="#000000"></path> </g></svg>
                                            {{ $media->getClientOriginalName() }}
                                        </p>
                                    </div>
                                @endif
                            @endif

                        </div>

                        <input
                            type="text" placeholder="Type a message..."
                            wire:model.live="text"
                            class="w-full px-4 py-3 bg-gray-100 rounded-full border-0 focus:outline-none focus:ring-2 focus:ring-sky-600 focus:bg-white transition-all"
                        >
                    </div>
                    <button
                        @click.prevent="
                            $wire.sendMessage({{ $friend->id }}).then(() => {
                                $refs.fileInput.value = null;
                            })
                        "
                        wire:loading.class="opacity-50 pointer-events-none"
                        :class="{
                            'cursor-pointer hover:bg-sky-700': $wire.text !== '' || $wire.media,
                            'cursor-not-allowed opacity-50': $wire.text === '' && !$wire.media,
                            'bg-sky-600 text-white p-3 rounded-full transition-colors shadow-lg' : true
                        }"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                </div>
        </div>
    @endcan

</div>
