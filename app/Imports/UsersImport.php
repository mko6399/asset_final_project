<?php

namespace App\Imports;

use App\Models\Agency;
use App\Models\Equipments;
use App\Models\Images_equipment;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Mockery\Undefined;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // dd($row);
        $user = Auth::user();
        $userId = $user->id;
        $userEmail = $user->email;
        $username = $user->name;


        if (isset($row['status1']) && $row['status1'] === 'X') {
            $status = '1';
        } elseif (isset($row['status2']) && $row['status2'] === 'X') {
            $status = '2';
        } elseif (isset($row['status3']) && $row['status3'] === 'X') {
            $status = '3';
        } elseif (isset($row['status4']) && $row['status4'] === 'X') {
            $status = '4';
        } else {
            $status = '5';
        }

        $originalDate = $row['date_acquired'] ?? null;
        $date = \DateTime::createFromFormat('d-m-Y', $originalDate);
        $formattedDate = $date ? $date->format('Y-m-d') : null;
        $existingEquipment = Equipments::where('asset_number', $row['asset_number'])->first();

        if ($existingEquipment) {
            Alert::error('มีข้อมูลที่ซ้ำกัน!!!', 'โปรดตรวจสอบว่าในระบบคุณมีข้อมูลนี้อยู่แล้ว');
            return null;
        }
        if (empty($row['location_site_code']) || empty($row['type_of_equipment_id'])) {
            Alert::error('ใน Excel !!!', 'คุณยังไม่ใส่ระบุเลขสถานที่(location_site_code) หรือ ประเภทครุภัณฑ์(type_of_equipment_id) โปรดระบุ และตรวจให้เรียบร้อยก่อนนำเข้า');
            return null;
        }


        $equipment = Equipments::create([

            'status' => $status,
            'asset_number' => $row['asset_number'] ?? null,
            'date_acquired' => $formattedDate,
            'item_description_name' => $row['item_description_name'] ?? null,
            'vendor' => $row['vendor'] ?? null,
            'acquisition_method' => $row['acquisition_method'] ?? null,
            'price' => $row['price'] ?? 0,
            'amount' => 1,
            'additional' => $row['additional'] ?? null,
            'reference_number' => $row['reference_number'] ?? null,
            'budget' => $row['budget'] ?? null,
            'serial_number' => $row['serial_number'] ?? null,
            'location_use_name' => $row['location_use_name'] ?? null,
            'location_site_code' =>  $row['location_site_code'],
            'type_of_equipment_id' => $row['type_of_equipment_id'] ?? null,
        ]);


        Images_equipment::create([
            'image_path' => $row['image_path'] ?? null,
            'description' => $row['description'] ?? null,
            'equipments_code' => $equipment->equipments_code,
        ]);





        Agency::create([
            'name_agency' => $row['name_agency'],

        ]);

        Alert::success('นำเข้าข้อมูลสำเร็จ', 'บันทึกข้อมูลเรียบร้อย');
        return $equipment;
    }
    public function headingRow(): int
    {
        return 2;
    }
}
