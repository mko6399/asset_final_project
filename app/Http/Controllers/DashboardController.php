<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use App\Models\Type_of_equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $statusCounts = Equipments::select('status', DB::raw('COUNT(status) as status_count'))
            ->groupBy('status')->get();

        $dataTypeequipment = Type_of_equipment::select()->get();
        $labels = $statusCounts->pluck('status'); // ดึง status เป็น labels
        $data = $statusCounts->pluck('status_count');
        // dd($data[1]);

        return view('equipment_registration.equipment-dashboard', compact('labels', 'data', 'dataTypeequipment'));
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
    public function updateChart(Request $request)
    {
        $typeOfEquipmentId = $request->query('type_of_equipment_id');


        if ($typeOfEquipmentId) {
            // หากมีการเลือกประเภท
            $statusCounts = Equipments::where('type_of_equipment_id', $typeOfEquipmentId)
                ->select('status', DB::raw('COUNT(status) as status_count'))
                ->groupBy('status')
                ->get();
        } else {
            // หากไม่มีการเลือกประเภท (แสดงทั้งหมด)
            $statusCounts = Equipments::select('status', DB::raw('COUNT(status) as status_count'))
                ->groupBy('status')
                ->get();
        }
        $labels = $statusCounts->pluck('status');
        $data = $statusCounts->pluck('status_count');

        return response()->json(['labels' => $labels, 'data' => $data]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
