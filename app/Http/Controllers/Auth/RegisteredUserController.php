<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
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

        Alert::success('สมัครสำเร็จ!!!', 'ระบบจะล็อกให้อัตโนมัติหลังสมัคร');
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
