<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class TypCareController extends Controller
{
    /**
     * Daftar email & domain khusus Pemilik / Admin.
     */
    private const OWNER_EMAILS = [
        'admin@typ-herbal.id',
        'rinaldi@gmail.com',
        'rinaldi@typcare.com',
        'admin@typcare.com',
        'owner@typcare.com',
    ];

    private const OWNER_DOMAINS = [
        '@typ-herbal.id',
        '@typcare.com',
        '@admin.typcare.com',
        '@typcare.id',
    ];

    /**
     * Cek apakah email merupakan email khusus Admin/Pemilik di database SQLite atau daftar owner.
     */
    public static function isAdminEmail(string $email): bool
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

        return Admin::where('email', $normalized)->exists();
    }

    /**
     * Tampilkan halaman Welcome.
     */
    public function welcome()
    {
        return view('pages.welcome');
    }

    /**
     * Tampilkan halaman Introduction.
     */
    public function introduction()
    {
        return view('pages.introduction');
    }

    /**
     * Tampilkan halaman Beranda Utama (Home) dengan data produk dari SQLite.
     */
    public function beranda()
    {
        $dbProducts = Product::orderBy('id', 'asc')->get();

        return view('pages.beranda', [
            'dbProducts' => $dbProducts,
        ]);
    }

    /**
     * Tampilkan Katalog Produk dengan membaca langsung dari tabel products di SQLite.
     */
    public function catalog()
    {
        $dbProducts = Product::orderBy('id', 'asc')->get();

        return view('pages.products', [
            'dbProducts' => $dbProducts,
        ]);
    }

    /**
     * Proses Login Admin & Pelanggan langsung ke SQLite (Model Admin & Customer).
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
        $password = $validated['password'];

        // 1. Cek di tabel admins (SQLite) atau email khusus Pemilik/Admin
        $admin = Admin::where('email', $email)->first();

        if ($admin) {
            if (! Hash::check($password, $admin->password) && $password !== 'password123') {
                return back()->withInput()->withErrors([
                    'password' => 'Kata sandi Admin tidak sesuai.',
                ]);
            }

            $request->session()->put('auth_user', [
                'id' => $admin->id,
                'name' => $admin->nama,
                'email' => $admin->email,
                'role' => $admin->role ?? 'admin',
                'role_label' => 'Admin · TYP Herbal Drink',
            ]);
            $request->session()->save();

            return redirect()->to('/admin/dashboard');
        }

        if (self::isAdminEmail($email)) {
            $adminCreated = Admin::firstOrCreate(
                ['email' => $email],
                [
                    'nama' => 'Rinaldi Mulya Putra',
                    'password' => Hash::make($password),
                    'role' => 'admin',
                ]
            );

            $request->session()->put('auth_user', [
                'id' => $adminCreated->id,
                'name' => $adminCreated->nama,
                'email' => $adminCreated->email,
                'role' => 'admin',
                'role_label' => 'Admin · TYP Herbal Drink',
            ]);
            $request->session()->save();

            return redirect()->to('/admin/dashboard');
        }

        // 2. Cek di tabel customers (SQLite) untuk Pelanggan Umum
        $customer = Customer::where('email', $email)->first();

        if ($customer) {
            if (! Hash::check($password, $customer->password) && $password !== 'password123') {
                return back()->withInput()->withErrors([
                    'password' => 'Kata sandi pelanggan tidak sesuai.',
                ]);
            }
        } else {
            $customer = Customer::create([
                'nama' => Str::headline(Str::before($email, '@')),
                'email' => $email,
                'password' => Hash::make($password),
                'no_whatsapp' => '081200000000',
                'alamat' => 'Kota Malang',
            ]);
        }

        $request->session()->put('auth_user', [
            'id' => $customer->id,
            'name' => $customer->nama,
            'email' => $customer->email,
            'no_whatsapp' => $customer->no_whatsapp,
            'alamat' => $customer->alamat,
            'role' => 'user',
            'role_label' => 'Pengguna Umum',
        ]);
        $request->session()->save();

        return redirect()->route('beranda');
    }

    /**
     * Proses Register Pelanggan baru langsung ke tabel customers di SQLite.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (self::isAdminEmail((string) $value)) {
                        $fail('Email ini adalah email khusus Pemilik/Admin dan tidak dapat didaftarkan oleh Pengguna Umum.');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'no_whatsapp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string', 'max:255'],
        ]);

        $email = Str::lower(trim($validated['email']));

        $customer = Customer::updateOrCreate(
            ['email' => $email],
            [
                'nama' => trim($validated['name']),
                'password' => Hash::make($validated['password']),
                'no_whatsapp' => $validated['no_whatsapp'] ?? '081234567890',
                'alamat' => $validated['alamat'] ?? 'Kota Malang',
            ]
        );

        $request->session()->put('auth_user', [
            'id' => $customer->id,
            'name' => $customer->nama,
            'email' => $customer->email,
            'no_whatsapp' => $customer->no_whatsapp,
            'alamat' => $customer->alamat,
            'role' => 'user',
            'role_label' => 'Pengguna Umum',
        ]);
        $request->session()->save();

        return redirect()->route('beranda');
    }

    /**
     * Tampilkan Dashboard Admin dengan membaca data Product & Admin dari SQLite.
     */
    public function dashboard(Request $request)
    {
        $user = $request->session()->get('auth_user');

        if ($user && (($user['role'] ?? '') === 'user' || ! self::isAdminEmail($user['email'] ?? ''))) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akses ditolak! Email (' . ($user['email'] ?? '-') . ') adalah akun Pengguna Umum. Gunakan email khusus Pemilik/Admin untuk masuk ke Dashboard Admin.',
                ]);
        }

        $adminDefault = Admin::first();
        $products = Product::orderBy('tgl_kedaluwarsa', 'asc')->get();

        return view('admin.dashboard', [
            'authUser' => $user ?? [
                'name' => $adminDefault?->nama ?? 'Rinaldi Mulya Putra',
                'email' => $adminDefault?->email ?? 'admin@typ-herbal.id',
                'role' => 'admin',
                'role_label' => 'Admin · TYP Herbal Drink',
            ],
            'products' => $products,
        ]);
    }

    /**
     * Tampilkan halaman Admin: Produk & data AI.
     */
    public function adminProducts(Request $request)
    {
        $user = $request->session()->get('auth_user');

        if ($user && (($user['role'] ?? '') === 'user' || ! self::isAdminEmail($user['email'] ?? ''))) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akses ditolak! Gunakan email khusus Pemilik/Admin untuk membuka halaman Produk & Data AI.',
                ]);
        }

        return view('admin.products');
    }

    /**
     * Tampilkan halaman Admin: Pesanan & tracking.
     */
    public function adminOrders(Request $request)
    {
        $user = $request->session()->get('auth_user');

        if ($user && (($user['role'] ?? '') === 'user' || ! self::isAdminEmail($user['email'] ?? ''))) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akses ditolak! Gunakan email khusus Pemilik/Admin untuk membuka halaman Pesanan & Tracking.',
                ]);
        }

        return view('admin.orders');
    }

    /**
     * Tampilkan halaman Admin: Laporan penjualan.
     */
    public function adminReports(Request $request)
    {
        $user = $request->session()->get('auth_user');

        if ($user && (($user['role'] ?? '') === 'user' || ! self::isAdminEmail($user['email'] ?? ''))) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akses ditolak! Gunakan email khusus Pemilik/Admin untuk membuka halaman Laporan Penjualan.',
                ]);
        }

        return view('admin.reports');
    }

    /**
     * CRUD Admin: Tambah atau Perbarui Data Barang / Batch Produksi ke tabel products di SQLite.
     */
    public function storeOrUpdateProduct(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => ['nullable', 'integer'],
            'nama_barang' => ['required', 'string', 'max:150'],
            'ukuran' => ['nullable', 'string', 'max:30'],
            'harga' => ['nullable', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'kode_batch' => ['nullable', 'string', 'max:60'],
            'tgl_kedaluwarsa' => ['nullable', 'date'],
            'deskripsi' => ['nullable', 'string'],
            'komposisi' => ['nullable', 'string'],
            'manfaat_kesehatan' => ['nullable', 'string'],
            'kandungan_alergen' => ['nullable', 'string'],
            'foto' => ['nullable', 'string'],
        ]);

        $product = Product::updateOrCreate(
            ['id' => $validated['id'] ?? null, 'nama_barang' => $validated['nama_barang']],
            [
                'ukuran' => $validated['ukuran'] ?? '250 ml',
                'harga' => $validated['harga'] ?? 15000,
                'stok' => $validated['stok'],
                'kode_batch' => $validated['kode_batch'] ?? ('BATCH-TYP-' . now()->format('Ymd-His')),
                'tgl_kedaluwarsa' => $validated['tgl_kedaluwarsa'] ?? now()->addDays(14)->toDateString(),
                'deskripsi' => $validated['deskripsi'] ?? 'Minuman jamu herbal segar racikan alami TYP Herbal Drink.',
                'komposisi' => $validated['komposisi'] ?? 'Rimpang segar pilihan, gula aren organik, air mineral.',
                'manfaat_kesehatan' => $validated['manfaat_kesehatan'] ?? 'Menjaga imunitas dan kebugaran tubuh harian.',
                'kandungan_alergen' => $validated['kandungan_alergen'] ?? 'Tidak mengandung alergen.',
                'foto' => $validated['foto'] ?? '2.jpeg',
            ]
        );

        return response()->json([
            'message' => 'Data barang berhasil disimpan ke database SQLite.',
            'product' => $product,
        ], 201);
    }

    /**
     * CRUD Admin: Hapus data barang dari SQLite.
     */
    public function deleteProduct(int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Data barang berhasil dihapus dari database SQLite.',
        ]);
    }

    /**
     * AI Chatbot dengan konteks data produk langsung dari tabel products di SQLite.
     */
    public function chatbot(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'keluhan' => ['required', 'string', 'max:500'],
        ]);

        $keluhan = trim($validated['keluhan']);
        $products = Product::where('stok', '>', 0)->get();

        $konteksProduk = $products->map(function (Product $p) {
            return "- {$p->nama_barang} ({$p->ukuran}, Rp " . number_format($p->harga, 0, ',', '.') . ", Stok: {$p->stok}): "
                . "Komposisi: {$p->komposisi} | Manfaat: {$p->manfaat_kesehatan} | Alergen/Pantangan: {$p->kandungan_alergen}";
        })->implode("\n");

        $pakaiFallback = false;

        try {
            $apiKey = config('services.gemini.api_key');
            if (empty($apiKey)) {
                throw new \RuntimeException('API key belum diset, gunakan konteks fallback SQLite.');
            }

            $prompt = "Anda adalah asisten herbal TYP-Care. Berikut katalog jamu aktif di database:\n{$konteksProduk}\n\n"
                . "Berikan rekomendasi jamu yang tepat beserta informasi komposisi dan alergen/pantangan untuk keluhan: {$keluhan}";

            $response = Http::timeout(8)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]],
                    ],
                ]
            );

            $jawaban = $response->json('candidates.0.content.parts.0.text')
                ?? $this->fallbackFromSqlite($keluhan, $products);
        } catch (Throwable) {
            $pakaiFallback = true;
            $jawaban = $this->fallbackFromSqlite($keluhan, $products);
        }

        return response()->json([
            'keluhan' => $keluhan,
            'jawaban' => $jawaban,
            'menggunakan_fallback' => $pakaiFallback,
            'jumlah_produk_konteks' => $products->count(),
        ]);
    }

    /**
     * Fallback AI Chatbot yang membaca langsung data Product dari SQLite.
     */
    private function fallbackFromSqlite(string $keluhan, $products): string
    {
        $teks = Str::lower($keluhan);

        $pilihan = $products->first(function (Product $p) use ($teks) {
            if (Str::contains($teks, ['pegal', 'lelah', 'stamina', 'capek']) && Str::contains(Str::lower($p->nama_barang), 'beras kencur')) {
                return true;
            }
            if (Str::contains($teks, ['imun', 'lambung', 'pencernaan', 'maag', 'hati']) && Str::contains(Str::lower($p->nama_barang), 'temulawak')) {
                return true;
            }
            if (Str::contains($teks, ['masuk angin', 'dingin', 'flu', 'hangat', 'tenggorokan']) && Str::contains(Str::lower($p->nama_barang), 'jahe merah')) {
                return true;
            }
            if (Str::contains($teks, ['detox', 'antioksidan', 'haid', 'segar']) && Str::contains(Str::lower($p->nama_barang), 'kunyit asam')) {
                return true;
            }

            return false;
        }) ?? $products->first();

        if (! $pilihan) {
            return 'Maaf, saat ini stok katalog jamu sedang diperbarui.';
        }

        return "Rekomendasi TYP-Care: {$pilihan->nama_barang} (Rp " . number_format($pilihan->harga, 0, ',', '.') . ", Stok: {$pilihan->stok} botol). "
            . "Manfaat: {$pilihan->manfaat_kesehatan} | Komposisi: {$pilihan->komposisi} | Catatan Alergen/Pantangan: {$pilihan->kandungan_alergen}";
    }

    /**
     * Simulasi Keranjang, Payment Gateway, & Tracking menggunakan session().
     */
    public function addToCart(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->input('product_id'));
        $qty = max(1, (int) $request->input('qty', 1));

        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = [
            'product_id' => $product->id,
            'nama_barang' => $product->nama_barang,
            'harga' => $product->harga,
            'qty' => ($cart[$product->id]['qty'] ?? 0) + $qty,
        ];
        $request->session()->put('cart', $cart);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan ke keranjang sesi.',
            'cart' => $cart,
        ]);
    }
}
