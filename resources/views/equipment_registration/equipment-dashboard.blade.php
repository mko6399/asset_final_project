<x-guest-layout>
    <div class="w-full">
        <div class="grid lg:grid-cols-6 md:grid-cols-2 gap-4 mb-8">

            <div class="  flex justify-center  w-full  rounded-lg  ">



            </div>

            <div class="lg:col-span-3 md:col-span-1">
                <div class=" w-full ">
                    <select id="type_of_equipment_id" name="type_of_equipment_id"
                        class="bg-orange-200 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full text-center">
                        <option value="">เลือกประเภท</option>
                        @foreach ($dataTypeequipment as $value)
                            <option value="{{ $value->type_of_equipment_id }}">{{ $value->name_type_of_equipment }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full grid grid-cols-2 gap-4">

                    <div class="w-full flex justify-center mt-10">

                        <div class="w-full h-full">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>



                    <div class="flex flex-col gap-6 space-y-2 mt-10">
                        <div id="status-available" class="bg-red-400 px-4 py-2 rounded-lg w-full text-center">ใช้ได้
                            {{ $datalesttest[0] }} ชิ้น</div>
                        <div id="status-damaged" class="bg-blue-500 px-4 py-2 rounded-lg w-full text-center">ชำรุด
                            {{ $datalesttest[1] }} ชิ้น</div>
                        <div id="status-worn" class="bg-yellow-400 px-4 py-2 rounded-lg w-full text-center">เสื่อมคุณภาพ
                            {{ $datalesttest[2] }} ชิ้น</div>
                        <div id="status-not-used" class="bg-green-500 px-4 py-2 rounded-lg w-full text-center">ไม่ใช้
                            {{ $datalesttest[3] }} ชิ้น</div>
                        <div id="status-other" class="bg-purple-500 px-4 py-2 rounded-lg w-full text-center">สูญหาย
                            {{ $datalesttest[4] }} ชิ้น</div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1">
                {{-- <input id="yearPicker" type="text" class="form-input" placeholder="เลือกปี"> --}}
            </div>
            <div class="lg:col-span-1 ">
                <div class=" bg-orange-400 rounded-lg p-4 shadow-md flex flex-col text-center justify-center  ">

                    <div class="flex items-center space-x-4">

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


                    <div class="bg-orange-300 rounded-lg px-4 py-2 mt-4 text-center text-blue-900">
                        {{ Auth::user()->prefix }} {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                    </div>
                </div>
            </div>

        </div>


        <div class=" grid-flow-row  space-y-4">
            @if (Auth::user()->role !== 'officer')
                <div class="row-span-1 text-center text-2xl text-blue-600 bg-yellow-300 rounded-lg">
                    หน่วยงาน :
                    สังกัดวิทยาเขตพัทลุง/คณะวิทยาศาสตร์และนวัตกรรมดิจิทัล/สำนักงานคณะวิทยาศาสตร์และนวัตกรรมดิจิทัล
                </div>
            @endif

            <div class="row-span-1 text-center m-10">
                <button class="bg-orange-200 px-4 py-2 rounded-lg mx-2">
                    {{ $datadate }}</button>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var users = {{ Js::from($data) }};

        const percentageData = users;

        var year;

        const data = {

            datasets: [{
                label: ['My First dataset'],
                backgroundColor: ['#f87171', // สีชมพูเข้ม (จาก Tailwind สีแดง light: red-400)
                    '#3b82f6', // สีน้ำเงินเข้ม (จาก Tailwind สีน้ำเงิน light: blue-500)
                    '#facc15', // สีเหลืองเข้ม (จาก Tailwind สีเหลือง light: yellow-400)
                    '#4caf50', // สีเขียวเข้ม (สามารถใช้สี tailwind `#10b981` : green-500)
                    '#8b5cf6', // สีม่วงเข้ม (จาก Tailwind สีม่วง light: purple-500)
                ],

                borderColor: ['#f87171',
                    '#3b82f6',
                    '#facc15',
                    '#4caf50',
                    '#8b5cf6'
                ],
                data: percentageData,


            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let value = tooltipItem.raw; // ค่า raw data
                                return value + '%'; // ใส่ % ใน tooltip
                            }
                        }
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        $(document).ready(function() {
            $('#type_of_equipment_id').on('change', function() {
                var typeOfEquipmentId = $(this).val();

                $.ajax({
                    url: '{{ route('update.chart') }}',
                    type: 'GET',
                    data: {
                        type_of_equipment_id: typeOfEquipmentId
                    },
                    success: function(response) {
                        console.log(response);

                        var labels = response.labels;
                        var data = response.data;
                        var datalesttest1 = response.datalesttest;

                        // Update Chart
                        // myChart.data.labels = labels;
                        myChart.data.datasets[0].data = datalesttest1;
                        myChart.update();
                        $('#status-available').text('ใช้ได้ ' + (datalesttest1[0] ?? 0) +
                            ' ชิ้น');
                        $('#status-damaged').text('ชำรุด ' + (datalesttest1[1] ?? 0) + ' ชิ้น');
                        $('#status-worn').text('เสื่อมคุณภาพ ' + (datalesttest1[2] ?? 0) +
                            ' ชิ้น');
                        $('#status-not-used').text('ไม่ใช้ ' + (datalesttest1[3] ?? 0) +
                            ' ชิ้น');
                        $('#status-other').text('สูญหาย ' + (datalesttest1[4] ?? 0) + ' ชิ้น');
                    }
                });
            });
        });

        console.log(year);

        // $(document).ready(function() {
        //     $('#yearPicker').on('change', function() {
        //         var date2222Id = $(this).val();
        //         console.log(date2222Id);

        //         $.ajax({
        //             url: '{{ route('update.chart') }}',
        //             type: 'GET',
        //             data: {
        //                 date2222: date2222Id
        //             },
        //             success: function(response) {
        //                 var labels = response.labels;
        //                 var data = response.data;

        //                 // Update Chart
        //                 myChart.data.labels = labels;
        //                 myChart.data.datasets[0].data = data;
        //                 myChart.update();
        //                 $('#status-available').text('ใช้ได้ ' + (data[0] ?? 0) + ' ชิ้น');
        //                 $('#status-damaged').text('ชำรุด ' + (data[1] ?? 0) + ' ชิ้น');
        //                 $('#status-worn').text('เสื่อมคุณภาพ ' + (data[2] ?? 0) + ' ชิ้น');
        //                 $('#status-not-used').text('ไม่ใช้ ' + (data[3] ?? 0) + ' ชิ้น');
        //                 $('#status-other').text('สูญหาย ' + (data[4] ?? 0) + ' ชิ้น');
        //             }
        //         });
        //     });
        // });
    </script>
</x-guest-layout>
