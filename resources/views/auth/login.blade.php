<x-guest-layout>    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
    <x-input-label for="password" :value="__('Password')" />

    <!-- Password Input with Eye Icon -->
    <div class="relative">
        <x-text-input 
            id="password" 
            class="block mt-1 w-full pr-10" 
            type="password" 
            name="password" 
            required 
            autocomplete="current-password" 
            style="padding-right: 2.5rem;" 
        />

        <!-- Eye Icon inside the Input -->
        <span onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center" style="margin-top: -30px;
        margin-right: 10px;
        cursor: pointer;">
            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2C5 2 1 7 1 10s4 8 9 8 9-5 9-8-4-8-9-8zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-10a4 4 0 0 0-4 4h2a2 2 0 1 1 4 0h2a4 4 0 0 0-4-4z"/>
            </svg>
        </span>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Script to toggle password visibility -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('fill', 'blue');  // Optional: Change icon color
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('fill', 'currentColor'); // Revert icon color
            }
        }
    </script>
</x-guest-layout>
