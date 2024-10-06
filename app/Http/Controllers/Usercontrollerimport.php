<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class Usercontrollerimport extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    public function create(): View
    {
        return view('equipment_registration.equipment-import');
    }


    public function import(Request $request)
    {

        if (!$request->hasFile('file')) {
            return redirect()->back()->withErrors(['file' => 'กรุณาเลือกไฟล์เพื่อทำการนำเข้า']);
        }


        try {
            // นำเข้าข้อมูลจากไฟล์ Excel
            Excel::import(new UsersImport, $request->file('file'));

            // ถ้านำเข้าข้อมูลสำเร็จ
            return redirect()->route('equipment.adminhomepage')->with('success', 'Users imported successfully.');
        } catch (\Exception $e) {
            // ถ้ามีข้อผิดพลาดในการนำเข้า
            return redirect()->back()->withErrors(['file' => 'เกิดข้อผิดพลาดในการนำเข้าข้อมูล: ' . $e->getMessage()]);
        }
    }
}
