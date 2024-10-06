<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use App\Models\Images_equipment;
use App\Models\Responsible;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EquipmentUserComtroller extends Controller
{





    public function edit(int $equipments_code)
    {
        $dataTypeequipment = DB::table('type_of_equipment')->select('type_of_equipment_id', 'name_type_of_equipment')->get();
        $datalocation = DB::table('location')->select('location_site_code', 'location_site_name')->get();
        $data_use = DB::table('users')->select('id', 'prefix', 'name', 'last_name')->get();


        $dataforedit = Equipments::with([
            'imagesequipments',   // ความสัมพันธ์กับ Type_of_equipmen
            'location',            // ความสัมพันธ์กับ Location
            'typeOfEquipment',

            'responsible'
        ])->findOrFail($equipments_code);



        $responsibleIds = $dataforedit->responsible->user_id;



        $dataeditresponsible = User::select('id', 'prefix', 'name', 'last_name')
            ->where('id', $responsibleIds)
            ->get(); // จะคืนค่าเป็น object ของ User หรือ null ถ้าไม่พบ








        // dd($imagePath = $dataforedit->imagesequipments->first()->image_path);

        $imagePath = $dataforedit->imagesequipments->isNotEmpty() ? $dataforedit->imagesequipments->first()->image_path : null;

        return view('equipment_registration.epuipment-edit', compact('dataforedit', 'dataTypeequipment', 'datalocation', 'data_use', 'imagePath', 'dataeditresponsible',  'responsibleIds'));
    }


    public function update(Request $request, string $equipments_code)
    {


        $user = Auth::user();
        $userrole = $user->role;

        // ค้นหาอุปกรณ์ที่ต้องการอัปเดต
        $equipment = Equipments::find($equipments_code);
        $equipment->update($request->all());

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/equipments';
            $file->move($path, $filename);

            // อัปเดตหรือสร้างข้อมูลภาพ
            Images_equipment::updateOrCreate([
                'equipments_code' => $equipments_code,
            ], [
                'image_path' => $filename,
            ]);
        }

        // อัปเดตหรือสร้างข้อมูลผู้รับผิดชอบ
        if ($request->has('user_id') && $request->input('user_id') != null && $request->input('user_id') != 0) {
            Responsible::updateOrCreate([
                'equipments_code' => $equipments_code,
            ], [
                'user_id' => $request->input('user_id'), // อัปเดตหรือสร้างใหม่ด้วย user_id
            ]);
        }



        // แสดงข้อความแจ้งเตือนสำเร็จ
        Alert::success('แก้ไขเรียบร้อย!!!', 'แก้ไขลงในระบบเรียบร้อยแล้วเรียบร้อย');

        // เปลี่ยนเส้นทางไปยังหน้าแรกของอุปกรณ์
        return redirect()->route('equipment.homepage');
    }

    public function homepage()
    {
        $user = Auth::user();
        $userrole = $user->role;
        $userId = $user->id;




        $dataequipment = DB::table('equipments as e')
            ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
            ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
            ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
            ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')

            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->where('r.user_id', $userId) // Filter by the logged-in user's ID
            ->select(
                'e.*',
                'toe.*',
                'u.id',
                'u.prefix',
                'u.name',
                'u.last_name',
                'ie.*',
                'l.*',
                'r.*',

            )->orderBy('e.created_at', 'desc')
            ->get();



        return view('equipment_registration.epuipment-homepage', compact('dataequipment'));
    }
}
