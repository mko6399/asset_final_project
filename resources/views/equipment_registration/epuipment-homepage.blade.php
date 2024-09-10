<x-guest-layout>
    <div class=" overflow-x-auto rounded-lg">

        <div class="grid grid-cols-6 ">
            <div class="bg-orange-400 gap-5 rounded-lg text-center">
                @if (Auth::user()->role !== 'officer')
                    <h1 class="text-lg">จัดการข้อมูลครุภัณฑ์</h1>
                @else
                    <h1 class="text-lg">ครุภัณฑ์ที่รับผิดชอบ</h1>
                @endif

            </div>
            <div class="col-span-4">
                <form method="GET" action="{{ route('equipment.search') }}" class="mb-4">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="ค้นหาครุภัณฑ์..."
                            value="{{ request()->query('search') }}" class="px-4 py-2 border rounded-lg w-full">
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg"> <svg
                                xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 4a7 7 0 11-7 7 7 7 0 017-7zm0 2a5 5 0 100 10 5 5 0 000-10zm9 9l-3-3" />
                            </svg> ค้นหา</button>
                    </div>
                </form>
            </div>

            <div class="   bg-orange-400 rounded-lg text-center">
                <div class=" items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" fill="#0033A0">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z" />
                    </svg>



                    @if (Auth::user()->role !== 'officer')
                        <h1 class="text-lg">ผู้ดูแลระบบ</h1>
                    @else
                        <h1 class="text-lg">ผู้รับผิดชอบ</h1>
                    @endif
                </div>
                <div class="bg-orange-300 my-4  w-full">
                    {{ Auth::user()->prefix }}
                    {{ Auth::user()->name }}
                    {{ Auth::user()->last_name }}
                </div>


            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">หมายเลขครุภัณฑ์</th>
                    <th scope="col" class="px-6 py-3">ชื่อครุภัณฑ์</th>
                    <th scope="col" class="px-6 py-3">สถานะ</th>
                    <th scope="col" class="px-6 py-3">หมายเหตุ</th>
                    <th scope="col" class="px-6 py-3">ผู้รับผิดชอบครุภัณฑ์</th>
                    <th scope="col" class="px-6 py-3">สถานที่</th>
                    <th scope="col" class="px-6 py-3">หมายเลข S/N</th>
                    <th scope="col" class="px-6 py-3">วันที่ได้มา</th>
                    <th scope="col" class="px-6 py-3">งบประมาณ</th>
                    <th scope="col" class="px-6 py-3">วันที่ได้มา</th>
                    <th scope="col" class="px-6 py-3">--</th>
                    <th scope="col" class="px-6 py-3">จำนวนเงิน</th>
                    <th scope="col" class="px-6 py-3">หน่วยงานที่รับผิดชอบ</th>
                    <th scope="col" class="px-6 py-3">รูปภาพ</th>
                    <th scope="col" class="px-6 py-3">แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataequipment as $equipment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-3">{{ $equipment->asset_number }}</td>
                        <td class="px-6 py-3">{{ $equipment->item_description_name }}</td>
                        <td class="px-6 py-3">
                            @if ($equipment->status == 1)
                                ใช้งานได้
                            @elseif ($equipment->status == 2)
                                ไม่ใช้
                            @elseif ($equipment->status == 3)
                                ชำรุด
                            @else
                                ไม่ทราบสถานะ
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $equipment->additional }}</td>
                        <td class="px-6 py-3">{{ $equipment->prefix }}{{ $equipment->name }}
                            {{ $equipment->last_name }}</td>
                        <td class="px-6 py-3">{{ $equipment->location_site_name }}</td>
                        <td class="px-6 py-3">{{ $equipment->serial_number }}</td>
                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($equipment->date_acquired)->locale('th_TH')->translatedFormat('j F') }}
                            {{ \Carbon\Carbon::parse($equipment->date_acquired)->addYears(543)->year }}
                        </td>
                        <td class="px-6 py-3">{{ $equipment->budget }}</td>
                        <td class="px-6 py-3">{{ $equipment->acquisition_method }}</td>
                        <td class="px-6 py-3">{{ $equipment->acquisition_method }}</td>
                        <td class="px-6 py-3">{{ number_format($equipment->price, 2) }} ฿</td>
                        <td class="px-6 py-3">หน่วยงานที่รับผิดชอบ</td>
                        <td class="px-6 py-3">
                            <img src="{{ asset('uploads/equipments/' . $equipment->image_path) }}"
                                alt="Equipment Image" class="w-20 h-20 object-cover">
                        </td>
                        <td class="px-6 py-3">

                            <a href="{{ route('equipment.edit', ['equipments_code' => $equipment->equipments_code]) }}"
                                class="text-blue-500"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (Auth::user()->role !== 'officer')
            <div class="flex justify-end  space-x-10">
                <div>

                    <button type="button" onclick="window.location.href='{{ route('equipment.index') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="rounded-full w-20 h-20 bg-orange-400 text-white">
                            <path fill-rule="evenodd"
                                d="M12 5a1 1 0 0 1 1 1v4h4a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V6a1 1 0 0 1 1-1z"
                                clip-rule="evenodd" />
                        </svg></button>
                </div>
                <div class="bg-orange-400 rounded-lg text-2xl w-auto h-1/2">

                    <button type="button" onclick="window.location.href='{{ route('dashboardequipment.index') }}'">

                        กลับหน้าหลัก
                    </button>
                </div>
        @endif
    </div>
    </div>
</x-guest-layout>
