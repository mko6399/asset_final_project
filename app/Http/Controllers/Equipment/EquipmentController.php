<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Equipments;
use App\Models\Images_equipment;
use App\Models\Location;
use App\Models\Location_use;
use App\Models\Responsible;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $dataTypeequipment = DB::table('type_of_equipment')->select('type_of_equipment_id', 'name_type_of_equipment')->get();
        $datalocation = DB::table('location')->select('location_site_code', 'location_site_name')->get();

        return view('equipment_registration.equipment-form', compact('dataTypeequipment', 'datalocation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $assetNumber = $request->input('asset_number');
        // // $referenceNumber = $request->input('reference_number');
        // $serialNumber = $request->input('serial_number');
        // if (empty($serialNumber) || strlen($serialNumber) !== 28) {
        //     // สร้าง asset_number ใหม่ที่มีความยาว 28 ตัวอักษร
        //     $serialNumber = strtoupper(bin2hex(random_bytes(14))); // ใช้ 14 bytes เพื่อให้ได้ 28 ตัวอักษร (hex)
        // }
        if (empty($assetNumber) || strlen($assetNumber) !== 28) {
            // สร้าง asset_number ใหม่ที่มีความยาว 28 ตัวอักษร
            $assetNumber = strtoupper(bin2hex(random_bytes(14))); // ใช้ 14 bytes เพื่อให้ได้ 28 ตัวอักษร (hex)
        }
        $request->validate([
            'status' => 'required',
            'type_of_equipment_id' => 'required',
            'location_site_code' => 'required',
            'location_use_name' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional: Validate the image
            'asset_number' => 'nullable|string|max:255',
            'date_acquired' => 'required|date',
            'item_description_name' => 'required|string|max:255',
            'vendor' => 'required|string|max:255',
            'acquisition_method' => 'required|string|max:255',
            'price' => 'required|numeric',
            'additional' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'budget' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_path')) {

            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = 'uploads/equipments';
            $file->move($path, $filename);
        }

        $equipment = Equipments::create([
            'status' => $request->input('status'),
            'type_of_equipment_id' => $request->input('type_of_equipment_id'),
            'location_site_code' => $request->input('location_site_code'),
            'asset_number' => $assetNumber,
            'date_acquired' => $request->input('date_acquired'),
            'item_description_name' => $request->input('item_description_name'),
            'vendor' => $request->input('vendor'),
            'acquisition_method' => $request->input('acquisition_method'),
            'price' => $request->input('price'),
            'amount' => 1,
            'reference_number' => $request->input('reference_number'),
            'budget' => $request->input('budget'),
            'serial_number' => $request->input('serial_number'),
            'additional' => $request->input('additional'),
            'location_use_name' => $request->input('location_use_name'),
        ]);


        if (isset($filename)) {
            Images_equipment::create([
                'equipments_code' => $equipment->equipments_code,
                'image_path' => $filename,
            ]);
        }



        Alert::success('Save success!!!', 'เรียบร้อย');
        return redirect()->route('equipment.homepage');
    }


    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
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
        // dd($dataforedit);
        $dataeditresponsible = DB::table('responsible as r')
            ->join('users as u', 'r.user_id', '=', 'u.id')->select(
                'r.*',
                'u.id',
                'u.prefix',
                'u.name',
                'u.last_name'
            )->get();

        // dd($imagePath = $dataforedit->imagesequipments->first()->image_path);
        if ($dataforedit && $dataforedit->imagesequipments->isNotEmpty()) {
            // ถ้ามีข้อมูล ให้ดึง path ของรูปภาพ
            $imagePath = $dataforedit->imagesequipments->first()->image_path;
        } else {
            // ถ้าไม่มีข้อมูล ตั้งค่าตัวแปรเป็น null หรือค่าเริ่มต้นที่คุณต้องการ
            $imagePath = null;
        }

        return view('equipment_registration.epuipment-edit', compact('dataforedit', 'dataTypeequipment', 'datalocation', 'data_use', 'imagePath', 'dataeditresponsible'));
    }

    /**
     * Update the specified resource in storage.
     */
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






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Equipments::findOrFail($id)->delete();


        Alert::success('คุณได้ยืนยันลบแล้ว!!!', 'เรียบร้อย');
        return redirect()->route('equipment.homepage');
    }

    public function homepage()
    {
        $user = Auth::user();
        $userrole = $user->role;
        $userId = $user->id;

        if ($userrole == 'admin') {

            $dataequipment = DB::table('equipments as e')
                ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
                ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
                ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
                ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')

                ->select(
                    'e.*',
                    'toe.*',
                    'ie.*',
                    'l.*',
                    'r.*',

                    'e.equipments_code'
                )
                ->get();
        } else {

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

                )
                ->get();
        }

        // dd($dataequipment);
        return view('equipment_registration.epuipment-homepage', compact('dataequipment'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $dataequipment = Equipments::when($query, function ($queryBuilder, $query) {
            $queryBuilder->where('asset_number', 'like', "%{$query}%")
                ->orWhere('item_description_name', 'like', "%{$query}%")
                ->orWhere('status', 'like', "%{$query}%")
                ->orWhere('additional', 'like', "%{$query}%")
                ->orWhere('serial_number', 'like', "%{$query}%")
                ->orWhere('budget', 'like', "%{$query}%")
                ->orWhere('acquisition_method', 'like', "%{$query}%");
        })->get();

        return view('equipment_registration.epuipment-homepage', compact('dataequipment'));
    }
}
