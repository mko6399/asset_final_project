<html lang="en">

<head>
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
            font-size: 1rem;
            line-height: 12pt;
        }

        @page {
            size: A4 landscape;

        }

        table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            font-size: 0.9rem;
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
            /* display: table-row-group; */
            border: 1px solid #000;
            padding: 4px;
            /* ลด padding เพื่อประหยัดพื้นที่ */
            text-align: center;
        }

        .page-break {
            page-break-after: always;
            /* ใช้เพื่อให้ขึ้นหน้าใหม่ */
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('build/assets/TSULOGOblack.jpg') }}" alt="logo" class="logo">
        <h1>มหาวิทยาลัยทักษิณ</h1>
        <h2>รายงานตรวจสอบครุภัณฑ์ประจำปี (ทั้งหมด)</h2>
        <h3>ปีงบประมาณ: ปี พ.ศ. XXXX</h3>
        <h3>วันที่: XX/XX/XXXX</h3>
    </div>

    <div class="details page-break">
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
                @php
                    for ($i = 1; $i < 100; $i++) {
                        if ($i % 23 == 0) {
                            echo '</tbody>
        </table><table style="page-break-before: always;">
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
            <tbody>';
                        }
                        echo '<tr>';
                        echo '
                    <td>' .
                            $i .
                            '</td>
                    <td>เครื่องคอมพิวเตอร์ตั้งโต๊ะ</td>
                    <td>1234567890</td>
                    <td>✓</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>SN-ABC123</td>
                    <td>01/01/2020</td>
                    <td>งบประมาณแผ่นดิน</td>
                    <td>ซื้อ</td>
                    <td>25,000</td>
                    <td>สำนักงานคณะ</td>
                    <td>นายสมชาย ใจดี</td>
                    <td>ห้องทำงาน 301</td>
                    <td>-</td>
                    </tr>';
                    }
                @endphp
            </tbody>
        </table>
    </div>
    <br />
    <br />
    <br />
</body>

</html>
