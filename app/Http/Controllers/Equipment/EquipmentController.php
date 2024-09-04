<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Equipments;
use App\Models\Images_equipment;
use App\Models\Location;
use App\Models\Location_use;
use App\Models\Responsible;
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


        $request->validate([
            'status' => 'required',
            'type_of_equipment_id' => 'required',
            'location_site_code' => 'required',

            'location_use_name' => 'string|max:255',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional: Validate the image
            'asset_number' => 'required|numeric',
            'date_acquired' => 'required|date',
            'item_description_name' => 'required|string|max:255',
            'vendor' => 'required|string|max:255',
            'acquisition_method' => 'required|string|max:255',
            'price' => 'required|numeric',

            'reference_number' => 'string|max:255',
            'budget' => 'required|string|max:255',
            'serial_number' => 'string|max:255',
        ]);

        if ($request->hasFile('image_path')) {

            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = 'uploads/equipments';
            $file->move($path, $filename);
        }
        $location_use_code = null;
        if ($request->has('location_use_name')) {
            $locationUse = Location_use::create([
                'location_use_name' => $request->input('location_use_name'),
            ]);
            $location_use_code = $locationUse->location_use_code; // Get the generated ID
        }

        $equipment = Equipments::create([
            'status' => $request->input('status'),
            'type_of_equipment_id' => $request->input('type_of_equipment_id'),
            'location_site_code' => $request->input('location_site_code'),
            'asset_number' => $request->input('asset_number'),
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
            'location_use_code' => $location_use_code,
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
            'location_use',
            'responsible'
        ])->findOrFail($equipments_code);
        // dd($dataforedit, $data_use);

        return view('equipment_registration.epuipment-edit', compact('dataforedit', 'dataTypeequipment', 'datalocation', 'data_use'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $dataformrequest = $request->validate([
            'equipments_code' => 'require|integer',
            'status' => 'required',
            'type_of_equipment_id' => 'required',
            'location_site_code' => 'required',
            'location_use_name' => 'string|max:255',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional: Validate the image
            'asset_number' => 'numeric',
            'date_acquired' => 'required|date',
            'item_description_name' => 'required|string|max:500',
            'vendor' => 'string|max:255',
            'acquisition_method' => 'required|string|max:255',
            'price' => 'numeric',
            'reference_number' => 'string|max:255',
            'budget' => 'required|string|max:255',
            'serial_number' => 'string|max:255',
            'user_id' => 'required|numeric',
        ]);
        dd($dataformrequest);
        $equipment = Equipments::find($id);
        $dataupdatelocation_use = Location_use::find($equipment->location_use_code);
        $dataupdatelocation = Location::find($equipment->location_site_code);
        // dd($equipment, $dataupdatelocation_use, $dataupdatelocation);

        Responsible::updateOrCreate([

            'user_id' => $request->input('user_id'),
            'equipments_code' => $equipment->equipments_code,
        ]);



        Alert::success('แก้ไขเรียบร้อย!!!', 'แก้ไขลงในระบบเรียบร้อยแล้วเรียบร้อย');
        return view('equipment_registration.epuipment-homepage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
    }

    public function homepage()
    {
        $user = Auth::user();
        $userrole = $user->role;
        $userId = $user->id;

        if ($userrole == 'admin') {
            // Original query for admin
            $dataequipment = DB::table('equipments as e')
                ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
                ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
                ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
                ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')
                ->leftJoin('location_use as lu', 'e.location_use_code', '=', 'lu.location_use_code')
                ->select(
                    'e.*',
                    'toe.*',
                    'ie.*',
                    'l.*',
                    'r.*',
                    'lu.location_use_name',
                    'lu.location_use_code',
                    'e.equipments_code'
                )
                ->get();
        } else {

            $dataequipment = DB::table('equipments as e')
                ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
                ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
                ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
                ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')
                ->leftJoin('location_use as lu', 'e.location_use_code', '=', 'lu.location_use_code')
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
                    'lu.location_use_name',
                    'lu.location_use_code'
                )
                ->get();
        }

        return view('equipment_registration.epuipment-homepage', compact('dataequipment'));
    }
}
