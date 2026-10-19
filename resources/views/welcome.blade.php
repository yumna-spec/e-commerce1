<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ __('home.hero_description') }}">
    <meta name="theme-color" content="#fffaf2">
    <title>Happy Burger — {{ __('home.hero_title') }}</title>
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
            --line: rgba(40, 35, 31, .12);
            font-family: "Trebuchet MS", Arial, sans-serif;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; color: var(--ink); background: var(--paper); }
        a { color: inherit; text-decoration: none; }
        button { font: inherit; }
        .container { width: min(1160px, calc(100% - 48px)); margin: 0 auto; }
        .announcement {
            padding: 10px 20px;
            color: var(--paper);
            background: var(--ink);
            text-align: center;
            font-size: .76rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .site-header { position: relative; z-index: 2; background: var(--paper); }
        .nav-wrap { min-height: 82px; display: flex; align-items: center; justify-content: space-between; gap: 28px; }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-size: 1.2rem; font-weight: 900; letter-spacing: -.05em; white-space: nowrap; }
        .brand-mark { width: 36px; height: 36px; display: grid; place-items: center; border-radius: 50%; color: var(--ink); background: var(--yellow); }
        .brand-mark svg { width: 21px; height: 21px; }
        .nav-links, .nav-actions { display: flex; align-items: center; gap: 25px; }
        .nav-links a, .nav-actions a, .language-switch a { font-size: .88rem; font-weight: 700; }
        .nav-links a { color: var(--muted); transition: color .2s ease; }
        .nav-links a:hover, .nav-actions a:hover { color: var(--orange-dark); }
        .nav-actions { gap: 14px; }
        .nav-actions form { margin: 0; }
        .nav-actions button { padding: 0; border: 0; color: var(--ink); background: transparent; cursor: pointer; font-weight: 700; }
        .language-switch { display: flex; align-items: center; gap: 8px; padding-left: 14px; border-left: 1px solid var(--line); }
        .language-switch a { color: var(--muted); }
        .language-switch a[aria-current="page"] { color: var(--orange-dark); }
        .button { min-height: 48px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; padding: 0 22px; border: 0; border-radius: 999px; background: var(--orange); color: white; font-size: .92rem; font-weight: 800; transition: transform .2s ease, background .2s ease; }
        .button:hover { transform: translateY(-2px); background: var(--orange-dark); }
        .button svg { width: 17px; height: 17px; }
        .button-outline { border: 1px solid var(--line); background: transparent; color: var(--ink); }
        .button-outline:hover { color: white; }
        .mobile-menu { display: none; }
        .hero { padding: 50px 0 72px; overflow: hidden; }
        .hero-grid { min-height: 490px; display: grid; grid-template-columns: 1fr 1.03fr; align-items: center; gap: 38px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 9px; margin: 0 0 21px; color: var(--orange-dark); font-size: .76rem; font-weight: 900; letter-spacing: .14em; text-transform: uppercase; }
        .eyebrow::before { width: 25px; height: 2px; background: currentColor; content: ""; }
        h1, h2, p { margin-top: 0; }
        h1 { max-width: 570px; margin-bottom: 20px; font-size: clamp(3.5rem, 7vw, 6.45rem); line-height: .94; letter-spacing: -.075em; }
        h1 span { color: var(--orange); }
        .hero-copy { max-width: 475px; margin-bottom: 29px; color: var(--muted); font-size: 1.08rem; line-height: 1.75; }
        .hero-buttons { display: flex; flex-wrap: wrap; gap: 12px; }
        .hero-note { display: flex; align-items: center; gap: 11px; margin-top: 31px; color: var(--muted); font-size: .82rem; font-weight: 700; }
        .note-mark { width: 19px; height: 19px; display: grid; place-items: center; border-radius: 50%; color: var(--orange-dark); background: #fbe4d8; }
        .note-mark svg { width: 12px; height: 12px; }
        .hero-photo { position: relative; min-height: 475px; }
        .hero-photo::before { position: absolute; inset: 5% 0 0 8%; border-radius: 48% 52% 43% 57% / 49% 43% 57% 51%; background: var(--yellow); content: ""; transform: rotate(-5deg); }
        .hero-photo img { position: absolute; inset: 0; width: 100%; height: 100%; border: 9px solid var(--paper); border-radius: 47% 53% 45% 55% / 48% 43% 57% 52%; object-fit: cover; object-position: 50% 56%; box-shadow: 0 26px 75px rgba(50, 31, 15, .15); transform: rotate(2deg); }
        .photo-badge { position: absolute; right: -5px; bottom: 22px; width: 112px; height: 112px; display: grid; place-items: center; padding: 15px; border: 5px solid var(--paper); border-radius: 50%; color: var(--ink); background: var(--yellow); text-align: center; font-size: .82rem; font-weight: 900; line-height: 1.25; transform: rotate(9deg); }
        .good-stuff { padding: 27px 0; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); background: #fffdf9; }
        .good-stuff-grid { display: grid; grid-template-columns: repeat(3, 1fr); }
        .good-stuff-item { display: flex; align-items: center; justify-content: center; gap: 13px; padding: 8px 20px; }
        .good-stuff-item + .good-stuff-item { border-left: 1px solid var(--line); }
        .good-stuff-icon { width: 38px; height: 38px; display: grid; place-items: center; flex: 0 0 auto; border-radius: 50%; background: var(--cream); color: var(--orange-dark); }
        .good-stuff-icon svg { width: 20px; height: 20px; }
        .good-stuff-item strong, .good-stuff-item span { display: block; }
        .good-stuff-item strong { margin-bottom: 3px; font-size: .92rem; }
        .good-stuff-item span { color: var(--muted); font-size: .79rem; }
        .story { padding: 105px 0; }
        .story-grid { display: grid; grid-template-columns: .85fr 1fr; align-items: center; gap: 90px; }
        .story-art { position: relative; min-height: 360px; display: grid; place-items: center; border-radius: 28px; background: var(--cream); overflow: hidden; }
        .story-art::before, .story-art::after { position: absolute; width: 220px; height: 220px; border: 1px solid rgba(230, 94, 47, .2); border-radius: 50%; content: ""; }
        .story-art::after { width: 300px; height: 300px; }
        .story-burger { position: relative; z-index: 1; width: 170px; height: 150px; display: grid; place-items: center; border: 10px solid #fffaf2; border-radius: 42% 42% 22% 22%; color: var(--orange-dark); background: var(--yellow); font-size: 5.3rem; box-shadow: 0 18px 40px rgba(70, 42, 15, .13); transform: rotate(-7deg); }
        .story-sticker { position: absolute; right: 28px; bottom: 25px; z-index: 1; padding: 11px 15px; border-radius: 7px; background: var(--orange); color: white; font-size: .76rem; font-weight: 900; letter-spacing: .04em; transform: rotate(4deg); }
        .story h2, .menu-cta h2 { margin-bottom: 19px; font-size: clamp(2.3rem, 4vw, 3.55rem); line-height: 1.04; letter-spacing: -.06em; }
        .story-copy { margin-bottom: 25px; color: var(--muted); font-size: 1rem; line-height: 1.8; }
        .text-link { display: inline-flex; align-items: center; gap: 9px; color: var(--orange-dark); font-weight: 900; }
        .text-link svg { width: 17px; height: 17px; transition: transform .2s ease; }
        .text-link:hover svg { transform: translateX(4px); }
        .menu-cta { padding: 64px 0; background: var(--ink); color: white; }
        .menu-cta-inner { display: flex; align-items: center; justify-content: space-between; gap: 32px; }
        .menu-cta .eyebrow { color: var(--yellow); }
        .menu-cta h2 { max-width: 600px; margin-bottom: 10px; }
        .menu-cta p { max-width: 530px; margin-bottom: 0; color: rgba(255,255,255,.7); line-height: 1.7; }
        .menu-cta .button { flex: 0 0 auto; color: var(--ink); background: var(--yellow); }
        .menu-cta .button:hover { background: #ffdb75; }
        .site-footer { padding: 25px 0; }
        .footer-inner { display: flex; align-items: center; justify-content: space-between; gap: 20px; color: var(--muted); font-size: .8rem; }
        .footer-inner p { margin: 0; }
        .footer-links { display: flex; gap: 18px; font-weight: 700; }
        @media (max-width: 920px) {
            .nav-links { gap: 16px; }
            .nav-actions { gap: 10px; }
            .nav-actions .button { min-height: 42px; padding: 0 15px; }
            .hero-grid { grid-template-columns: 1fr .9fr; gap: 20px; }
            .hero-photo { min-height: 400px; }
            .story-grid { gap: 50px; }
        }
        @media (max-width: 720px) {
            .container { width: min(100% - 36px, 540px); }
            .announcement { font-size: .65rem; }
            .nav-wrap { min-height: 72px; flex-wrap: wrap; gap: 12px; }
            .nav-links { display: none; }
            .nav-actions { gap: 12px; margin-left: auto; }
            .nav-actions > a:not(.button), .nav-actions form, .nav-actions .button-outline { display: none; }
            .language-switch { padding-left: 0; border-left: 0; }
            .mobile-menu { position: relative; display: block; }
            .mobile-menu summary { display: grid; width: 40px; height: 40px; place-items: center; border: 1px solid var(--line); border-radius: 50%; cursor: pointer; list-style: none; }
            .mobile-menu summary::-webkit-details-marker { display: none; }
            .mobile-menu summary svg { width: 20px; height: 20px; }
            .mobile-menu[open] .mobile-menu-panel { position: absolute; top: 48px; right: 0; z-index: 3; width: 210px; display: grid; gap: 0; padding: 8px; border: 1px solid var(--line); border-radius: 14px; background: var(--paper); box-shadow: 0 14px 35px rgba(40,35,31,.12); }
            .mobile-menu-panel a { padding: 12px; border-radius: 8px; font-size: .9rem; font-weight: 700; }
            .mobile-menu-panel a:hover { background: var(--cream); }
            .mobile-menu-panel form { margin: 0; }
            .mobile-menu-panel button { width: 100%; padding: 12px; border: 0; border-radius: 8px; background: transparent; color: var(--ink); text-align: start; font-size: .9rem; font-weight: 700; cursor: pointer; }
            .mobile-menu-panel button:hover { background: var(--cream); }
            .hero { padding: 29px 0 51px; }
            .hero-grid { grid-template-columns: 1fr; gap: 18px; }
            .hero-copy { font-size: 1rem; }
            .hero-photo { min-height: min(85vw, 420px); margin: 0 10px; }
            .photo-badge { right: -7px; bottom: 2px; width: 94px; height: 94px; font-size: .72rem; }
            .good-stuff { padding: 12px 0; }
            .good-stuff-grid { grid-template-columns: 1fr; }
            .good-stuff-item { justify-content: flex-start; padding: 13px 5px; }
            .good-stuff-item + .good-stuff-item { border-top: 1px solid var(--line); border-left: 0; }
            .story { padding: 65px 0; }
            .story-grid { grid-template-columns: 1fr; gap: 35px; }
            .story-art { min-height: 285px; }
            .story-burger { width: 145px; height: 130px; font-size: 4.5rem; }
            .menu-cta { padding: 48px 0; }
            .menu-cta-inner { align-items: flex-start; flex-direction: column; }
            .footer-inner { align-items: flex-start; flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <div class="announcement">{{ __('home.announcement') }}</div>

    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="Happy Burger home">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M5 12v3m14-3v3" stroke="currentColor" stroke-width="2"/></svg>
                </span>
                <span>Happy Burger</span>
            </a>

            <nav class="nav-links" aria-label="Main navigation">
                <a href="#our-promise">{{ __('home.nav_story') }}</a>
                <a href="#menu">{{ __('home.nav_menu') }}</a>
            </nav>

            <div class="nav-actions">
                @auth('admin')
                    <a href="{{ route('admin.product') }}">{{ __('product.Products') }}</a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">{{ __('home.logout') }}</button>
                    </form>
                @elseif(auth('web')->check())
                    <a href="{{ route('dashboarduser') }}">{{ __('home.my_account') }}</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">{{ __('home.logout') }}</button>
                    </form>
                @else
                    <a href="{{ route('login.form') }}">{{ __('login.login') }}</a>
                    <a class="button" href="{{ route('register.form') }}">{{ __('home.Register') }}</a>
                @endauth
                <div class="language-switch" aria-label="{{ __('home.language') }}">
                    <a href="{{ url('/lang/en') }}" @if(app()->getLocale() === 'en') aria-current="page" @endif>EN</a>
                    <span aria-hidden="true">/</span>
                    <a href="{{ url('/lang/ar') }}" @if(app()->getLocale() === 'ar') aria-current="page" @endif>AR</a>
                </div>
                <details class="mobile-menu">
                    <summary aria-label="{{ __('home.open_menu') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </summary>
                    <nav class="mobile-menu-panel" aria-label="{{ __('home.mobile_navigation') }}">
                        <a href="#our-promise">{{ __('home.nav_story') }}</a>
                        <a href="#menu">{{ __('home.nav_menu') }}</a>
                        @auth('admin')
                            <a href="{{ route('admin.product') }}">{{ __('product.Products') }}</a>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit">{{ __('home.logout') }}</button>
                            </form>
                        @elseif(auth('web')->check())
                            <a href="{{ route('dashboarduser') }}">{{ __('home.my_account') }}</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">{{ __('home.logout') }}</button>
                            </form>
                        @else
                            <a href="{{ route('login.form') }}">{{ __('login.login') }}</a>
                            <a href="{{ route('register.form') }}">{{ __('home.Register') }}</a>
                        @endauth
                    </nav>
                </details>
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container hero-grid">
                <div>
                    <p class="eyebrow">{{ __('home.hero_eyebrow') }}</p>
                    <h1>{{ __('home.hero_title') }} <span>{{ __('home.hero_title_highlight') }}</span></h1>
                    <p class="hero-copy">{{ __('home.hero_description') }}</p>
                    <div class="hero-buttons">
                        <a class="button" href="{{ route('product.list') }}">
                            {{ __('home.browse_menu') }}
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        @if(!Auth::guard('web')->check() && !Auth::guard('admin')->check())
                            <a class="button button-outline" href="{{ route('register.form') }}">{{ __('home.create_account') }}</a>
                        @endif
                    </div>
                    <p class="hero-note">
                        <span class="note-mark" aria-hidden="true">
                            <svg viewBox="0 0 16 16" fill="none"><path d="m3.5 8 3 3 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        {{ __('home.hero_note') }}
                    </p>
                </div>
                <div class="hero-photo">
                    <img src="{{ asset('images/resturant.jpg') }}" alt="{{ __('home.hero_image_alt') }}" fetchpriority="high">
                    <div class="photo-badge">{{ __('home.photo_badge') }}</div>
                </div>
            </div>
        </section>

        <section class="good-stuff" aria-label="{{ __('home.promise_heading') }}">
            <div class="container good-stuff-grid">
                <div class="good-stuff-item">
                    <span class="good-stuff-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 21s7-3.7 7-10V5l-7-3-7 3v6c0 6.3 7 10 7 10Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <div><strong>{{ __('home.promise_fresh_title') }}</strong><span>{{ __('home.promise_fresh_text') }}</span></div>
                </div>
                <div class="good-stuff-item">
                    <span class="good-stuff-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36 6.36-1.42-1.42M7.06 7.06 5.64 5.64m12.72 0-1.42 1.42M7.06 16.94l-1.42 1.42" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/></svg>
                    </span>
                    <div><strong>{{ __('home.promise_grilled_title') }}</strong><span>{{ __('home.promise_grilled_text') }}</span></div>
                </div>
                <div class="good-stuff-item">
                    <span class="good-stuff-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1L12 21l7.8-7.5 1.1-1.1a5.5 5.5 0 0 0-.1-7.8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                    </span>
                    <div><strong>{{ __('home.promise_happy_title') }}</strong><span>{{ __('home.promise_happy_text') }}</span></div>
                </div>
            </div>
        </section>

        <section class="story" id="our-promise">
            <div class="container story-grid">
                <div class="story-art" aria-hidden="true">
                    <div class="story-burger">🍔</div>
                    <span class="story-sticker">{{ __('home.story_sticker') }}</span>
                </div>
                <div>
                    <p class="eyebrow">{{ __('home.story_eyebrow') }}</p>
                    <h2>{{ __('home.story_title') }}</h2>
                    <p class="story-copy">{{ __('home.story_description') }}</p>
                    <a class="text-link" href="{{ route('product.list') }}">
                        {{ __('home.discover_food') }}
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>
        </section>

        <section class="menu-cta" id="menu">
            <div class="container menu-cta-inner">
                <div>
                    <p class="eyebrow">{{ __('home.menu_eyebrow') }}</p>
                    <h2>{{ __('home.menu_title') }}</h2>
                    <p>{{ __('home.menu_description') }}</p>
                </div>
                <a class="button" href="{{ route('product.list') }}">
                    {{ __('home.browse_menu') }}
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </span>
                <span>Happy Burger</span>
            </a>
            <p>© {{ date('Y') }} Happy Burger. {{ __('home.footer_note') }}</p>
            <div class="footer-links">
                <a href="{{ route('product.list') }}">{{ __('home.nav_menu') }}</a>
                @if(!Auth::guard('web')->check() && !Auth::guard('admin')->check())
                    <a href="{{ route('login.form') }}">{{ __('login.login') }}</a>
                @endif
            </div>
        </div>
    </footer>
</body>
</html>
