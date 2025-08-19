<div class="min-h-full w-full flex flex-col">
    <div class="bg-gray-200 py-3 flex items-center justify-center shadow-sm">
        <div class="flex items-center space-x-4">
            <img
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face&auto=format"
                 class="w-12 h-12 rounded-full object-cover"
            >
            <div>
                <h2 class="font-semibold text-gray-900">Alex Johnson</h2>
                <p class="text-sm text-sky-600 flex items-center">
                    <span class="w-2 h-2 bg-sky-600 rounded-full mr-2"></span>
                    Active
                </p>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gradient-to-b from-gray-100 to-gray-200">
        <!-- Date Separator -->
        <div class="flex justify-center">
            <span class="bg-white px-3 py-1 rounded-full text-xs text-gray-500 shadow-sm">Today</span>
        </div>

        <!-- Received Messages -->
        <div class="flex items-start space-x-3">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face&auto=format"
                 class="w-8 h-8 rounded-full object-cover mt-1">
            <div class="flex flex-col space-y-1 max-w-sm">
                <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm">
                    <p class="text-gray-800">Hey! How's the project coming along?</p>
                </div>
                <span class="text-xs text-gray-500 px-2">2:30 PM</span>
            </div>
        </div>

        <!-- Sent Messages -->
        <div class="flex justify-end">
            <div class="flex flex-col space-y-1 max-w-sm">
                <div class="bg-sky-500 text-white rounded-2xl rounded-tr-md px-4 py-3 shadow-sm">
                    <p>It's going really well! Just finished the main features.</p>
                </div>
                <div class="flex items-center justify-end space-x-1 px-2">
                    <span class="text-xs text-gray-500">2:31 PM</span>
                    <svg class="w-4 h-4 text-sky-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div class="flex items-start space-x-3">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face&auto=format"
                 class="w-8 h-8 rounded-full object-cover mt-1">
            <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm">
                <div class="flex space-x-1">
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-200 px-6 py-4">
        <div class="flex items-center space-x-4">
            <button class="p-2 hover:bg-sky-200 rounded-full transition-colors">
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
            <button class="bg-sky-600 hover:bg-sky-700 text-white p-3 rounded-full transition-colors shadow-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
            </button>
        </div>
    </div>
</div>
