<x-guest-layout>

    <div class="w-full gap4">
        <h2 class="text-2xl font-bold mb-6 text-blue-600 text-center">จัดการผู้รับผิดชอบครุภัณฑ์</h2>
        <div class="grid lg:grid-cols-4 md:grid-cols-1    ">

            <div class="col-span-1 w-3/3 ">
                <a href="{{ route('UserManagement.create') }}"
                    class="flex items-center bg-green-700 text-white px-4 py-2 font-bold rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-blue-600">

                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    เพิ่มผู้รับผิดชอบครุภัณฑ์
                </a>
            </div>

            <div class="col-span-2">
                <form action="{{ route('UserManagement.index') }}" method="GET" class="mb-6">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="ค้นหาผู้รับผิดชอบ"
                            value="{{ request('search') }}"
                            class="border-2 border-blue-500 px-4 py-2 rounded-lg mr-2 w-full" />
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                            ค้นหา
                        </button>
                    </div>

                </form>
            </div>


            <div
                class="col-span-1 bg-orange-400 rounded-lg shadow-md text-center lg:w-full lg:h-full md:w-full  md:h-auto p-4">
                <div class="flex items-center justify-center space-x-4  mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"
                        fill="#0033A0">
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
        <div class="overflow-x-auto mt-10">
            <table class="table-auto w-full border-collapse border-2 border-blue-500 text-blue-500">
                <thead class="bg-amber-300 text-black">
                    <tr class="">
                        <th class="border-2 border-blue-500 px-4 py-2">คำนำหน้าชื่อ</th>
                        <th class="border-2 border-blue-500 px-4 py-2">ชื่อ</th>
                        <th class="border-2 border-blue-500 px-4 py-2">นามสกุล</th>
                        <th class="border-2 border-blue-500 px-4 py-2">ตำแหน่ง</th>
                        <th class="border-2 border-blue-500 px-4 py-2">อีเมล์</th>

                        <th class="border-2 border-blue-500 px-4 py-2">แก้ไข</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">
                    @foreach ($datauserformanage as $user)
                        <tr>
                            <td class="border-2 border-blue-500 px-4 py-2">{{ $user->prefix }}</td>
                            <td class="border-2 border-blue-500 px-4 py-2">{{ $user->name }}</td>
                            <td class="border-2 border-blue-500 px-4 py-2">{{ $user->last_name }}</td>
                            <td class="border-2 border-blue-500 px-4 py-2">{{ $user->position }}</td>
                            <td class="border-2 border-blue-500 px-4 py-2">{{ $user->email }}</td>

                            <td class="border-2 border-blue-500 px-4 py-2 text-center">
                                <a href="{{ route('UserManagement.edit', ['id' => $user->id]) }}"
                                    class="text-blue-500 hover:text-blue-700">

                                    <svg class="w-10" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="m3.99 16.854-1.314 3.504a.75.75 0 0 0 .966.965l3.503-1.314a3 3 0 0 0 1.068-.687L18.36 9.175s-.354-1.061-1.414-2.122c-1.06-1.06-2.122-1.414-2.122-1.414L4.677 15.786a3 3 0 0 0-.687 1.068zm12.249-12.63 1.383-1.383c.248-.248.579-.406.925-.348.487.08 1.232.322 1.934 1.025.703.703.945 1.447 1.025 1.934.058.346-.1.677-.348.925L19.774 7.76s-.353-1.06-1.414-2.12c-1.06-1.062-2.121-1.415-2.121-1.415z"
                                                fill="#000000"></path>
                                        </g>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $datauserformanage->links() }}
            </div>

        </div>
    </div>
</x-guest-layout>
