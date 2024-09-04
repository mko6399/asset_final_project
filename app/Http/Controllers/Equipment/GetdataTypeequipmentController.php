<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetdataTypeequipmentController extends Controller
{


    public function index()
    {

        // $dataTypeequipment = DB::table('type_of_equipment')->select('type_of_equipment_id', 'name_type_of_equipment')->get();

        // return view('equipment_registration.equipment-form', compact('dataTypeequipment'));
    }
}
