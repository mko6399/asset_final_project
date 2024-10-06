<!DOCTYPE html>
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
    </style>
</head>

<body>
    <div class="header">
        {{-- {{ public_path('build/assets/TSULOGOblack.jpg') }} --}}
        <img src="http://std.csit.sci.tsu.ac.th/642021154/project/public/build/assets/TSULOGOblack.jpg" alt="logo"
            class="logo">
        <h1>มหาวิทยาลัยทักษิณ</h1>
        <h2>รายงานตรวจสอบครุภัณฑ์ประจำปี (ทั้งหมด)</h2>
        <h3>ปีงบประมาณ: {{ $year }}</h3>

        <h3>วันที่: {{ now()->format('d/m/Y') }}</h3>
    </div>
</body>

</html>
