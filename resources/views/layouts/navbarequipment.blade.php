<nav class="bg-gradient-to-b from-amber-200 to-white shadow-lg w-full">
    <div class="max-w-screen-xl mx-auto  py-3 flex items-center justify-between">
        <!-- Logo -->
        <a href='{{ route('dashboardequipment.index') }}' class="flex-shrink-0">
            <img src="{{ URL('build/assets/logosri.png') }}" alt="logo" class="h-20 w-auto" />
        </a>

        <!-- Navigation Links -->
        <div class="text-blue-600 text-xl">
            <p>ระบบตรวจสอบและติดตามครภัณฑ์ คณะวิทยาศาตร์และนวัตกรรมดิจิทัล มหาวิทยาลัยทักษิณ</p>
            <p>Equipment Inspection and Tracking System, Faculty of Science and Digital Innovation, Thaksin University
            </p>
        </div>


    </div>
</nav>
{{-- @if (Auth::check())
    <nav class="bg-gradient-to-b from-amber-200 to-white shadow-lg w-full">
        <div class="max-w-screen-xl mx-auto py-3 flex items-center justify-between">
            <!-- Logo -->
            <a href='{{ route('dashboardequipment.index') }}' class="flex-shrink-0">
                <img src="{{ URL('build/assets/logosri.png') }}" alt="logo" class="h-20 w-auto" />
            </a>
            <div class="text-blue-600 text-xl">
                <p>ระบบตรวจสอบและติดตามครภัณฑ์ คณะวิทยาศาตร์และนวัตกรรมดิจิทัล มหาวิทยาลัยทักษิณ</p>
                <p>Equipment Inspection and Tracking System, Faculty of Science and Digital Innovation, Thaksin
                    University
                </p>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Add hover effects and text colors that match the existing theme -->
                <a href="{{ route('dashboardequipment.index') }}"
                    class="text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-sm font-medium">
                    หน้าหลัก
                </a>
                <a href="{{ route('reportpdf.index') }}"
                    class="text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-sm font-medium">
                    รายงาน PDF
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-sm font-medium">
                    การตั้งค่าบัญชี
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-sm font-medium">
                        ออกจากระบบ
                    </button>
                </form>
            </div>

            <!-- Mobile menu button (hamburger icon) -->
            <div class="-mr-2 flex md:hidden">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-orange-700 hover:bg-orange-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden bg-orange-100">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('dashboardequipment.index') }}"
                    class="block text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-base font-medium">
                    หน้าหลัก
                </a>
                <a href="{{ route('reportpdf.index') }}"
                    class="block text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-base font-medium">
                    รายงาน PDF
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="block text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-base font-medium">
                    การตั้งค่าบัญชี
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit"
                        class="text-orange-700 hover:bg-orange-200 px-3 py-2 rounded-md text-base font-medium">
                        ออกจากระบบ
                    </button>
                </form>
            </div>
        </div>
    </nav>
@endif --}}
