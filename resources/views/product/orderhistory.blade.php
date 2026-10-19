<x-layouts>
  <style>
    .order-history {
      --order-ink: #28231f;
      --order-muted: #70665e;
      --order-paper: #fffaf2;
      --order-cream: #f6eddf;
      --order-orange: #e95e2f;
      --order-line: rgba(40, 35, 31, .1);
      padding: 20px 12px 54px;
      color: var(--order-ink);
    }

    .order-history * { box-sizing: border-box; }
    .order-history a { text-decoration: none; }
    .order-history .history-shell { width: min(1050px, 100%); margin: 0 auto; }
    .order-history .history-hero {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      overflow: hidden;
      margin: 0 0 26px;
      padding: clamp(25px, 5vw, 43px);
      border-radius: 22px;
      color: white;
      background: var(--order-ink);
    }
    .order-history .history-hero::after {
      position: absolute;
      inset: 0 0 0 auto;
      width: 44%;
      background: linear-gradient(90deg, var(--order-ink), transparent), url("{{ asset('images/resturant.jpg') }}") center 55% / cover;
      content: "";
      opacity: .6;
    }
    .order-history .hero-copy { position: relative; z-index: 1; max-width: 580px; }
    .order-history .eyebrow {
      margin: 0 0 10px;
      color: #f8c84e;
      font-size: .73rem;
      font-weight: 800;
      letter-spacing: .12em;
      text-transform: uppercase;
    }
    .order-history h1 {
      margin: 0 0 10px;
      color: white;
      font-size: clamp(2rem, 4vw, 3.2rem);
      line-height: 1;
      letter-spacing: -.06em;
    }
    .order-history .hero-copy > p:last-child { margin: 0; color: rgba(255,255,255,.76); font-size: .92rem; line-height: 1.6; }
    .order-history .hero-action {
      position: relative;
      z-index: 1;
      flex: 0 0 auto;
      display: inline-flex;
      min-height: 43px;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 0 17px;
      border-radius: 999px;
      color: var(--order-ink);
      background: #f8c84e;
      font-size: .85rem;
      font-weight: 800;
      transition: transform .18s, background .18s;
    }
    .order-history .hero-action:hover { transform: translateY(-2px); background: #ffda75; }
    .order-history .hero-action svg { width: 17px; height: 17px; }
    .order-history .notice {
      margin-bottom: 18px;
      padding: 14px 17px;
      border: 1px solid #b6e0c1;
      border-radius: 12px;
      color: #176b38;
      background: #f0fbf3;
      font-size: .88rem;
      font-weight: 700;
    }
    .order-history .notice-error { border-color: #f3c6c2; color: #b42318; background: #fff3f1; }
    .order-history .history-heading {
      display: flex;
      align-items: end;
      justify-content: space-between;
      gap: 16px;
      margin: 0 0 16px;
    }
    .order-history .history-heading .eyebrow { margin-bottom: 6px; color: var(--order-orange); }
    .order-history h2 { margin: 0; color: var(--order-ink); font-size: 1.55rem; letter-spacing: -.045em; }
    .order-history .order-count { color: var(--order-muted); font-size: .82rem; }
    .order-history .orders { display: grid; gap: 15px; }
    .order-history .order-card {
      overflow: hidden;
      border: 1px solid var(--order-line);
      border-radius: 16px;
      background: white;
      box-shadow: 0 6px 20px rgba(40,35,31,.045);
    }
    .order-history .order-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 17px 20px;
      border-bottom: 1px solid var(--order-line);
      background: #fffdf9;
    }
    .order-history .order-reference { display: flex; align-items: center; gap: 13px; min-width: 0; }
    .order-history .order-icon {
      width: 41px;
      height: 41px;
      display: grid;
      flex: 0 0 auto;
      place-items: center;
      border-radius: 12px;
      color: #a53c20;
      background: var(--order-cream);
    }
    .order-history .order-icon svg { width: 22px; height: 22px; }
    .order-history .order-label { display: block; margin-bottom: 3px; color: var(--order-muted); font-size: .73rem; }
    .order-history .order-id { display: block; font-size: .98rem; font-weight: 900; }
    .order-history .order-date { color: var(--order-muted); font-size: .78rem; text-align: end; white-space: nowrap; }
    .order-history .order-content { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 22px; padding: 19px 20px; }
    .order-history .items-label { margin: 0 0 10px; color: var(--order-muted); font-size: .74rem; font-weight: 800; letter-spacing: .04em; text-transform: uppercase; }
    .order-history .items { display: grid; gap: 8px; }
    .order-history .item { display: flex; align-items: baseline; justify-content: space-between; gap: 16px; font-size: .88rem; }
    .order-history .item-name { min-width: 0; font-weight: 700; }
    .order-history .item-quantity { margin-inline-start: 5px; color: var(--order-muted); font-size: .79rem; font-weight: 500; }
    .order-history .item-price { flex: 0 0 auto; color: var(--order-muted); font-size: .84rem; }
    .order-history .missing-item { color: var(--order-muted); font-style: italic; }
    .order-history .order-summary { min-width: 180px; display: flex; flex-direction: column; align-items: flex-end; justify-content: center; gap: 12px; }
    .order-history .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 7px 11px;
      border-radius: 999px;
      color: #855800;
      background: #fff4d3;
      font-size: .76rem;
      font-weight: 800;
      text-transform: capitalize;
    }
    .order-history .status-pill::before { width: 7px; height: 7px; border-radius: 50%; background: currentColor; content: ""; }
    .order-history .status-delivered { color: #176b38; background: #e7f7eb; }
    .order-history .status-cancel { color: #a72e25; background: #fff0ee; }
    .order-history .status-preparing, .order-history .status-out { color: #315c9b; background: #edf4ff; }
    .order-history .total-label { color: var(--order-muted); font-size: .76rem; }
    .order-history .total { font-size: 1.08rem; font-weight: 900; }
    .order-history .track-link {
      min-height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      padding: 0 14px;
      border: 1px solid rgba(233,94,47,.26);
      border-radius: 999px;
      color: #b64625;
      background: white;
      font-size: .79rem;
      font-weight: 800;
      transition: background .18s, color .18s;
    }
    .order-history .track-link:hover { color: white; background: var(--order-orange); }
    .order-history .track-link svg { width: 15px; height: 15px; }
    .order-history .empty-state {
      padding: 54px 22px;
      border: 1px dashed rgba(40,35,31,.18);
      border-radius: 18px;
      background: white;
      text-align: center;
    }
    .order-history .empty-icon {
      width: 57px;
      height: 57px;
      display: grid;
      place-items: center;
      margin: 0 auto 14px;
      border-radius: 50%;
      color: #a53c20;
      background: var(--order-cream);
    }
    .order-history .empty-icon svg { width: 26px; height: 26px; }
    .order-history .empty-state h3 { margin: 0 0 8px; color: var(--order-ink); font-size: 1.24rem; }
    .order-history .empty-state p { margin: 0 auto 18px; color: var(--order-muted); font-size: .88rem; }
    .order-history .shop-link {
      min-height: 43px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0 18px;
      border-radius: 999px;
      color: white;
      background: var(--order-orange);
      font-size: .84rem;
      font-weight: 800;
    }
    .order-history .shop-link:hover { background: #c64620; }
    @media (max-width: 620px) {
      .order-history { padding: 12px 4px 38px; }
      .order-history .history-hero { align-items: flex-start; flex-direction: column; gap: 17px; border-radius: 17px; }
      .order-history .history-hero::after { width: 55%; opacity: .35; }
      .order-history .order-top { align-items: flex-start; padding: 14px; }
      .order-history .order-content { grid-template-columns: 1fr; gap: 17px; padding: 15px; }
      .order-history .order-summary { min-width: 0; align-items: center; justify-content: space-between; flex-direction: row; flex-wrap: wrap; padding-top: 13px; border-top: 1px solid var(--order-line); }
      .order-history .history-heading { align-items: flex-start; flex-direction: column; gap: 5px; }
    }
    @media (prefers-reduced-motion: reduce) {
      .order-history *, .order-history *::before, .order-history *::after { transition-duration: .01ms !important; }
    }
  </style>

  <section class="order-history">
    <div class="history-shell">
      <div class="history-hero">
        <div class="hero-copy">
          <p class="eyebrow">{{ __('product.orders_eyebrow') }}</p>
          <h1>{{ __('product.order_history_title') }}</h1>
          <p>{{ __('product.order_history_intro') }}</p>
        </div>
        <a class="hero-action" href="{{ route('product.list') }}">
          {{ __('product.browse_menu') }}
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      @if(session('success'))
        <div class="notice" role="status">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="notice notice-error" role="alert">{{ session('error') }}</div>
      @endif

      <div class="history-heading">
        <div>
          <p class="eyebrow">{{ __('product.past_orders_eyebrow') }}</p>
          <h2>{{ __('product.past_orders_title') }}</h2>
        </div>
        <span class="order-count">{{ trans_choice('product.order_count', $orders->count(), ['count' => $orders->count()]) }}</span>
      </div>

      @if($orders->isNotEmpty())
        <div class="orders">
          @foreach($orders as $order)
            @php
              $status = $order->latestStatus?->name ?? 'pending';
              $statusClass = match (strtolower($status)) {
                  'delivered' => 'status-delivered',
                  'cancel', 'cancelled' => 'status-cancel',
                  'preparing' => 'status-preparing',
                  'out delivery' => 'status-out',
                  default => '',
              };
              $orderTotal = $order->orderitemsProduct->sum(fn ($item) => (float) $item->price * $item->quantity);
            @endphp
            <article class="order-card">
              <div class="order-top">
                <div class="order-reference">
                  <span class="order-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                  </span>
                  <span>
                    <span class="order-label">{{ __('product.order_number') }}</span>
                    <span class="order-id">#{{ $order->id }}</span>
                  </span>
                </div>
                <time class="order-date" datetime="{{ $order->created_at->toIso8601String() }}">
                  {{ $order->created_at->format('M j, Y · g:i A') }}
                </time>
              </div>
              <div class="order-content">
                <div>
                  <p class="items-label">{{ __('product.order_items') }}</p>
                  @if($order->orderitemsProduct->isNotEmpty())
                    <div class="items">
                      @foreach($order->orderitemsProduct as $item)
                        <div class="item">
                          <span class="item-name">
                            @if($item->product)
                              {{ $item->product->name }}
                            @else
                              <span class="missing-item">{{ __('product.item_unavailable') }}</span>
                            @endif
                            <span class="item-quantity">× {{ $item->quantity }}</span>
                          </span>
                          <span class="item-price">${{ number_format((float) $item->price * $item->quantity, 2) }}</span>
                        </div>
                      @endforeach
                    </div>
                  @else
                    <span class="missing-item">{{ __('product.no_order_items') }}</span>
                  @endif
                </div>
                <div class="order-summary">
                  <span class="status-pill {{ $statusClass }}">{{ __('product.status_' . str_replace(' ', '_', strtolower($status))) }}</span>
                  <span>
                    <span class="total-label">{{ __('product.order_total') }}</span><br>
                    <span class="total">${{ number_format($orderTotal, 2) }}</span>
                  </span>
                  <a class="track-link" href="{{ route('ordertracking', ['id' => $order->id]) }}">
                    {{ __('product.track_order') }}
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  </a>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @else
        <div class="empty-state">
          <span class="empty-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none"><path d="M4 9.5c.7-3.1 3.3-5 8-5s7.3 1.9 8 5M4 12h16m-14 3h12m-11 3h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
          </span>
          <h3>{{ __('product.no_orders_yet') }}</h3>
          <p>{{ __('product.no_orders_hint') }}</p>
          <a class="shop-link" href="{{ route('product.list') }}">{{ __('product.start_ordering') }}</a>
        </div>
      @endif
    </div>
  </section>
</x-layouts>
