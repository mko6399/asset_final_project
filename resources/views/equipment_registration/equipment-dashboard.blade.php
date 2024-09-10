<x-guest-layout>
    <div class="max-h-screen  ">
        <div class="flex flex-col justify-around">
            <div class="flex items-center space-x-5 gap-x-36">
                <select id="type_of_equipment_id" name="type_of_equipment_id"
                    class="bg-orange-200 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 w-1/2">
                    <option value="">เลือกประเภท</option>
                    @foreach ($dataTypeequipment as $value)
                        <option value="{{ $value->type_of_equipment_id }}">{{ $value->name_type_of_equipment }}</option>
                    @endforeach
                </select>
                <div class="grid grid-cols-1   bg-orange-400 rounded-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            fill="#0033A0">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z" />
                        </svg>



                        @if (Auth::user()->role !== 'officer')
                            <h1 class="text-lg">ผู้ดูแลระบบ</h1>
                        @else
                            <h1 class="text-lg">ผู้รับผิดชอบ</h1>
                        @endif
                    </div>
                    <div class="bg-orange-300 my-4 ">
                        {{ Auth::user()->prefix }}
                        {{ Auth::user()->name }}
                        {{ Auth::user()->last_name }}
                    </div>


                </div>
            </div>
        </div>




        <!-- Top Menu Section -->
        <div class="w-full flex max-w-4xl mx-auto">


            <!-- Main Content Section -->
            <div class=" justify-center mb-8">
                <!-- Pie Chart (Placeholder for Chart) -->
                <div class="w-full h-auto ">

                    <canvas id="myChart"></canvas>
                </div>
            </div>

            <!-- Status List -->
            <div class="flex flex-col justify-end items-end space-y-2 mb-8">
                <div id="status-available" class="bg-orange-300 px-4 py-2 rounded-lg w-48 text-center">ใช้ได้
                    {{ $data[0] ?? 0 }} ชิ้น</div>
                <div id="status-damaged" class="bg-yellow-300 px-4 py-2 rounded-lg w-48 text-center">ชำรุด
                    {{ $data[1] ?? 0 }} ชิ้น</div>
                <div id="status-worn" class="bg-lime-300 px-4 py-2 rounded-lg w-48 text-center">เสื่อมคุณภาพ
                    {{ $data[2] ?? 0 }} ชิ้น
                </div>
                <div id="status-not-used" class="bg-green-300 px-4 py-2 rounded-lg w-48 text-center">ไม่ใช้
                    {{ $data[3] ?? 0 }} ชิ้น</div>
                <div id="status-other" class="bg-red-300 px-4 py-2 rounded-lg w-48 text-center">อื่นๆ
                    {{ $data[4] ?? 0 }} ชิ้น</div>



            </div>



            <!-- Year Selection -->

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
                backgroundColor: ['rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',

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
                        $('#status-other').text('อื่นๆ ' + (data[4] ?? 0) + ' ชิ้น');
                    }
                });
            });
        });
    </script>
</x-guest-layout>
