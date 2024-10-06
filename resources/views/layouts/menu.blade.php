@if (Auth::check())
    <div x-data="{ open: false }"
        class="relative lg:w-64 lg:min-h-screen bg-gradient-to-b from-white to-amber-300 text-orange-700 shadow-lg">

        <!-- ปุ่มเปิด/ปิดเมนูบนมือถือ -->
        <button @click="open = !open"
            class="lg:hidden flex items-center justify-between w-full px-6 py-4 bg-orange-200  text-sm font-medium hover:bg-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
            เมนู
            <svg :class="open ? 'transform rotate-180' : ''" class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.707a1 1 0 011.414 0L10 11.414l3.293-3.707a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <!-- เมนู -->
        <nav :class="open ? 'block' : 'hidden'" class="lg:block mt-4 space-y-1 lg:space-y-2">
            @if (Auth::user()->role !== 'officer')
                <a href="{{ route('usersimport') }}" class="block px-6 py-2  hover:bg-orange-300 text-sm">
                    • นำเข้าข้อมูลครุภัณฑ์
                </a>
                <a href='{{ route('UserManagement.index') }}' class="block px-6 py-2  hover:bg-orange-300 text-sm">
                    • จัดการข้อมูลผู้รับผิดชอบครุภัณฑ์
                </a>

                <a href='{{ route('equipment.adminhomepage') }}' class="block px-6 py-2  hover:bg-orange-300 text-sm">
                    • จัดการข้อมูลครุภัณฑ์
                </a>
            @else
                <a href='{{ route('equipment.homepage') }}' class="block px-6 py-2  hover:bg-orange-300 text-sm">
                    • จัดการข้อมูลสถานะครุภัณฑ์
                </a>
            @endif

            <a href='{{ route('reportpdf.index') }}' class="block px-6 py-2  hover:bg-orange-300 text-sm">
                • สร้างรายงาน PDF
            </a>

            <a href="{{ route('profile.edit') }}" class="block px-6 py-2  hover:bg-orange-300 text-sm">
                • การตั้งค่าบัญชี
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="block px-6 py-2  hover:bg-orange-300 text-sm"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    • ออกจากระบบ
                </a>
            </form>
        </nav>
    </div>
@endif
