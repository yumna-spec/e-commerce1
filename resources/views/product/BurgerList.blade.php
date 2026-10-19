<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fffaf2">
    <title>{{ __('product.menu_title') }} — Happy Burger</title>
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
        body { margin: 0; color: var(--ink); background: var(--paper); }
        a { color: inherit; text-decoration: none; }
        button, input, select { font: inherit; }
        .container { width: min(1160px, calc(100% - 48px)); margin: 0 auto; }
        .announcement { padding: 10px 20px; color: var(--paper); background: var(--ink); text-align: center; font-size: .74rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        .site-header { background: var(--paper); }
        .nav-wrap { min-height: 78px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-size: 1.15rem; font-weight: 900; letter-spacing: -.05em; white-space: nowrap; }
        .brand-mark { width: 35px; height: 35px; display: grid; place-items: center; border-radius: 50%; background: var(--yellow); }
        .brand-mark svg { width: 20px; height: 20px; }
        .nav-links, .nav-actions { display: flex; align-items: center; gap: 22px; }
        .nav-links a, .nav-actions a, .nav-actions button { font-size: .87rem; font-weight: 700; }
        .nav-links a, .nav-actions > a:not(.button) { color: var(--muted); }
        .nav-links a:hover, .nav-actions > a:not(.button):hover { color: var(--orange-dark); }
        .nav-actions form { margin: 0; }
        .nav-actions button { padding: 0; border: 0; color: var(--muted); background: transparent; cursor: pointer; }
        .button { min-height: 43px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 0 18px; border: 0; border-radius: 999px; color: white; background: var(--orange); font-size: .87rem; font-weight: 800; cursor: pointer; transition: transform .18s, background .18s; }
        .button:hover { transform: translateY(-1px); background: var(--orange-dark); }
        .button svg { width: 17px; height: 17px; }
        .hero { position: relative; padding: 51px 0 91px; overflow: hidden; color: white; background: var(--ink); }
        .hero::before { position: absolute; inset: 0; background: linear-gradient(90deg, rgba(31,26,22,.94), rgba(31,26,22,.80) 50%, rgba(31,26,22,.36)), url("{{ asset('images/resturant.jpg') }}") center 46% / cover; content: ""; }
        .hero-inner { position: relative; }
        .eyebrow { margin: 0 0 13px; color: var(--yellow); font-size: .73rem; font-weight: 900; letter-spacing: .14em; text-transform: uppercase; }
        h1 { max-width: 700px; margin: 0 0 13px; font-size: clamp(2.8rem, 6vw, 5.3rem); line-height: .98; letter-spacing: -.075em; }
        .hero-copy { max-width: 560px; margin: 0; color: rgba(255,255,255,.78); font-size: 1.02rem; line-height: 1.7; }
        .hero-count { display: inline-flex; align-items: center; gap: 8px; margin-top: 23px; padding: 9px 13px; border: 1px solid rgba(255,255,255,.2); border-radius: 999px; color: white; font-size: .82rem; font-weight: 700; }
        .hero-count svg { width: 16px; height: 16px; color: var(--yellow); }
        .sample-note { display: inline-block; margin-top: 12px; padding: 8px 12px; border: 1px solid rgba(248,200,78,.45); border-radius: 9px; color: #fff2c9; background: rgba(248,200,78,.1); font-size: .78rem; line-height: 1.5; }
        .menu-area { padding: 0 0 74px; }
        .filter-card { position: relative; z-index: 1; display: grid; grid-template-columns: minmax(200px, 1.6fr) repeat(3, minmax(130px, .9fr)) auto; align-items: end; gap: 13px; margin-top: -40px; padding: 20px; border: 1px solid rgba(40,35,31,.08); border-radius: 18px; background: white; box-shadow: 0 16px 40px rgba(40,35,31,.12); }
        .filter-field label { display: block; margin: 0 0 7px; color: var(--muted); font-size: .75rem; font-weight: 800; }
        .filter-field input, .filter-field select { width: 100%; height: 45px; padding: 0 12px; border: 1px solid var(--line); border-radius: 10px; outline: none; color: var(--ink); background: white; font-size: .88rem; }
        .filter-field input:focus, .filter-field select:focus { border-color: var(--orange); box-shadow: 0 0 0 3px rgba(233,94,47,.12); }
        .search-wrap { position: relative; }
        .search-wrap svg { position: absolute; top: 14px; inset-inline-start: 13px; width: 17px; height: 17px; color: var(--muted); pointer-events: none; }
        .search-wrap input { padding-inline-start: 39px; }
        .filter-actions { display: flex; align-items: center; gap: 12px; }
        .filter-actions .button { height: 45px; padding: 0 19px; }
        .clear-link { color: var(--muted); font-size: .79rem; font-weight: 700; white-space: nowrap; }
        .clear-link:hover { color: var(--orange-dark); }
        .results-heading { display: flex; align-items: end; justify-content: space-between; gap: 16px; margin: 40px 0 19px; }
        .results-heading .eyebrow { margin-bottom: 7px; color: var(--orange-dark); }
        h2 { margin: 0; font-size: clamp(1.7rem, 3vw, 2.3rem); letter-spacing: -.06em; }
        .results-count { color: var(--muted); font-size: .84rem; }
        .success-alert { margin-bottom: 20px; padding: 13px 16px; border: 1px solid #b6e0c1; border-radius: 12px; color: #176b38; background: #f0fbf3; font-size: .88rem; font-weight: 700; }
        .error-alert { margin-top: 18px; padding: 13px 16px; border: 1px solid #f3c6c2; border-radius: 12px; color: #b42318; background: #fff3f1; font-size: .88rem; font-weight: 700; }
        .product-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 23px; }
        .product-card { min-width: 0; overflow: hidden; border: 1px solid rgba(40,35,31,.08); border-radius: 18px; background: white; box-shadow: 0 7px 25px rgba(40,35,31,.055); transition: transform .2s, box-shadow .2s; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 15px 35px rgba(40,35,31,.12); }
        .product-photo { position: relative; height: 220px; overflow: hidden; background: var(--cream); }
        .product-photo img { width: 100%; height: 100%; display: block; object-fit: cover; transition: transform .35s; }
        .product-card:hover .product-photo img { transform: scale(1.04); }
        .category-tag { position: absolute; top: 13px; inset-inline-start: 13px; max-width: calc(100% - 26px); overflow: hidden; padding: 7px 11px; border-radius: 999px; color: var(--ink); background: rgba(255,250,242,.95); font-size: .72rem; font-weight: 800; text-overflow: ellipsis; white-space: nowrap; }
        .featured-tag { position: absolute; top: 13px; inset-inline-end: 13px; padding: 7px 10px; border-radius: 999px; color: var(--ink); background: var(--yellow); font-size: .7rem; font-weight: 900; }
        .product-body { display: flex; min-height: 208px; flex-direction: column; padding: 19px; }
        .product-title-row { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
        .product-title { margin: 0; font-size: 1.16rem; line-height: 1.25; letter-spacing: -.035em; }
        .price { flex: 0 0 auto; color: var(--orange-dark); font-size: 1.05rem; font-weight: 900; white-space: nowrap; }
        .description { display: -webkit-box; min-height: 42px; margin: 10px 0 18px; overflow: hidden; color: var(--muted); font-size: .86rem; line-height: 1.6; -webkit-box-orient: vertical; -webkit-line-clamp: 2; }
        .order-row { display: flex; align-items: center; gap: 9px; margin-top: auto; }
        .quantity { width: 66px; height: 42px; padding: 0 8px; border: 1px solid var(--line); border-radius: 10px; color: var(--ink); background: white; text-align: center; }
        .order-row .button { flex: 1; min-width: 0; }
        .sign-in-order { width: 100%; margin-top: auto; }
        .visually-hidden { position: absolute; width: 1px; height: 1px; padding: 0; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
        .empty-state { padding: 65px 20px; border: 1px dashed rgba(40,35,31,.2); border-radius: 18px; background: white; text-align: center; }
        .empty-icon { width: 55px; height: 55px; display: grid; place-items: center; margin: 0 auto 14px; border-radius: 50%; color: var(--orange-dark); background: var(--cream); }
        .empty-icon svg { width: 25px; height: 25px; }
        .empty-state h3 { margin: 0 0 8px; font-size: 1.3rem; }
        .empty-state p { margin: 0 0 18px; color: var(--muted); font-size: .9rem; }
        .site-footer { padding: 23px 0; border-top: 1px solid var(--line); }
        .footer-inner { display: flex; align-items: center; justify-content: space-between; gap: 18px; color: var(--muted); font-size: .8rem; }
        .footer-inner p { margin: 0; }
        @media (max-width: 960px) {
            .filter-card { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .filter-actions { grid-column: 1 / -1; justify-content: flex-end; }
            .product-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .nav-links { display: none; }
        }
        @media (max-width: 620px) {
            .container { width: calc(100% - 36px); }
            .announcement { font-size: .62rem; }
            .nav-wrap { min-height: 68px; }
            .brand { font-size: 1rem; }
            .nav-actions { gap: 12px; }
            .nav-actions > a:not(.button), .nav-actions form { display: none; }
            .nav-actions .button { min-height: 39px; padding: 0 13px; font-size: .8rem; }
            .hero { padding: 39px 0 76px; }
            .hero-copy { font-size: .93rem; }
            .menu-area { padding-bottom: 48px; }
            .filter-card { grid-template-columns: 1fr 1fr; gap: 11px; margin-top: -34px; padding: 15px; border-radius: 15px; }
            .filter-field:first-child { grid-column: 1 / -1; }
            .filter-actions { justify-content: space-between; }
            .results-heading { align-items: flex-start; flex-direction: column; margin-top: 31px; }
            .product-grid { grid-template-columns: 1fr; gap: 16px; }
            .product-photo { height: 230px; }
            .footer-inner { align-items: flex-start; flex-direction: column; }
        }
        @media (max-width: 380px) {
            .filter-card { grid-template-columns: 1fr; }
            .filter-field:first-child, .filter-actions { grid-column: auto; }
            .product-photo { height: 205px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <div class="announcement">{{ __('home.announcement') }}</div>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="Happy Burger home">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </span>
                <span>Happy Burger</span>
            </a>
            <nav class="nav-links" aria-label="{{ __('product.navigation') }}">
                <a href="{{ route('home') }}">{{ __('product.home') }}</a>
                @auth('web')
                    <a href="{{ route('dashboarduser') }}">{{ __('home.my_account') }}</a>
                    <a href="{{ route('order.user') }}">{{ __('product.my_orders') }}</a>
                @endauth
            </nav>
            <div class="nav-actions">
                @auth('web')
                    <a class="button" href="{{ route('cart.view') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 4h2l2.1 10.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L20 8H6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="20" r="1" fill="currentColor"/><circle cx="17" cy="20" r="1" fill="currentColor"/></svg>
                        {{ __('product.View Cart') }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">{{ __('home.logout') }}</button>
                    </form>
                @else
                    <a href="{{ route('login.form') }}">{{ __('login.login') }}</a>
                    <a class="button" href="{{ route('register.form') }}">{{ __('home.Register') }}</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container hero-inner">
                <p class="eyebrow">{{ __('product.menu_eyebrow') }}</p>
                <h1>{{ __('product.menu_title') }}</h1>
                <p class="hero-copy">{{ __('product.menu_description') }}</p>
                <span class="hero-count">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    {{ trans_choice('product.menu_item_count', $products->count(), ['count' => $products->count()]) }}
                </span>
                @if($products->contains(fn ($product) => $product->category_name === 'Sample Burgers'))
                    <p class="sample-note">{{ __('product.sample_menu_note') }}</p>
                @endif
            </div>
        </section>

        <section class="menu-area">
            <div class="container">
                <form class="filter-card" action="{{ route('product.list') }}" method="GET">
                    <div class="filter-field">
                        <label for="menu-search">{{ __('product.search_label') }}</label>
                        <div class="search-wrap">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="1.8"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                            <input id="menu-search" type="search" name="search" value="{{ request('search') }}" placeholder="{{ __('product.search_placeholder') }}">
                        </div>
                    </div>
                    <div class="filter-field">
                        <label for="category">{{ __('product.category_filter') }}</label>
                        <select id="category" name="category">
                            <option value="">{{ __('product.all_categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category === 'Sample Burgers' ? __('product.sample_category') : $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-field">
                        <label for="max-price">{{ __('product.max_price') }}</label>
                        <input id="max-price" type="number" name="max_price" value="{{ request('max_price') }}" min="0" step="0.01" placeholder="{{ __('product.any_price') }}">
                    </div>
                    <div class="filter-field">
                        <label for="sort">{{ __('product.sort_by') }}</label>
                        <select id="sort" name="sort">
                            <option value="featured" @selected(request('sort', 'featured') === 'featured')>{{ __('product.sort_featured') }}</option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>{{ __('product.sort_price_low') }}</option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>{{ __('product.sort_price_high') }}</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <a class="clear-link" href="{{ route('product.list') }}">{{ __('product.clear_filters') }}</a>
                        <button class="button" type="submit">{{ __('product.apply_filters') }}</button>
                    </div>
                </form>

                @if($errors->any())
                    <div class="error-alert" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                @session('success')
                    <div class="success-alert" role="status">{{ session('success') }}</div>
                @endsession

                <div class="results-heading">
                    <div>
                        <p class="eyebrow">{{ __('product.menu_section_eyebrow') }}</p>
                        <h2>{{ __('product.menu_section_title') }}</h2>
                    </div>
                    <span class="results-count">{{ trans_choice('product.results_count', $products->count(), ['count' => $products->count()]) }}</span>
                </div>

                @if($products->isNotEmpty())
                    <div class="product-grid">
                        @foreach($products as $product)
                            <article class="product-card">
                                <div class="product-photo">
                                    <img src="{{ $product->image ? asset(str_starts_with($product->image, 'images/') ? $product->image : 'storage/'.$product->image) : asset('images/resturant.jpg') }}" alt="{{ $product->name }}" loading="lazy">
                                    @if($product->category_name)
                                        <span class="category-tag">{{ $product->category_name === 'Sample Burgers' ? __('product.sample_category') : $product->category_name }}</span>
                                    @endif
                                    @if($product->Is_trend)
                                        <span class="featured-tag">{{ __('product.popular') }}</span>
                                    @endif
                                </div>
                                <div class="product-body">
                                    <div class="product-title-row">
                                        <h3 class="product-title">{{ $product->name }}</h3>
                                        <span class="price">${{ number_format((float) $product->price, 2) }}</span>
                                    </div>
                                    @if($product->description)
                                        <p class="description">{{ $product->description }}</p>
                                    @else
                                        <p class="description">{{ __('product.freshly_made') }}</p>
                                    @endif
                                    @auth('web')
                                        <form class="order-row" method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <label class="visually-hidden" for="quantity-{{ $product->id }}">{{ __('product.quantity') }} — {{ $product->name }}</label>
                                            <input class="quantity" id="quantity-{{ $product->id }}" type="number" name="quantity" value="1" min="1" aria-label="{{ __('product.quantity') }}" required>
                                            <button class="button" type="submit">
                                                {{ __('product.order_now') }}
                                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </button>
                                        </form>
                                    @else
                                        <a class="button sign-in-order" href="{{ route('login.form') }}">{{ __('product.sign_in_to_order') }}</a>
                                    @endauth
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <span class="empty-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </span>
                        <h3>{{ __('product.no_menu_results') }}</h3>
                        <p>{{ __('product.no_menu_results_hint') }}</p>
                        <a class="button" href="{{ route('product.list') }}">{{ __('product.clear_filters') }}</a>
                    </div>
                @endif
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
            <a href="{{ route('home') }}">{{ __('product.back_home') }}</a>
        </div>
    </footer>
</body>
</html>
