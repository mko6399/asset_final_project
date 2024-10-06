<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use App\Models\Type_of_equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    // public function index()
    // {
    //     $statusCounts = Equipments::select('status', DB::raw('COUNT(status) as status_count'))
    //         ->groupBy('status')->get();

    //     // สร้าง array ที่มีค่าเป็น 0 ล่วงหน้า
    //     $statusData = [
    //         '1' => 0, // ใช้ได้
    //         '2' => 0, // ชำรุด
    //         '3' => 0, // เสื่อมคุณภาพ
    //         '4' => 0, // ไม่ใช้
    //         '5' => 0  // สูญหาย
    //     ];

    //     // นำข้อมูลที่ได้จากฐานข้อมูลไปใส่ใน array
    //     foreach ($statusCounts as $count) {
    //         $statusData[$count->status] = $count->status_count;
    //     }


    //     $labels = array_keys($statusData); // ดึงสถานะเป็น labels
    //     $data = array_values($statusData); // ดึงจำนวนของแต่ละสถานะ

    //     $equipmentdate = Equipments::select()->get();
    //     $dataTypeequipment = Type_of_equipment::select()->get();

    //     // ดึงวันที่สร้างแรกสุด
    //     $datadate = $equipmentdate->pluck('created_at')->first();
    //     if ($datadate) {
    //         $datadate = \Carbon\Carbon::parse($datadate)->addYears(543)->year; // Convert to Carbon instance
    //     } else {
    //         $datadate = \Carbon\Carbon::now(); // Fallback to current date if no date found
    //     }

    //     return view('equipment_registration.equipment-dashboard', compact('labels', 'data', 'dataTypeequipment', 'datadate'));
    // }

    public function index()
    {
        // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
        $user = Auth::user();

        // ตรวจสอบสถานะของผู้ใช้
        if ($user->role === 'officer') {
            // ถ้าเป็น officer ให้ดึงข้อมูลเฉพาะที่เกี่ยวข้อง
            $statusCounts = Equipments::whereHas('responsible', function ($query) use ($user) {
                $query->where('user_id', $user->id); // กรองข้อมูลจาก user ที่ล็อกอิน
            })->select('status', DB::raw('COUNT(status) as status_count'))
                ->groupBy('status')
                ->get();
        } else {
            // ถ้าไม่ใช่ officer ให้ดึงข้อมูลทั้งหมด
            $statusCounts = Equipments::select('status', DB::raw('COUNT(status) as status_count'))
                ->groupBy('status')->get();
        }

        // สร้าง array ที่มีค่าเป็น 0 ล่วงหน้า
        $statusData = [
            '1' => 0, // ใช้ได้
            '2' => 0, // ชำรุด
            '3' => 0, // เสื่อมคุณภาพ
            '4' => 0, // ไม่ใช้
            '5' => 0  // สูญหาย
        ];

        // นำข้อมูลที่ได้จากฐานข้อมูลไปใส่ใน array
        foreach ($statusCounts as $count) {
            $statusData[$count->status] = $count->status_count;
        }

        // คำนวณจำนวนรวมของสถานะทั้งหมด
        $totalCount = array_sum($statusData);

        // คำนวณเปอร์เซ็นต์สำหรับแต่ละสถานะ
        $percentageData = [];
        foreach ($statusData as $status => $count) {
            $percentageData[$status] = $totalCount > 0 ? ($count / $totalCount) * 100 : 0; // คำนวณเปอร์เซ็นต์
        }

        $labels = array_keys($percentageData); // ดึงสถานะเป็น labels
        $data = array_values($percentageData); // ดึงเปอร์เซ็นต์ของแต่ละสถานะ
        $datalesttest = array_values($statusData);

        $equipmentdate = Equipments::select()->get();
        $dataTypeequipment = Type_of_equipment::select()->get();

        // ดึงวันที่สร้างแรกสุด
        $datadate = $equipmentdate->pluck('created_at')->first();
        if ($datadate) {
            $datadate = \Carbon\Carbon::parse($datadate)->addYears(543)->year; // Convert to Carbon instance
        } else {
            $datadate = \Carbon\Carbon::now(); // Fallback to current date if no date found
        }

        return view('equipment_registration.equipment-dashboard', compact('labels', 'data', 'dataTypeequipment', 'datadate', 'datalesttest'));
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
    // public function updateChart(Request $request)
    // {
    //     $typeOfEquipmentId = $request->query('type_of_equipment_id');

    //     // สร้าง array ที่มีค่าเป็น 0 ล่วงหน้า
    //     $statusData = [
    //         '1' => 0, // ใช้ได้
    //         '2' => 0, // ชำรุด
    //         '3' => 0, // เสื่อมคุณภาพ
    //         '4' => 0, // ไม่ใช้
    //         '5' => 0  // สูญหาย
    //     ];

    //     if ($typeOfEquipmentId) {
    //         // หากมีการเลือกประเภท
    //         $statusCounts = Equipments::where('type_of_equipment_id', $typeOfEquipmentId)
    //             ->select('status', DB::raw('COUNT(status) as status_count'))
    //             ->groupBy('status')
    //             ->get();
    //     } else {
    //         // หากไม่มีการเลือกประเภท (แสดงทั้งหมด)
    //         $statusCounts = Equipments::select('status', DB::raw('COUNT(status) as status_count'))
    //             ->groupBy('status')
    //             ->get();
    //     }

    //     // นำข้อมูลที่ได้จากฐานข้อมูลไปใส่ใน array
    //     foreach ($statusCounts as $count) {
    //         $statusData[$count->status] = $count->status_count;
    //     }

    //     // ดึงสถานะเป็น labels และจำนวนเป็น data
    //     $labels = array_keys($statusData);
    //     $data = array_values($statusData);

    //     return response()->json(['labels' => $labels, 'data' => $data]);
    // }

    public function updateChart(Request $request)
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
        $typeOfEquipmentId = $request->query('type_of_equipment_id'); // ดึง type_of_equipment_id จาก request

        // สร้าง array ที่มีค่าเป็น 0 ล่วงหน้า
        $statusData = [
            '1' => 0, // ใช้ได้
            '2' => 0, // ชำรุด
            '3' => 0, // เสื่อมคุณภาพ
            '4' => 0, // ไม่ใช้
            '5' => 0  // สูญหาย
        ];

        // สร้าง query เริ่มต้น
        $query = Equipments::query();

        if ($user->role === 'officer') {
            // ถ้าเป็น officer ให้ดึงข้อมูลเฉพาะที่เกี่ยวข้องกับผู้ใช้นั้น
            $query->whereHas('responsible', function ($query) use ($user) {
                $query->where('user_id', $user->id); // กรองข้อมูลจาก user ที่ล็อกอิน
            });
        }

        // เช็คประเภทอุปกรณ์
        if ($typeOfEquipmentId) {
            $query->where('type_of_equipment_id', $typeOfEquipmentId); // เพิ่มเงื่อนไขกรองประเภทอุปกรณ์
        }

        // ดึงข้อมูลสถานะพร้อมกับการนับจำนวน
        $statusCounts = $query->select('status', DB::raw('COUNT(status) as status_count'))
            ->groupBy('status')
            ->get();

        // นำข้อมูลที่ได้จากฐานข้อมูลไปใส่ใน array
        foreach ($statusCounts as $count) {
            $statusData[$count->status] = $count->status_count; // อัปเดตค่าตามที่ดึงมาจากฐานข้อมูล
        }

        // คำนวณจำนวนรวมของสถานะทั้งหมด
        $totalCount = array_sum($statusData);

        // คำนวณเปอร์เซ็นต์สำหรับแต่ละสถานะ
        $percentageData = [];
        foreach ($statusData as $status => $count) {
            $percentageData[$status] = $totalCount > 0 ? ($count / $totalCount) * 100 : 0; // คำนวณเปอร์เซ็นต์
        }

        // ดึงสถานะเป็น labels และจำนวนเป็น data
        $labels = array_keys($percentageData);
        $data = array_values($percentageData);
        $datalesttest = array_values($statusData);

        // ส่งข้อมูลกลับไปให้ client เป็น JSON
        return response()->json(['labels' => $labels, 'data' => $data, 'datalesttest' => $datalesttest]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
