<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" class= "">
        @csrf
        <div>
            <div class="grid grid-cols-3 gap-5  ">

                <div class="mt-4  flex  gap-3 ">
                    <x-input-label for="prefix" :value="__('')" />
                    <x-select class="bg-orange-300" id="prefix" name="prefix" :options="[
                        '' => 'คำนำหน้าชื่อ',
                        'นาย' => 'นาย',
                        'นาง' => 'นาง',
                        'นางสาว' => 'นางสาว',
                        'อื่นๆ' => 'อื่นๆ',
                    ]"
                        x-on:change="selected = $event.target.value"
                        x-bind:class="{ 'bg-blue-400': selected !== 'bg-red-300' }" required autofocus required
                        autofocus />
                    <x-input-error :messages="$errors->get('prefix')" class="mt-2" />

                </div>
                <div class="mt-4 flex gap-3 items-center">
                    <x-input-label for="name" :value="__('ชื่อ')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-4 flex gap-3 items-center">
                    <x-input-label for="last_name" :value="__('นามสกุล')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                        :value="old('last_name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

            </div>

            <div class="grid grid-cols-3  gap-5 justify-center ">
                <!-- Name -->

                <div class="mt-4 flex  items-center ">
                    <x-input-label for="id" :value="__('รหัสผู้รับผิดชอบ')" />
                    <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                        :value="old('id')" />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <div class="mt-4 flex items-center">
                    <x-input-label for="position" :value="__('ตำแหน่ง')" />
                    <x-text-input id="position" class="block mt-1 w-full" type="text" name="position"
                        :value="old('position')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
            </div>
            <!-- Email Address -->
            <div class="grid grid-cols-3 ">
                <div class="mt-4 flex  items-center  gap-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
            <!-- Password -->
            <div class="grid grid-cols-3 ">
                <div class="mt-4 flex  items-center  gap-3">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 flex  items-center  gap-3">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
            <div class="flex items-center justify-center mt-40">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('ลงทะเบียน ?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>


    </form>
</x-guest-layout>
