<div class="w-full">
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">


        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Create an Account</h2>

        <form wire:submit.prevent="register">


            <div class="space-y-6">

                <div>
                    <label class="block text-sm md:text-base mb-1 text-white">Full Name:</label>
                    <input
                        wire:model="name"
                        type="text"
                        class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium text-sm md:text-base mb-1 text-white">Email:</label>
                    <input
                        wire:model="email"
                        type="email"
                        class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium text-sm md:text-base mb-1 text-white">Password:</label>
                    <input
                        wire:model="password"
                        type="password"
                        class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium text-sm md:text-base mb-1 text-white">Confirm Password:</label>
                    <input
                        wire:model="password_confirmation"
                        type="password"
                        class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <div>
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:loading.class="pointer-events-none"
                        class="w-full bg-[#1750b6] hover:bg-blue-800 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span wire:loading.remove>Create Account</span>
                        <span wire:loading>Creating...</span>
                    </button>
                </div>


            </div>
        </form>

        <div class="mt-4 flex justify-center">
            <p class="text-sm text-white">
                Already have an account?
                <a
                    wire:navigate
                    href="{{ route('login') }}"
                    class="text-blue-500 hover:underline"
                >
                    Log in here.
                </a>
            </p>
        </div>
    </div>
</div>
