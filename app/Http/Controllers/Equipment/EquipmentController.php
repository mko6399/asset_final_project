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
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {


        $dataTypeequipment = DB::table('type_of_equipment')->select('type_of_equipment_id', 'name_type_of_equipment')->get();
        $datalocation = DB::table('location')->select('location_site_code', 'location_site_name')->get();

        return view('admin.equipment-form', compact('dataTypeequipment', 'datalocation'));
    }

    /**
     * Show the form for creating a new resource.
     */



    public function store(Request $request)
    {
        $assetNumber = $request->input('asset_number');

        // if (empty($assetNumber) || strlen($assetNumber) !== 28) {
        //     // สร้าง asset_number ใหม่ที่มีความยาว 28 ตัวอักษร
        //     $assetNumber = strtoupper(bin2hex(random_bytes(14))); // ใช้ 14 bytes เพื่อให้ได้ 28 ตัวอักษร (hex)
        // }
        $request->validate([
            'status' => 'required',
            'type_of_equipment_id' => 'required',
            'location_site_code' => 'required',
            'location_use_name' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional: Validate the image
            'asset_number' => 'nullable|string|max:31',
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
        return redirect()->route('equipment.adminhomepage');
    }



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


        $responsibleIds = $dataforedit->responsible->user_id ?? '';




        $dataeditresponsible = User::select('id', 'prefix', 'name', 'last_name')
            ->where('id', $responsibleIds)
            ->get(); // จะคืนค่าเป็น object ของ User หรือ null ถ้าไม่พบ








        // dd($imagePath = $dataforedit->imagesequipments->first()->image_path);

        $imagePath = $dataforedit->imagesequipments->isNotEmpty() ? $dataforedit->imagesequipments->first()->image_path : null;

        return view('admin.equipment_editform', compact('dataforedit', 'dataTypeequipment', 'datalocation', 'data_use', 'imagePath', 'dataeditresponsible',  'responsibleIds'));
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
        return redirect()->route('equipment.adminhomepage');
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Equipments::findOrFail($id)->delete();


        Alert::success('คุณได้ยืนยันลบแล้ว!!!', 'เรียบร้อย');
        return redirect()->route('equipment.adminhomepage');
    }

    public function homepage()
    {

        $dataequipment = DB::table('equipments as e')
            ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
            ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
            ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
            ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')
            ->leftJoin('users as u', 'r.user_id', '=', 'u.id')
            ->select(
                'e.*',
                'toe.*',
                'ie.*',
                'l.*',
                'r.*',
                'u.prefix',
                'u.name',
                'u.last_name', // เพิ่ม 'u.' ก่อน 'last_name'
                'e.equipments_code'
            )
            ->orderBy('e.date_acquired', 'desc') // เรียงข้อมูลตาม updated_at จากล่าสุดไปเก่าสุด
            ->get();


        return view('equipment_registration.epuipment-homepage', compact('dataequipment'));
    }



    public function search(Request $request)
    {
        $query = $request->input('search');
        $statusMap = [
            'ใช้งานได้' => 1,
            'ชำรุด' => 2,
            'เสื่อมคุณภาพ' => 3,
            'ไม่ใช้' => 4,
            'สูญหาย' => 5,
        ];



        $statusQuery = $statusMap[$query] ?? null;
        $dataequipment = Equipments::with('imagesequipments')->when($query, function ($queryBuilder, $query) use ($statusQuery) {
            $queryBuilder->where('asset_number', 'like', "%{$query}%")
                ->orWhere('item_description_name', 'like', "%{$query}%")
                ->orWhere('status', 'like', "%{$query}%")
                ->orWhere('additional', 'like', "%{$query}%")
                ->orWhere('serial_number', 'like', "%{$query}%")
                ->orWhere('budget', 'like', "%{$query}%")
                ->orWhere('acquisition_method', 'like', "%{$query}%");
            if ($statusQuery !== null) {
                $queryBuilder->orWhere('status', $statusQuery);
            }
        })->get();


        return view('equipment_registration.epuipment-homepage', compact('dataequipment'));
    }
}
