<x-guest-layout>
    <h2 class="text-2xl font-bold mb-6 text-blue-600">จัดการผู้รับผิดชอบครุภัณฑ์</h2>
    <div class="container mx-auto mt-8">
        <form action="{{ route('UserManagement.index') }}" method="GET" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="ค้นหาผู้รับผิดชอบ" value="{{ request('search') }}"
                    class="border border-gray-300 px-4 py-2 rounded-lg mr-2 w-full" />
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    ค้นหา
                </button>
            </div>
        </form>
        <div class=" w-1/3 my-4">
            <a href="{{ route('UserManagement.create') }}"
                class="flex items-center bg-blue-500 text-white px-4 py-2 font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">

                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                เพิ่มผู้รับผิดชอบครุภัณฑ์
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">คำนำหน้าชื่อ</th>
                        <th class="border border-gray-300 px-4 py-2">ชื่อ</th>
                        <th class="border border-gray-300 px-4 py-2">นามสกุล</th>
                        <th class="border border-gray-300 px-4 py-2">ตำแหน่ง</th>
                        <th class="border border-gray-300 px-4 py-2">อีเมล์</th>

                        <th class="border border-gray-300 px-4 py-2">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datauserformanage as $user)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->prefix }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->last_name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->position }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>

                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('UserManagement.edit', ['id' => $user->id]) }}"
                                    class="text-blue-500 hover:text-blue-700">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 17h2m4-14h-8a2 2 0 00-2 2v14l4-4h6a2 2 0 002-2V5a2 2 0 00-2-2z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-guest-layout>
