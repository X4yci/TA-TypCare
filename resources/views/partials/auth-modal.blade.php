@php
    $initialTab = $authTab ?? null; // 'login', 'register', or null
    // Jika terdapat error validasi dari server, buka modal secara otomatis pada tab yang sesuai
    if ($errors->has('name') || $errors->has('password_confirmation')) {
        $initialTab = 'register';
    } elseif ($errors->any() || session('status') || session('google_warning')) {
        $initialTab = $initialTab ?? 'login';
    }
    $isOpen = in_array($initialTab, ['login', 'register']);
    $activeMode = $initialTab === 'register' ? 'register' : 'login';
@endphp

<!-- Auth Modal Backdrop & Container -->
<div
    id="auth-modal-overlay"
    class="fixed inset-0 z-50 bg-black/50 backdrop-blur-[1.5px] {{ $isOpen ? 'flex' : 'hidden' }} items-center justify-center p-4 overflow-y-auto transition-opacity duration-200"
    onclick="handleAuthBackdropClick(event)"
>
    <!-- Modal Card -->
    <div
        id="auth-modal-card"
        class="relative w-full max-w-[445px] bg-[#fdfcf9] rounded-[26px] p-7 sm:p-8 shadow-2xl border border-[#ece6da] my-auto"
        onclick="event.stopPropagation()"
    >
        <!-- Top Bar: Brand Logo & Close Button -->
        <div class="flex items-start justify-between">
            <a href="{{ url('/') }}" class="inline-flex items-center focus:outline-none">
                <img
                    src="{{ asset('image/image.png') }}"
                    alt="TYP Herbal Drink"
                    class="h-11 sm:h-12 w-auto object-contain mix-blend-multiply -ml-2"
                >
            </a>

            <button
                type="button"
                onclick="closeAuthModal()"
                aria-label="Tutup"
                class="w-8 h-8 rounded-full bg-[#f2eee5] hover:bg-[#e6e0d4] text-[#5c5852] flex items-center justify-center transition cursor-pointer"
            >
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Dynamic Heading & Subtitle -->
        <div class="mt-3">
            <h2 id="auth-modal-title" class="font-display text-[28px] sm:text-[31px] font-bold text-[#1e1e1c] tracking-tight leading-tight">
                {{ $activeMode === 'register' ? 'Buat Akun' : 'Senang kamu kembali' }}
            </h2>
            <p class="text-xs text-[#7c7870] mt-1">
                Lanjutkan ritual baikmu bersama TYP HERBAL DRINK
            </p>
        </div>

        <!-- Server Validation Error / Status Alert -->
        @if ($errors->any())
            <div class="mt-4 p-3 rounded-xl bg-[#fde8e8] border border-[#f5c2c2] text-[#b91c1c] text-xs leading-relaxed">
                @foreach ($errors->all() as $error)
                    <p class="font-medium">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="mt-4 p-3 rounded-xl bg-[#e8f3ec] border border-[#c5e0ce] text-[#1e5e38] text-xs font-medium">
                {{ session('status') }}
            </div>
        @endif

        <!-- Warning khusus Login Google (Demo Only) -->
        <div
            id="google-demo-warning"
            class="{{ session('google_warning') ? 'flex' : 'hidden' }} mt-4 p-3 rounded-xl bg-[#fef3c7] border border-[#f2d2b1] text-[#b45309] text-xs font-semibold items-center gap-2"
        >
            <svg class="w-4 h-4 shrink-0 text-[#b45309]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            <span id="google-demo-warning-text">{{ session('google_warning', 'tidak dapat di gunakan hanya demo') }}</span>
        </div>

        <!-- Tab Switcher: Masuk | Daftar -->
        <div class="mt-5 bg-[#f2efe8] p-1 rounded-xl grid grid-cols-2 gap-1">
            <button
                type="button"
                id="auth-tab-login"
                onclick="switchAuthTab('login')"
                class="{{ $activeMode === 'login' ? 'bg-white text-[#24583c] font-bold shadow-[0_1px_2px_rgba(0,0,0,0.06)]' : 'text-[#6e6a63] hover:text-[#1e1e1c] font-semibold' }} text-xs py-2.5 rounded-lg text-center transition cursor-pointer"
            >
                Masuk
            </button>
            <button
                type="button"
                id="auth-tab-register"
                onclick="switchAuthTab('register')"
                class="{{ $activeMode === 'register' ? 'bg-white text-[#24583c] font-bold shadow-[0_1px_2px_rgba(0,0,0,0.06)]' : 'text-[#6e6a63] hover:text-[#1e1e1c] font-semibold' }} text-xs py-2.5 rounded-lg text-center transition cursor-pointer"
            >
                Daftar
            </button>
        </div>

        <!-- FORM 1: MASUK (LOGIN - Gambar 2) -->
        <form
            id="auth-form-login"
            action="{{ route('login.submit') }}"
            method="POST"
            onsubmit="return handleLoginFormSubmit(event)"
            class="{{ $activeMode === 'login' ? 'block' : 'hidden' }} mt-5 space-y-4"
        >
            @csrf

            <!-- Email -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="login-email" class="block text-[11.5px] font-bold text-[#2c2a27]">Email</label>
                    <span id="login-role-badge" class="text-[10.5px] font-semibold px-2 py-0.5 rounded-md bg-[#e8f3ec] text-[#1e5e38]">
                        Akses Pemilik / Admin
                    </span>
                </div>
                <div class="flex items-center bg-white border border-[#e5dfd3] rounded-xl px-3.5 py-3 focus-within:border-[#2b6346] transition">
                    <svg class="w-4 h-4 text-[#8c857b] shrink-0 mr-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <input
                        type="email"
                        id="login-email"
                        name="email"
                        value="{{ old('email', 'rinaldi@gmail.com') }}"
                        placeholder="rinaldi@gmail.com"
                        oninput="checkLoginEmailRole(this.value)"
                        required
                        class="w-full text-[13px] text-[#2c2a27] placeholder-[#9c968c] focus:outline-none bg-transparent"
                    >
                </div>
                <p id="login-role-hint" class="text-[11px] text-[#6e736b] mt-1.5">
                    Email khusus Pemilik (<code class="text-[#24583c] font-semibold">rinaldi@gmail.com</code> / <code class="text-[#24583c] font-semibold">*@typcare.com</code>) akan masuk ke <strong>Dashboard Admin</strong>.
                </p>
            </div>

            <!-- Password -->
            <div>
                <label for="login-password" class="block text-[11.5px] font-bold text-[#2c2a27] mb-1.5">Password</label>
                <div class="flex items-center bg-white border border-[#e5dfd3] rounded-xl px-3.5 py-3 focus-within:border-[#2b6346] transition">
                    <svg class="w-4 h-4 text-[#8c857b] shrink-0 mr-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input
                        type="password"
                        id="login-password"
                        name="password"
                        value="password123"
                        required
                        class="w-full text-[13px] text-[#2c2a27] focus:outline-none bg-transparent"
                    >
                    <button
                        type="button"
                        onclick="togglePasswordVisibility('login-password')"
                        aria-label="Tampilkan password"
                        class="text-[#8c857b] hover:text-[#2c2a27] ml-2 focus:outline-none cursor-pointer"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Submit Button: Masuk -->
            <div class="pt-1">
                <button
                    type="submit"
                    class="w-full bg-[#2b6346] hover:bg-[#23523a] text-white font-semibold text-[13px] py-3.5 rounded-full transition cursor-pointer shadow-xs"
                >
                    Masuk
                </button>
            </div>

            <!-- Divider: atau -->
            <div class="flex items-center gap-3 py-1">
                <div class="flex-1 h-px bg-[#e8e2d7]"></div>
                <span class="text-[11px] text-[#8c857b]">atau</span>
                <div class="flex-1 h-px bg-[#e8e2d7]"></div>
            </div>

            <!-- Masuk dengan Google (Hanya Demo - Tidak Masuk ke Dashboard) -->
            <div>
                <a
                    href="{{ route('login.google') }}"
                    onclick="loginWithGoogleDemo(event)"
                    class="w-full bg-white hover:bg-[#faf8f4] border border-[#e5dfd3] text-[#1e1e1c] font-semibold text-xs py-3.5 rounded-full inline-flex items-center justify-center gap-2.5 transition cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5 text-[#1e1e1c]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.24 10.285V14.4h6.806c-.275 1.765-2.056 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z"/>
                    </svg>
                    <span>Masuk dengan Google</span>
                </a>
            </div>
        </form>

        <!-- FORM 2: DAFTAR (REGISTER - Gambar 1) -->
        <form
            id="auth-form-register"
            action="{{ route('register.submit') }}"
            method="POST"
            onsubmit="return validateRegisterForm(event)"
            class="{{ $activeMode === 'register' ? 'block' : 'hidden' }} mt-5 space-y-3.5"
        >
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="reg-name" class="block text-[11.5px] font-bold text-[#2c2a27] mb-1.5">Nama lengkap</label>
                <div class="flex items-center bg-white border border-[#e5dfd3] rounded-xl px-3.5 py-3 focus-within:border-[#2b6346] transition">
                    <svg class="w-4 h-4 text-[#8c857b] shrink-0 mr-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <input
                        type="text"
                        id="reg-name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama lengkap kamu"
                        required
                        class="w-full text-[13px] text-[#2c2a27] placeholder-[#9c968c] focus:outline-none bg-transparent"
                    >
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="reg-email" class="block text-[11.5px] font-bold text-[#2c2a27] mb-1.5">Email</label>
                <div id="reg-email-wrapper" class="flex items-center bg-white border border-[#e5dfd3] rounded-xl px-3.5 py-3 focus-within:border-[#2b6346] transition">
                    <svg class="w-4 h-4 text-[#8c857b] shrink-0 mr-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <input
                        type="email"
                        id="reg-email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="rinaldi@gmail.com"
                        oninput="checkRegisterEmailCollision(this.value)"
                        required
                        class="w-full text-[13px] text-[#2c2a27] placeholder-[#9c968c] focus:outline-none bg-transparent"
                    >
                </div>
                <p id="reg-email-error" class="hidden text-[11px] font-medium text-[#b91c1c] mt-1.5">
                    Email ini dikhususkan untuk Pemilik/Admin dan tidak dapat didaftarkan sebagai Pengguna Umum.
                </p>
            </div>

            <!-- Kata Sandi -->
            <div>
                <label for="reg-password" class="block text-[11.5px] font-bold text-[#2c2a27] mb-1.5">Kata sandi</label>
                <div class="flex items-center bg-white border border-[#e5dfd3] rounded-xl px-3.5 py-3 focus-within:border-[#2b6346] transition">
                    <svg class="w-4 h-4 text-[#8c857b] shrink-0 mr-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input
                        type="password"
                        id="reg-password"
                        name="password"
                        value="password123"
                        required
                        class="w-full text-[13px] text-[#2c2a27] focus:outline-none bg-transparent"
                    >
                    <button
                        type="button"
                        onclick="togglePasswordVisibility('reg-password')"
                        aria-label="Tampilkan kata sandi"
                        class="text-[#8c857b] hover:text-[#2c2a27] ml-2 focus:outline-none cursor-pointer"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Konfirmasi Kata Sandi -->
            <div>
                <label for="reg-password-confirm" class="block text-[11.5px] font-bold text-[#2c2a27] mb-1.5">Konfirmasi kata sandi</label>
                <div class="flex items-center bg-white border border-[#e5dfd3] rounded-xl px-3.5 py-3 focus-within:border-[#2b6346] transition">
                    <svg class="w-4 h-4 text-[#8c857b] shrink-0 mr-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input
                        type="password"
                        id="reg-password-confirm"
                        name="password_confirmation"
                        value="password123"
                        required
                        class="w-full text-[13px] text-[#2c2a27] focus:outline-none bg-transparent"
                    >
                    <button
                        type="button"
                        onclick="togglePasswordVisibility('reg-password-confirm')"
                        aria-label="Tampilkan konfirmasi kata sandi"
                        class="text-[#8c857b] hover:text-[#2c2a27] ml-2 focus:outline-none cursor-pointer"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Submit Button: Daftar Akun -->
            <div class="pt-1.5">
                <button
                    type="submit"
                    id="reg-submit-btn"
                    class="w-full bg-[#2b6346] hover:bg-[#23523a] text-white font-semibold text-[13px] py-3.5 rounded-full transition cursor-pointer shadow-xs"
                >
                    Daftar Akun
                </button>
            </div>
        </form>

        <!-- Modal Footer Note -->
        <p class="text-[11px] text-[#8c857b] text-center mt-5">
            Satu akun untuk ritual, batch, dan pesananmu.
        </p>
    </div>
