<x-guest-layout>

    @if ($user)
        <h2 class="text-2xl font-bold mb-6 text-blue-600">แก้ไขผู้รับผิดชอบครุภัณฑ์</h2>
    @else
        <h2 class="text-2xl font-bold mb-6 text-blue-600">เพิ่มผู้รับผิดชอบครุภัณฑ์</h2>
    @endif

    <form method="POST" action="{{ route('UserManagement.update', $user->id) }}" class="">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <x-input-label for="prefix" :value="__('Prefix')" />
                <x-select id="prefix" name="prefix" :options="[
                    '' => 'คำนำหน้าชื่อ',
                    'นาย' => 'นาย',
                    'นาง' => 'นาง',
                    'นางสาว' => 'นางสาว',
                    'อื่นๆ' => 'อื่นๆ',
                ]" required autofocus />
                <x-input-error :messages="$errors->get('prefix')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="flex flex-col">
                <x-input-label for="last_name" :value="__('นามสกุล')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)"
                    required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <div class="flex flex-col">
                <x-input-label for="id" :value="__('รหัสผู้รับผิดชอบ')" />
                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                    :value="old('id', $user->id)" />
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>

            <div class="flex flex-col">
                <x-input-label for="position" :value="__('ตำแหน่ง')" />
                <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position', $user->position)"
                    required autofocus autocomplete="position" />
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div class="flex flex-col">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)"
                    required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- <div class="flex flex-col">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex flex-col">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div> --}}

        </div>

        <div class="flex items-center justify-center mt-40">
            @if ($user)
                <x-primary-button class="ms-4">
                    {{ __('ยืนยันการแก้ไขผู้รับผิดชอบ') }}
                </x-primary-button>
            @else
                <x-primary-button class="ms-4">
                    {{ __('บันทึกเพิ่มผู้รับผิดชอบ') }}
                </x-primary-button>
            @endif

            <button type="button" onclick="window.location.href='{{ route('UserManagement.index') }}'"
                class="w-full md:w-1/2 bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">ยกเลิก</button>

            <a href="{{ route('UserManagement.destroy', ['id' => $user->id]) }}" data-confirm-delete="true"
                class="w-auto bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700 cursor-pointer"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 7h16M10 11v6M14 11v6m-7-9h14a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V10a2 2 0 012-2z" />

                </svg>

                ลบครุภัณฑ์
            </a>
        </div>

    </form>


    <script>
        document.querySelectorAll('a[data-confirm-delete]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.href;

                Swal.fire({
                    title: 'คุณกำลังจะลบครุภัณฑ์!',
                    text: "คุณต้องการลบตัวครุภัณฑ์ตัวนนี้ใช่ไหม ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยันการลบ',

                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
</x-guest-layout>
