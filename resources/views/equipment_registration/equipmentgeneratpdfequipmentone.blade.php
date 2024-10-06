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

        .setposi {
            padding: 1.3rem;
            display: flex;
            justify-content: center;

            font-size: 1.3rem;
            line-height: 15pt;
        }

        /* p {
            font-size: 1.5rem;

        } */

        .posi2 {
            position: absolute;
            bottom: 0;
            right: 0;
            text-align: right;


        }

        span {
            padding: 1.5rem;
            font-weight: bold;
        }


        img {
            width: 15rem;

        }
    </style>
</head>

<body>
    @foreach ($dataequipment as $item)
        <div class="">

            <div class="posi">
                @if ($item->image_path)
                    <img src="{{ public_path('uploads/equipments/' . $item->image_path) }}" alt="Equipment Image">
                @else
                    <p>ไม่มีรูป</p>
                @endif



            </div>

            <div class="setposi">


                <p>
                    <span>ชื่อครุภัณฑ์:</span> {{ $item->item_description_name }}
                </p>
                <p>
                    <span>ประเภทครุภัณฑ์:</span> {{ $item->name_type_of_equipment }}
                </p>
                <p>
                    <span>ราคา/หน่วย:</span> {{ $item->price }}
                </p>
                <p>
                    <span>จำนวน:</span> {{ $item->amount }}
                </p>
                <p>
                    <span>วันที่ได้มา:</span> {{ $item->date_acquired }}
                </p>
                <p>
                    <span>งบประมาณ:</span> {{ $item->budget }}
                </p>
                <p>
                    <span>สถานที่ใช้งาน:</span> {{ $item->location_use_name }}
                </p>
                <p>
                    <span>ผู้รับผิดชอบและใช้งาน:</span> {{ $item->prefix }}{{ $item->name }} {{ $item->last_name }}
                </p>
                <p>
                    <span>หมายเลขครุภัณฑ์:</span> {{ $item->asset_number }}
                </p>
                <p>
                    <span>ผู้ขาย:</span> {{ $item->vendor }}
                </p>
                <p>
                    <span>อ้างอิง:</span> {{ $item->reference_number }}
                </p>
                <p>
                    <span>S/N:</span> {{ $item->serial_number }}
                </p>

            </div>
        </div>
    @endforeach
</body>

</html>
