<div
    x-data="{ showChats: false }"
>
    <div
        x-cloak
        x-show="showChats"
        class="fixed inset-0 z-10 bg-surface-dark/10 backdrop-blur-xs lg:hidden"
        x-on:click="showChats = false"
        x-transition.opacity
    ></div>

    <div
        x-cloak
        x-bind:class="showChats ? 'translate-x-0' : '-translate-x-full'"
        class="bg-white flex flex-col shadow-2xl border-r border-gray-400
               fixed inset-y-0 left-0 flex-4/5 z-20 min-h-screen transform transition-transform lg:static lg:translate-x-0 lg:flex-1/3"
    >
        <livewire:header />

        <div class="w-full z-40">

            <div class="flex-1 overflow-y-auto" wire:poll.5s>

                @forelse($chats as $chat)

                    @php
                        $lastMessage = $this->getlatestMessage($chat->id);
                    @endphp

                    @if($lastMessage['sender'] !== null)
                        <button
                            wire:click="goToChat({{$chat->id}})"
                            wire:key="{{ $chat->id }}"
                            class="w-full cursor-pointer"
                        >
                            <div
                                class="flex items-center p-4 hover:bg-sky-100 cursor-pointer transition-colors"
                                :class="{'bg-sky-100': window.location.href.includes('{{ $chat->display_name }}') }"
                            >
                                <div class="relative">
                                    <img src="{{ asset('storage/users_avatars/' . $chat->avatar) }}"
                                         class="lg:size-12 md:size-11 sm:size-10 size-8 rounded-full object-cover"
                                    >
                                </div>

                                @php
                                    $unseenCount = $this->getUnseenMessagesCount($chat->id);
                                @endphp

                                <div class="ml-4 flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="font-semibold text-gray-900 text-base">{{ $chat->display_name }}</h3>
                                        <span
                                            @class([
                                                'text-sky-600' => $unseenCount > 0,
                                                'text-gray-700' => $unseenCount === 0,
                                                'text-xs font-medium' => true
                                            ])
                                        >
                                            {{ $lastMessage['time'] }}
                                        </span>
                                    </div>

                                    @php
                                        $mediaType = $lastMessage['media'];
                                        $hasMedia = $mediaType !== null;
                                    @endphp

                                    <div class="text-sm flex items-center truncate">
                                        <p class="flex items-center mr-2 text-gray-600">
                                            {{ $this->getLastMessageSenderName($lastMessage['sender']) }} :
                                            @if($hasMedia)
                                                <p class="flex items-center gap-1 text-gray-600">
                                                    @if($mediaType === 'image')
                                                        <svg class="size-5 text-gray-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 11C9.10457 11 10 10.1046 10 9C10 7.89543 9.10457 7 8 7C6.89543 7 6 7.89543 6 9C6 10.1046 6.89543 11 8 11Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6.56055 21C12.1305 8.89998 16.7605 6.77998 22.0005 14.63" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18 3H6C3.79086 3 2 4.79086 2 7V17C2 19.2091 3.79086 21 6 21H18C20.2091 21 22 19.2091 22 17V7C22 4.79086 20.2091 3 18 3Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                        Photo
                                                    @elseif($mediaType === 'video')
                                                        <svg class="size-5 text-gray-600" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H0V14H16V2ZM6.5 5V11H7.5L11 8L7.5 5H6.5Z" fill="#000000"></path> </g></svg>
                                                        Video
                                                    @else
                                                        <svg class="size-5 text-gray-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13 3L13.7071 2.29289C13.5196 2.10536 13.2652 2 13 2V3ZM19 9H20C20 8.73478 19.8946 8.48043 19.7071 8.29289L19 9ZM13.109 8.45399L14 8V8L13.109 8.45399ZM13.546 8.89101L14 8L13.546 8.89101ZM10 13C10 12.4477 9.55228 12 9 12C8.44772 12 8 12.4477 8 13H10ZM8 16C8 16.5523 8.44772 17 9 17C9.55228 17 10 16.5523 10 16H8ZM8.5 9C7.94772 9 7.5 9.44772 7.5 10C7.5 10.5523 7.94772 11 8.5 11V9ZM9.5 11C10.0523 11 10.5 10.5523 10.5 10C10.5 9.44772 10.0523 9 9.5 9V11ZM8.5 6C7.94772 6 7.5 6.44772 7.5 7C7.5 7.55228 7.94772 8 8.5 8V6ZM9.5 8C10.0523 8 10.5 7.55228 10.5 7C10.5 6.44772 10.0523 6 9.5 6V8ZM17.908 20.782L17.454 19.891L17.454 19.891L17.908 20.782ZM18.782 19.908L19.673 20.362L18.782 19.908ZM5.21799 19.908L4.32698 20.362H4.32698L5.21799 19.908ZM6.09202 20.782L6.54601 19.891L6.54601 19.891L6.09202 20.782ZM6.09202 3.21799L5.63803 2.32698L5.63803 2.32698L6.09202 3.21799ZM5.21799 4.09202L4.32698 3.63803L4.32698 3.63803L5.21799 4.09202ZM12 3V7.4H14V3H12ZM14.6 10H19V8H14.6V10ZM12 7.4C12 7.66353 11.9992 7.92131 12.0169 8.13823C12.0356 8.36682 12.0797 8.63656 12.218 8.90798L14 8C14.0293 8.05751 14.0189 8.08028 14.0103 7.97537C14.0008 7.85878 14 7.69653 14 7.4H12ZM14.6 8C14.3035 8 14.1412 7.99922 14.0246 7.9897C13.9197 7.98113 13.9425 7.9707 14 8L13.092 9.78201C13.3634 9.92031 13.6332 9.96438 13.8618 9.98305C14.0787 10.0008 14.3365 10 14.6 10V8ZM12.218 8.90798C12.4097 9.2843 12.7157 9.59027 13.092 9.78201L14 8V8L12.218 8.90798ZM8 13V16H10V13H8ZM8.5 11H9.5V9H8.5V11ZM8.5 8H9.5V6H8.5V8ZM13 2H8.2V4H13V2ZM4 6.2V17.8H6V6.2H4ZM8.2 22H15.8V20H8.2V22ZM20 17.8V9H18V17.8H20ZM19.7071 8.29289L13.7071 2.29289L12.2929 3.70711L18.2929 9.70711L19.7071 8.29289ZM15.8 22C16.3436 22 16.8114 22.0008 17.195 21.9694C17.5904 21.9371 17.9836 21.8658 18.362 21.673L17.454 19.891C17.4045 19.9162 17.3038 19.9539 17.0322 19.9761C16.7488 19.9992 16.3766 20 15.8 20V22ZM18 17.8C18 18.3766 17.9992 18.7488 17.9761 19.0322C17.9539 19.3038 17.9162 19.4045 17.891 19.454L19.673 20.362C19.8658 19.9836 19.9371 19.5904 19.9694 19.195C20.0008 18.8114 20 18.3436 20 17.8H18ZM18.362 21.673C18.9265 21.3854 19.3854 20.9265 19.673 20.362L17.891 19.454C17.7951 19.6422 17.6422 19.7951 17.454 19.891L18.362 21.673ZM4 17.8C4 18.3436 3.99922 18.8114 4.03057 19.195C4.06287 19.5904 4.13419 19.9836 4.32698 20.362L6.10899 19.454C6.0838 19.4045 6.04612 19.3038 6.02393 19.0322C6.00078 18.7488 6 18.3766 6 17.8H4ZM8.2 20C7.62345 20 7.25117 19.9992 6.96784 19.9761C6.69617 19.9539 6.59545 19.9162 6.54601 19.891L5.63803 21.673C6.01641 21.8658 6.40963 21.9371 6.80497 21.9694C7.18864 22.0008 7.65645 22 8.2 22V20ZM4.32698 20.362C4.6146 20.9265 5.07354 21.3854 5.63803 21.673L6.54601 19.891C6.35785 19.7951 6.20487 19.6422 6.10899 19.454L4.32698 20.362ZM8.2 2C7.65645 2 7.18864 1.99922 6.80497 2.03057C6.40963 2.06287 6.01641 2.13419 5.63803 2.32698L6.54601 4.10899C6.59545 4.0838 6.69617 4.04612 6.96784 4.02393C7.25117 4.00078 7.62345 4 8.2 4V2ZM6 6.2C6 5.62345 6.00078 5.25117 6.02393 4.96784C6.04612 4.69617 6.0838 4.59545 6.10899 4.54601L4.32698 3.63803C4.13419 4.01641 4.06287 4.40963 4.03057 4.80497C3.99922 5.18864 4 5.65645 4 6.2H6ZM5.63803 2.32698C5.07354 2.6146 4.6146 3.07354 4.32698 3.63803L6.10899 4.54601C6.20487 4.35785 6.35785 4.20487 6.54601 4.10899L5.63803 2.32698Z" fill="#000000"></path> </g></svg>
                                                        File
                                                    @endif
                                                </p>
                                            @else
                                                {{ $lastMessage['message']  }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if($unseenCount > 0)
                                    <div class="ml-2 bg-sky-600 text-white text-xs rounded-full px-2 py-1 md:max-w-[25px] text-center">
                                        {{ $unseenCount }}
                                    </div>
                                @endif

                            </div>
                        </button>
                    @else

                    @endif

                @empty
                    <div class="p-4 text-center mt-5 text-sky-600">
                        You have no chats yet. Want to chat with your friends?
                        <a
                            class="text-sky-700 font-semibold hover:underline ml-1"
                            href="{{ route('friends') }}"
                            wire:navigate
                        >
                            Click here.</a>
                    </div>
                @endforelse


            </div>
        </div>
    </div>

    <button
        class="fixed right-2 sm:top-2 top-4 z-20 rounded-full bg-sky-700 text-white p-4 cursor-pointer lg:hidden"
        x-on:click="showChats = !showChats"
    >
        <svg x-show="showChats" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="md:size-5 sm:size-4 size-3" aria-hidden="true">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
        </svg>

        <svg fill="#ffffff" x-show="!showChats" class="md:size-5 sm:size-4 size-3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.003 512.003" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M192.002,138.664c-111.253,0-192,62.805-192,149.333c0,31.104,10.325,59.264,31.552,85.888 c0.363,12.907-1.365,45.76-25.301,69.696c-6.997,6.997-8.256,17.856-3.093,26.261c3.968,6.443,10.923,10.155,18.176,10.155 c2.219,0,4.48-0.341,6.677-1.067c23.872-7.872,87.531-34.517,104.299-41.6h59.691c111.253,0,192-62.805,192-149.333 S303.255,138.664,192.002,138.664z M128.002,223.997h85.333c11.776,0,21.333,9.557,21.333,21.333 c0,11.776-9.557,21.333-21.333,21.333h-85.333c-11.776,0-21.333-9.557-21.333-21.333 C106.668,233.555,116.226,223.997,128.002,223.997z M256.002,351.997h-128c-11.776,0-21.333-9.557-21.333-21.333 s9.557-21.333,21.333-21.333h128c11.776,0,21.333,9.557,21.333,21.333S267.778,351.997,256.002,351.997z"></path> <path d="M480.439,267.227c21.227-26.645,31.552-54.805,31.552-85.888c0-86.549-80.747-149.333-192-149.333 c-69.056,0-127.765,25.28-161.408,65.877c10.88-1.109,21.973-1.877,33.408-1.877c136,0,234.667,80.747,234.667,192 c0,20.523-3.392,40-9.728,58.133c24.235,9.963,52.757,21.397,67.051,26.112c2.219,0.747,4.459,1.088,6.677,1.088 c7.253,0,14.229-3.712,18.176-10.155c5.184-8.405,3.904-19.285-3.072-26.261C481.804,312.987,480.076,280.134,480.439,267.227z"></path> </g> </g> </g> </g></svg>
    </button>

</div>


