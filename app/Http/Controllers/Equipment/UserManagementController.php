<?php


namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Responsible;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $datauserformanage = DB::table('users')
            ->select('id', 'prefix', 'name', 'last_name', 'position', 'email', 'role')
            ->where('role', 'officer')
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('prefix', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('position', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                }
            })
            ->get();
        return view('equipment_registration.equipment-showuser', compact('datauserformanage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('equipment_registration.equipment-managuser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {


        $validated =  $request->validate([
            'id' => ['nullable', 'string', 'max:20'],
            'prefix' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'position' => ['string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],


        ]);


        if (empty($validated['id'])) {

            $validated['id'] = mt_rand(100000000, 999999999);
        }
        $user = User::create([
            'id' => $validated['id'],
            'prefix' => $validated['prefix'],
            'name' => $validated['name'],
            'last_name' => $validated['last_name'],
            'position' => $validated['position'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'officer',
        ]);

        Alert::success('เพิ่มผู้รับผิดชอบแล้ว!!!', 'บันทึกลงในระบบอัตโนมัติหลังบันทึก');




        return redirect()->route('UserManagement.index');
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


        $databata = User::where('id', $id)->get();
        $user = $databata->first();


        return view('equipment_registration.equipment-edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data =   User::findOrFail($id);

        $data->update($request->all());


        Alert::success('แก้ไขข้อมูลเรียบร้อย!!!', 'แก้ไขลงในระบบเรียบร้อยแล้วเรียบร้อย');
        return redirect()->route('UserManagement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ตรวจสอบข้อมูลของผู้รับผิดชอบ
        $datacheck = Responsible::where('user_id', $id)->first();

        // ตรวจสอบว่า $datacheck มีข้อมูลอยู่หรือไม่
        if ($datacheck !== null && $datacheck->user_id != null && $datacheck->equipments_code != null) {
            // หากมีข้อมูล ให้แสดงข้อความแจ้งเตือน
            Alert::error('กรุณาย้ายผู้รับผิดชอบ!!!', 'ก่อนที่จะลบ');
            return redirect()->route('equipment.homepage');
        } else {
            // หากไม่มีข้อมูล ให้ทำการลบผู้ใช้งาน
            User::findOrFail($id)->delete(); // ทำการลบผู้ใช้งาน
            Alert::success('ลบในระบบเรียบร้อย!!!'); // เปลี่ยนเป็น Alert::success เนื่องจากการลบสำเร็จ
            return redirect()->route('UserManagement.index');
        }
    }
    public function addagency(Request $request)
    {

        $validated =  $request->validate([
            'id' => ['nullable', 'string', 'max:20'],
            'prefix' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'position' => ['string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],


        ]);


        if (empty($validated['id'])) {

            $validated['id'] = mt_rand(100000000, 999999999);
        }
        $user = User::create([
            'id' => $validated['id'],
            'prefix' => $validated['prefix'],
            'name' => $validated['name'],
            'last_name' => $validated['last_name'],
            'position' => $validated['position'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'officer',
        ]);

        Alert::success('เพิ่มข้อมูลหน่วยงานแล้ว!!!', 'บันทึกลงในระบบอัตโนมัติหลังบันทึก');
    }
}
