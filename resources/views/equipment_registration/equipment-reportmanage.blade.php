<x-guest-layout>
    <div class="w-full max-w-4xl mx-auto  mt-10">
        <div class="grid grid-rows-2 gap-8 ">
            <!-- รายงานปุ่ม -->
            <div class="flex flex-col space-y-4 text-center mt-10">
                {{-- <button class="bg-lime-300 w-full py-6 rounded-lg text-2xl font-bold text-blue-600 hover:bg-lime-400"
                    id="report-all-btn" data-target="modal" data-target = "#reportcomfrimform">
                    รายงานครุภัณฑ์ทั้งหมด
                </button> --}}
                <button class="bg-lime-300 w-full py-6 rounded-lg text-2xl font-bold text-blue-600 hover:bg-lime-400"
                    id="report-all-btn">
                    รายงานครุภัณฑ์ทั้งหมด


                </button>
                <button onclick="window.location.href ='{{ route('generate-pdf.index') }}'"
                    class="bg-yellow-300 w-full py-6 rounded-lg text-2xl font-bold text-blue-600 hover:bg-yellow-400">
                    รายงานครุภัณฑ์
                </button>
                <button onclick="window.location.href='{{ route('generate-pdf.reportdamaged') }}'"
                    class="bg-orange-300 w-full py-6 rounded-lg text-2xl font-bold text-blue-600 hover:bg-orange-400">
                    รายงานครุภัณฑ์สถานะชำรุด
                </button>
            </div>

            <!-- ปุ่มย้อนกลับ -->
            <div class="flex justify-center">

                @if (Auth::user()->role !== 'officer')
                    <button onclick="window.location.href='{{ route('equipment.adminhomepage') }}'"
                        class="bg-pink-300 w-1/6  h-1/6  rounded-lg hover:bg-pink-400">
                        ย้อนกลับ
                    </button>
                @else
                    <button onclick="window.location.href='{{ route('equipment.homepage') }}'"
                        class="bg-pink-300 w-1/6  h-1/6  rounded-lg hover:bg-pink-400">
                        ย้อนกลับ
                    </button>
                @endif

            </div>
        </div>
    </div>

    <div id="reportcomfrimform" class=" fixed inset-0 flex items-center justify-center z-50 hidden" aria-hidden="true">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-1/4">
            <form action="{{ route('generate-pdf.GeneratePDFEquipmentAll') }}" method="POST" class="space-y-4"
                role="document">
                @method('GET')
                <h2 class="text-center  text-xl">กรุณาเลือกช่วงวันที่ หากต้องการข้อมูลทั้งหมดไม่ต้องใส่</h2>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">วันที่เริ่มต้น</label>
                    <input type="date" id="start_date" name="start_date"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- วันที่สิ้นสุด -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">วันที่สิ้นสุด</label>
                    <input type="date" id="end_date" name="end_date"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- ปีงบประมาณ -->
                <div>
                    <label for="budget_year" class="block text-sm font-medium text-gray-700">ปีงบประมาณ (พ.ศ.)</label>
                    <input type="number" id="budget_year" name="budget_year" placeholder="เช่น 2567"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-blue-500">ส่งข้อมูล</button>
                </div>
            </form>
            <button id="close-modal" class="bg-red-500 mt-4 text-white hover:text-red-600 w-10">ปิด</button>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden"></div>

</x-guest-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     // เพิ่ม event listener ให้กับปุ่ม "รายงานครุภัณฑ์ทั้งหมด"
    //     document.getElementById('report-all-btn').addEventListener('click', function() {
    //         Swal.fire({
    //             title: 'ใส่ปีงบประมาณ',
    //             input: 'text',
    //             inputLabel: 'ปี พ.ศ.',
    //             inputValue: '{{ now()->year + 543 }}', // ค่าเริ่มต้นคือปีปัจจุบัน + 543
    //             showCancelButton: true,
    //             confirmButtonText: 'ตกลง',
    //             cancelButtonText: 'ยกเลิก',
    //             inputValidator: (value) => {
    //                 if (!value) {
    //                     return 'กรุณาใส่ปีงบประมาณ!'
    //                 }
    //             }
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 // ส่งค่าที่ผู้ใช้กรอกไปยังเซิร์ฟเวอร์
    //                 // การเข้ารหัสพารามิเตอร์ที่กรอกเข้ามา
    //                 const budgetYear = encodeURIComponent(result.value);
    //                 window.location.href =
    //                     '{{ route('generate-pdf.GeneratePDFEquipmentAll') }}?budget_year=' +
    //                     budgetYear;
    //             }
    //         });

    // });
    // });
    const modal = document.getElementById('reportcomfrimform');
    const overlay = document.getElementById('overlay');
    const openButton = document.getElementById('report-all-btn');
    const closeButton = document.getElementById('close-modal');

    // เปิด Modal
    openButton.addEventListener('click', function() {
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    });

    // ปิด Modal
    closeButton.addEventListener('click', function() {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    // ปิด Modal เมื่อคลิกที่ Overlay
    overlay.addEventListener('click', function() {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    });
</script>
