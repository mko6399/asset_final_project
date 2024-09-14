<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }



        body {
            font-family: "THSarabunNew", sans-serif;

        }


        table {
            width: 100%;
            border: 3px solid #000000;

            border-collapse: collapse;
        }

        th,
        td,
        tr,
        thead {
            border: 1px solid #000000;
            padding: 8px;
            text-align: left;

            font-size: 1.2rem;
        }

        .posi {
            display: flex;
            text-align: center;


        }


        p {
            font-size: 1.2rem
        }

        .posi2 {
            position: absolute;
            bottom: 0;
            right: 0;
            text-align: right;


        }

        .heardde {

            font-size: 1.2rem;
            margin: 20px;
        }

        img {
            width: 100px;

        }
    </style>
</head>


<body>
    <div class="posi">
        <img src="{{ public_path('build/assets/TSULOGOblack.jpg') }}" alt="logo" />

        <h1>ใบแจ้งชำรุด </h1>
        {{-- <h1>{{ $title }}</h1>

    <br />
    <br />
    <p class="w-28">{{ $content }}</p>
    <br />
    <br /> --}}

    </div>

    <div class="heardde">
        @foreach ($dataequipment as $data)
            <h3>

                ชื่อ-นามสกุล:{{ $data->name }}{{ $data->last_name }}
            </h3>
            <h3>
                ตำแหน่ง:สังกัดวิทยาเขตพัทลุง/คณะวิทยาศาสตร์และนวัตกรรมดิจิทัล/สำนักงานคณะวิทยาศาสตร์และนวัตกรรมดิจิทัล
            </h3>
            <h3>
                หน่วยงาน:สำนักงานคณะวิทยาศาสตร์และนวัตกรรมดิจิทัล
            </h3>
    </div>

    <center>
        <h2>รายละเอียดครุภัณฑ์ </h2>
    </center>

    <div>
        <table>
            <thead>
                <tr>
                    <th colspan="2">วันที่แจ้งชำรุด:
                        {{ \Carbon\Carbon::parse($data->updated_at)->locale('th_TH')->translatedFormat('j F') }}
                        {{ \Carbon\Carbon::parse($data->updated_at)->addYears(543)->year }}
                    </th>

                    <th>หมายเลขชำรุด:</th>

                </tr>
                <tr>
                    <th colspan="3">ชื่อ/ลักษะครุภัณฑ์:{{ $data->item_description_name }}</th>
                </tr>
                <tr>
                    <th>ประเภทครุภัณฑ์:{{ $data->name_type_of_equipment }}</th>
                    <th colspan="2">หมายเหตุชำรุด:{{ $data->additional }}</th>
                </tr>

            </thead>

        </table>
        @endforeach
    </div>
    <div class="posi2">
        <p>ลงชื่อ..............................................................</p>
        <p>(..................................................................)</p>
        <center>
            <p>ข้าราชการ/เจ้าหน้าที่</p>
        </center>
    </div>

</body>

</html>
