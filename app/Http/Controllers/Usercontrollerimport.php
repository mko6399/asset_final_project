<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;

class Usercontrollerimport extends Controller
{

    public function create(): View
    {
        return view('equipment_registration.equipment-import');
    }


    public function import(Request $request)
    {


        $data = Excel::import(new UsersImport, $request->file('file'));

        return redirect()->route('equipment.homepage')->with('success', 'Users imported successfully.');
    }
}
