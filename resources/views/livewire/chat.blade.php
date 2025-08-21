<div class="min-h-full w-full flex flex-col">
    <div class="bg-gray-100 py-3 flex items-center justify-center shadow-sm">
        <div class="flex items-center space-x-4">
            <img
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face&auto=format"
                 class="lg:size-12 md:size-11 sm:size-10 size-8 rounded-full object-cover"
            >
            <div>
                <h2 class="font-semibold md:text-base text-sm text-gray-900">Alex Johnson</h2>
                <p class="text-sm text-sky-600 flex items-center">
                    <span class="size-2 bg-sky-600 rounded-full mr-2"></span>
                    Active
                </p>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-white">
        <!-- Date Separator -->
        <x-date :date="'Today'"/>

        <!-- Received Messages -->
        <livewire:friend-message />

        <livewire:my-message />

        <!-- Typing Indicator -->
        <div class="flex items-start space-x-3">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face&auto=format"
                 class="md:size-8 size-6 rounded-full object-cover mt-1">
            <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm">
                <div class="flex space-x-1">
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-200 px-6 py-4" x-data="{ openMedia: false, openWithKeyboard: false }">

        <div
            x-cloak x-show="openMedia || openWithKeyboard"
            x-transition.opacity x-trap="openWithKeyboard"
            x-on:click.outside="openMedia = false, openWithKeyboard = false"
            x-on:keydown.down.prevent="$focus.wrap().next()"
            x-on:keydown.up.prevent="$focus.wrap().previous()"
            class="w-full z-50 mb-2 bg-white rounded-lg p-4"
        >
            <div class="w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center py-9 w-full border border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-100 ">
                    <div class="mb-2 flex items-center justify-center">
                        <svg class="w-8 h-8 text-sky-700" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 486.3 486.3" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M395.5,135.8c-5.2-30.9-20.5-59.1-43.9-80.5c-26-23.8-59.8-36.9-95-36.9c-27.2,0-53.7,7.8-76.4,22.5 c-18.9,12.2-34.6,28.7-45.7,48.1c-4.8-0.9-9.8-1.4-14.8-1.4c-42.5,0-77.1,34.6-77.1,77.1c0,5.5,0.6,10.8,1.6,16 C16.7,200.7,0,232.9,0,267.2c0,27.7,10.3,54.6,29.1,75.9c19.3,21.8,44.8,34.7,72,36.2c0.3,0,0.5,0,0.8,0h86 c7.5,0,13.5-6,13.5-13.5s-6-13.5-13.5-13.5h-85.6C61.4,349.8,27,310.9,27,267.1c0-28.3,15.2-54.7,39.7-69 c5.7-3.3,8.1-10.2,5.9-16.4c-2-5.4-3-11.1-3-17.2c0-27.6,22.5-50.1,50.1-50.1c5.9,0,11.7,1,17.1,3c6.6,2.4,13.9-0.6,16.9-6.9 c18.7-39.7,59.1-65.3,103-65.3c59,0,107.7,44.2,113.3,102.8c0.6,6.1,5.2,11,11.2,12c44.5,7.6,78.1,48.7,78.1,95.6 c0,49.7-39.1,92.9-87.3,96.6h-73.7c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5h74.2c0.3,0,0.6,0,1,0c30.5-2.2,59-16.2,80.2-39.6 c21.1-23.2,32.6-53,32.6-84C486.2,199.5,447.9,149.6,395.5,135.8z"></path> <path d="M324.2,280c5.3-5.3,5.3-13.8,0-19.1l-71.5-71.5c-2.5-2.5-6-4-9.5-4s-7,1.4-9.5,4l-71.5,71.5c-5.3,5.3-5.3,13.8,0,19.1 c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l48.5-48.5v222.9c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5V231.5l48.5,48.5 C310.4,285.3,318.9,285.3,324.2,280z"></path> </g> </g> </g></svg>
                    </div>
                    <h2 class="text-center text-gray-400   text-xs font-normal leading-4 mb-1">Upload images, videos, documents...(Max 10MB)</h2>
                    <h4 class="text-center text-gray-700 text-sm font-medium leading-snug">Drag and Drop your file here or</h4>
                    <input id="dropzone-file" type="file" class="hidden" />
                </label>
            </div>
        </div>

        <div class="flex items-center space-x-4">

            <button
                x-on:click="openMedia = !openMedia"
                x-bind:aria-expanded="openMedia" x-on:keydown.space.prevent="openWithKeyboard = true"
                x-on:keydown.enter.prevent="openWithKeyboard = true" x-on:keydown.down.prevent="openWithKeyboard = true"
                class="p-2 hover:bg-sky-300 rounded-full transition-colors cursor-pointer"
                :class="{'bg-sky-300': openMedia || openWithKeyboard }"
            >
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
            </button>


            <div class="flex-1 relative">
                <input
                    type="text" placeholder="Type a message..."
                    class="w-full px-4 py-3 bg-gray-100 rounded-full border-0 focus:outline-none focus:ring-2 focus:ring-sky-600 focus:bg-white transition-all"
                >
            </div>
            <button class="bg-sky-600 hover:bg-sky-700 cursor-pointer text-white p-3 rounded-full transition-colors shadow-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
            </button>
        </div>
    </div>
</div>
