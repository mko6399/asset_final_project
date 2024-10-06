<x-guest-layout>


    <form method="POST" action="{{ route('UserManagement.update', $user->id) }}">
        @csrf
        @method('PUT')
        @if ($user)
            <h2 class="text-2xl font-bold mb-6 text-blue-600 text-center">แก้ไขผู้รับผิดชอบครุภัณฑ์</h2>
        @else
            <h2 class="text-2xl font-bold mb-6 text-blue-600 text-center">เพิ่มผู้รับผิดชอบครุภัณฑ์</h2>
        @endif

        <div class="grid  md:grid-cols-2 lg:grid-cols-3 gap-4">


            <div class="col-span-1">
                <x-input-label for="prefix" :value="__('Prefix')" />
                <x-select id="prefix" name="prefix" :options="[
                    '' => 'คำนำหน้าชื่อ',
                    'นาย' => 'นาย',
                    'นาง' => 'นาง',
                    'นางสาว' => 'นางสาว',
                    'อื่นๆ' => 'อื่นๆ',
                ]" :value="$user->prefix" />
                <x-input-error :messages="$errors->get('prefix')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="col-span-1">
                <x-input-label for="last_name" :value="__('นามสกุล')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)"
                    required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <x-input-label for="id" :value="__('รหัสผู้รับผิดชอบ')" />
                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                    :value="old('id', $user->id)" />
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <x-input-label for="position" :value="__('ตำแหน่ง')" />
                <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position', $user->position)"
                    required autofocus autocomplete="position" />
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div class="col-span-1">
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

        <div class="grid grid-cols-3  mt-40  gap-10">

            <div class="col-span-1">
                @if ($user)
                    <button type="submit"
                        class="lg:w-full md:w-1/2 bg-green-700 text-white px-4 py-2 font-bold rounded-lg hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-950">
                        ยืนยันการแก้ไขผู้รับผิดชอบ
                    </button>
                @else
                    <button type="submit"
                        class="lg:w-full md:w-1/2 bg-green-700 text-white px-4 py-2 font-bold rounded-lg hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-950">
                        บันทึกเพิ่มผู้รับผิดชอบ
                    </button>
                @endif
            </div>

            <div class="col-span-1">
                <button type="button" onclick="window.location.href='{{ route('UserManagement.index') }}'"
                    class="lg:w-full md:w-1/2 bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">ยกเลิก</button>
            </div>


            <div class="col-span-1">
                <button type="button"
                    onclick="window.location.href='{{ route('UserManagement.destroy', ['id' => $user->id]) }}'"
                    class="lg:w-full md:w-1/2 bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">ลบครุภัณฑ์ผู้รับผิดชอบ</button>
                {{-- <a href="{{ route('UserManagement.destroy', ['id' => $user->id]) }}" data-confirm-delete="true"
                    class="w-full bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">


                    ลบครุภัณฑ์ผู้รับผิดชอบ
                </a> --}}
            </div>
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
