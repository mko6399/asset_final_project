<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }




        body {
            font-family: "THSarabunNew", sans-serif;
            font-size: 1.2rem;
            padding: 15px;
            line-height: 8pt;
        }

        @page {
            size: A4 landscape;

        }

        .header {
            text-align: center;
        }

        .logo {
            width: 60px;


        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            font-size: 0.9rem;
            line-height: 7pt;
            /* ลดขนาดฟอนต์ตารางเพื่อให้พอดี */
        }

        thead {
            display: table-header-group;
            border: 1px solid #000;
            padding: 4px;
            /* ลด padding เพื่อประหยัดพื้นที่ */
            text-align: center;
        }

        tbody {
            display: table-row-group;
            border: 1px solid #000;
            padding: 4px;
            /* ลด padding เพื่อประหยัดพื้นที่ */
            text-align: center;
        }

        th,
        td,
        tr {
            border: 1px solid #000;
            padding: 4px;
            /* ลด padding เพื่อประหยัดพื้นที่ */
            text-align: center;
        }

        h1,
        h2,
        h3 {
            margin: 20px;
            padding: 0;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
        }

        th {
            font-size: 0.85rem;
            white-space: nowrap;
            /* บังคับให้หัวตารางไม่ขึ้นบรรทัดใหม่ */
        }

        td {
            font-size: 0.8rem;
        }

        img {
            width: 60px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('build/assets/TSULOGOblack.jpg') }}" alt="logo">
        <h1>มหาวิทยาลัยทักษิณ</h1>
        <h2>รายงานตรวจสอบครุภัณฑ์ประจำปี (ทั้งหมด)</h2>
        <h3>ปีงบประมาณ: {{ $year }}</h3>

        <h3>{{ $currentDate }}</h3>
    </div>

    <div class="details">
        <p>แหล่งเงิน: ทั้งหมด</p>
        <p>แผนงานทั้งหมด: ทั้งหมด</p>
        <p>หน่วยงาน: สังกัดวิทยาเขตพัทลุง/คณะวิทยาศาสตร์และนวัตกรรมดิจิทัล/สำนักงานคณะวิทยาศาสตร์และนวัตกรรมดิจิทัล</p>
        <p>กองทุน: ทั้งหมด</p>
        <p>ประเภท: ทั้งหมด</p>
        <p class="section-title">สถานที่ใช้งาน: สำนักงานคณะวิทยาศาสตร์และนวัตกรรมดิจิทัล</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th rowspan="2">ลำดับที่</th>
                    <th rowspan="2">รายการขนาดลักษณะ</th>
                    <th rowspan="2">หมายเลขสินทรัพย์</th>
                    <th colspan="5">ผลการตรวจสอบ</th>
                    <th rowspan="2">เลข S/N</th>
                    <th colspan="4">รายการรับ (ตามทะเบียนครุภัณฑ์)</th>
                    <th rowspan="2">หน่วยงาน</th>
                    <th rowspan="2">ผู้รับผิดชอบ</th>
                    <th rowspan="2">สถานที่ใช้งาน</th>
                    <th rowspan="2">หมายเหตุชำรุด</th>
                </tr>
                <tr>
                    <th>ใช้ได้</th>
                    <th>ชำรุด</th>
                    <th>เสื่อมคุณภาพ</th>
                    <th>ไม่ใช้</th>
                    <th>สูญหาย</th>
                    <th>ได้มาเมื่อ</th>
                    <th>จากงบประมาณ</th>
                    <th>วิธีที่ได้มา</th>
                    <th>จำนวนเงิน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataequipment as $equipment)
                    <tr>
                        <td>{{ $equipment->equipments_code }}</td>
                        <td>{{ $equipment->item_description_name }}</td>
                        <td>{{ $equipment->asset_number }}</td>
                        @if ($equipment->status == 1)
                            <td>X</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @elseif ($equipment->status == 2)
                            <td></td>
                            <td>X</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @elseif ($equipment->status == 3)
                            <td></td>
                            <td></td>
                            <td>X</td>
                            <td></td>
                            <td></td>
                        @elseif ($equipment->status == 4)
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>X</td>
                            <td></td>
                        @elseif ($equipment->status == 5)
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>X</td>
                        @endif
                        <td>{{ $equipment->serial_number }}</td>
                        <td>{{ $equipment->date_acquired }}</td>
                        <td>{{ $equipment->budget }}</td>
                        <td>{{ $equipment->acquisition_method }}</td>
                        <td>{{ $equipment->price }}</td>
                        <td>สำนักงานคณะ</td>
                        <td>{{ $equipment->prefix }} {{ $equipment->name }} {{ $equipment->last_name }}</td>
                        <td>{{ $equipment->location_use_name }}</td>

                        @if ($equipment->additional)
                            <td> {{ $equipment->additional }}</td>
                        @else
                            <th>ไม่ได้ระบุไว้</th>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br />
    <br />
    <br />
</body>

</html>
