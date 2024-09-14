<?php

namespace App\Http\Controllers\Equipment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EquipmentOneReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
                    'e.*',
                    'toe.*',
                    'ie.*',
                    'l.*',
                    'r.*',
                    'u.prefix',
                    'u.name',
                    'last_name',

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
        return view('equipment-report.show-all-reportone-equipment', compact('dataequipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
