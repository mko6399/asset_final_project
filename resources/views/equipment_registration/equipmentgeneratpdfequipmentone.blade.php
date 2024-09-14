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
            border: 2px solid #000000;
            line-height: 10pt;
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
            display: flex;

        }

        img {
            width: 50%;

        }
    </style>
</head>

<body>
    @foreach ($dataequipment as $item)
        <div class="heardde">

            <div class="posi">
                <img src="{{ public_path('uploads/equipments/' . $item->image_path) }}" alt="Equipment Image">





            </div>
            <p>
                ชื่อครุภัณฑ์: {{ $item->item_description_name }}
            </p>
            <p>
                ประเภทครุภัณฑ์: {{ $item->name_type_of_equipment }}
            </p>
            <p>
                ราคา/หน่วย : {{ $item->price }}
            </p>
            <p>
                จำนวน: {{ $item->amount }}
            </p>
            <p>
                วันที่ได้มา: {{ $item->date_acquired }}
            </p>
            <p>
                งบประมาณ: {{ $item->budget }}
            </p>
            <p>
                สถานที่ใช้งาน: {{ $item->location_use_name }}
            </p>
            <p>
                ผู้รับผิดชอบและใช้งาน: {{ $item->prefix }}{{ $item->name }} {{ $item->last_name }}
            </p>
            <p>
                หมายเลขครุภัณฑ์: {{ $item->asset_number }}
            </p>
            <p>
                ผู้ขาย: {{ $item->vendor }}
            </p>
            <p>
                อ้างอิง: {{ $item->reference_number }}
            </p>
            <p>
                S/N: {{ $item->serial_number }}
            </p>

        </div>
    @endforeach
</body>

</html>
