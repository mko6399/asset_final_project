<x-guest-layout>
    <div class="relative overflow-x-auto">
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
                        <td class="px-6 py-3">คนรับผิดชอบครุภัณฑ์</td>
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
    </div>
</x-guest-layout>
