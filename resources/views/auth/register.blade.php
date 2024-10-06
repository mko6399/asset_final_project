<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" class="max-w-3xl m-32 mx-auto  p-8  space-x-3 ">
        @csrf
        <div class=" flex flex-col text-center">
            <h1 class="lg:text-5xl lg:m-10  md:m-auto md:text-2xl text-blue-600 ">สมัครสมาชิก</h1>
            <!-- Grid for prefix, name, and last name -->
            <div class="grid lg:grid-cols-3 md:grid-cols-1 gap-5 mb-6">

                <!-- Prefix -->
                <div class="mt-4 flex gap-3 items-center">
                    <x-input-label for="prefix" :value="__('คำนำหน้าชื่อ')" />
                    <x-select class="bg-orange-300" id="prefix" name="prefix" :options="[
                        '' => 'คำนำหน้าชื่อ',
                        'นาย' => 'นาย',
                        'นาง' => 'นาง',
                        'นางสาว' => 'นางสาว',
                        'อื่นๆ' => 'อื่นๆ',
                    ]"
                        x-on:change="selected = $event.target.value"
                        x-bind:class="{ 'bg-blue-400': selected !== 'bg-red-300' }" required autofocus />
                    <x-input-error :messages="$errors->get('prefix')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="mt-4 flex gap-3 items-center">
                    <x-input-label for="name" :value="__('ชื่อ')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div class="mt-4 flex gap-3 items-center">
                    <x-input-label for="last_name" :value="__('นามสกุล')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                        :value="old('last_name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

            </div>

            <!-- Grid for ID and Position -->
            <div class="grid lg:grid-cols-2 md:grid-cols-1 gap-5 mb-6">
                <!-- Responsible ID -->
                <div class="mt-4 flex items-center">
                    <x-input-label for="id" :value="__('รหัสผู้รับผิดชอบ')" />
                    <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                        :value="old('id')" />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- Position -->
                <div class="mt-4 flex items-center">
                    <x-input-label for="position" :value="__('ตำแหน่ง')" />
                    <x-text-input id="position" class="block mt-1 w-full" type="text" name="position"
                        :value="old('position')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
            </div>

            <!-- Email -->
            <div class="grid grid-cols-1  mb-6">
                <div class="mt-4 flex items-center gap-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <!-- Password and Confirm Password -->
            <div class="grid lg:grid-cols-2 md:grid-cols-1 gap-5 mb-6">
                <!-- Password -->
                <div class="mt-4 flex items-center gap-3">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 flex items-center gap-3">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-center mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('มีบัญชีอยู่แล้ว ?') }}
                </a>
                <x-primary-button class="ms-4 bg-green-600">
                    {{ __('ลงทะเบียน') }}
                </x-primary-button>
            </div>
        </div>
    </form>

</x-guest-layout>
