<x-guest-layout>
    <div class="p-4">
        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="flex flex-col items-center space-y-4 bg-orange-400 rounded-lg p-4 shadow-md">
                <div class="flex items-center space-x-4">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" fill="#0033A0">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z" />
                    </svg>


                    <div>
                        @if (Auth::user()->role !== 'officer')
                            <h1 class="text-lg font-bold text-blue-900">ผู้ดูแลระบบ</h1>
                        @else
                            <h1 class="text-lg font-bold text-blue-900">ผู้รับผิดชอบ</h1>
                        @endif
                    </div>
                </div>


                <div class="bg-orange-300 rounded-lg px-4 py-2 mt-4 text-center text-blue-900">
                    {{ Auth::user()->prefix }} {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                </div>
            </div>

            <div class="col-span-3">
                <div class="grid grid-cols-2 gap-4">

                    <div class="flex justify-center mb-8">

                        <div class="w-full h-auto">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>


                    <div class="flex flex-col justify-end space-y-2 mb-8">
                        <div id="status-available" class="bg-orange-300 px-4 py-2 rounded-lg w-full text-center">ใช้ได้
                            {{ $data[0] ?? 0 }} ชิ้น</div>
                        <div id="status-damaged" class="bg-yellow-300 px-4 py-2 rounded-lg w-full text-center">ชำรุด
                            {{ $data[1] ?? 0 }} ชิ้น</div>
                        <div id="status-worn" class="bg-lime-300 px-4 py-2 rounded-lg w-full text-center">เสื่อมคุณภาพ
                            {{ $data[2] ?? 0 }} ชิ้น</div>
                        <div id="status-not-used" class="bg-green-300 px-4 py-2 rounded-lg w-full text-center">ไม่ใช้
                            {{ $data[3] ?? 0 }} ชิ้น</div>
                        <div id="status-other" class="bg-red-300 px-4 py-2 rounded-lg w-full text-center">สูญหาย
                            {{ $data[4] ?? 0 }} ชิ้น</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex justify-center mt-4">
            <button class="bg-orange-200 px-4 py-2 rounded-lg mx-2">2567</button>
            <button class="bg-yellow-200 px-4 py-2 rounded-lg mx-2">2566</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var users = {{ Js::from($data) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: ['rgba(255, 99, 132, 0.8)', // สีชมพูเข้ม
                    'rgba(54, 162, 235, 0.8)', // สีน้ำเงินเข้ม
                    'rgba(255, 206, 86, 0.8)', // สีเหลืองเข้ม
                    'rgba(75, 192, 192, 0.8)', // สีเขียวเข้ม
                    'rgba(153, 102, 255, 0.8)'
                ],

                borderColor: 'rgb(255, 99, 132)',
                data: users,
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {}
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
                        var labels = response.labels;
                        var data = response.data;

                        // Update Chart
                        myChart.data.labels = labels;
                        myChart.data.datasets[0].data = data;
                        myChart.update();
                        $('#status-available').text('ใช้ได้ ' + (data[0] ?? 0) + ' ชิ้น');
                        $('#status-damaged').text('ชำรุด ' + (data[1] ?? 0) + ' ชิ้น');
                        $('#status-worn').text('เสื่อมคุณภาพ ' + (data[2] ?? 0) + ' ชิ้น');
                        $('#status-not-used').text('ไม่ใช้ ' + (data[3] ?? 0) + ' ชิ้น');
                        $('#status-other').text('สูญหาย ' + (data[4] ?? 0) + ' ชิ้น');
                    }
                });
            });
        });
    </script>
</x-guest-layout>
