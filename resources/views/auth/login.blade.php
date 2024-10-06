<x-guest-layout>
    <!-- Session Status -->
    <div class="min-h-screen flex flex-col w-full justify-center  py-6 sm:py-12">

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class=" flex flex-col items-center">
            @csrf

            <h1 class="lg:text-5xl lg:m-32  md:m-auto md:text-2xl text-blue-600 ">เข้าสู่ระบบ</h1>

            <!-- Email Address -->
            <div class="lg:w-1/3 md:w-full ">
                <x-input-label for="email" :value="__('อีเมล์')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class=" lg:w-1/3 md:w-full  lg:m-9 md:m-5">
                <x-input-label for="password" :value="__('รหัสผ่าน')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                @if (Route::has('register'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('register') }}">
                        {{ __('---สมัครสมาชิก---') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-guest-layout>
