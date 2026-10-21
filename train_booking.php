<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RailBook — Train Ticket Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --navy: #0B1426;
    --navy-mid: #132040;
    --navy-light: #1E3060;
    --saffron: #FF6B00;
    --saffron-light: #FF8A30;
    --amber: #FFA500;
    --cream: #FDF6EC;
    --cream-dim: #F5EDD8;
    --white: #FFFFFF;
    --green: #22C55E;
    --red: #EF4444;
    --text-main: #0B1426;
    --text-muted: #5A6A8A;
    --text-light: #8A9BBF;
    --border: #D1DAEA;
    --border-light: #EBF0F8;
    --bg: #F0F4FA;
    --card: #FFFFFF;
    --font-head: 'Syne', sans-serif;
    --font-body: 'DM Sans', sans-serif;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: var(--font-body);
    background: var(--bg);
    color: var(--text-main);
    min-height: 100vh;
  }

  /* HEADER */
  .header {
    background: var(--navy);
    padding: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 60px;
    position: sticky;
    top: 0;
    z-index: 100;
  }
  .logo {
    font-family: var(--font-head);
    font-size: 22px;
    font-weight: 800;
    color: var(--white);
    letter-spacing: -0.5px;
  }
  .logo span { color: var(--saffron); }
  .header-nav { display: flex; gap: 1.5rem; }
  .header-nav a {
    color: rgba(255,255,255,0.6);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s;
  }
  .header-nav a:hover { color: var(--white); }

  /* STEP PROGRESS */
  .step-bar {
    background: var(--navy-mid);
    padding: 0.75rem 2rem;
  }
  .step-list {
    display: flex;
    gap: 0;
    max-width: 700px;
    margin: 0 auto;
    align-items: center;
  }
  .step-item {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
    position: relative;
  }
  .step-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 28px;
    right: -4px;
    top: 50%;
    height: 1px;
    background: rgba(255,255,255,0.15);
    z-index: 0;
  }
  .step-item.done::after { background: var(--saffron); opacity: 0.5; }
  .step-circle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 600;
    color: rgba(255,255,255,0.4);
    z-index: 1;
    flex-shrink: 0;
    transition: all 0.3s;
  }
  .step-item.active .step-circle {
    background: var(--saffron);
    border-color: var(--saffron);
    color: var(--white);
  }
  .step-item.done .step-circle {
    background: rgba(34,197,94,0.2);
    border-color: var(--green);
    color: var(--green);
  }
  .step-label {
    font-size: 11px;
    font-weight: 500;
    color: rgba(255,255,255,0.35);
    white-space: nowrap;
  }
  .step-item.active .step-label { color: var(--white); }
  .step-item.done .step-label { color: rgba(255,255,255,0.6); }

  /* HERO BAND */
  .hero-band {
    background: var(--navy);
    padding: 2.5rem 2rem 3rem;
  }
  .hero-band h1 {
    font-family: var(--font-head);
    font-size: 28px;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 4px;
  }
  .hero-band p {
    font-size: 14px;
    color: rgba(255,255,255,0.5);
  }

  /* SEARCH CARD */
  .search-card {
    background: var(--card);
    border-radius: 16px;
    padding: 1.75rem;
    max-width: 900px;
    margin: -1.5rem auto 0;
    position: relative;
    border: 1px solid var(--border-light);
    box-shadow: 0 4px 20px rgba(11,20,38,0.08);
  }

  .main-wrap {
    max-width: 960px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
  }

  .field-row {
    display: grid;
    gap: 12px;
  }
  .field-row-2 { grid-template-columns: 1fr 1fr; }
  .field-row-3 { grid-template-columns: 1fr 1fr 1fr; }
  .field-row-4 { grid-template-columns: 1fr 1fr 1fr 1fr; }

  .station-row {
    display: grid;
    grid-template-columns: 1fr 48px 1fr;
    gap: 0;
    align-items: center;
    margin-bottom: 12px;
  }

  .field-group { display: flex; flex-direction: column; gap: 5px; position: relative; }
  .field-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
  }
  .field-input {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-family: var(--font-body);
    font-size: 14px;
    color: var(--text-main);
    background: var(--white);
    outline: none;
    transition: border-color 0.2s;
  }
  .field-input:focus { border-color: var(--saffron); }
  .field-input.station { font-size: 15px; font-weight: 500; }
  select.field-input { appearance: none; cursor: pointer; }

  .swap-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--navy);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    margin-top: 22px;
    transition: background 0.2s, transform 0.2s;
  }
  .swap-btn:hover { background: var(--saffron); transform: rotate(180deg); }
  .swap-btn svg { width: 16px; height: 16px; fill: none; stroke: white; stroke-width: 2; }

  .autocomplete-list {
    position: absolute;
    top: calc(100% + 4px);
    left: 0; right: 0;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 10px;
    z-index: 50;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(11,20,38,0.1);
  }
  .autocomplete-item {
    padding: 10px 14px;
    font-size: 13px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    gap: 2px;
    transition: background 0.15s;
  }
  .autocomplete-item:hover { background: var(--bg); }
  .autocomplete-item .station-code {
    font-size: 11px;
    font-weight: 700;
    color: var(--saffron);
    letter-spacing: 1px;
  }
  .autocomplete-item .station-full { color: var(--text-main); font-weight: 500; }
  .autocomplete-item .station-state { color: var(--text-muted); font-size: 11px; }

  .search-btn {
    width: 100%;
    padding: 13px;
    background: var(--saffron);
    border: none;
    border-radius: 10px;
    font-family: var(--font-head);
    font-size: 15px;
    font-weight: 700;
    color: var(--white);
    cursor: pointer;
    letter-spacing: 0.3px;
    transition: background 0.2s;
    margin-top: 4px;
  }
  .search-btn:hover { background: var(--saffron-light); }

  /* RESULTS */
  .results-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.25rem;
  }
  .results-title {
    font-family: var(--font-head);
    font-size: 18px;
    font-weight: 700;
  }
  .results-subtitle { font-size: 13px; color: var(--text-muted); margin-top: 2px; }

  .train-card {
    background: var(--card);
    border-radius: 14px;
    border: 1px solid var(--border-light);
    margin-bottom: 12px;
    overflow: hidden;
    transition: border-color 0.2s;
  }
  .train-card:hover { border-color: var(--saffron); }

  .train-main {
    padding: 1.25rem 1.5rem;
    display: grid;
    grid-template-columns: 1fr auto 1fr auto;
    gap: 1rem;
    align-items: center;
  }
  .train-name { font-family: var(--font-head); font-size: 15px; font-weight: 700; }
  .train-number { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
  .train-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 6px;
    margin-top: 5px;
    letter-spacing: 0.3px;
  }
  .badge-sf { background: #FFF3E8; color: #C85000; }
  .badge-exp { background: #E8F4FF; color: #1055A0; }
  .badge-raj { background: #FDF0FF; color: #7000AA; }

  .time-block { text-align: center; }
  .time-big { font-family: var(--font-head); font-size: 22px; font-weight: 700; }
  .time-station { font-size: 11px; color: var(--text-muted); font-weight: 500; letter-spacing: 0.5px; }

  .duration-block { text-align: center; }
  .duration-line {
    display: flex; align-items: center; gap: 6px; margin-bottom: 3px;
  }
  .dur-dot {
    width: 6px; height: 6px; border-radius: 50%; background: var(--saffron);
  }
  .dur-track { flex: 1; height: 1px; background: var(--border); position: relative; }
  .dur-track::after {
    content: '';
    position: absolute;
    right: 0; top: -2px;
    width: 0; height: 0;
    border-style: solid;
    border-width: 3px 0 3px 5px;
    border-color: transparent transparent transparent var(--border);
  }
  .duration-text { font-size: 12px; color: var(--text-muted); font-weight: 500; }
  .stops-text { font-size: 11px; color: var(--text-light); }

  .class-grid {
    display: flex; gap: 8px; flex-wrap: wrap; justify-content: flex-end;
  }
  .class-pill {
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 6px 10px;
    cursor: pointer;
    transition: all 0.15s;
    text-align: center;
    min-width: 72px;
  }
  .class-pill:hover { border-color: var(--saffron); }
  .class-pill.selected { border-color: var(--saffron); background: #FFF5EB; }
  .class-pill .cls-name { font-size: 11px; font-weight: 700; color: var(--text-muted); letter-spacing: 0.3px; }
  .class-pill .cls-price { font-size: 14px; font-weight: 700; color: var(--text-main); }
  .class-pill .cls-avail { font-size: 10px; }
  .avail-green { color: var(--green); }
  .avail-red { color: var(--red); }
  .avail-orange { color: var(--amber); }

  .train-footer {
    padding: 0.7rem 1.5rem;
    background: var(--bg);
    border-top: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .train-footer-info { font-size: 12px; color: var(--text-muted); display: flex; gap: 12px; }
  .book-btn {
    padding: 9px 22px;
    background: var(--saffron);
    border: none;
    border-radius: 8px;
    font-family: var(--font-head);
    font-size: 13px;
    font-weight: 700;
    color: var(--white);
    cursor: pointer;
    transition: background 0.2s;
  }
  .book-btn:hover { background: var(--saffron-light); }

  /* PASSENGER FORM */
  .pax-card {
    background: var(--card);
    border-radius: 14px;
    border: 1px solid var(--border-light);
    margin-bottom: 1rem;
    overflow: hidden;
  }
  .pax-card-header {
    padding: 0.9rem 1.25rem;
    background: var(--navy);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .pax-card-header h3 { font-family: var(--font-head); font-size: 14px; color: var(--white); font-weight: 700; }
  .pax-card-body { padding: 1.25rem; }

  .seat-map {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-top: 8px;
  }
  .seat-btn {
    width: 42px; height: 36px;
    border-radius: 6px;
    border: 1.5px solid var(--border);
    font-size: 10px;
    font-weight: 600;
    cursor: pointer;
    background: var(--white);
    color: var(--text-muted);
    transition: all 0.15s;
  }
  .seat-btn:hover { border-color: var(--saffron); color: var(--saffron); }
  .seat-btn.taken { background: var(--bg); color: var(--text-light); cursor: not-allowed; border-color: var(--border-light); }
  .seat-btn.selected { background: var(--saffron); border-color: var(--saffron); color: var(--white); }

  /* PAYMENT */
  .pay-method {
    border: 1.5px solid var(--border);
    border-radius: 10px;
    padding: 1rem 1.25rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.15s;
    margin-bottom: 8px;
    background: var(--card);
  }
  .pay-method:hover { border-color: var(--saffron); }
  .pay-method.active { border-color: var(--saffron); background: #FFF8F2; }
  .pay-icon {
    width: 40px; height: 40px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    font-weight: 700;
    flex-shrink: 0;
  }
  .pay-title { font-weight: 600; font-size: 14px; }
  .pay-sub { font-size: 12px; color: var(--text-muted); }
  .radio-dot {
    width: 18px; height: 18px;
    border-radius: 50%;
    border: 2px solid var(--border);
    margin-left: auto;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .pay-method.active .radio-dot {
    border-color: var(--saffron);
  }
  .pay-method.active .radio-dot::after {
    content: '';
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--saffron);
  }
  .upi-input-wrap {
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid var(--border-light);
  }

  /* SUMMARY BOX */
  .summary-box {
    background: var(--navy);
    border-radius: 14px;
    padding: 1.25rem;
    color: var(--white);
    position: sticky;
    top: 80px;
  }
  .summary-box h3 { font-family: var(--font-head); font-size: 14px; font-weight: 700; color: rgba(255,255,255,0.7); margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
  .summary-row { display: flex; justify-content: space-between; font-size: 13px; padding: 5px 0; border-bottom: 1px solid rgba(255,255,255,0.07); }
  .summary-row:last-child { border-bottom: none; }
  .summary-row .s-key { color: rgba(255,255,255,0.5); }
  .summary-total { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.15); }
  .summary-total .t-label { color: rgba(255,255,255,0.6); font-size: 13px; }
  .summary-total .t-amount { font-family: var(--font-head); font-size: 22px; font-weight: 800; color: var(--saffron); }

  /* CONFIRMATION */
  .confirm-hero {
    text-align: center;
    padding: 2rem 1rem;
  }
  .confirm-check {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: #ECFDF5;
    border: 2px solid var(--green);
    display: flex; align-items: center; justify-content: center;
    font-size: 32px;
    margin: 0 auto 1rem;
  }
  .pnr-box {
    background: var(--navy);
    border-radius: 12px;
    padding: 1.25rem;
    text-align: center;
    margin: 1.25rem 0;
  }
  .pnr-label { font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 1px; }
  .pnr-number { font-family: var(--font-head); font-size: 28px; font-weight: 800; color: var(--saffron); letter-spacing: 4px; }

  .ticket-card {
    background: var(--card);
    border-radius: 14px;
    border: 1px solid var(--border-light);
    overflow: hidden;
  }
  .ticket-top {
    background: var(--navy);
    padding: 1rem 1.25rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .ticket-body { padding: 1.25rem; }
  .ticket-route {
    display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;
  }
  .route-station { flex: 1; }
  .route-stn-name { font-family: var(--font-head); font-size: 16px; font-weight: 700; }
  .route-stn-time { font-size: 20px; font-weight: 700; color: var(--saffron); }
  .route-arrow { color: var(--text-light); font-size: 20px; }

  .detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 10px;
    background: var(--bg);
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1rem;
  }
  .detail-cell .d-key { font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
  .detail-cell .d-val { font-size: 13px; font-weight: 600; }

  .action-row {
    display: flex; gap: 10px; margin-top: 1rem;
  }
  .action-btn {
    flex: 1;
    padding: 11px;
    border-radius: 9px;
    font-family: var(--font-head);
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s;
  }
  .btn-outline {
    background: transparent;
    border: 1.5px solid var(--border);
    color: var(--text-main);
  }
  .btn-outline:hover { border-color: var(--navy); }
  .btn-primary {
    background: var(--saffron);
    border: none;
    color: var(--white);
  }
  .btn-primary:hover { background: var(--saffron-light); }

  /* LAYOUT */
  .content-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 1.5rem;
    align-items: start;
  }

  .section-title {
    font-family: var(--font-head);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .divider { height: 1px; background: var(--border-light); margin: 1rem 0; }

  .filter-bar {
    display: flex;
    gap: 8px;
    margin-bottom: 1rem;
    flex-wrap: wrap;
  }
  .filter-chip {
    padding: 6px 14px;
    border: 1px solid var(--border);
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    background: var(--card);
    transition: all 0.15s;
  }
  .filter-chip:hover { border-color: var(--saffron); }
  .filter-chip.on { background: var(--navy); color: var(--white); border-color: var(--navy); }

  .back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: var(--text-muted);
    cursor: pointer;
    margin-bottom: 1rem;
    padding: 6px 0;
    background: none;
    border: none;
    font-family: var(--font-body);
  }
  .back-btn:hover { color: var(--text-main); }

  /* RESPONSIVE */
  @media (max-width: 700px) {
    .field-row-2, .field-row-3, .field-row-4 { grid-template-columns: 1fr; }
    .train-main { grid-template-columns: 1fr 1fr; gap: 0.75rem; }
    .content-grid { grid-template-columns: 1fr; }
    .detail-grid { grid-template-columns: 1fr 1fr; }
    .header-nav { display: none; }
    .hero-band h1 { font-size: 22px; }
  }

  /* HIDDEN SECTIONS */
  .section { display: none; }
  .section.active { display: block; }

  /* PASSENGER COUNT */
  .counter {
    display: flex; align-items: center; gap: 10px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    padding: 8px 14px;
    background: var(--white);
    width: 120px;
  }
  .counter-btn {
    width: 24px; height: 24px;
    border-radius: 6px;
    border: 1px solid var(--border);
    background: var(--bg);
    cursor: pointer;
    font-size: 16px;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-main);
    transition: all 0.15s;
    line-height: 1;
  }
  .counter-btn:hover { border-color: var(--saffron); color: var(--saffron); }
  .counter-val { font-weight: 700; font-size: 15px; flex: 1; text-align: center; }

  /* Notification */
  .notify {
    position: fixed;
    bottom: 1.5rem; right: 1.5rem;
    background: var(--navy);
    color: var(--white);
    padding: 0.75rem 1.25rem;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    z-index: 999;
    transform: translateY(80px);
    opacity: 0;
    transition: all 0.3s;
  }
  .notify.show { transform: translateY(0); opacity: 1; }
</style>
</head>
<body>

<!-- HEADER -->
<header class="header">
  <div class="logo">Rail<span>Book</span></div>
  <nav class="header-nav">
    <a href="#">PNR Status</a>
    <a href="#">Train Info</a>
    <a href="#">My Bookings</a>
    <a href="#">Login</a>
  </nav>
</header>

<!-- STEP BAR -->
<div class="step-bar">
  <div class="step-list">
    <div class="step-item active" id="s1">
      <div class="step-circle">1</div>
      <span class="step-label">Search</span>
    </div>
    <div class="step-item" id="s2">
      <div class="step-circle">2</div>
      <span class="step-label">Trains</span>
    </div>
    <div class="step-item" id="s3">
      <div class="step-circle">3</div>
      <span class="step-label">Passengers</span>
    </div>
    <div class="step-item" id="s4">
      <div class="step-circle">4</div>
      <span class="step-label">Payment</span>
    </div>
    <div class="step-item" id="s5">
      <div class="step-circle">&#10003;</div>
      <span class="step-label">Confirm</span>
    </div>
  </div>
</div>

<!-- ===================== SECTION 1: SEARCH ===================== -->
<section class="section active" id="sec-search">
  <div class="hero-band">
    <h1>Book Train Tickets</h1>
    <p>Fast, reliable booking across 7000+ stations</p>
  </div>

  <div style="padding: 0 1.5rem 2.5rem; max-width: 960px; margin: 0 auto;">
    <div class="search-card">

      <!-- Station Row -->
      <div class="station-row">
        <div class="field-group" id="from-group">
          <label class="field-label">From</label>
          <input class="field-input station" id="from-input" placeholder="City or station" autocomplete="off" oninput="showSuggestions('from-input','from-list')">
          <div class="autocomplete-list" id="from-list" style="display:none"></div>
        </div>
        <div>
          <button class="swap-btn" onclick="swapStations()" title="Swap">
            <svg viewBox="0 0 24 24"><path d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4"/></svg>
          </button>
        </div>
        <div class="field-group" id="to-group">
          <label class="field-label">To</label>
          <input class="field-input station" id="to-input" placeholder="City or station" autocomplete="off" oninput="showSuggestions('to-input','to-list')">
          <div class="autocomplete-list" id="to-list" style="display:none"></div>
        </div>
      </div>

      <!-- Fields Row -->
      <div class="field-row field-row-4" style="margin-bottom:12px">
        <div class="field-group">
          <label class="field-label">Date of Journey</label>
          <input type="date" class="field-input" id="journey-date">
        </div>
        <div class="field-group">
          <label class="field-label">Class</label>
          <select class="field-input" id="journey-class">
            <option value="SL">Sleeper (SL)</option>
            <option value="3A">Third AC (3A)</option>
            <option value="2A">Second AC (2A)</option>
            <option value="1A">First AC (1A)</option>
            <option value="CC">Chair Car (CC)</option>
            <option value="EC">Exec Chair (EC)</option>
            <option value="2S">Second Sitting (2S)</option>
          </select>
        </div>
        <div class="field-group">
          <label class="field-label">Quota</label>
          <select class="field-input" id="journey-quota">
            <option>General</option>
            <option>Tatkal</option>
            <option>Premium Tatkal</option>
            <option>Ladies</option>
            <option>Senior Citizen</option>
            <option>Divyaang</option>
          </select>
        </div>
        <div class="field-group">
          <label class="field-label">Passengers</label>
          <div class="counter">
            <button class="counter-btn" onclick="changePax(-1)">−</button>
            <span class="counter-val" id="pax-count">1</span>
            <button class="counter-btn" onclick="changePax(1)">+</button>
          </div>
        </div>
      </div>

      <button class="search-btn" onclick="goToResults()">&#128269; Search Trains</button>
    </div>
  </div>
</section>

<!-- ===================== SECTION 2: RESULTS ===================== -->
<section class="section" id="sec-results">
  <div class="main-wrap">
    <button class="back-btn" onclick="goTo(1)">&#8592; Back to Search</button>

    <div class="results-header">
      <div>
        <div class="results-title" id="results-route-title">Mumbai → Delhi</div>
        <div class="results-subtitle" id="results-meta">Wed, 09 Apr 2025 · Sleeper · General · 1 Passenger</div>
      </div>
    </div>

    <div class="filter-bar">
      <span class="filter-chip on">All Trains</span>
      <span class="filter-chip">Before 6 AM</span>
      <span class="filter-chip">6 AM – Noon</span>
      <span class="filter-chip">Noon – 6 PM</span>
      <span class="filter-chip">After 6 PM</span>
      <span class="filter-chip">AC Only</span>
      <span class="filter-chip">Sleeper</span>
    </div>

    <div id="train-list"></div>
  </div>
</section>

<!-- ===================== SECTION 3: PASSENGERS ===================== -->
<section class="section" id="sec-passengers">
  <div class="main-wrap">
    <button class="back-btn" onclick="goTo(2)">&#8592; Back to Trains</button>

    <div class="content-grid">
      <div>
        <!-- Contact Info -->
        <div class="pax-card">
          <div class="pax-card-header">
            <h3>&#128222; Contact Information</h3>
          </div>
          <div class="pax-card-body">
            <div class="field-row field-row-2">
              <div class="field-group">
                <label class="field-label">Mobile Number</label>
                <input class="field-input" placeholder="10-digit mobile" type="tel" maxlength="10">
              </div>
              <div class="field-group">
                <label class="field-label">Email Address</label>
                <input class="field-input" placeholder="you@email.com" type="email">
              </div>
            </div>
          </div>
        </div>

        <!-- Passenger Cards -->
        <div id="pax-forms"></div>

        <!-- Seat Selection -->
        <div class="pax-card">
          <div class="pax-card-header">
            <h3>&#128189; Seat Preference</h3>
          </div>
          <div class="pax-card-body">
            <p style="font-size:13px;color:var(--text-muted);margin-bottom:10px">Select berth preference (subject to availability)</p>
            <div class="seat-map" id="seat-map"></div>
            <div style="display:flex;gap:16px;margin-top:10px;font-size:11px;color:var(--text-muted);">
              <span style="display:flex;align-items:center;gap:4px;"><span style="display:inline-block;width:12px;height:12px;background:var(--bg);border:1px solid var(--border);border-radius:3px;"></span>Available</span>
              <span style="display:flex;align-items:center;gap:4px;"><span style="display:inline-block;width:12px;height:12px;background:var(--saffron);border-radius:3px;"></span>Selected</span>
              <span style="display:flex;align-items:center;gap:4px;"><span style="display:inline-block;width:12px;height:12px;background:var(--bg);border:1px dashed var(--border-light);border-radius:3px;"></span>Taken</span>
            </div>
          </div>
        </div>

        <button class="search-btn" onclick="goTo(4)" style="max-width:300px">Continue to Payment &#8594;</button>
      </div>

      <div>
        <div class="summary-box" id="pax-summary"></div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== SECTION 4: PAYMENT ===================== -->
<section class="section" id="sec-payment">
  <div class="main-wrap">
    <button class="back-btn" onclick="goTo(3)">&#8592; Back to Passengers</button>

    <div class="content-grid">
      <div>
        <div class="section-title">Choose Payment Method</div>

        <div class="pay-method active" onclick="selectPay(this,'upi')">
          <div class="pay-icon" style="background:#E8F5E9;color:#1A7B3B;font-size:13px;">UPI</div>
          <div>
            <div class="pay-title">UPI / GPay / PhonePe</div>
            <div class="pay-sub">Pay using any UPI app</div>
          </div>
          <div class="radio-dot"></div>
        </div>
        <div id="upi-extra" class="upi-input-wrap" style="display:none; padding: 0 0 8px 52px;">
          <input class="field-input" placeholder="Enter UPI ID (e.g. name@upi)" style="max-width:300px;">
        </div>

        <div class="pay-method" onclick="selectPay(this,'card')">
          <div class="pay-icon" style="background:#EEF0FF;color:#3040A0;font-size:13px;">CARD</div>
          <div>
            <div class="pay-title">Debit / Credit Card</div>
            <div class="pay-sub">Visa, Mastercard, RuPay accepted</div>
          </div>
          <div class="radio-dot"></div>
        </div>
        <div id="card-extra" style="display:none; background:var(--card); border:1px solid var(--border-light); border-radius:10px; padding:1rem; margin-bottom:8px;">
          <div class="field-row field-row-2" style="margin-bottom:8px">
            <div class="field-group" style="grid-column:span 2">
              <label class="field-label">Card Number</label>
              <input class="field-input" placeholder="1234  5678  9012  3456" maxlength="19">
            </div>
          </div>
          <div class="field-row field-row-3">
            <div class="field-group">
              <label class="field-label">Name on Card</label>
              <input class="field-input" placeholder="Full name">
            </div>
            <div class="field-group">
              <label class="field-label">Expiry</label>
              <input class="field-input" placeholder="MM / YY" maxlength="7">
            </div>
            <div class="field-group">
              <label class="field-label">CVV</label>
              <input class="field-input" placeholder="•••" type="password" maxlength="3">
            </div>
          </div>
        </div>

        <div class="pay-method" onclick="selectPay(this,'netbanking')">
          <div class="pay-icon" style="background:#FFF3E0;color:#C85000;font-size:12px;">NET</div>
          <div>
            <div class="pay-title">Net Banking</div>
            <div class="pay-sub">All major banks supported</div>
          </div>
          <div class="radio-dot"></div>
        </div>
        <div id="nb-extra" style="display:none; background:var(--card); border:1px solid var(--border-light); border-radius:10px; padding:1rem; margin-bottom:8px;">
          <div class="field-group">
            <label class="field-label">Select Bank</label>
            <select class="field-input">
              <option>State Bank of India</option>
              <option>HDFC Bank</option>
              <option>ICICI Bank</option>
              <option>Axis Bank</option>
              <option>Kotak Mahindra Bank</option>
              <option>Punjab National Bank</option>
              <option>Other Bank</option>
            </select>
          </div>
        </div>

        <div class="pay-method" onclick="selectPay(this,'wallet')">
          <div class="pay-icon" style="background:#FDF0FF;color:#7000AA;font-size:12px;">&#128179;</div>
          <div>
            <div class="pay-title">Wallets</div>
            <div class="pay-sub">Paytm, MobiKwik, Amazon Pay</div>
          </div>
          <div class="radio-dot"></div>
        </div>

        <button class="search-btn" onclick="processPayment()" id="pay-btn" style="max-width:300px;margin-top:1rem">Pay &amp; Confirm Booking</button>
      </div>

      <div>
        <div class="summary-box" id="pay-summary"></div>
        <div style="margin-top:10px;background:var(--card);border-radius:10px;padding:1rem;border:1px solid var(--border-light);">
          <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-muted);">
            <span style="color:var(--green);font-size:16px;">&#128274;</span>
            <span>256-bit SSL encrypted. Your payment info is safe.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== SECTION 5: CONFIRMATION ===================== -->
<section class="section" id="sec-confirm">
  <div class="main-wrap" style="max-width:640px;">
    <div class="confirm-hero">
      <div class="confirm-check">&#10003;</div>
      <h2 style="font-family:var(--font-head);font-size:22px;font-weight:800;margin-bottom:4px;">Booking Confirmed!</h2>
      <p style="color:var(--text-muted);font-size:14px;">Ticket details sent to your email &amp; mobile</p>
    </div>

    <!-- PNR -->
    <div class="pnr-box">
      <div class="pnr-label">PNR Number</div>
      <div class="pnr-number" id="pnr-display">2468135790</div>
      <div style="font-size:12px;color:rgba(255,255,255,0.4);margin-top:4px;">Please save your PNR for reference</div>
    </div>

    <!-- Ticket -->
    <div class="ticket-card">
      <div class="ticket-top">
        <div>
          <div style="font-family:var(--font-head);font-size:14px;color:white;font-weight:700;" id="cnf-train-name">12951 — Mumbai Rajdhani</div>
          <div style="font-size:11px;color:rgba(255,255,255,0.5);margin-top:2px;" id="cnf-date-class">Wed, 09 Apr 2025 · 3A · General</div>
        </div>
        <div style="background:rgba(34,197,94,0.15);color:var(--green);border:1px solid var(--green);border-radius:8px;padding:5px 12px;font-size:12px;font-weight:600;">CONFIRMED</div>
      </div>
      <div class="ticket-body">
        <div class="ticket-route">
          <div class="route-station">
            <div class="route-stn-time" id="cnf-dep">16:25</div>
            <div class="route-stn-name" id="cnf-from">Mumbai CST</div>
            <div style="font-size:11px;color:var(--text-muted);">Departure</div>
          </div>
          <div style="flex:1;text-align:center;">
            <div style="font-size:12px;color:var(--text-muted);" id="cnf-dur">15h 35m</div>
            <div style="height:1px;background:var(--border);margin:4px 0;"></div>
            <div style="font-size:10px;color:var(--text-light);">&#8594;</div>
          </div>
          <div class="route-station" style="text-align:right;">
            <div class="route-stn-time" id="cnf-arr">08:00</div>
            <div class="route-stn-name" id="cnf-to">New Delhi</div>
            <div style="font-size:11px;color:var(--text-muted);">Arrival</div>
          </div>
        </div>

        <div class="detail-grid" id="cnf-details"></div>

        <!-- Passengers -->
        <div style="margin-bottom:1rem;">
          <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:var(--text-muted);margin-bottom:8px;">Passengers</div>
          <div id="cnf-pax-list"></div>
        </div>

        <!-- Actions -->
        <div class="action-row">
          <button class="action-btn btn-outline" onclick="downloadTicket()">&#8681; Download PDF</button>
          <button class="action-btn btn-outline" onclick="notify('SMS sent to registered mobile!')">&#128241; SMS</button>
          <button class="action-btn btn-primary" onclick="notify('Email sent!')">&#128140; Email</button>
        </div>
        <div style="margin-top:8px;text-align:center;">
          <button class="action-btn btn-outline" onclick="goTo(1)" style="max-width:200px;margin:0 auto;">Book Another Ticket</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Notification toast -->
<div class="notify" id="toast"></div>

<script>
// DATA
const STATIONS = [
  {code:'CSTM',name:'Mumbai Chhatrapati Shivaji Terminus',state:'Maharashtra'},
  {code:'BCT',name:'Mumbai Central',state:'Maharashtra'},
  {code:'NDLS',name:'New Delhi',state:'Delhi'},
  {code:'DLI',name:'Old Delhi',state:'Delhi'},
  {code:'HWH',name:'Howrah Junction',state:'West Bengal'},
  {code:'MAS',name:'Chennai Central',state:'Tamil Nadu'},
  {code:'SBC',name:'Bengaluru City Junction',state:'Karnataka'},
  {code:'SC',name:'Secunderabad Junction',state:'Telangana'},
  {code:'PUNE',name:'Pune Junction',state:'Maharashtra'},
  {code:'ADI',name:'Ahmedabad Junction',state:'Gujarat'},
  {code:'JP',name:'Jaipur Junction',state:'Rajasthan'},
  {code:'LKO',name:'Lucknow NR',state:'Uttar Pradesh'},
  {code:'PNBE',name:'Patna Junction',state:'Bihar'},
  {code:'BPL',name:'Bhopal Junction',state:'Madhya Pradesh'},
  {code:'NGP',name:'Nagpur Junction',state:'Maharashtra'},
  {code:'AMD',name:'Amritsar Junction',state:'Punjab'},
  {code:'CNB',name:'Kanpur Central',state:'Uttar Pradesh'},
  {code:'ST',name:'Surat Junction',state:'Gujarat'},
  {code:'BRC',name:'Vadodara Junction',state:'Gujarat'},
  {code:'GKP',name:'Gorakhpur Junction',state:'Uttar Pradesh'},
];

const TRAINS = [
  {num:'12951',name:'Mumbai Rajdhani',dep:'16:25',arr:'08:00',dur:'15h 35m',stops:2,days:'Mon-Sat',type:'raj',classes:{SL:null,'3A':{p:1315,a:'AVL 48'},'2A':{p:1800,a:'AVL 12'},'1A':{p:3200,a:'AVL 4'},'CC':null,'EC':null,'2S':null}},
  {num:'12137',name:'Punjab Mail',dep:'19:55',arr:'11:30',dur:'15h 35m',stops:8,days:'Daily',type:'exp',classes:{SL:{p:475,a:'WL 22'},'3A':{p:1260,a:'AVL 34'},'2A':{p:1720,a:'WL 4'},'1A':null,'CC':null,'EC':null,'2S':null}},
  {num:'12263',name:'Duronto Express',dep:'23:00',arr:'13:05',dur:'14h 05m',stops:1,days:'Fri-Mon',type:'sf',classes:{SL:{p:525,a:'AVL 86'},'3A':{p:1385,a:'AVL 21'},'2A':{p:1900,a:'AVL 8'},'1A':null,'CC':null,'EC':null,'2S':null}},
  {num:'22221',name:'Tejas Rajdhani',dep:'06:05',arr:'22:35',dur:'16h 30m',stops:3,days:'Daily',type:'raj',classes:{SL:null,'3A':{p:1390,a:'AVL 55'},'2A':{p:1850,a:'RAC 2'},'1A':{p:3400,a:'AVL 2'},'CC':null,'EC':null,'2S':null}},
  {num:'12617',name:'Mangala Lakshadweep',dep:'11:30',arr:'05:10',dur:'17h 40m',stops:12,days:'Daily',type:'exp',classes:{SL:{p:455,a:'AVL 120'},'3A':{p:1200,a:'AVL 43'},'2A':{p:1650,a:'AVL 9'},'1A':{p:2900,a:'AVL 2'},'CC':null,'EC':null,'2S':null}},
];

let state = {
  step: 1, from:'', to:'', date:'', cls:'SL', quota:'General', pax:1,
  selectedTrain: null, selectedClass: null, paxData: [],
};

function goTo(n) {
  state.step = n;
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  const map = {1:'search',2:'results',3:'passengers',4:'payment',5:'confirm'};
  document.getElementById('sec-'+map[n]).classList.add('active');
  updateStepBar(n);
  window.scrollTo({top:0,behavior:'smooth'});
}

function updateStepBar(n) {
  for(let i=1;i<=5;i++) {
    const el = document.getElementById('s'+i);
    el.classList.remove('active','done');
    if(i < n) el.classList.add('done');
    else if(i === n) el.classList.add('active');
  }
}

// SET TODAY's DATE
document.getElementById('journey-date').valueAsDate = new Date();

// PAX COUNTER
function changePax(d) {
  state.pax = Math.max(1, Math.min(6, state.pax + d));
  document.getElementById('pax-count').textContent = state.pax;
}

// AUTOCOMPLETE
function showSuggestions(inputId, listId) {
  const q = document.getElementById(inputId).value.toLowerCase();
  const list = document.getElementById(listId);
  if(q.length < 1) { list.style.display='none'; return; }
  const matches = STATIONS.filter(s =>
    s.name.toLowerCase().includes(q) || s.code.toLowerCase().includes(q)
  ).slice(0,5);
  if(!matches.length) { list.style.display='none'; return; }
  list.innerHTML = matches.map(s => `
    <div class="autocomplete-item" onclick="selectStation('${inputId}','${listId}','${s.name}','${s.code}')">
      <span class="station-code">${s.code}</span>
      <span class="station-full">${s.name}</span>
      <span class="station-state">${s.state}</span>
    </div>`).join('');
  list.style.display='block';
}

function selectStation(inputId, listId, name, code) {
  document.getElementById(inputId).value = name + ' (' + code + ')';
  document.getElementById(listId).style.display='none';
  if(inputId==='from-input') state.from = name;
  else state.to = name;
}

document.addEventListener('click', e => {
  if(!e.target.closest('#from-group')) document.getElementById('from-list').style.display='none';
  if(!e.target.closest('#to-group')) document.getElementById('to-list').style.display='none';
});

// SWAP
function swapStations() {
  const fv = document.getElementById('from-input').value;
  const tv = document.getElementById('to-input').value;
  document.getElementById('from-input').value = tv;
  document.getElementById('to-input').value = fv;
  const tmp = state.from; state.from = state.to; state.to = tmp;
}

// GO TO RESULTS
function goToResults() {
  const fv = document.getElementById('from-input').value;
  const tv = document.getElementById('to-input').value;
  if(!fv || !tv) { notify('Please enter From and To stations'); return; }
  state.from = fv; state.to = tv;
  state.date = document.getElementById('journey-date').value;
  state.cls = document.getElementById('journey-class').value;
  state.quota = document.getElementById('journey-quota').value;

  const dtFmt = state.date ? new Date(state.date).toDateString() : '';
  document.getElementById('results-route-title').textContent = shortName(fv) + ' → ' + shortName(tv);
  document.getElementById('results-meta').textContent = `${dtFmt} · ${state.cls} · ${state.quota} · ${state.pax} Passenger${state.pax>1?'s':''}`;

  renderTrains();
  goTo(2);
}

function shortName(v) { return v.split('(')[0].trim().split(' ').slice(0,2).join(' '); }

function renderTrains() {
  const list = document.getElementById('train-list');
  const cls = state.cls;
  list.innerHTML = TRAINS.map(t => {
    const c = t.classes[cls];
    const classButtons = Object.entries(t.classes).filter(([k,v])=>v).map(([k,v])=>{
      const colorClass = v.a.startsWith('AVL') ? 'avail-green' : v.a.startsWith('WL') ? 'avail-red' : 'avail-orange';
      return `<div class="class-pill${k===cls?' selected':''}" onclick="selectClass(this,'${t.num}','${k}',${v.p})">
        <div class="cls-name">${k}</div>
        <div class="cls-price">₹${v.p}</div>
        <div class="cls-avail ${colorClass}">${v.a}</div>
      </div>`;
    }).join('');
    const typeLabel = t.type==='raj'?'Rajdhani':t.type==='sf'?'Superfast':'Express';
    const typeClass = 'badge-'+t.type;
    return `<div class="train-card">
      <div class="train-main">
        <div>
          <div class="train-name">${t.name}</div>
          <div class="train-number">#${t.num}</div>
          <div class="train-badge ${typeClass}">${typeLabel}</div>
        </div>
        <div class="time-block">
          <div class="time-big">${t.dep}</div>
          <div class="time-station">${shortName(state.from)}</div>
        </div>
        <div class="duration-block">
          <div class="duration-line"><div class="dur-dot"></div><div class="dur-track"></div><div class="dur-dot"></div></div>
          <div class="duration-text">${t.dur}</div>
          <div class="stops-text">${t.stops} stop${t.stops>1?'s':''}</div>
        </div>
        <div style="text-align:right">
          <div class="time-big">${t.arr}</div>
          <div class="time-station">${shortName(state.to)}</div>
        </div>
      </div>
      <div style="padding:0 1.5rem 1rem">
        <div class="class-grid" id="cls-${t.num}">${classButtons}</div>
      </div>
      <div class="train-footer">
        <div class="train-footer-info">
          <span>&#128197; ${t.days}</span>
          ${c?`<span style="color:${c.a.startsWith('AVL')?'var(--green)':c.a.startsWith('WL')?'var(--red)':'var(--amber)'}">&#9679; ${c.a}</span>`:''}
        </div>
        <button class="book-btn" onclick="bookTrain('${t.num}')">Book Now &#8594;</button>
      </div>
    </div>`;
  }).join('');
}

function selectClass(el, trainNum, cls, price) {
  document.querySelectorAll(`#cls-${trainNum} .class-pill`).forEach(p => p.classList.remove('selected'));
  el.classList.add('selected');
}

function bookTrain(num) {
  state.selectedTrain = TRAINS.find(t=>t.num===num);
  state.selectedClass = state.cls;
  buildPassengerForms();
  buildSeatMap();
  updateSummary();
  goTo(3);
}

function buildPassengerForms() {
  const wrap = document.getElementById('pax-forms');
  wrap.innerHTML = Array.from({length:state.pax},(_,i)=>`
    <div class="pax-card">
      <div class="pax-card-header">
        <h3>&#128100; Passenger ${i+1}</h3>
        <span style="color:rgba(255,255,255,0.5);font-size:11px;">${state.selectedClass} Class</span>
      </div>
      <div class="pax-card-body">
        <div class="field-row field-row-3" style="margin-bottom:10px">
          <div class="field-group">
            <label class="field-label">Full Name</label>
            <input class="field-input" id="pax-name-${i}" placeholder="As per ID proof">
          </div>
          <div class="field-group">
            <label class="field-label">Age</label>
            <input class="field-input" id="pax-age-${i}" placeholder="Years" type="number" min="1" max="120" style="width:100%">
          </div>
          <div class="field-group">
            <label class="field-label">Gender</label>
            <select class="field-input" id="pax-gender-${i}">
              <option>Male</option><option>Female</option><option>Other</option>
            </select>
          </div>
        </div>
        <div class="field-row field-row-2">
          <div class="field-group">
            <label class="field-label">Berth Preference</label>
            <select class="field-input" id="pax-berth-${i}">
              <option>No Preference</option>
              <option>Lower Berth</option>
              <option>Middle Berth</option>
              <option>Upper Berth</option>
              <option>Side Lower</option>
              <option>Side Upper</option>
            </select>
          </div>
          <div class="field-group">
            <label class="field-label">ID Proof (Optional)</label>
            <select class="field-input">
              <option>Select ID Type</option>
              <option>Aadhaar Card</option>
              <option>Passport</option>
              <option>Voter ID</option>
              <option>Driving Licence</option>
              <option>PAN Card</option>
            </select>
          </div>
        </div>
      </div>
    </div>`).join('');
}

function buildSeatMap() {
  const wrap = document.getElementById('seat-map');
  const taken = [3,7,11,15,18,22,25];
  wrap.innerHTML = Array.from({length:36},(_,i)=>{
    const n = i+1;
    const isTaken = taken.includes(n);
    return `<button class="seat-btn${isTaken?' taken':''}" ${isTaken?'disabled':''} onclick="toggleSeat(this,${n})">${n}<br><span style="font-size:8px;font-weight:400">${['L','M','U','SL','SU'][i%5]}</span></button>`;
  }).join('');
}

function toggleSeat(el,n) {
  el.classList.toggle('selected');
}

function updateSummary() {
  const t = state.selectedTrain;
  if(!t) return;
  const cls = state.selectedClass;
  const c = t.classes[cls];
  const price = c ? c.p : 0;
  const total = price * state.pax;
  const html = `
    <h3>Booking Summary</h3>
    <div class="summary-row"><span class="s-key">Train</span><span>${t.name}</span></div>
    <div class="summary-row"><span class="s-key">Route</span><span>${shortName(state.from)} → ${shortName(state.to)}</span></div>
    <div class="summary-row"><span class="s-key">Date</span><span>${state.date ? new Date(state.date).toDateString() : '—'}</span></div>
    <div class="summary-row"><span class="s-key">Class</span><span>${cls} · ${state.quota}</span></div>
    <div class="summary-row"><span class="s-key">Passengers</span><span>${state.pax}</span></div>
    <div class="summary-row"><span class="s-key">Fare / Person</span><span>₹${price}</span></div>
    <div class="summary-row"><span class="s-key">GST (5%)</span><span>₹${Math.round(total*0.05)}</span></div>
    <div class="summary-row"><span class="s-key">Conv. Fee</span><span>₹${15*state.pax}</span></div>
    <div class="summary-total">
      <span class="t-label">Total Amount</span>
      <span class="t-amount">₹${(total + Math.round(total*0.05) + 15*state.pax).toLocaleString('en-IN')}</span>
    </div>`;
  document.getElementById('pax-summary').innerHTML = html;
  document.getElementById('pay-summary').innerHTML = html;
}

// PAYMENT
let payType = 'upi';
function selectPay(el, type) {
  document.querySelectorAll('.pay-method').forEach(m => m.classList.remove('active'));
  el.classList.add('active');
  payType = type;
  document.getElementById('upi-extra').style.display = type==='upi'?'block':'none';
  document.getElementById('card-extra').style.display = type==='card'?'block':'none';
  document.getElementById('nb-extra').style.display = type==='netbanking'?'block':'none';
}

// Show UPI by default
document.getElementById('upi-extra').style.display = 'block';

function processPayment() {
  const btn = document.getElementById('pay-btn');
  btn.textContent = 'Processing...';
  btn.disabled = true;
  setTimeout(()=>{
    collectPaxData();
    buildConfirmation();
    goTo(5);
    btn.textContent = 'Pay & Confirm Booking';
    btn.disabled = false;
  },1800);
}

function collectPaxData() {
  state.paxData = Array.from({length:state.pax},(_,i)=>({
    name: document.getElementById('pax-name-'+i)?.value || 'Passenger '+(i+1),
    age: document.getElementById('pax-age-'+i)?.value || '—',
    gender: document.getElementById('pax-gender-'+i)?.value || 'Male',
    berth: document.getElementById('pax-berth-'+i)?.value || 'No Preference',
    seat: 'B1/'+(Math.floor(Math.random()*40)+1),
  }));
}

function buildConfirmation() {
  const t = state.selectedTrain;
  const cls = state.selectedClass;
  const c = t.classes[cls];
  const price = c ? c.p : 0;
  const total = price * state.pax;

  document.getElementById('pnr-display').textContent = String(Math.floor(2000000000+Math.random()*1000000000));
  document.getElementById('cnf-train-name').textContent = t.num + ' — ' + t.name;
  document.getElementById('cnf-date-class').textContent = `${state.date ? new Date(state.date).toDateString() : ''} · ${cls} · ${state.quota}`;
  document.getElementById('cnf-dep').textContent = t.dep;
  document.getElementById('cnf-arr').textContent = t.arr;
  document.getElementById('cnf-dur').textContent = t.dur;
  document.getElementById('cnf-from').textContent = shortName(state.from);
  document.getElementById('cnf-to').textContent = shortName(state.to);

  document.getElementById('cnf-details').innerHTML = `
    <div class="detail-cell"><div class="d-key">Class</div><div class="d-val">${cls}</div></div>
    <div class="detail-cell"><div class="d-key">Quota</div><div class="d-val">${state.quota}</div></div>
    <div class="detail-cell"><div class="d-key">Total Fare</div><div class="d-val">₹${total.toLocaleString('en-IN')}</div></div>`;

  document.getElementById('cnf-pax-list').innerHTML = state.paxData.map((p,i)=>`
    <div style="display:flex;justify-content:space-between;padding:7px 0;border-bottom:1px solid var(--border-light);font-size:13px;">
      <div><span style="font-weight:600;">${p.name||'Passenger '+(i+1)}</span> <span style="color:var(--text-muted);">(${p.age}/${p.gender[0]})</span></div>
      <div style="display:flex;gap:10px;color:var(--text-muted);">
        <span>${p.berth.split(' ')[0]}</span>
        <span style="color:var(--green);font-weight:600;">${p.seat}</span>
      </div>
    </div>`).join('');
}

function downloadTicket() { notify('Ticket PDF downloading...'); }

function notify(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2500);
}

// Filter chips toggle
document.querySelectorAll('.filter-chip').forEach(chip => {
  chip.addEventListener('click', function() {
    document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('on'));
    this.classList.add('on');
  });
});
</script>
</body>
</html>
