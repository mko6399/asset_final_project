<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Equipments;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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
    public function generatePDF()
    {
        $data = [
            'title' => 'ทดสอบการใช้ฟอนต์ THSarabunNewใน PDF',
            'content' => 'นี่คือเนื้อหาใน PDF ที่ใช้ฟอนต์ THSarabunNew'
        ];

        $pdf = Pdf::loadView('equipment_registration.equipmentgeneratpdf', $data);

        // ล้าง Cache ของ Dompdf


        return $pdf->download('dataequipmentstatus.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function GeneratePDFEquipmentAll()
    {
        $data = [
            'title' => 'ทดสอบการใช้ฟอนต์ THSarabunNewใน PDF',
            'content' => 'นี่คือเนื้อหาใน PDF ที่ใช้ฟอนต์ THSarabunNew'
        ];

        $pdf = Pdf::loadView('equipment_registration.equipmentgeneratpdfall', $data)->setPaper('a4', 'portrait');;

        // ล้าง Cache ของ Dompdf


        return $pdf->download('GeneratePDFEquipmentAll.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function GeneratePDFEquipmentone()
    {
        $data = [
            'title' => 'ทดสอบการใช้ฟอนต์ THSarabunNewใน PDF',
            'content' => 'นี่คือเนื้อหาใน PDF ที่ใช้ฟอนต์ THSarabunNew'
        ];

        $pdf = Pdf::loadView('equipment_registration.equipmentgeneratpdfequipmentone.blade', $data);

        // ล้าง Cache ของ Dompdf


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
}
