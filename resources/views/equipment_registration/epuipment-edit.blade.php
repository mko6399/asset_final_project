<x-guest-layout>
    <h2 class="text-2xl font-bold mb-6 text-blue-600">ครุภัณฑ์</h2>

    <form method="POST" action="{{ route('equipment.update', $dataforedit->equipments_code) }}" x-data="{ status: '{{ $dataforedit->status }}', imagePreview: '{{ $dataforedit->imagesequipments->first()->image_path ?? '' }}', location_site_code: '{{ $dataforedit->location->location_site_code ?? '' }}' }"
        enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Upload image -->
        <div class="flex flex-col items-center">
            <template x-if="imagePreview">
                <div class="mb-4 flex justify-center">
                    <img :src="`/uploads/equipments/{{ $imagePath }}`" alt="Image Preview"
                        class="w-full max-w-xs border rounded-lg">
                </div>
            </template>
            <label for="image_path" class="block text-gray-700 font-medium mb-2">อัปโหลดภาพ:</label>
            <input id="image_path" type="file" name="image_path"
                @change="imagePreview = URL.createObjectURL($event.target.files[0])"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Asset Number -->
            <div class="flex flex-col">
                <label for="asset_number" class="block text-gray-700 font-medium mb-2">หมายเลขครุภัณฑ์:</label>
                <input id="asset_number" type="text" name="asset_number" value="{{ $dataforedit->asset_number }}"
                    pattern="\d{10}-\d{7}-\d{4}-\d{7}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Item Description Name -->
            <div class="flex flex-col">
                <label for="item_description_name"
                    class="block text-gray-700 font-medium mb-2">ลักษณะรายการ/ชื่อ:</label>
                <input id="item_description_name" type="text" name="item_description_name"
                    value="{{ $dataforedit->item_description_name }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Type of Equipment -->
            <div class="flex flex-col">
                <label for="type_of_equipment_id" class="block text-gray-700 font-medium mb-2">ประเภทครุภัณฑ์:</label>
                <select id="type_of_equipment_id" name="type_of_equipment_id"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">เลือกประเภท</option>
                    @foreach ($dataTypeequipment as $value)
                        <option value="{{ $value->type_of_equipment_id }}"
                            {{ $value->type_of_equipment_id == $dataforedit->type_of_equipment_id ? 'selected' : '' }}>
                            {{ $value->name_type_of_equipment }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="flex flex-col">
                <label for="status" class="block text-gray-700 font-medium mb-2">สถานะ:</label>
                <select id="status" name="status" x-model="status"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1" {{ $dataforedit->status == 1 ? 'selected' : '' }}>ใช้งานได้</option>
                    <option value="2" {{ $dataforedit->status == 2 ? 'selected' : '' }}>ใช้งานไม่ได้</option>
                    <option value="3" {{ $dataforedit->status == 3 ? 'selected' : '' }}>ชำรุด</option>
                </select>
            </div>

            <!-- Date Acquired -->
            <div class="flex flex-col">
                <label for="date_acquired" class="block text-gray-700 font-medium mb-2">วันที่ได้มา:</label>
                <input id="date_acquired" type="date" name="date_acquired" value="{{ $dataforedit->date_acquired }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Location -->
            <div class="flex flex-col">
                <label for="location_site_code" class="block text-gray-700 font-medium mb-2">สถานที่:</label>
                <select id="location_site_code" name="location_site_code" x-model="location_site_code"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="0">เลือกสถานที่</option>
                    @foreach ($datalocation as $value)
                        <option value="{{ $value->location_site_code }}"
                            {{ $value->location_site_code == $dataforedit->location_site_code ? 'selected' : '' }}>
                            {{ $value->location_site_name }}
                        </option>
                    @endforeach
                </select>
            </div>



            <!-- Location Use -->
            <div class="flex flex-col" ">
                <label for="location_use_name" class="block text-gray-700 font-medium mb-2">สถานที่ใช้งานใน:</label>
                <textarea id="location_use_name" name="location_use_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $dataforedit->location_use->location_use_name ?? '' }}</textarea>
            </div>

            <!-- Additional -->
            <div class="flex flex-col" x-show="status === '3'">
                <label for="additional" class="block text-gray-700 font-medium mb-2">หมายเหตุ:</label>
                <textarea id="additional" name="additional"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $dataforedit->additional }}</textarea>
            </div>

            <!-- Vendor -->
            <div class="flex flex-col">
                <label for="vendor" class="block text-gray-700 font-medium mb-2">ผู้ขาย:</label>
                <input id="vendor" type="text" name="vendor" value="{{ $dataforedit->vendor }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Acquisition Method -->
            <div class="flex flex-col">
                <label for="acquisition_method" class="block text-gray-700 font-medium mb-2">วิธีที่ได้มา:</label>
                <input id="acquisition_method" type="text" name="acquisition_method"
                    value="{{ $dataforedit->acquisition_method }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Price -->
            <div class="flex flex-col">
                <label for="price" class="block text-gray-700 font-medium mb-2">ราคา/หน่วย:</label>
                <input id="price" type="number" step="0.01" name="price"
                    value="{{ $dataforedit->price }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Budget -->
            <div class="flex flex-col">
                <label for="budget" class="block text-gray-700 font-medium mb-2">งบประมาณ:</label>
                <input id="budget" type="text" name="budget" value="{{ $dataforedit->budget }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Serial Number -->
            <div class="flex flex-col">
                <label for="serial_number" class="block text-gray-700 font-medium mb-2">S/N:</label>
                <input id="serial_number" type="text" name="serial_number"
                    value="{{ $dataforedit->serial_number }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Reference Number -->
            <div class="flex flex-col">
                <label for="reference_number" class="block text-gray-700 font-medium mb-2">หมายเลขอ้างอิง:</label>
                <input id="reference_number" type="text" name="reference_number"
                    value="{{ $dataforedit->reference_number }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="flex flex-col">
                                                  @if (Auth::user()->role !== 'officer')
                <label for="user_id" class="block text-gray-700 font-medium mb-2">มอบหมายผู้รับผิด:</label>
                <select id="user_id" name="user_id" x-model="user_id"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="0">เลือกผู้รับผิดชอบ</option>
                    @foreach ($data_use as $value)
                        <option value="{{ $value->id }}" {{ $value->id == $dataforedit->id ? 'selected' : '' }}>
                            {{ $value->prefix . $value->name . ' ' . $value->last_name }}
                        </option>
                    @endforeach
                </select>
            @else
                <!-- สำหรับผู้ใช้ที่เป็น 'officer' หรือแอดมิน ให้ซ่อนฟิลด์นี้ -->
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @endif
            </div>

        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            บันทึกการเปลี่ยนแปลง
        </button>
    </form>
    <div class="flex justify-end">

        {{-- <form id="delete-form" action="{{ route('equipment.delete', $dataforedit->equipments_code) }}"
            method="post">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="w-auto bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                data-confirm-delete="true" onclick="return confirm('คุณต้องการลบใช่ไหม ?')">
                ลบ
            </button>
        </form> --}}

        <a href="{{ route('equipment.delete', ['equipments_code' => $dataforedit->equipments_code]) }}"
            data-confirm-delete="true"
            class="w-auto bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">
            ลบครุภัณฑ์
        </a>

    </div>
    <script>
        document.querySelectorAll('a[data-confirm-delete]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.href;

                Swal.fire({
                    title: 'คุณกำลังจะลบครุภัณฑ์!',
                    text: "คุณต้องการลบตัวครุภัณฑ์ตัวนนี้ใช่ไหม ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
</x-guest-layout>
