<x-guest-layout>
    <div class="grid grid-cols-1  grid-rows-1">

        <div class=" flex justify-end mt-4">
            <div
                class="col-span-1 bg-orange-400 rounded-lg shadow-md text-center lg:w-1/5  lg:h-full md:w-full  md:h-auto p-4">
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

        <div class="container overflow-auto  mx-auto p-4">
            <table id="example" class="min-w-full  text-blue-500">
                <thead class="bg-amber-300 text-black">
                    <tr>

                        <th class="py-2 px-4 border-2 border-blue-500">รายการขนาดลักษณะ</th>
                        <th class="py-2 px-4 border-2 border-blue-500">หมายเลขสินทรัพย์</th>
                        <th class="py-2 px-4 border-2 border-blue-500">ผลการตรวจสอบ</th>

                        <th class="py-2 px-4 border-2 border-blue-500">ได้มาเมื่อ</th>


                        <th class="py-2 px-4 border-2 border-blue-500">จำนวนเงิน</th>
                        <th class="py-2 px-4 border-2 border-blue-500">หน่วยงาน</th>
                        <th class="py-2 px-4 border-2 border-blue-500">ผู้รับผิดชอบ</th>
                        <th class="py-2 px-4 border-2 border-blue-500">สถานที่ใช้งาน</th>
                        <th class="py-2 px-4 border-2 border-blue-500">หมายเหตุชำรุด</th>
                        <th class="py-2 px-4 border-2 border-blue-500">สร้างรายตัวครุภัณฑ์</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">


                    @foreach ($datadamaged as $item)
                        <tr class="py-2 px-4 border-2 border-blue-500">

                            <td class="py-2 px-4 border-2 border-blue-500">{{ $item->item_description_name }}</td>
                            <td class="py-2 px-4 border-2 border-blue-500">{{ $item->asset_number }}</td>
                            <td class="py-2 px-4 border-2 border-blue-500">
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

                            <td class="py-2 px-4 border-2 border-blue-500">{{ $item->date_acquired }}</td>


                            <td class="py-2 px-4 border-2 border-blue-500">{{ $item->price }}</td>
                            <td class="py-2 px-4 border-2 border-blue-500">สำนักงานคณะ</td>
                            <td class="py-2 px-4 border-2 border-blue-500">{{ $item->prefix }} {{ $item->name }}
                                {{ $item->last_name }}
                            </td>
                            <td class="py-2 px-4 border-2 border-blue-500">{{ $item->location_use_name }}</td>
                            <td class="py-2 px-4 border-2 border-blue-500">{{ $item->additional }}</td>
                            <td class="py-2 px-4 border-2 border-blue-500"> <a
                                    href="{{ route('generate-pdf.generatePDF', ['id' => $item->equipments_code]) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    <!-- Icon แก้ไข -->
                                    <svg class="w-1/2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                        xml:space="preserve" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path style="fill:#E2E5E7;"
                                                d="M128,0c-17.6,0-32,14.4-32,32v448c0,17.6,14.4,32,32,32h320c17.6,0,32-14.4,32-32V128L352,0H128z">
                                            </path>
                                            <path style="fill:#B0B7BD;"
                                                d="M384,128h96L352,0v96C352,113.6,366.4,128,384,128z"></path>
                                            <polygon style="fill:#CAD1D8;" points="480,224 384,128 480,128 "></polygon>
                                            <path style="fill:#F15642;"
                                                d="M416,416c0,8.8-7.2,16-16,16H48c-8.8,0-16-7.2-16-16V256c0-8.8,7.2-16,16-16h352c8.8,0,16,7.2,16,16 V416z">
                                            </path>
                                            <g>
                                                <path style="fill:#FFFFFF;"
                                                    d="M101.744,303.152c0-4.224,3.328-8.832,8.688-8.832h29.552c16.64,0,31.616,11.136,31.616,32.48 c0,20.224-14.976,31.488-31.616,31.488h-21.36v16.896c0,5.632-3.584,8.816-8.192,8.816c-4.224,0-8.688-3.184-8.688-8.816V303.152z M118.624,310.432v31.872h21.36c8.576,0,15.36-7.568,15.36-15.504c0-8.944-6.784-16.368-15.36-16.368H118.624z">
                                                </path>
                                                <path style="fill:#FFFFFF;"
                                                    d="M196.656,384c-4.224,0-8.832-2.304-8.832-7.92v-72.672c0-4.592,4.608-7.936,8.832-7.936h29.296 c58.464,0,57.184,88.528,1.152,88.528H196.656z M204.72,311.088V368.4h21.232c34.544,0,36.08-57.312,0-57.312H204.72z">
                                                </path>
                                                <path style="fill:#FFFFFF;"
                                                    d="M303.872,312.112v20.336h32.624c4.608,0,9.216,4.608,9.216,9.072c0,4.224-4.608,7.68-9.216,7.68 h-32.624v26.864c0,4.48-3.184,7.92-7.664,7.92c-5.632,0-9.072-3.44-9.072-7.92v-72.672c0-4.592,3.456-7.936,9.072-7.936h44.912 c5.632,0,8.96,3.344,8.96,7.936c0,4.096-3.328,8.704-8.96,8.704h-37.248V312.112z">
                                                </path>
                                            </g>
                                            <path style="fill:#CAD1D8;"
                                                d="M400,432H96v16h304c8.8,0,16-7.2,16-16v-16C416,424.8,408.8,432,400,432z">
                                            </path>
                                        </g>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>

            </div>
        </div>
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
