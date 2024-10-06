<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

        img {
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
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('build/assets/TSULOGOblack.jpg') }}" alt="logo" />
        <h1>มหาวิทยาลัยทักษิณ</h1>
        <h2>รายงานสรุปยอดครุภัณฑ์ตรวจสอบครุภัณฑ์ประจำปี (ทั้งหมด)</h2>
        <h3>ปีงบประมาณ: {{ $year }}</h3>
        <!-- ถ้าไม่มี session จะใช้ค่าปีปัจจุบัน -->


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
                    <th>ประเภทครุภัณฑ์</th>
                    <th>จำนวนครุภัณฑ์ทั้งหมด</th>
                    <th>ใช้งานได้</th>
                    <th>ชำรุด</th>
                    <th>เสื่อมคุณภาพ</th>
                    <th>ไม่ใช้</th>
                    <th>สูญหาย</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($dataequipment as $item)
                    <tr>
                        <td>{{ $item->name_type_of_equipment }}</td>
                        <td>{{ $item->total_equipments }}</td>
                        <td>{{ $item->status_1_count }}</td>
                        <td>{{ $item->status_2_count }}</td>
                        <td>{{ $item->status_3_count }}</td>
                        <td>{{ $item->status_4_count }}</td>
                        <td>{{ $item->status_5_count }}</td>
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
