<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" class= "  " >
        @csrf
   
<div class="grid grid-grid-rows-12 gap-2" >
        <div class="">
            <x-input-label for="id" :value="__('รหัสผู้รับผิดชอบ')" />
            <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="old('id')" />
            <x-input-error :messages="$errors->get('id')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="prefix" :value="__('คำนำหน้าชื่อ')" />
            <x-select id="prefix" name="Prefix" :options="[
                '' => 'เลือกคำนำหน้าชื่อ',
                'นาย' => 'นาย',
                'นาง' => 'นาง',
                'นางสาว' => 'นางสาว',
                'อื่นๆ' => 'อื่นๆ',
            ]" required autofocus />
            <x-input-error :messages="$errors->get('Prefix')" class="mt-2" />
        </div>

        <!-- Name -->
       <div class="mt-4">
            <x-input-label for="name" :value="__('ชื่อ')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

     
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('นามสกุล')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="position" :value="__('ตำแหน่ง')" />
            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('position')" class="mt-2" />
        </div>
           <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </div>
    </form>
</x-guest-layout>
