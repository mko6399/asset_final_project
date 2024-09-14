<x-guest-layout>
    <div class="container mx-auto p-4">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ลำดับที่</th>
                    <th class="py-2 px-4 border-b">รายการขนาดลักษณะ</th>
                    <th class="py-2 px-4 border-b">หมายเลขสินทรัพย์</th>
                    <th class="py-2 px-4 border-b">ผลการตรวจสอบ</th>
                    <th class="py-2 px-4 border-b">เลข S/N</th>
                    <th class="py-2 px-4 border-b">ได้มาเมื่อ</th>
                    <th class="py-2 px-4 border-b">จากงบประมาณ</th>
                    <th class="py-2 px-4 border-b">วิธีที่ได้มา</th>
                    <th class="py-2 px-4 border-b">จำนวนเงิน</th>
                    <th class="py-2 px-4 border-b">หน่วยงาน</th>
                    <th class="py-2 px-4 border-b">ผู้รับผิดชอบ</th>
                    <th class="py-2 px-4 border-b">สถานที่ใช้งาน</th>
                    <th class="py-2 px-4 border-b">หมายเหตุชำรุด</th>

                    <th class="py-2 px-4 border-b">สร้างรายตัวครุภัณฑ์</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataequipment as $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $item->equipments_code }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->item_description_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->asset_number }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($item->status == 1)
                                ใช้งานได้
                            @elseif ($item->status == 2)
                                ชำรุด
                            @elseif ($item->status == 3)
                                เสื่อมสภาพ
                            @elseif ($item->status == 4)
                                ไม่ใช้
                            @elseif ($item->status == 5)
                                สูญหาย
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $item->serial_number }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->date_acquired }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->budget }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->acquisition_method }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->price }}</td>
                        <td class="py-2 px-4 border-b">สำนักงานคณะ</td>
                        <td class="py-2 px-4 border-b">{{ $item->prefix }} {{ $item->name }} {{ $item->last_name }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ $item->location_use_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->additional }}</td>
                        {{-- <td> <img src="{{ url('uploads/equipments/' . $item->image_path) }}"></td> --}}
                        <td> <a href="{{ route('generate-pdf.GeneratePDFEquipmentone', ['id' => $item->equipments_code]) }}"
                                class="text-blue-500 hover:text-blue-700">
                                <!-- Icon แก้ไข -->
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
</x-guest-layout>
