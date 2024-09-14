<x-guest-layout>
    <h2 class="text-2xl font-bold mb-6 text-blue-600">เพิ่มผู้รับผิดชอบครุภัณฑ์</h2>
    <form method="POST" action="{{ route('UserManagement.store') }}" class= "">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">


            <div class="flex flex-col">
                <x-input-label for="prefix" :value="__('   ')" />
                <x-select class="bg-orange-300" id="prefix" name="prefix" :options="[
                    '' => 'คำนำหน้าชื่อ',
                    'นาย' => 'นาย',
                    'นาง' => 'นาง',
                    'นางสาว' => 'นางสาว',
                    'อื่นๆ' => 'อื่นๆ',
                ]"
                    x-on:change="selected = $event.target.value"
                    x-bind:class="{ 'bg-blue-400': selected !== 'bg-red-300' }" required autofocus required autofocus />
                <x-input-error :messages="$errors->get('prefix')" class="mt-2" />

            </div>
            <div class="flex flex-col">
                <x-input-label for="name" :value="__('ชื่อ')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="flex flex-col">
                <x-input-label for="last_name" :value="__('นามสกุล')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>






            <div class="flex flex-col">
                <x-input-label for="id" :value="__('รหัสผู้รับผิดชอบ')" />
                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                    :value="old('id')" />
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>

            <div class="flex flex-col">
                <x-input-label for="position" :value="__('ตำแหน่ง')" />
                <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>



            <div class="flex flex-col">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->

            <div class="flex flex-col">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="flex flex-col">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-center mt-40">
            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('ลงทะเบียน ?') }}
            </a> --}}

            <x-primary-button class="ms-4">
                {{ __('บันทึกเพิ่มผู้รับผิดชอบ') }}
            </x-primary-button>
            <button type="button" onclick="window.location.href='{{ route('UserManagement.index') }}'"
                class="w-full md:w-1/2 bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">ยกเลิก</button>
        </div>

    </form>



</x-guest-layout>
