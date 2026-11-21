<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Daftar email khusus Pemilik / Admin yang diizinkan masuk ke Dashboard Operasional.
     */
    private const OWNER_EMAILS = [
        'rinaldi@gmail.com',
        'rinaldi@typcare.com',
        'admin@typcare.com',
        'owner@typcare.com',
    ];

    /**
     * Domain khusus backoffice Pemilik / Admin.
     */
    private const OWNER_DOMAINS = [
        '@typcare.com',
        '@admin.typcare.com',
        '@typcare.id',
    ];

    /**
     * Cek apakah email merupakan email khusus Pemilik / Admin.
     */
    public static function isOwnerEmail(string $email): bool
    {
        $normalized = Str::lower(trim($email));

        if (in_array($normalized, self::OWNER_EMAILS, true)) {
            return true;
        }

        foreach (self::OWNER_DOMAINS as $domain) {
            if (Str::endsWith($normalized, $domain)) {
                return true;
            }
        }

        return false;
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
     * Proses autentikasi login:
     * - Jika lolos validasi email khusus Pemilik/Admin -> langsung arahkan ke Dashboard Admin.
     * - Jika email Pengguna Umum -> tidak masuk ke Dashboard Admin.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:4'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 4 karakter.',
        ]);

        $email = Str::lower(trim($validated['email']));

        // Validasi email khusus Pemilik / Admin -> Langsung arahkan ke Dashboard Admin
        if (self::isOwnerEmail($email)) {
            $request->session()->put('auth_user', [
                'name' => 'Rinaldi Mulya Putra',
                'email' => $email,
                'role' => 'admin',
                'role_label' => 'Admin · TYP Herbal Drink',
            ]);
            $request->session()->save();

            return redirect()->to('/admin/dashboard');
        }

        // Jika bukan email khusus Pemilik/Admin, simpan sebagai Pengguna Umum
        $generalName = Str::headline(Str::before($email, '@'));
        $request->session()->put('auth_user', [
            'name' => $generalName,
            'email' => $email,
            'role' => 'user',
            'role_label' => 'Pengguna Umum',
        ]);
        $request->session()->save();

        return redirect()->route('beranda');
    }

    /**
     * Proses pendaftaran akun baru (Pengguna Umum) dengan proteksi agar tidak memakai email Pemilik/Admin.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (self::isOwnerEmail((string) $value)) {
                        $fail('Email ini adalah email khusus Pemilik/Admin dan tidak dapat didaftarkan oleh Pengguna Umum.');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 4 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $email = Str::lower(trim($validated['email']));

        $request->session()->put('auth_user', [
            'name' => trim($validated['name']),
            'email' => $email,
            'role' => 'user',
            'role_label' => 'Pengguna Umum',
        ]);
        $request->session()->save();

        return redirect()->route('beranda');
    }

    /**
     * Tampilkan Dashboard Admin.
     * Menolak akses jika sesi aktif adalah Pengguna Umum.
     */
    public function dashboard(Request $request)
    {
        $user = $request->session()->get('auth_user');

        // Jika yang sedang login adalah Pengguna Umum, tolak akses ke Dashboard Admin
        if ($user && (($user['role'] ?? '') === 'user' || ! self::isOwnerEmail($user['email'] ?? ''))) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akses ditolak! Email (' . ($user['email'] ?? '-') . ') adalah akun Pengguna Umum. Gunakan email khusus Pemilik/Admin untuk masuk ke Dashboard Admin.',
                ]);
        }

        return view('admin.dashboard', [
            'authUser' => $user ?? [
                'name' => 'Rinaldi Mulya Putra',
                'email' => 'rinaldi@gmail.com',
                'role' => 'admin',
                'role_label' => 'Admin · TYP Herbal Drink',
            ],
        ]);
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
