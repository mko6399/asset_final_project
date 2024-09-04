<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse

    {
        $request->authenticate();

        $request->session()->regenerate();
        Alert::success('เข้าสู่ระบบสำเร็จ!!!', 'ยินดีต้อนสู่ระบบตรวจสอบและติดตามสถานะครุภัณฑ์');
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        Alert::success('ออกจากระบบแล้ว!!!', 'คุณได้ออกจากระบบแล้ว');
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
