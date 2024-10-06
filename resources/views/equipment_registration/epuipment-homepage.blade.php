<x-guest-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
    <div class="min-h-screen flex flex-col">

        <!-- Content Container -->
        <div class="flex-grow  rounded-lg">
            <div class="w-full grid lg:grid-cols-4 md:grid-cols-8 gap-4 p-4">
                <!-- Header Section -->
                <div class=" w-full space-y-1 rounded-lg text-center p-4 lg:col-span-1 md:col-span-2">
                    @if (Auth::user()->role !== 'officer')
                        <h1 class="w-full text-blue-600 text-lg  bg-orange-400">จัดการข้อมูลครุภัณฑ์</h1>
                        <h1 class="w-full text-lg text-white bg-blue-600">ครุภัณฑ์สำนักงาน</h1>
                    @else
                        <h1 class="w-full text-blue-500 text-lg  bg-orange-400">ครุภัณฑ์ที่รับผิดชอบ</h1>
                    @endif
                </div>
                <div class="lg:col-span-2 md:col-span-4">

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
        </div>


        <div class="flex lg:justify-end md:justify-center">
            @if (Auth::user()->role !== 'officer')
                <button type="button" onclick="window.location.href='{{ route('equipment.index') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="rounded-full w-20 h-20 bg-orange-400 text-white">
                        <path fill-rule="evenodd"
                            d="M12 5a1 1 0 0 1 1 1v4h4a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V6a1 1 0 0 1 1-1z"
                            clip-rule="evenodd" />

                    </svg><span class="text-lg font-bold">เพิ่มครุภัณฑ์</span></button>
            @endif
        </div>
        <div class="w-full h-full overflow-auto p-4">

            <table id="example" class="min-w-full border-collapse border border-gray-200 ">
                <thead class="bg-amber-300 text-black">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">หมายเลขครุภัณฑ์</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">ชื่อครุภัณฑ์</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">สถานะ</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">สถานที่</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">ผู้รับผิดชอบครุภัณฑ์</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">รูปภาพ</th>
                        @if (Auth::user()->role !== 'officer')
                            <th scope="col" class="px-6 py-3 border-2 border-blue-600">แก้ไข</th>
                        @else
                            <th scope="col" class="px-6 py-3 border-2 border-blue-600">แก้ไขสถานะครุภัณฑ์</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">
                    @foreach ($dataequipment as $equipment)
                        <tr class="border-2 border-gray-200 hover:bg-gray-100 transition duration-200">
                            <td class="px-6 py-3 border-2 border-gray-200">
                                {{ $equipment->asset_number }}
                            </td>
                            <td class="px-6 py-3 border-2 border-gray-200">
                                {{ Str::limit($equipment->item_description_name, 20) }}
                            </td>
                            <td class="px-6 py-3 border-2 border-gray-200">
                                @if ($equipment->status == 1)
                                    ใช้งานได้
                                @elseif ($equipment->status == 2)
                                    ชำรุด
                                @elseif ($equipment->status == 3)
                                    เสื่อมคุณภาพ
                                @elseif ($equipment->status == 4)
                                    ไม่ใช้
                                @else
                                    สูญหาย
                                @endif
                            </td>
                            <td class="px-6 py-3 border-2 border-gray-200">
                                {{ Str::limit($equipment->location_site_name, 20) }}
                            </td>
                            <td class="px-6 py-3 border-2 border-gray-200">
                                {{ $equipment->prefix }} {{ $equipment->name }} {{ $equipment->last_name }}
                            </td>
                            <td class="px-6 py-3 border-2 border-gray-200">
                                @if ($equipment->image_path)
                                    <img src="{{ asset('uploads/equipments/' . $equipment->image_path) }}"
                                        alt="Equipment Image" class="w-20 h-20 object-cover">
                                @else
                                    <span class="text-red-500">ไม่มีรูปหรืออยู่ในโหมดการค้นหา</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 border-2 border-gray-200">
                                @if (Auth::user()->role !== 'officer')
                                    <a href="{{ route('equipment.adminedit', ['equipments_code' => $equipment->equipments_code]) }}"
                                        class="text-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V14" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('equipment.edit', ['equipments_code' => $equipment->equipments_code]) }}"
                                        class="text-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V14" />
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-amber-300 text-black">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">หมายเลขครุภัณฑ์</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">ชื่อครุภัณฑ์</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">สถานะ</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">สถานที่</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">ผู้รับผิดชอบครุภัณฑ์</th>
                        <th scope="col" class="px-6 py-3 border-2 border-blue-600">รูปภาพ</th>
                        @if (Auth::user()->role !== 'officer')
                            <th scope="col" class="px-6 py-3 border-2 border-blue-600">แก้ไข</th>
                        @else
                            <th scope="col" class="px-6 py-3 border-2 border-blue-600">แก้ไขสถานะครุภัณฑ์</th>
                        @endif
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

    {{-- <div class="flex justify-end mt-5 space-x-10">
        <div>
            @if (Auth::user()->role !== 'officer')
                <button type="button" onclick="window.location.href='{{ route('equipment.index') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="rounded-full w-20 h-20 bg-orange-400 text-white">
                        <path fill-rule="evenodd"
                            d="M12 5a1 1 0 0 1 1 1v4h4a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V6a1 1 0 0 1 1-1z"
                            clip-rule="evenodd" />
                    </svg></button>
            @endif
        </div>

        <div class="flex justify-center mt-5 bg-orange-400 text-white hover:bg-black  rounded-lg text-2xl w-1/8 h-1/3">
            <button type="button" class="flex items-center space-x-2 p-2"
                onclick="window.location.href='{{ route('dashboardequipment.index') }}'">
                <svg class="w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>กลับหน้าหลัก</span>
            </button>
        </div>


    </div> --}}

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

    <script>
        new DataTable('#example', {
            layout: {
                topStart: {

                }
            }
        });
    </script>
</x-guest-layout>
