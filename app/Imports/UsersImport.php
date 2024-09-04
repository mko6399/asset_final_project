<?php

namespace App\Imports;

use App\Models\Agency;
use App\Models\Equipments;
use App\Models\Images_equipment;
use App\Models\Location;
use App\Models\Location_use;
use App\Models\Responsible;

use App\Models\Type_of_equipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
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


        $equipment = Equipments::create([
            'equipments_code' => $row['equipments_code'],
            'status' => $status,
            'asset_number' => $row['asset_number'] ?? null,
            'date_acquired' => $formattedDate,
            'item_description_name' => $row['item_description_name'] ?? null,
            'vendor' => $row['vendor'] ?? null,
            'acquisition_method' => $row['acquisition_method'] ?? null,
            'price' => $row['price'] ?? 0,
            'amount' => $row['amount'] ?? 0,
            'additional' => $row['additional'] ?? null,
            'reference_number' => $row['reference_number'] ?? null,
            'budget' => $row['budget'] ?? null,
            'serial_number' => $row['serial_number'] ?? null,
        ]);


        Images_equipment::create([
            'image_path' => $row['image_path'] ?? null,
            'description' => $row['description'] ?? null,
            'equipments_code' => $equipment->equipments_code,
        ]);


        $location = Location::create([

            'location_site_name' => $row['location_site_name'] ?? null,
        ]);


        Location_use::create([
            'location_use_name' => $row['location_use_name'] ?? null,
            'location_site_code' => $location->location_site_code,
        ]);
        Type_of_equipment::create([
            'name_type_of_equipment' => $row['name_type_of_equipment'] ?? null,
            'equipments_code' => $equipment->equipments_code,
        ]);
        Agency::create([
            'name_agency' => $row['name_agency'],

        ]);

        return $equipment;
    }
    public function headingRow(): int
    {
        return 2;
    }
}
