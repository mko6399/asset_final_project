<x-guest-layout>


    <h2 class="text-2xl font-bold mb-6 text-blue-600">ครุภัณฑ์</h2>
    <form method="POST" action="{{ route('equipment.store') }}" x-data="{ status: '', imagePreview: '', location_site_code: '' }" enctype="multipart/form-data"
        class="space-y-4">
        @csrf


        <!-- Upload image -->
        <div class="flex flex-col items-center">
            <template x-if="imagePreview">
                <div class="mb-4 flex justify-center">
                    <img :src="imagePreview" alt="Image Preview" class="w-full max-w-xs border rounded-lg">
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
                <input id="asset_number" type="number" name="asset_number"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Item Description Name -->
            <div class="flex flex-col">
                <label for="item_description_name"
                    class="block text-gray-700 font-medium mb-2">ลักษณะรายการ/ชื่อ:</label>
                <input id="item_description_name" type="text" name="item_description_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Type of Equipment -->
            <div class="flex flex-col">
                <label for="type_of_equipment_id" class="block text-gray-700 font-medium mb-2">ประเภทครุภัณฑ์:</label>
                <select id="type_of_equipment_id" name="type_of_equipment_id"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>เลือกประเภท</option>
                    @if (isset($dataTypeequipment))
                        @foreach ($dataTypeequipment as $value)
                            <option value="{{ $value->type_of_equipment_id }}">{{ $value->name_type_of_equipment }}
                            </option>
                        @endforeach
                    @else
                        <option>ไม่พบข้อมูล</option>
                    @endif
                </select>
            </div>

            <!-- Status -->
            <div class="flex flex-col">
                <label for="status" class="block text-gray-700 font-medium mb-2">สถานะ:</label>
                <select id="status" name="status" x-model="status"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1">ใช้งานได้</option>
                    <option value="2">ใช้งานไม่ได้</option>
                    <option value="3">ชำรุด</option>
                </select>
            </div>

            <!-- Date Acquired -->
            <div class="flex flex-col">
                <label for="date_acquired" class="block text-gray-700 font-medium mb-2">วันที่ได้มา:</label>
                <input id="date_acquired" type="date" name="date_acquired"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>


            <!-- Location -->
            <div class="flex flex-col">
                <label for="location_site_code" class="block text-gray-700 font-medium mb-2">สถานที่:</label>
                <select id="location_site_code" name="location_site_code" x-model="location_site_code"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>เลือกสถานที่</option>
                    @if (isset($datalocation))
                        @foreach ($datalocation as $value)
                            <option value="{{ $value->location_site_code }}">{{ $value->location_site_name }}</option>
                        @endforeach
                    @else
                        <option>ไม่พบข้อมูล</option>
                    @endif
                </select>
            </div>

            <!-- Location Use -->
            <div class="flex flex-col" x-show="location_use_name !== '0'">
                <label for="location_use_name" class="block text-gray-700 font-medium mb-2">สถานที่ใช้งานใน:</label>
                <textarea id="location_use_name" name="location_use_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <!-- Additional -->
            <div class="flex flex-col" x-show="status === '3'">
                <label for="additional" class="block text-gray-700 font-medium mb-2">หมายเหตุ:</label>
                <textarea id="additional" name="additional" x-bind:disabled="status !== '3'"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <!-- Vendor -->
            <div class="flex flex-col">
                <label for="vendor" class="block text-gray-700 font-medium mb-2">ผู้ขาย:</label>
                <input id="vendor" type="text" name="vendor"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Acquisition Method -->
            <div class="flex flex-col">
                <label for="acquisition_method" class="block text-gray-700 font-medium mb-2">วิธีที่ได้มา:</label>
                <input id="acquisition_method" type="text" name="acquisition_method"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Price -->
            <div class="flex flex-col">
                <label for="price" class="block text-gray-700 font-medium mb-2">ราคา/หน่วย:</label>
                <input id="price" type="number" step="0.01" name="price"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>



            <!-- Budget -->
            <div class="flex flex-col">
                <label for="budget" class="block text-gray-700 font-medium mb-2">งบประมาณ:</label>
                <input id="budget" type="text" name="budget"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Serial Number -->
            <div class="flex flex-col">
                <label for="serial_number" class="block text-gray-700 font-medium mb-2">S/N:</label>
                <input id="serial_number" type="text" name="serial_number"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Reference Number -->
            <div class="flex flex-col">
                <label for="reference_number" class="block text-gray-700 font-medium mb-2">เลขอ้างอิง:</label>
                <input id="reference_number" type="text" name="reference_number"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>



        <!-- Submit Button -->
        {{-- <div x-data="{ showConfirm: false }">
            <button type="button" @click="showConfirm = true"
                class="w-full bg-red-500 text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">
                Delete
            </button>
            <template x-if="showConfirm">
                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg space-y-4">
                        <h2 class="text-lg font-semibold text-gray-700">ต้องการบันทึกเลยหรือไม่</h2>
                        <div class="flex space-x-4">
                            <button type="button" @click="deleteItem()"
                                class="bg-red-600 text-white px-4 py-2 font-bold rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600">
                                Yes
                            </button>
                            <button type="button" @click="showConfirm = false"
                                class="bg-gray-300 text-gray-700 px-4 py-2 font-bold rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                No
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div> --}}
        <div class="mt-6 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
            <button type="submit"
                class="w-full md:w-1/2 bg-[#83ef6edb] text-white px-4 py-2 font-bold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600">บันทึก</button>
            <button type="button" onclick="window.location.href='{{ route('equipment.homepage') }}'"
                class="w-full md:w-1/2 bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">ยกเลิก</button>
        </div>

    </form>

</x-guest-layout>
