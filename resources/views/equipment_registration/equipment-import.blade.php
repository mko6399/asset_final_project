<x-guest-layout>

    <div class="w-full h-screen bg-center grid lg:grid-cols-1 grid-rows-1 gap-4 p-4">

        <div class=" flex justify-end ">
            <div
                class="col-span-1 bg-orange-400 rounded-lg shadow-md text-center lg:w-1/4 lg:h-3/5 md:w-full  md:h-auto p-4">
                <div class="flex items-center justify-center space-x-4  mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" fill="#0033A0">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z" />
                    </svg>
                    @if (Auth::user()->role !== 'officer')
                        <h1 class="text-lg font-bold text-blue-900">ผู้ดูแลระบบ</h1>
                    @else
                        <h1 class="text-lg font-bold text-blue-900">ผู้รับผิดชอบ</h1>
                    @endif
                </div>

                <div class="bg-orange-300 rounded-lg px-4 py-2 text-center text-blue-900">
                    {{ Auth::user()->prefix }} {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                </div>

                <div
                    class="flex justify-center mt-5 bg-orange-950 text-white hover:bg-white hover:text-black rounded-lg text-2xl w-full">
                    <button type="button" class="flex items-center space-x-2 p-2"
                        onclick="window.location.href='{{ route('dashboardequipment.index') }}'">
                        <svg class="w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>กลับหน้าหลัก</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- ส่วนตรงกลางจอ -->
        <div class=" flex items-center justify-center  lg:p-20">
            <div class="col-span-1 w-1/2 ">
                <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data"
                    class="bg-white p-8 rounded-lg shadow-md lg:w-2/3 w-full">
                    @csrf
                    <input type="file" name="file" required class="mb-4 block w-full border-gray-300">

                    <button type="submit"
                        class="w-full bg-green-300 border-2 hover:bg-green-900 rounded-lg border-black px-4 py-2">นำเข้า
                        Excel
                    </button>

                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
