<div
    class="flex w-full min-h-screen"
     x-data="{ showChats: false }"
>

    <div
        x-cloak
        x-show="showChats"
        class="fixed inset-0 z-10 bg-surface-dark/10 backdrop-blur-xs lg:hidden"
        x-on:click="showChats = false"
        x-transition.opacity
    >

    </div>

    <div
        x-cloak
        x-bind:class="showChats ? 'translate-x-0' : '-translate-x-full'"
        class="bg-white flex flex-col shadow-2xl border-r border-gray-400
               fixed inset-y-0 left-0 flex-4/5 z-20 transform transition-transform lg:static lg:translate-x-0 lg:flex-1/3"    >
        <livewire:header />

        <livewire:chats />
    </div>

    <div class="flex-1 flex flex-col lg:flex-2/3">
        <button
            class="fixed right-4 top-2 z-20 rounded-full bg-sky-700 text-white p-4 cursor-pointer lg:hidden"
            x-on:click="showChats = ! showChats"
        >
            <svg x-show="showChats" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="md:size-5 sm:size-4 size-3" aria-hidden="true">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg>

            <svg fill="#ffffff" x-show="! showChats" class="md:size-5 sm:size-4 size-3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.003 512.003" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M192.002,138.664c-111.253,0-192,62.805-192,149.333c0,31.104,10.325,59.264,31.552,85.888 c0.363,12.907-1.365,45.76-25.301,69.696c-6.997,6.997-8.256,17.856-3.093,26.261c3.968,6.443,10.923,10.155,18.176,10.155 c2.219,0,4.48-0.341,6.677-1.067c23.872-7.872,87.531-34.517,104.299-41.6h59.691c111.253,0,192-62.805,192-149.333 S303.255,138.664,192.002,138.664z M128.002,223.997h85.333c11.776,0,21.333,9.557,21.333,21.333 c0,11.776-9.557,21.333-21.333,21.333h-85.333c-11.776,0-21.333-9.557-21.333-21.333 C106.668,233.555,116.226,223.997,128.002,223.997z M256.002,351.997h-128c-11.776,0-21.333-9.557-21.333-21.333 s9.557-21.333,21.333-21.333h128c11.776,0,21.333,9.557,21.333,21.333S267.778,351.997,256.002,351.997z"></path> <path d="M480.439,267.227c21.227-26.645,31.552-54.805,31.552-85.888c0-86.549-80.747-149.333-192-149.333 c-69.056,0-127.765,25.28-161.408,65.877c10.88-1.109,21.973-1.877,33.408-1.877c136,0,234.667,80.747,234.667,192 c0,20.523-3.392,40-9.728,58.133c24.235,9.963,52.757,21.397,67.051,26.112c2.219,0.747,4.459,1.088,6.677,1.088 c7.253,0,14.229-3.712,18.176-10.155c5.184-8.405,3.904-19.285-3.072-26.261C481.804,312.987,480.076,280.134,480.439,267.227z"></path> </g> </g> </g> </g></svg>
        </button>
        <livewire:chat />
    </div>
</div>