</div>

<script>
    const OWNER_EMAILS = ['rinaldi@gmail.com', 'rinaldi@typcare.com', 'admin@typcare.com', 'owner@typcare.com'];
    const OWNER_DOMAINS = ['@typcare.com', '@admin.typcare.com', '@typcare.id'];

    function isOwnerEmailAddress(email) {
        const clean = (email || '').trim().toLowerCase();
        if (!clean) return false;
        if (OWNER_EMAILS.includes(clean)) return true;
        return OWNER_DOMAINS.some(domain => clean.endsWith(domain));
    }

    function checkLoginEmailRole(value) {
        const badge = document.getElementById('login-role-badge');
        const hint = document.getElementById('login-role-hint');
        const clean = (value || '').trim().toLowerCase();

        if (!clean) {
            badge.textContent = 'Menunggu Email';
            badge.className = 'text-[10.5px] font-semibold px-2 py-0.5 rounded-md bg-[#f2efe8] text-[#6e6a63]';
            return;
        }

        if (isOwnerEmailAddress(clean)) {
            badge.textContent = 'Akses Pemilik / Admin';
            badge.className = 'text-[10.5px] font-semibold px-2 py-0.5 rounded-md bg-[#e8f3ec] text-[#1e5e38]';
            hint.innerHTML = 'Email terverifikasi sebagai <strong>Pemilik/Admin</strong> — akan diarahkan ke <strong>Dashboard Operasional</strong>.';
        } else {
            badge.textContent = 'Akses Pengguna Umum';
            badge.className = 'text-[10.5px] font-semibold px-2 py-0.5 rounded-md bg-[#fef3c7] text-[#b45309]';
            hint.innerHTML = 'Email terdeteksi sebagai <strong>Pengguna Umum</strong> — tidak dapat mengakses Dashboard Admin.';
        }
    }

    function checkRegisterEmailCollision(value) {
        const errorEl = document.getElementById('reg-email-error');
        const wrapper = document.getElementById('reg-email-wrapper');
        if (isOwnerEmailAddress(value)) {
            errorEl.classList.remove('hidden');
            wrapper.classList.remove('border-[#e5dfd3]');
            wrapper.classList.add('border-[#b91c1c]');
            return false;
        } else {
            errorEl.classList.add('hidden');
            wrapper.classList.remove('border-[#b91c1c]');
            wrapper.classList.add('border-[#e5dfd3]');
            return true;
        }
    }

    function validateRegisterForm(event) {
        const regEmail = document.getElementById('reg-email').value;
        if (!checkRegisterEmailCollision(regEmail)) {
            event.preventDefault();
            document.getElementById('reg-email').focus();
            return false;
        }
        return true;
    }

    function handleLoginFormSubmit(event) {
        const emailInput = document.getElementById('login-email');
        const passwordInput = document.getElementById('login-password');
        const email = (emailInput ? emailInput.value : '').trim().toLowerCase();
        const password = (passwordInput ? passwordInput.value : '').trim();

        if (!email || password.length < 4) {
            return true; // biarkan validasi HTML/server menangani input kosong
        }

        // Jika email lolos validasi khusus Pemilik/Admin, langsung arahkan ke Dashboard Admin
        if (isOwnerEmailAddress(email)) {
            event.preventDefault();
            window.location.href = "{{ route('admin.dashboard') }}";
            return false;
        }

        return true;
    }

    function loginWithGoogleDemo(event) {
        if (event) {
            event.preventDefault();
        }
        const warningBox = document.getElementById('google-demo-warning');
        const warningText = document.getElementById('google-demo-warning-text');
        if (warningText) {
            warningText.textContent = 'tidak dapat di gunakan hanya demo';
        }
        if (warningBox) {
            warningBox.classList.remove('hidden');
            warningBox.classList.add('flex');
        }
    }

    function openAuthModal(mode = 'login') {
        const overlay = document.getElementById('auth-modal-overlay');
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        switchAuthTab(mode);
    }

    function closeAuthModal() {
        const overlay = document.getElementById('auth-modal-overlay');
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        if (window.location.pathname === '/login' || window.location.pathname === '/register') {
            window.history.pushState({}, '', '{{ url("/") }}');
        }
    }

    function handleAuthBackdropClick(event) {
        if (event.target.id === 'auth-modal-overlay') {
            closeAuthModal();
        }
    }

    function switchAuthTab(mode) {
        const warningBox = document.getElementById('google-demo-warning');
        if (warningBox) {
            warningBox.classList.add('hidden');
            warningBox.classList.remove('flex');
        }
        const titleEl = document.getElementById('auth-modal-title');
        const tabLogin = document.getElementById('auth-tab-login');
        const tabRegister = document.getElementById('auth-tab-register');
        const formLogin = document.getElementById('auth-form-login');
        const formRegister = document.getElementById('auth-form-register');

        const activeTabClass = 'bg-white text-[#24583c] font-bold shadow-[0_1px_2px_rgba(0,0,0,0.06)] text-xs py-2.5 rounded-lg text-center transition cursor-pointer';
        const inactiveTabClass = 'text-[#6e6a63] hover:text-[#1e1e1c] font-semibold text-xs py-2.5 rounded-lg text-center transition cursor-pointer';

        if (mode === 'register') {
            titleEl.textContent = 'Buat Akun';
            tabRegister.className = activeTabClass;
            tabLogin.className = inactiveTabClass;
            formRegister.classList.remove('hidden');
            formRegister.classList.add('block');
            formLogin.classList.add('hidden');
            formLogin.classList.remove('block');
        } else {
            titleEl.textContent = 'Senang kamu kembali';
            tabLogin.className = activeTabClass;
            tabRegister.className = inactiveTabClass;
            formLogin.classList.remove('hidden');
            formLogin.classList.add('block');
            formRegister.classList.add('hidden');
            formRegister.classList.remove('block');
        }
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return;
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const loginInput = document.getElementById('login-email');
        if (loginInput) checkLoginEmailRole(loginInput.value);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeAuthModal();
        }
    });
</script>
