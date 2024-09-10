@if (Auth::check())
    <div x-data="{ open: false }" class="relative inline-block text-left">
        <div>
            <button @click="open = !open" type="button"
                class="inline-flex justify-between items-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-200 text-sm font-medium text-orange-600 hover:bg-orange-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                <div>
                    <div>{{ Auth::user()->name }}</div>
                </div>
                <svg class="ml-2 h-5 w-5 text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.293 7.707a1 1 0 011.414 0L10 11.414l3.293-3.707a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="open" @click.away="open = false"
            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-orange-100 ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
                @if (Auth::user()->role !== 'officer')
                    <a href="{{ route('usersimport') }}"
                        class="flex items-center text-orange-700 block px-4 py-2 text-sm hover:bg-orange-200">
                        <span class="mr-2">•</span> นำเข้าข้อมูลครุภัณฑ์
                    </a>
                    <a href='{{ route('UserManagement.index') }}'
                        class="flex items-center text-orange-700 block px-4 py-2 text-sm hover:bg-orange-200">
                        <span class="mr-2">•</span> จัดการข้อมูลผู้รับผิดชอบครุภัณฑ์
                    </a>
                @endif


                <a href='{{ route('equipment.homepage') }}'
                    class="flex items-center text-orange-700 block px-4 py-2 text-sm hover:bg-orange-200">
                    <span class="mr-2">•</span> จัดการข้อมูลครุภัณฑ์
                </a>
                <a href='{{ route('reportpdf.index') }}'
                    class="flex items-center text-orange-700 block px-4 py-2 text-sm hover:bg-orange-200">
                    <span class="mr-2">•</span> สร้างรายงาน PDF
                </a>

                <x-dropdown-link :href="route('profile.edit')"
                    class="flex items-center text-orange-700 block px-4 py-2 text-sm hover:bg-orange-200">
                    {{ __(' •      การตั้งค่าบัญชี') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        class="flex items-center text-orange-700 block px-4 py-2 text-sm hover:bg-orange-200"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __(' •    ออกจากระบบ') }}
                    </x-dropdown-link>
                </form>


            </div>
        </div>
    </div>
@endif
