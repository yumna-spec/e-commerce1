<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fffaf2">
    <title>{{ __('login.sign_in_title') }} — Happy Burger</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --ink: #28231f;
            --muted: #70665e;
            --paper: #fffaf2;
            --cream: #f6eddf;
            --orange: #e95e2f;
            --orange-dark: #c64620;
            --yellow: #f8c84e;
            --line: #e8e0d5;
            --danger: #b42318;
            font-family: "DM Sans", "Trebuchet MS", Arial, sans-serif;
        }

        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: var(--ink); background: var(--paper); }
        a { color: inherit; text-decoration: none; }
        .topbar { width: min(1160px, calc(100% - 48px)); min-height: 82px; display: flex; align-items: center; justify-content: space-between; gap: 20px; margin: 0 auto; }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-size: 1.2rem; font-weight: 900; letter-spacing: -.05em; }
        .brand-mark { width: 36px; height: 36px; display: grid; place-items: center; border-radius: 50%; background: var(--yellow); }
        .brand-mark svg { width: 21px; height: 21px; }
        .top-link { color: var(--muted); font-size: .9rem; font-weight: 700; }
        .top-link:hover, .signup-link:hover { color: var(--orange-dark); }
        main { min-height: calc(100vh - 140px); display: grid; place-items: center; padding: 18px 24px 42px; }
        .auth-shell { width: min(1060px, 100%); min-height: 610px; display: grid; grid-template-columns: .9fr 1.1fr; overflow: hidden; border: 1px solid rgba(40,35,31,.08); border-radius: 28px; background: white; box-shadow: 0 30px 80px rgba(45,32,18,.11); }
        .visual { position: relative; min-height: 100%; display: flex; align-items: flex-end; padding: 44px; overflow: hidden; color: white; background: var(--ink); }
        .visual::before { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(26,20,15,.05) 5%, rgba(26,20,15,.15) 35%, rgba(26,20,15,.84) 100%), url("{{ asset('images/resturant.jpg') }}") center 56% / cover; content: ""; }
        .visual-content { position: relative; max-width: 370px; }
        .eyebrow { margin: 0 0 14px; color: var(--yellow); font-size: .73rem; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; }
        .visual h1 { margin: 0 0 13px; font-size: clamp(2.3rem, 4vw, 3.6rem); line-height: .98; letter-spacing: -.065em; }
        .visual p:last-child { margin: 0; color: rgba(255,255,255,.82); font-size: .98rem; line-height: 1.7; }
        .form-side { display: flex; align-items: center; justify-content: center; padding: 58px clamp(30px, 6vw, 76px); }
        .form-content { width: min(100%, 410px); }
        .form-kicker { margin: 0 0 8px; color: var(--orange-dark); font-size: .77rem; font-weight: 800; letter-spacing: .11em; text-transform: uppercase; }
        h2 { margin: 0 0 8px; font-size: 2rem; letter-spacing: -.055em; }
        .subtitle { margin: 0 0 27px; color: var(--muted); font-size: .94rem; line-height: 1.6; }
        .alert { margin-bottom: 20px; padding: 13px 16px; border: 1px solid #f3c6c2; border-radius: 12px; color: var(--danger); background: #fff3f1; font-size: .87rem; }
        .alert ul { display: grid; gap: 4px; margin: 0; padding-inline-start: 20px; }
        .field { margin-bottom: 18px; }
        .field label { display: block; margin-bottom: 8px; font-size: .86rem; font-weight: 700; }
        .field input { width: 100%; height: 51px; padding: 0 15px; border: 1px solid var(--line); border-radius: 11px; outline: none; color: var(--ink); background: #fff; font: inherit; font-size: .94rem; transition: border-color .18s, box-shadow .18s; }
        .field input:focus { border-color: var(--orange); box-shadow: 0 0 0 3px rgba(233,94,47,.14); }
        .field.has-error input { border-color: var(--danger); }
        .password-wrap { position: relative; }
        .password-wrap input { padding-inline-end: 65px; }
        .toggle-pass { position: absolute; inset-block: 0; inset-inline-end: 13px; border: 0; color: var(--muted); background: transparent; font: inherit; font-size: .8rem; font-weight: 700; cursor: pointer; }
        .error-text { display: block; margin: 7px 2px 0; color: var(--danger); font-size: .8rem; }
        .form-meta { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin: 2px 0 22px; }
        .remember { display: inline-flex; align-items: center; gap: 9px; color: var(--muted); font-size: .84rem; cursor: pointer; }
        .remember input { width: 16px; height: 16px; accent-color: var(--orange); }
        .forgot { color: var(--orange-dark); font-size: .82rem; font-weight: 700; }
        .forgot:hover { text-decoration: underline; }
        .submit { width: 100%; min-height: 51px; display: inline-flex; justify-content: center; align-items: center; border: 0; border-radius: 999px; color: white; background: var(--orange); font: inherit; font-weight: 800; cursor: pointer; transition: transform .18s, background .18s; }
        .submit:hover { transform: translateY(-1px); background: var(--orange-dark); }
        .signup { margin: 23px 0 0; padding-top: 21px; border-top: 1px solid var(--line); color: var(--muted); text-align: center; font-size: .88rem; }
        .signup-link { margin-inline-start: 4px; color: var(--orange-dark); font-weight: 800; }
        footer { padding: 0 20px 20px; color: var(--muted); text-align: center; font-size: .77rem; }
        @media (max-width: 760px) {
            .topbar { min-height: 70px; }
            main { min-height: auto; padding: 12px 18px 35px; }
            .auth-shell { max-width: 520px; grid-template-columns: 1fr; border-radius: 22px; }
            .visual { min-height: 220px; padding: 27px 30px; }
            .visual::before { background-position: center 53%; }
            .visual h1 { max-width: 360px; font-size: 2.5rem; }
            .form-side { padding: 34px 30px 36px; }
        }
        @media (max-width: 420px) {
            .topbar { width: calc(100% - 36px); }
            .brand { font-size: 1.05rem; }
            .top-link { font-size: .82rem; }
            .visual { min-height: 190px; padding: 24px; }
            .visual h1 { font-size: 2.15rem; }
            .form-side { padding: 30px 22px; }
            .form-meta { align-items: flex-start; flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </span>
            <span>Happy Burger</span>
        </a>
        <a class="top-link" href="{{ route('home') }}">{{ __('login.back_home') }}</a>
    </header>

    <main>
        <div class="auth-shell">
            <section class="visual" aria-label="{{ __('login.brand_message') }}">
                <div class="visual-content">
                    <p class="eyebrow">{{ __('login.brand_eyebrow') }}</p>
                    <h1>{{ __('login.brand_headline') }}</h1>
                    <p>{{ __('login.brand_message') }}</p>
                </div>
            </section>
            <section class="form-side" aria-labelledby="form-title">
                <div class="form-content">
                    <p class="form-kicker">{{ __('login.sign_in_kicker') }}</p>
                    <h2 id="form-title">{{ __('login.sign_in_title') }}</h2>
                    <p class="subtitle">{{ __('login.sign_in_subtitle') }}</p>

                    @if ($errors->any())
                        <div class="alert" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ __('login.Email') }}</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">{{ __('login.Password') }}</label>
                            <div class="password-wrap">
                                <input id="password" type="password" name="password" autocomplete="current-password" required>
                                <button class="toggle-pass" type="button" data-target="password" aria-label="{{ __('login.show_password') }}">{{ __('login.show_password') }}</button>
                            </div>
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-meta">
                            <label class="remember" for="rememberMe">
                                <input id="rememberMe" type="checkbox" name="remember" value="1" @checked(old('remember'))>
                                <span>{{ __('login.Remember me') }}</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="forgot" href="{{ route('password.request') }}">{{ __('login.forgot_password') }}</a>
                            @endif
                        </div>

                        <button class="submit" type="submit">{{ __('login.Sign in') }}</button>
                    </form>

                    <p class="signup">{{ __('login.no_account') }} <a class="signup-link" href="{{ route('register.form') }}">{{ __('login.create_account') }}</a></p>
                </div>
            </section>
        </div>
    </main>

    <footer>© {{ date('Y') }} Happy Burger. {{ __('home.footer_note') }}</footer>
    <script>
        document.querySelectorAll('.toggle-pass').forEach(function (button) {
            button.addEventListener('click', function () {
                var input = document.getElementById(button.dataset.target);
                var showing = input.type === 'password';
                input.type = showing ? 'text' : 'password';
                button.textContent = showing ? @json(__('login.hide_password')) : @json(__('login.show_password'));
                button.setAttribute('aria-label', button.textContent);
            });
        });
    </script>
</body>
</html>
