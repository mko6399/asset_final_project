<x-guest-layout>




    <form method="POST" action="{{ route('equipment.store') }}" x-data="{ status: '{{ old('status') }}', imagePreview: '', location_site_code: '{{ old('location_site_code') }}' }" enctype="multipart/form-data"
        class="space-y-4">
        @csrf

        <h2 class="text-2xl font-bold mb-6 fl text-blue-600 text-center m-10">ครุภัณฑ์</h2>
        <!-- Upload image -->
        <div class="flex flex-col items-center">
            <template x-if="imagePreview">
                <div class="mb-4 flex justify-center">
                    <img :src="imagePreview" alt="Image Preview" class="w-full max-w-xs border rounded-lg">
                </div>
            </template>
            <label for="image_path" class="block text-gray-700 font-medium mb-2">อัปโหลดภาพ:</label>
            <input id="image_path" type="file" name="image_path" value="{{ old('image_path') }}"
                @change="imagePreview = URL.createObjectURL($event.target.files[0])"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Asset Number -->
            <div class="flex flex-col">
                <label for="asset_number" class="block text-gray-700 font-medium mb-2">หมายเลขครุภัณฑ์:
                    <span id="number-message" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span></label>
                <input id="asset_number" type="text" name="asset_number" maxlength="31"
                    value="{{ old('asset_number') }}" oninput="formatasset_number()"
                    placeholder="6706040040-0031040-0031-0010002"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <!-- แสดงข้อความผิดพลาด -->
                <span id="numbererror-message" class="text-red-500 mt-1"></span>
            </div>


            <!-- Item Description Name -->
            <div class="flex flex-col">
                <label for="item_description_name" class="block text-gray-700 font-medium mb-2">ลักษณะรายการ/ชื่อ: <span
                        id="item_description_name-message" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span> </label>
                <input id="item_description_name" type="text" name="item_description_name" oninput="cheakdata()"
                    value="{{ old('item_description_name') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" ">
            </div>

            <!-- Type of Equipment -->
            <div class="flex flex-col">
                <label for="type_of_equipment_id" class="block text-gray-700 font-medium mb-2">ประเภทครุภัณฑ์: <span id="Errortype_of_equipment_id" class="text-red-500">*จำเป็นต้องเลือก</span></label>
                <select id="type_of_equipment_id" name="type_of_equipment_id"
                   oninput="cheakdata()"  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">เลือกประเภท</option>

                                                         @if (isset($dataTypeequipment))
                @foreach ($dataTypeequipment as $value)
                    <option value="{{ $value->type_of_equipment_id }}"
                        {{ old('type_of_equipment_id') == $value->type_of_equipment_id ? 'selected' : '' }}>
                        {{ $value->name_type_of_equipment }}
                    </option>
                @endforeach
            @else
                <option>ไม่พบข้อมูล</option>
                @endif
                </select>
                @if ($errors->has('type_of_equipment_id'))
                    <span class="text-red-500 mt-1">กรุณาเลือกสถานะ</span>
                @endif
            </div>

            <!-- Status -->
            <div class="flex flex-col">
                <label for="status" class="block text-gray-700 font-medium mb-2">สถานะ: <span
                        id="required-message-status" class="text-red-500">*ข้อมูลจำเป็นต้องเลือก</span></label>
                <select id="status" name="status" x-model="status" oninput="cheakdata()"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>เลือกสถานะ</option>
                    <option value="1">ใช้งานได้</option>
                    <option value="2">ชำรุด</option>
                    <option value="3">เสื่อมคุณภาพ</option>
                    <option value="4">ไม่ใช้</option>
                    <option value="5">สูญหาย</option>
                </select>
                @if ($errors->has('status'))
                    <span class="text-red-500 mt-1">กรุณาเลือกสถานะ</span>
                @endif
            </div>



            <!-- Date Acquired -->
            <div class="flex flex-col">
                <label for="date_acquired" class="block text-gray-700 font-medium mb-2">วันที่ได้มา: <span
                        id=date_acquiredmessage" class="text-red-500">*ข้อมูลจำเป็นต้องเลือก</span></label>
                <input id="date_acquired" type="date" name="date_acquired" oninput="cheakdata()"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('date_acquired') }}">
                @if ($errors->has('date_acquired'))
                    <span class="text-red-500 mt-1">กรุณาใส่วันที่ได้มา</span>
                @endif
            </div>


            <!-- Location -->
            <div class="flex flex-col">
                <label for="location_site_code" class="block text-gray-700 font-medium mb-2">สถานที่: <span
                        id="location_site_codemessage" class="text-red-500">*ข้อมูลจำเป็นต้องเลือก</span></label>
                <select id="location_site_code" name="location_site_code" x-model="location_site_code"
                    oninput="cheakdata()"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">เลือกสถานที่</option>
                    @if (isset($datalocation))
                        @foreach ($datalocation as $value)
                            <option value="{{ $value->location_site_code }}">{{ $value->location_site_name }}</option>
                        @endforeach
                    @else
                        <option>ไม่พบข้อมูล</option>
                    @endif
                </select>
                @if ($errors->has('location_site_code'))
                    <span class="text-red-500 mt-1">กรุณาเลือกสถานะ</span>
                @endif
            </div>

            <!-- Location Use -->
            <div class="flex flex-col" x-show="location_use_name !== '0'">
                <label for="location_use_name" class="block text-gray-700 font-medium mb-2">สถานที่ใช้งานใน:<span
                        id="location_use_name-message" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span></label>
                <textarea id="location_use_name" name="location_use_name" oninput="cheakdata()"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>



            <!-- Vendor -->
            <div class="flex flex-col">
                <label for="vendor" class="block text-gray-700 font-medium mb-2">ผู้ขาย: <span
                        id="required-message-vendor" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span></label>
                <input id="vendor" type="text" name="vendor" oninput="cheakdata()"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Acquisition Method -->
            <div class="flex flex-col">
                <label for="acquisition_method" class="block text-gray-700 font-medium mb-2">วิธีที่ได้มา: <span
                        id="required-message-acquisition" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span></label>
                <input id="acquisition_method" type="text" name="acquisition_method" oninput="cheakdata()"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Price -->
            <div class="flex flex-col">
                <label for="price" class="block text-gray-700 font-medium mb-2">ราคา/หน่วย: <span
                        id="required-message-price" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span></label>
                <input id="price" type="number" step="0.01" name="price" min="0"
                    max="9999999999.0" oninput="cheakdata() "
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    oninput="if(this.value.length > 10) this.value = this.value.slice(0,10);">
            </div>



            <!-- Budget -->
            <div class="flex flex-col">
                <label for="budget" class="block text-gray-700 font-medium mb-2">งบประมาณ: <span
                        id="required-message-budget" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span></label>
                <input id="budget" type="text" name="budget" placeholder="เช่น เงินอุดหนุนรัฐ"
                    oninput="cheakdata() "
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Serial Number -->
            <div class="flex flex-col">
                <label for="serial_number" class="block text-gray-700 font-medium mb-2">S/N:</label>
                <input id="serial_number" type="text" name="serial_number"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    maxlength="40">
            </div>

            <!-- Reference Number -->
            <div class="flex flex-col">
                <label for="reference_number" class="block text-gray-700 font-medium mb-2">เลขอ้างอิง:</label>
                <input id="reference_number" type="text" name="reference_number"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    maxlength="40">
            </div>
            <!-- Additional -->
            <div class="flex flex-col" x-show="status === '2'">
                <label for="additional" class="block text-gray-700 font-medium mb-2">หมายเหตุแจ้งชำรุด: <span
                        id="additional-message" class="text-red-500">*ข้อมูลจำเป็นต้องกรอก</span></label>
                <textarea id="additional" name="additional" x-bind:disabled="status !== '2'" oninput="cheakdata() "
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>
        </div>




        <div class="m-24 flex flex-col md:flex-row  md:space-y-0 md:space-x-6 lg:gap-96">

            <button type="submit"
                class="lg:w-1/3 md:w-1/3 bg-[#83ef6edb] text-white px-4 py-2 font-bold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600">บันทึก</button>
            <button type="button" onclick="window.location.href='{{ route('equipment.adminhomepage') }}'"
                class="lg:w-1/3 md:w-1/3 bg-[#e33a31db] text-white px-4 py-2 font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">ยกเลิก</button>
        </div>

    </form>

    <script>
        function formatasset_number() {
            let input = document.getElementById("asset_number");
            let errorMessage = document.getElementById("numbererror-message");
            let value = input.value.replace(/\D/g, ''); // ลบตัวอักษรที่ไม่ใช่ตัวเลขออก
            const requiredMessage = document.getElementById('number-message');

            // แทรก '-' ตามตำแหน่งที่กำหนด
            if (value.length > 10) {
                value = value.slice(0, 10) + '-' + value.slice(10); // แทรก '-' หลังจากตำแหน่งที่ 10
            }
            if (value.length > 18) {
                value = value.slice(0, 18) + '-' + value.slice(18); // แทรก '-' หลังจากตำแหน่งที่ 19
            }
            if (value.length > 23) {
                value = value.slice(0, 23) + '-' + value.slice(23); // แทรก '-' หลังจากตำแหน่งที่ 24
            }

            input.value = value; // อัปเดตค่าของ input
            let pattern = /^\d{10}-\d{7}-\d{4}-\d{7}$/; // รูปแบบที่ต้องการ
            if (input.value.length === 0) {

                errorMessage.textContent = 'กรุณากรอกหมายเลขครุภัณฑ์';

                event.preventDefault();
            } else if (!pattern.test(input.value)) {
                requiredMessage.style.display = 'none';
                errorMessage.textContent = 'ข้อมูลไม่ถูกต้อง กรุณากรอกหมายเลขครุภัณฑ์ตามรูปแบบที่กำหนด';

                event.preventDefault();

            } else if (input.value.length < 31) {
                // ถ้าค่าตรงตามรูปแบบ
                errorMessage.textContent = 'กรุณากรอกข้อมูลให้ครบ';

                event.preventDefault();

            } else {
                errorMessage.textContent = '';
            }



        }

        function cheakdata() {
            const typeInput = document.getElementById('type_of_equipment_id');
            const errorMessageType = document.getElementById('Errortype_of_equipment_id');
            const nameitem = document.getElementById('item_description_name');
            const itemerrorMessage = document.getElementById('item_description_name-message');
            const statusInput = document.getElementById('status');
            const statusErrorMessage = document.getElementById('required-message-status');

            const vendorInput = document.getElementById('vendor');
            const vendorErrorMessage = document.getElementById('required-message-vendor');

            const acquisitionInput = document.getElementById('acquisition_method');
            const acquisitionErrorMessage = document.getElementById('required-message-acquisition');

            const priceInput = document.getElementById('price');
            const priceErrorMessage = document.getElementById('required-message-price');

            const budgetInput = document.getElementById('budget');
            const budgetErrorMessage = document.getElementById('required-message-budget');

            const additionInput = document.getElementById('additional');
            const additionErrorMessage = document.getElementById('additional-message');

            const locationusenameInput = document.getElementById('location_use_name');
            const locationusenameErrorMessage = document.getElementById('location_use_name-message');

            const dateInput = document.getElementById('date_acquired');
            const dateErrorMessage = document.getElementById('date_acquiredmessage');



            const locationsitecodeInput = document.getElementById('location_site_code');
            const locationsitecodeErrorMessage = document.getElementById('location_site_codemessage');


            if (locationsitecodeInput.value.trim() === '') {
                locationsitecodeErrorMessage.style.display = 'inline'; // แสดงข้อความแจ้งข้อผิดพลาด
            } else {
                locationsitecodeErrorMessage.style.display = 'none'; // ซ่อนข้อความแจ้งข้อผิดพลาด
            }




            if (locationusenameInput.value.trim() === '') {
                locationusenameErrorMessage.style.display = 'inline'; // แสดงข้อความแจ้งข้อผิดพลาด
            } else {
                locationusenameErrorMessage.style.display = 'none'; // ซ่อนข้อความแจ้งข้อผิดพลาด
            }



            if (additionInput.value.trim() === '') {
                additionErrorMessage.style.display = 'inline'; // แสดงข้อความแจ้งข้อผิดพลาด
            } else {
                additionErrorMessage.style.display = 'none'; // ซ่อนข้อความแจ้งข้อผิดพลาด
            }




            if (typeInput.value.trim() === '') {
                errorMessageType.style.display = 'inline'; // แสดงข้อความแจ้งข้อผิดพลาด
            } else {
                errorMessageType.style.display = 'none'; // ซ่อนข้อความแจ้งข้อผิดพลาด
            }

            // ตรวจสอบลักษณะรายการ/ชื่อ
            if (nameitem.value.trim() === '') {
                itemerrorMessage.style.display = 'inline'; // แสดงข้อความแจ้งข้อผิดพลาด
            } else {
                itemerrorMessage.style.display = 'none'; // ซ่อนข้อความแจ้งข้อผิดพลาด
            }

            // ตรวจสอบสถานะ
            if (statusInput.value.trim() === '') {
                statusErrorMessage.style.display = 'inline';
            } else {
                statusErrorMessage.style.display = 'none';
            }

            // ตรวจสอบผู้ขาย
            if (vendorInput.value.trim() === '') {
                vendorErrorMessage.style.display = 'inline';
            } else {
                vendorErrorMessage.style.display = 'none';
            }

            // ตรวจสอบวิธีการได้มา
            if (acquisitionInput.value.trim() === '') {
                acquisitionErrorMessage.style.display = 'inline';
            } else {
                acquisitionErrorMessage.style.display = 'none';
            }

            // ตรวจสอบราคา
            if (priceInput.value.trim() === '') {
                priceErrorMessage.style.display = 'inline';
            } else {
                priceErrorMessage.style.display = 'none';
            }

            // ตรวจสอบงบประมาณ
            if (budgetInput.value.trim() === '') {
                budgetErrorMessage.style.display = 'inline';
            } else {
                budgetErrorMessage.style.display = 'none';
            }

            if (dateInput.value.trim() === '') {
                dateErrorMessage.style.display = 'inline'; // แสดงข้อความเมื่อไม่มีการกรอกข้อมูล
            } else {
                dateErrorMessage.style.display = 'inline'; // ซ่อนข้อความเมื่อกรอกข้อมูลแล้ว
            }
        }




        // const assetNumberInput = document.getElementById('asset_number');
        // const errorMessage = document.getElementById('error-message');

        // // ดักจับเหตุการณ์ input
        // assetNumberInput.addEventListener('input', function() {
        //     errorMessage.textContent = ''; // เคลียร์ข้อความผิดพลาดเมื่อมีการป้อนข้อมูล
        // });

        // // ดักจับเหตุการณ์ blur (เมื่อผู้ใช้คลิกออกจากฟิลด์)
        // assetNumberInput.addEventListener('blur', function() {
        //     if (!assetNumberInput.value.trim()) {
        //         errorMessage.textContent = 'กรุณาป้อนหมายเลขครุภัณฑ์';
        //     }
        // });

        // // ดักจับเหตุการณ์ submit ของแบบฟอร์ม
        // document.querySelector('form').addEventListener('submit', function(event) {
        //     if (!assetNumberInput.value.trim()) {
        //         errorMessage.textContent = 'กรุณาป้อนหมายเลขครุภัณฑ์';
        //         event.preventDefault(); // หยุดการส่งแบบฟอร์ม
        //     }
        // });
    </script>
</x-guest-layout>
