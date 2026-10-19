<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fffaf2">
    <title>{{ __('login.sign_up_title') }} — Happy Burger</title>
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
        .top-link:hover, .signin-link:hover { color: var(--orange-dark); }
        main { min-height: calc(100vh - 140px); display: grid; place-items: center; padding: 18px 24px 42px; }
        .auth-shell { width: min(1100px, 100%); min-height: 690px; display: grid; grid-template-columns: .82fr 1.18fr; overflow: hidden; border: 1px solid rgba(40,35,31,.08); border-radius: 28px; background: white; box-shadow: 0 30px 80px rgba(45,32,18,.11); }
        .visual { position: relative; min-height: 100%; display: flex; align-items: flex-end; padding: 44px; overflow: hidden; color: white; background: var(--ink); }
        .visual::before { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(26,20,15,.05) 5%, rgba(26,20,15,.15) 35%, rgba(26,20,15,.84) 100%), url("{{ asset('images/resturant.jpg') }}") center 56% / cover; content: ""; }
        .visual-content { position: relative; max-width: 370px; }
        .eyebrow { margin: 0 0 14px; color: var(--yellow); font-size: .73rem; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; }
        .visual h1 { margin: 0 0 13px; font-size: clamp(2.3rem, 4vw, 3.6rem); line-height: .98; letter-spacing: -.065em; }
        .visual p:last-child { margin: 0; color: rgba(255,255,255,.82); font-size: .98rem; line-height: 1.7; }
        .form-side { display: flex; align-items: center; justify-content: center; padding: 48px clamp(30px, 5vw, 66px); }
        .form-content { width: min(100%, 440px); }
        .form-kicker { margin: 0 0 8px; color: var(--orange-dark); font-size: .77rem; font-weight: 800; letter-spacing: .11em; text-transform: uppercase; }
        h2 { margin: 0 0 8px; font-size: 2rem; letter-spacing: -.055em; }
        .subtitle { margin: 0 0 22px; color: var(--muted); font-size: .94rem; line-height: 1.6; }
        .alert { margin-bottom: 18px; padding: 13px 16px; border: 1px solid #f3c6c2; border-radius: 12px; color: var(--danger); background: #fff3f1; font-size: .87rem; }
        .alert ul { display: grid; gap: 4px; margin: 0; padding-inline-start: 20px; }
        .field { margin-bottom: 14px; }
        .field label { display: block; margin-bottom: 7px; font-size: .84rem; font-weight: 700; }
        .field input { width: 100%; height: 47px; padding: 0 14px; border: 1px solid var(--line); border-radius: 10px; outline: none; color: var(--ink); background: #fff; font: inherit; font-size: .92rem; transition: border-color .18s, box-shadow .18s; }
        .field input:focus { border-color: var(--orange); box-shadow: 0 0 0 3px rgba(233,94,47,.14); }
        .field.has-error input { border-color: var(--danger); }
        .password-wrap { position: relative; }
        .password-wrap input { padding-inline-end: 65px; }
        .toggle-pass { position: absolute; inset-block: 0; inset-inline-end: 13px; border: 0; color: var(--muted); background: transparent; font: inherit; font-size: .8rem; font-weight: 700; cursor: pointer; }
        .error-text { display: block; margin: 6px 2px 0; color: var(--danger); font-size: .8rem; }
        .avatar-row { display: flex; align-items: center; gap: 13px; margin: 18px 0; padding: 12px; border: 1px dashed #d9cfc1; border-radius: 12px; background: #fffdf9; }
        .avatar-preview { width: 50px; height: 50px; display: grid; flex: 0 0 auto; place-items: center; overflow: hidden; border-radius: 50%; color: var(--orange-dark); background: var(--cream) center / cover no-repeat; }
        .avatar-preview svg { width: 23px; height: 23px; }
        .avatar-info { min-width: 0; flex: 1; }
        .avatar-title { display: block; margin-bottom: 3px; font-size: .84rem; font-weight: 700; }
        .avatar-hint { display: block; overflow: hidden; color: var(--muted); font-size: .75rem; text-overflow: ellipsis; white-space: nowrap; }
        .avatar-row input[type="file"] { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; clip-path: inset(50%); }
        .avatar-row input[type="file"]:focus-visible + .btn-upload { outline: 3px solid rgba(233,94,47,.25); outline-offset: 2px; }
        .btn-upload { flex: 0 0 auto; padding: 9px 13px; border: 1px solid var(--line); border-radius: 999px; color: var(--ink); background: white; font-size: .78rem; font-weight: 700; cursor: pointer; }
        .btn-upload:hover { border-color: var(--orange); color: var(--orange-dark); }
        .submit { width: 100%; min-height: 49px; display: inline-flex; justify-content: center; align-items: center; margin-top: 4px; border: 0; border-radius: 999px; color: white; background: var(--orange); font: inherit; font-weight: 800; cursor: pointer; transition: transform .18s, background .18s; }
        .submit:hover { transform: translateY(-1px); background: var(--orange-dark); }
        .signin { margin: 20px 0 0; padding-top: 18px; border-top: 1px solid var(--line); color: var(--muted); text-align: center; font-size: .87rem; }
        .signin-link { margin-inline-start: 4px; color: var(--orange-dark); font-weight: 800; }
        footer { padding: 0 20px 20px; color: var(--muted); text-align: center; font-size: .77rem; }
        @media (max-width: 820px) {
            main { min-height: auto; padding: 12px 18px 35px; }
            .auth-shell { max-width: 560px; grid-template-columns: 1fr; border-radius: 22px; }
            .visual { min-height: 205px; padding: 26px 30px; }
            .visual::before { background-position: center 53%; }
            .visual h1 { max-width: 380px; font-size: 2.45rem; }
            .form-side { padding: 34px 30px 36px; }
        }
        @media (max-width: 460px) {
            .topbar { width: calc(100% - 36px); min-height: 70px; }
            .brand { font-size: 1.05rem; }
            .top-link { font-size: .82rem; }
            .visual { min-height: 175px; padding: 22px; }
            .visual h1 { font-size: 2.1rem; }
            .form-side { padding: 28px 21px; }
            .avatar-row { gap: 10px; padding: 10px; }
            .avatar-preview { width: 43px; height: 43px; }
            .btn-upload { padding: 8px 10px; }
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
        <a class="top-link" href="{{ route('login.form') }}">{{ __('login.have_account') }} {{ __('login.sign_in_title') }}</a>
    </header>

    <main>
        <div class="auth-shell">
            <section class="visual" aria-label="{{ __('login.brand_message') }}">
                <div class="visual-content">
                    <p class="eyebrow">{{ __('login.brand_eyebrow') }}</p>
                    <h1>{{ __('login.join_headline') }}</h1>
                    <p>{{ __('login.join_message') }}</p>
                </div>
            </section>
            <section class="form-side" aria-labelledby="form-title">
                <div class="form-content">
                    <p class="form-kicker">{{ __('login.join_kicker') }}</p>
                    <h2 id="form-title">{{ __('login.sign_up_title') }}</h2>
                    <p class="subtitle">{{ __('login.sign_up_subtitle') }}</p>

                    @if ($errors->any())
                        <div class="alert" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ __('login.full_name') }}</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus>
                            @error('name')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ __('login.Email') }}</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">{{ __('login.Password') }}</label>
                            <div class="password-wrap">
                                <input id="password" type="password" name="password" autocomplete="new-password" required>
                                <button class="toggle-pass" type="button" data-target="password" aria-label="{{ __('login.show_password') }}">{{ __('login.show_password') }}</button>
                            </div>
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password_confirmation">{{ __('login.confirm_password') }}</label>
                            <div class="password-wrap">
                                <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
                                <button class="toggle-pass" type="button" data-target="password_confirmation" aria-label="{{ __('login.show_password') }}">{{ __('login.show_password') }}</button>
                            </div>
                        </div>

                        <div class="avatar-row">
                            <div class="avatar-preview" id="avatarPreview" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.7"/><path d="M4.5 21a7.5 7.5 0 0 1 15 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                            </div>
                            <div class="avatar-info">
                                <span class="avatar-title">{{ __('login.profile_photo') }}</span>
                                <span class="avatar-hint" id="avatarName">{{ __('login.photo_hint') }}</span>
                            </div>
                            <input type="file" name="image" id="image" accept="image/jpeg,image/png" aria-label="{{ __('login.profile_photo') }}" required>
                            <label for="image" class="btn-upload">{{ __('login.choose_photo') }}</label>
                        </div>
                        @error('image')
                            <span class="error-text">{{ $message }}</span>
                        @enderror

                        <button class="submit" type="submit">{{ __('login.create_account') }}</button>
                    </form>

                    <p class="signin">{{ __('login.have_account') }} <a class="signin-link" href="{{ route('login.form') }}">{{ __('login.sign_in_title') }}</a></p>
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

        document.getElementById('image').addEventListener('change', function () {
            var file = this.files[0];
            if (!file) return;

            document.getElementById('avatarName').textContent = file.name;
            var reader = new FileReader();
            reader.addEventListener('load', function () {
                var preview = document.getElementById('avatarPreview');
                preview.style.backgroundImage = 'url("' + reader.result + '")';
                preview.replaceChildren();
            });
            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>
