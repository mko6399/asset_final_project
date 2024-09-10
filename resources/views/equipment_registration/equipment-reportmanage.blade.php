<x-guest-layout>

    <!-- PDF Report Section -->
    <div class="w-full max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            {{-- <button class="bg-orange-300 text-blue-800 px-6 py-3 rounded-lg hover:bg-orange-400">
                สร้างรายงาน PDF
            </button>
            <div class="bg-orange-300 text-blue-800 p-4 rounded-lg">
                ผู้รับผิดชอบครุภัณฑ์<br>
                <span class="font-bold">นางสาวตะวัน กอแสง</span>
            </div> --}}
        </div>

        <!-- Main Content Section -->
        <div class="space-y-4 text-center">
            <button onclick="window.location.href='{{ route('generate-pdf.GeneratePDFEquipmentAll') }}'"
                class="bg-lime-300 w-full py-6 rounded-lg text-2xl font-bold text-blue-600 hover:bg-lime-400">
                รายงานครุภัณฑ์ทั้งหมด

            </button>
            <button class="bg-yellow-300 w-full py-6 rounded-lg text-2xl font-bold text-blue-600 hover:bg-yellow-400">
                รายงานตัวครุภัณฑ์
            </button>
            <button onclick="window.location.href='{{ route('generate-pdf.generatePDF') }}'"
                class="bg-orange-300 w-full py-6 rounded-lg text-2xl font-bold text-blue-600 hover:bg-orange-400">
                รายงานครุภัณฑ์สถานะชำรุด
            </button>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <button onclick="window.location.href='{{ route('equipment.homepage') }}'"
                class="bg-pink-300 px-6 py-3 rounded-lg hover:bg-pink-400">
                ย้อนกลับ
            </button>
        </div>
    </div>

</x-guest-layout>
