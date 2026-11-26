<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Cek apakah email merupakan email khusus Pemilik / Admin.
     */
    public static function isOwnerEmail(string $email): bool
    {
        return TypCareController::isAdminEmail($email);
    }

    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Tampilkan halaman register.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Route Login Google (Tidak dapat digunakan, hanya demo).
     */
    public function loginGoogle()
    {
        return redirect()->route('login')
            ->with('google_warning', 'tidak dapat di gunakan hanya demo');
    }

    /**
     * Delegasikan proses login ke TypCareController (SQLite Admin & Customer).
     */
    public function login(Request $request)
    {
        return app(TypCareController::class)->login($request);
    }

    /**
     * Delegasikan proses register ke TypCareController (SQLite Customer).
     */
    public function register(Request $request)
    {
        return app(TypCareController::class)->register($request);
    }

    /**
     * Delegasikan tampilan Dashboard Admin ke TypCareController.
     */
    public function dashboard(Request $request)
    {
        return app(TypCareController::class)->dashboard($request);
    }

    /**
     * Keluar dari sesi aktif.
     */
    public function logout(Request $request)
    {
        $request->session()->forget('auth_user');
        $request->session()->save();

        return redirect()->route('home');
    }
}
