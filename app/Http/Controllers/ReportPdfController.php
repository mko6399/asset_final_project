<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Equipments;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;

class ReportPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        return view('equipment_registration.equipment-reportmanage');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function generatePDF(string $id)
    {


        $dataequipment = DB::table('equipments as e')
            ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
            ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
            ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
            ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->where('e.equipments_code', $id)
            ->select(
                'e.*',
                'toe.*',
                'u.id',
                'u.prefix',
                'u.name',
                'u.last_name',
                'ie.*',
                'l.*',
                'r.*'
            )
            ->get();


        $pdf = Pdf::loadView('equipment_registration.equipmentgeneratpdf', ['dataequipment' => $dataequipment]);

        // ล้าง Cache ของ Dompdf


        return $pdf->download('dataequipmentstatus.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function GeneratePDFEquipmentAll()
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
                ->leftJoin('users as u', 'r.user_id', '=', 'u.id')
                ->select(
                    'toe.name_type_of_equipment',  // ประเภทอุปกรณ์
                    DB::raw('COUNT(e.equipments_code) as total_equipments'),  // นับจำนวนอุปกรณ์ทั้งหมด
                    DB::raw('SUM(CASE WHEN e.status = 1 THEN 1 ELSE 0 END) as status_1_count'),  // นับจำนวนสถานะ 1
                    DB::raw('SUM(CASE WHEN e.status = 2 THEN 1 ELSE 0 END) as status_2_count'),  // นับจำนวนสถานะ 2
                    DB::raw('SUM(CASE WHEN e.status = 3 THEN 1 ELSE 0 END) as status_3_count'),  // นับจำนวนสถานะ 3
                    DB::raw('SUM(CASE WHEN e.status = 4 THEN 1 ELSE 0 END) as status_4_count'),  // นับจำนวนสถานะ 4
                    DB::raw('SUM(CASE WHEN e.status = 5 THEN 1 ELSE 0 END) as status_5_count')   // นับจำนวนสถานะ 5
                )
                ->groupBy('toe.name_type_of_equipment')  // จัดกลุ่มตามประเภทอุปกรณ์
                ->get();

            $pdf = Pdf::loadView('equipment_registration.epquiment-adminreport', ['dataequipment' => $dataequipment])->setPaper('a4', 'portrait');
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
            $pdf = Pdf::loadView('equipment_registration.equipmentgeneratpdfall', ['dataequipment' => $dataequipment])->setPaper('a4', 'portrait');
        }
        // dd($dataequipment);



        // $pdf = Pdf::loadView('equipment_registration.eqtest', $data)->setPaper('a4', 'portrait');;

        // ล้าง Cache ของ Dompdf
        // $pdf = Pdf::loadView('equipment_registration.equipmentgeneratpdfall', $data)->setPaper('a4', 'portrait');;

        return $pdf->download('GeneratePDFEquipmentAll.pdf');
    }
    /**
     * Display the specified resource.
     */
    public function GeneratePDFEquipmentone(string $id)
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

            ->where('e.equipments_code', $id)
            ->select(
                'e.*',
                'toe.*',
                'u.id',
                'u.prefix',
                'u.name',
                'u.last_name',
                'ie.*',
                'l.*',
                'r.*'
            )
            ->get();


        $pdf = Pdf::loadView('equipment_registration.equipmentgeneratpdfequipmentone', ['dataequipment' => $dataequipment]);




        return $pdf->download('GeneratePDFEquipmentAll.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function reportpagseDamaged()
    {
        $user = Auth::user();
        $userrole = $user->role;
        $userId = $user->id;


        if ($userrole == 'admin') {

            $datadamaged = DB::table('equipments as e')
                ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
                ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
                ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
                ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')
                ->leftJoin('users as u', 'r.user_id', '=', 'u.id')
                ->leftJoin('agency as a', 'u.agency_id', '=', 'a.agency_id')
                ->select('e.*', 'toe.*', 'ie.*', 'l.*', 'r.*', 'u.prefix', 'u.name', 'u.last_name', 'e.equipments_code')
                ->where('e.status', 2)
                ->get();
        } else {
            $datadamaged = DB::table('equipments as e')
                ->leftJoin('type_of_equipment as toe', 'e.type_of_equipment_id', '=', 'toe.type_of_equipment_id')
                ->leftJoin('images_equipment as ie', 'e.equipments_code', '=', 'ie.equipments_code')
                ->leftJoin('location as l', 'e.location_site_code', '=', 'l.location_site_code')
                ->leftJoin('responsible as r', 'e.equipments_code', '=', 'r.equipments_code')
                ->leftJoin('users as u', 'r.user_id', '=', 'u.id')
                ->leftJoin('agency as a', 'u.agency_id', '=', 'a.agency_id')
                ->select('e.*', 'toe.*', 'ie.*', 'l.*', 'r.*', 'u.prefix', 'u.name', 'u.last_name', 'e.equipments_code', 'a.*')
                ->where('e.status', 2)->where('r.user_id', $userId)
                ->get();
        }


        // dd($datadamaged);

        return view('equipment_registration.equipment-damagedreport', compact('datadamaged'));
    }
}
