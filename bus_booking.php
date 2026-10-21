
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{--brand:#1a56db;--brand-dark:#1239a0;--brand-light:#e8f0fd;--green:#16a34a;--green-light:#dcfce7;--red:#dc2626;--red-light:#fee2e2;--amber:#d97706;--amber-light:#fef3c7;--r:10px;--rs:6px}
body{font-family:var(--font-sans,system-ui);color:var(--color-text-primary);background:var(--color-background-tertiary);font-size:14px;line-height:1.5}
.page{max-width:1200px;margin:0 auto;padding:0 0 3rem}
nav{background:var(--brand);padding:0 1.5rem;height:52px;display:flex;align-items:center;justify-content:space-between}
.nav-logo{color:#fff;font-size:17px;font-weight:500;display:flex;align-items:center;gap:8px}
.nav-logo-icon{width:28px;height:28px;background:#fff;border-radius:6px;display:flex;align-items:center;justify-content:center}
.nav-logo-icon svg{width:18px;height:18px;fill:var(--brand)}
.hero{background:var(--brand);padding:1.5rem 1.5rem 2.5rem}
.hero h1{color:#fff;font-size:clamp(18px,3vw,26px);font-weight:500;margin-bottom:.25rem}
.hero p{color:rgba(255,255,255,.7);font-size:13px;margin-bottom:1.25rem}
.search-card{background:var(--color-background-primary);border-radius:var(--r);padding:1.25rem;border:0.5px solid var(--color-border-tertiary);margin:0 1.5rem;margin-top:-1.5rem;position:relative;z-index:10}
.search-grid{display:grid;grid-template-columns:1fr auto 1fr 1.1fr 1fr auto;gap:10px;align-items:end}
.sf{display:flex;flex-direction:column;gap:4px}
.sf label{font-size:11px;color:var(--color-text-secondary);text-transform:uppercase;letter-spacing:.4px;font-weight:500}
.sf input,.sf select{border:1px solid var(--color-border-tertiary);border-radius:var(--rs);padding:8px 10px;font-size:14px;background:var(--color-background-secondary);color:var(--color-text-primary);outline:none;transition:border-color .2s;width:100%}
.sf input:focus,.sf select:focus{border-color:var(--brand)}
.swap-btn{width:34px;height:34px;border-radius:50%;border:1px solid var(--color-border-tertiary);background:var(--color-background-secondary);cursor:pointer;display:flex;align-items:center;justify-content:center;margin-bottom:1px;flex-shrink:0;transition:all .2s;color:var(--color-text-secondary)}
.swap-btn:hover{background:var(--brand-light);border-color:var(--brand)}
.swap-btn svg{width:15px;height:15px}
.sugg{position:absolute;top:calc(100% + 3px);left:0;right:0;background:var(--color-background-primary);border:1px solid var(--color-border-tertiary);border-radius:var(--rs);z-index:50;overflow:hidden}
.sugg-item{padding:9px 12px;font-size:13px;cursor:pointer;display:flex;align-items:center;gap:8px;transition:background .15s}
.sugg-item:hover{background:var(--brand-light)}
.sugg-icon{width:24px;height:24px;background:var(--brand-light);border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;color:var(--brand)}
.pax-selector{position:relative}
.pax-btn{width:100%;border:1px solid var(--color-border-tertiary);border-radius:var(--rs);padding:8px 10px;font-size:14px;background:var(--color-background-secondary);cursor:pointer;text-align:left;color:var(--color-text-primary)}
.pax-drop{position:absolute;top:calc(100% + 4px);left:0;min-width:200px;background:var(--color-background-primary);border:1px solid var(--color-border-tertiary);border-radius:var(--rs);padding:12px;z-index:60}
.pax-row{display:flex;align-items:center;justify-content:space-between;padding:5px 0;border-bottom:0.5px solid var(--color-border-tertiary)}
.pax-row:last-child{border-bottom:none}
.qty-c{display:flex;align-items:center;gap:8px}
.qb{width:25px;height:25px;border-radius:50%;border:1px solid var(--color-border-tertiary);background:none;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--brand);transition:all .2s}
.qb:hover{background:var(--brand);color:#fff;border-color:var(--brand)}
.qv{font-size:14px;font-weight:500;min-width:16px;text-align:center}
.btn-search{background:var(--brand);color:#fff;border:none;border-radius:var(--rs);padding:9px 22px;font-size:14px;font-weight:500;cursor:pointer;white-space:nowrap;transition:background .2s;display:flex;align-items:center;gap:6px}
.btn-search:hover{background:var(--brand-dark)}
.btn-search svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
.step-bar{display:flex;align-items:center;justify-content:center;gap:0;padding:1rem 1.5rem;background:var(--color-background-primary);border-bottom:0.5px solid var(--color-border-tertiary);margin:0 1.5rem;border-radius:0 0 var(--r) var(--r)}
.step{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--color-text-secondary)}
.step.active{color:var(--brand)}
.step.done{color:var(--green)}
.step-num{width:22px;height:22px;border-radius:50%;border:1.5px solid currentColor;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500;flex-shrink:0}
.step-line{width:40px;height:1px;background:var(--color-border-tertiary);margin:0 4px}
.step-line.done{background:var(--green)}
.main{padding:1rem 1.5rem;display:grid;grid-template-columns:220px 1fr;gap:1rem}
.filters{background:var(--color-background-primary);border-radius:var(--r);padding:1rem;border:0.5px solid var(--color-border-tertiary);height:fit-content;position:sticky;top:10px}
.filter-hd{font-size:14px;font-weight:500;margin-bottom:.75rem;display:flex;align-items:center;justify-content:space-between}
.filter-reset{font-size:11px;color:var(--brand);cursor:pointer;font-weight:400}
.fsec{margin-bottom:1rem;border-bottom:0.5px solid var(--color-border-tertiary);padding-bottom:1rem}
.fsec:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0}
.flabel{font-size:11px;color:var(--color-text-secondary);font-weight:500;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.4px}
.f-chips{display:flex;flex-wrap:wrap;gap:5px}
.fchip{border:1px solid var(--color-border-tertiary);border-radius:5px;padding:3px 9px;font-size:12px;cursor:pointer;background:var(--color-background-secondary);transition:all .15s;color:var(--color-text-primary)}
.fchip.on{background:var(--brand);color:#fff;border-color:var(--brand)}
.time-grid{display:grid;grid-template-columns:1fr 1fr;gap:5px}
.time-chip{border:1px solid var(--color-border-tertiary);border-radius:5px;padding:4px 6px;font-size:11px;cursor:pointer;background:var(--color-background-secondary);text-align:center;transition:all .15s;color:var(--color-text-primary)}
.time-chip.on{background:var(--brand);color:#fff;border-color:var(--brand)}
.price-range-row{display:flex;gap:5px;margin-bottom:6px}
.pi{width:70px;border:1px solid var(--color-border-tertiary);border-radius:5px;padding:4px 7px;font-size:12px;background:var(--color-background-secondary);color:var(--color-text-primary)}
.range-sl{width:100%;accent-color:var(--brand)}
.am-list{display:flex;flex-direction:column;gap:5px}
.am-item{display:flex;align-items:center;gap:7px;font-size:12px;cursor:pointer;color:var(--color-text-primary)}
.am-item input{accent-color:var(--brand);width:13px;height:13px}
.results-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem;flex-wrap:wrap;gap:8px}
.res-count{font-size:13px;color:var(--color-text-secondary)}
.res-count strong{color:var(--color-text-primary);font-weight:500}
.sort-row{display:flex;gap:6px}
.s-btn{border:1px solid var(--color-border-tertiary);border-radius:5px;padding:4px 10px;font-size:12px;background:var(--color-background-secondary);cursor:pointer;transition:all .15s;color:var(--color-text-primary)}
.s-btn.on{background:var(--brand);color:#fff;border-color:var(--brand)}
.buses{display:flex;flex-direction:column;gap:.75rem}
.bus-card{background:var(--color-background-primary);border-radius:var(--r);border:0.5px solid var(--color-border-tertiary);overflow:hidden;transition:box-shadow .2s}
.bus-card:hover{box-shadow:0 2px 12px rgba(26,86,219,.1)}
.bus-main{padding:1rem 1.25rem;display:grid;grid-template-columns:1.2fr 1.6fr 1fr 1fr auto;gap:12px;align-items:center}
.op-name{font-size:14px;font-weight:500;margin-bottom:3px}
.bus-type-badge{display:inline-flex;align-items:center;gap:4px;border-radius:4px;padding:2px 7px;font-size:11px;font-weight:500}
.badge-ac{background:#e0f2fe;color:#0369a1}
.badge-sl{background:#f3e8ff;color:#7e22ce}
.badge-se{background:#fef9c3;color:#854d0e}
.badge-vo{background:#f0fdf4;color:#166534}
.time-block{text-align:center}
.dep-time,.arr-time{font-size:20px;font-weight:500}
.time-city{font-size:11px;color:var(--color-text-secondary)}
.dur-line{display:flex;align-items:center;gap:6px;color:var(--color-text-secondary);font-size:12px}
.dur-track{flex:1;height:1.5px;background:var(--color-border-tertiary);position:relative}
.dur-track::after{content:'';position:absolute;left:50%;top:-3px;transform:translateX(-50%);width:7px;height:7px;border-radius:50%;background:var(--brand)}
.seats-info{text-align:center}
.seats-num{font-size:16px;font-weight:500;color:var(--green)}
.seats-label{font-size:11px;color:var(--color-text-secondary)}
.price-col{text-align:right}
.orig-p{font-size:12px;color:#aaa;text-decoration:line-through}
.main-p{font-size:20px;font-weight:500;color:var(--brand);line-height:1}
.per-p{font-size:11px;color:var(--color-text-secondary)}
.rating-pill{display:inline-flex;align-items:center;gap:3px;background:var(--green);color:#fff;border-radius:4px;padding:2px 7px;font-size:12px;font-weight:500;margin-top:4px}
.card-actions{display:flex;flex-direction:column;gap:6px;align-items:flex-end}
.btn-view{border:1.5px solid var(--brand);color:var(--brand);background:none;border-radius:var(--rs);padding:6px 14px;font-size:12px;cursor:pointer;transition:all .2s;white-space:nowrap}
.btn-view:hover{background:var(--brand);color:#fff}
.btn-book{background:var(--brand);color:#fff;border:none;border-radius:var(--rs);padding:6px 14px;font-size:12px;cursor:pointer;transition:background .2s;white-space:nowrap}
.btn-book:hover{background:var(--brand-dark)}
.urgency{font-size:11px;color:var(--red);font-weight:500}
.bus-extra{border-top:0.5px solid var(--color-border-tertiary);padding:.75rem 1.25rem;display:flex;gap:8px;flex-wrap:wrap}
.xtag{background:var(--color-background-secondary);border-radius:4px;padding:3px 8px;font-size:11px;color:var(--color-text-secondary)}
.discount-badge{font-size:11px;background:#fff3cd;color:#856404;border-radius:4px;padding:2px 7px;font-weight:500}
.panel{background:var(--color-background-primary);border-radius:var(--r);border:0.5px solid var(--color-border-tertiary);margin-bottom:.75rem;overflow:hidden}
.panel-hd{padding:.85rem 1.25rem;font-size:14px;font-weight:500;border-bottom:0.5px solid var(--color-border-tertiary);display:flex;align-items:center;justify-content:space-between}
.panel-body{padding:1rem 1.25rem}
.seat-layout-wrap{display:grid;grid-template-columns:auto 1fr;gap:1.5rem;align-items:start}
.seat-legend{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:.75rem}
.leg-item{display:flex;align-items:center;gap:5px;font-size:12px;color:var(--color-text-secondary)}
.leg-box{width:14px;height:14px;border-radius:3px;flex-shrink:0}
.deck-tabs{display:flex;gap:6px;margin-bottom:.75rem}
.dtab{border:1px solid var(--color-border-tertiary);border-radius:5px;padding:4px 12px;font-size:12px;cursor:pointer;background:var(--color-background-secondary);transition:all .2s;color:var(--color-text-primary)}
.dtab.on{background:var(--brand);color:#fff;border-color:var(--brand)}
.bus-shell{background:var(--color-background-secondary);border-radius:var(--r);padding:14px;border:0.5px solid var(--color-border-tertiary);display:inline-block}
.seat-row{display:flex;gap:5px;align-items:center}
.seat{width:32px;height:30px;border-radius:4px;border:1.5px solid;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:500;transition:transform .15s;user-select:none}
.seat:hover:not(.booked){transform:scale(1.1)}
.seat.avail{background:#dcfce7;border-color:#16a34a;color:#166534}
.seat.booked{background:#fee2e2;border-color:#dc2626;color:#991b1b;cursor:not-allowed}
.seat.selected{background:#1a56db;border-color:#1239a0;color:#fff}
.seat.ladies{background:#fce7f3;border-color:#db2777;color:#9d174d}
.seat.aisle{background:none;border:none;cursor:default;font-size:9px;color:var(--color-text-secondary)}
.seat-info-panel{flex:1}
.sel-seats-list{min-height:60px;background:var(--color-background-secondary);border-radius:var(--rs);padding:10px;border:0.5px solid var(--color-border-tertiary);margin-bottom:.75rem}
.sel-seat-tag{display:inline-flex;align-items:center;gap:4px;background:var(--brand);color:#fff;border-radius:4px;padding:3px 8px;font-size:12px;margin:2px}
.no-sel{font-size:13px;color:var(--color-text-secondary)}
.price-preview{background:var(--brand-light);border-radius:var(--rs);padding:10px;border:0.5px solid rgba(26,86,219,.2)}
.pp-row{display:flex;justify-content:space-between;font-size:13px;padding:2px 0}
.pp-total{font-weight:500;font-size:15px;color:var(--brand);border-top:0.5px solid rgba(26,86,219,.2);padding-top:6px;margin-top:4px}
.bp-list{display:flex;flex-direction:column;gap:6px;max-height:220px;overflow-y:auto}
.bp-item{border:1px solid var(--color-border-tertiary);border-radius:var(--rs);padding:8px 10px;cursor:pointer;transition:all .2s;background:var(--color-background-secondary)}
.bp-item:hover{border-color:var(--brand)}
.bp-item.sel{border-color:var(--brand);background:var(--brand-light)}
.bp-name{font-size:13px;font-weight:500;margin-bottom:2px}
.bp-time{font-size:12px;color:var(--color-text-secondary)}
.bp-map{background:var(--color-background-secondary);border-radius:var(--rs);border:0.5px solid var(--color-border-tertiary);overflow:hidden;display:flex;flex-direction:column}
.map-placeholder{background:#dce9f5;height:130px;display:flex;align-items:center;justify-content:center;font-size:12px;color:#666;position:relative}
.map-pin{width:20px;height:20px;background:var(--brand);border-radius:50% 50% 50% 0;transform:rotate(-45deg);position:absolute}
.map-pin-inner{width:8px;height:8px;background:#fff;border-radius:50%;position:absolute;top:6px;left:6px}
.map-info{padding:8px 10px;font-size:12px;color:var(--color-text-secondary)}
.pass-form{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.fg{display:flex;flex-direction:column;gap:4px}
.fg label{font-size:11px;color:var(--color-text-secondary);text-transform:uppercase;letter-spacing:.4px;font-weight:500}
.fg input,.fg select{border:1px solid var(--color-border-tertiary);border-radius:var(--rs);padding:8px 10px;font-size:13px;background:var(--color-background-secondary);color:var(--color-text-primary);outline:none;transition:border-color .2s}
.fg input:focus,.fg select:focus{border-color:var(--brand)}
.fg-full{grid-column:1/-1}
.autofill-bar{background:var(--brand-light);border-radius:var(--rs);padding:8px 12px;margin-bottom:.75rem;display:flex;align-items:center;justify-content:space-between;border:0.5px solid rgba(26,86,219,.2)}
.autofill-bar span{font-size:12px;color:#1239a0}
.btn-autofill{background:var(--brand);color:#fff;border:none;border-radius:5px;padding:4px 12px;font-size:12px;cursor:pointer}
.pay-opts{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:1rem}
.pay-opt{border:1.5px solid var(--color-border-tertiary);border-radius:var(--rs);padding:10px 8px;text-align:center;cursor:pointer;transition:all .2s;background:var(--color-background-secondary)}
.pay-opt.on{border-color:var(--brand);background:var(--brand-light)}
.pay-lbl{font-size:11px;color:var(--color-text-secondary)}
.card-fields{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:1rem}
.fare-box{background:var(--color-background-secondary);border-radius:var(--rs);padding:1rem;border:0.5px solid var(--color-border-tertiary)}
.fare-row{display:flex;justify-content:space-between;font-size:13px;padding:4px 0;border-bottom:0.5px solid var(--color-border-tertiary)}
.fare-row:last-child{border-bottom:none}
.fare-total{font-weight:500;font-size:16px;color:var(--brand)}
.fare-disc{color:var(--green)}
.promo-row{display:flex;gap:8px;margin:1rem 0}
.promo-row input{flex:1;border:1px solid var(--color-border-tertiary);border-radius:var(--rs);padding:8px 10px;font-size:13px;background:var(--color-background-secondary);color:var(--color-text-primary);outline:none}
.promo-row input:focus{border-color:var(--brand)}
.btn-promo{background:none;border:1px solid var(--brand);color:var(--brand);border-radius:var(--rs);padding:8px 14px;font-size:12px;cursor:pointer;transition:all .2s}
.btn-promo:hover{background:var(--brand);color:#fff}
.btn-pay{width:100%;background:var(--brand);color:#fff;border:none;border-radius:var(--rs);padding:12px;font-size:15px;font-weight:500;cursor:pointer;margin-top:1rem;transition:background .2s}
.btn-pay:hover{background:var(--brand-dark)}
.sec-row{display:flex;justify-content:center;gap:14px;margin-top:8px;flex-wrap:wrap}
.sec-badge{display:flex;align-items:center;gap:4px;font-size:11px;color:var(--color-text-secondary)}
.confirm-card{background:var(--color-background-primary);border-radius:var(--r);border:0.5px solid var(--color-border-tertiary);max-width:600px;margin:0 auto;overflow:hidden}
.confirm-top{background:var(--brand);padding:1.5rem;text-align:center;color:#fff}
.confirm-icon{width:52px;height:52px;background:#fff;border-radius:50%;margin:0 auto .75rem;display:flex;align-items:center;justify-content:center}
.confirm-icon svg{width:28px;height:28px;stroke:var(--green);fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round}
.pnr-box{background:rgba(255,255,255,.15);border-radius:8px;padding:10px 16px;margin-top:1rem;display:inline-block}
.pnr-label{font-size:11px;opacity:.75;text-transform:uppercase;letter-spacing:.5px}
.pnr-val{font-size:20px;font-weight:500;letter-spacing:2px}
.ticket-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:1rem}
.tg-item{background:var(--color-background-secondary);border-radius:var(--rs);padding:10px}
.tg-label{font-size:11px;color:var(--color-text-secondary);margin-bottom:3px}
.tg-val{font-size:13px;font-weight:500}
.confirm-actions{display:flex;gap:8px;flex-wrap:wrap}
.btn-dl{flex:1;background:var(--brand);color:#fff;border:none;border-radius:var(--rs);padding:10px;font-size:13px;font-weight:500;cursor:pointer}
.btn-share{flex:1;border:1.5px solid var(--brand);color:var(--brand);background:none;border-radius:var(--rs);padding:10px;font-size:13px;cursor:pointer}
.btn-new{flex:1;border:1px solid var(--color-border-tertiary);color:var(--color-text-secondary);background:none;border-radius:var(--rs);padding:10px;font-size:13px;cursor:pointer}
.next-btn-row{margin-top:1rem;display:flex;justify-content:flex-end;gap:8px}
.btn-next{background:var(--brand);color:#fff;border:none;border-radius:var(--rs);padding:10px 24px;font-size:14px;font-weight:500;cursor:pointer;transition:background .2s}
.btn-next:hover{background:var(--brand-dark)}
.btn-back{border:1px solid var(--color-border-tertiary);background:none;color:var(--color-text-secondary);border-radius:var(--rs);padding:10px 18px;font-size:14px;cursor:pointer}
@media(max-width:700px){
  .search-grid{grid-template-columns:1fr;gap:8px}
  .swap-btn{display:none}
  .main{grid-template-columns:1fr;padding:.75rem}
  .filters{display:none}
  .bus-main{grid-template-columns:1fr 1fr;gap:8px}
  .pay-opts{grid-template-columns:1fr 1fr}
  .ticket-grid{grid-template-columns:1fr}
  .pass-form{grid-template-columns:1fr}
  .fg-full{grid-column:1}
  .seat-layout-wrap{grid-template-columns:1fr}
  .card-fields{grid-template-columns:1fr}
}
</style>

<h2 style="position:absolute;width:1px;height:1px;clip:rect(0,0,0,0);overflow:hidden">Bus booking page with search, listings, seat selection, passenger details, payment, and confirmation</h2>

<div class="page" id="app">

<nav>
  <div class="nav-logo">
    <div class="nav-logo-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="1" y="6" width="22" height="13" rx="3"/><path d="M6 6V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/><line x1="8" y1="19" x2="8" y2="21"/><line x1="16" y1="19" x2="16" y2="21"/></svg>
    </div>
    BusGo
  </div>
</nav>

<div class="hero" id="heroSection">
  <h1>Book Bus Tickets Online</h1>
  <p>10,000+ operators · Live seat selection · Instant confirmation</p>
</div>

<div class="search-card" id="searchCard">
  <div class="search-grid">
    <div class="sf" style="position:relative">
      <label>From</label>
      <input type="text" id="fromInput" placeholder="Mumbai" value="Mumbai" oninput="showSugg('from',this.value)" onblur="hideSugg('from')" autocomplete="off">
      <div class="sugg" id="sugg-from" style="display:none">
        <div class="sugg-item" onmousedown="setSugg('from','Mumbai')"><div class="sugg-icon">M</div><div><div style="font-size:13px;font-weight:500">Mumbai</div><div style="font-size:11px;color:var(--color-text-secondary)">Maharashtra</div></div></div>
        <div class="sugg-item" onmousedown="setSugg('from','Pune')"><div class="sugg-icon">P</div><div><div style="font-size:13px;font-weight:500">Pune</div><div style="font-size:11px;color:var(--color-text-secondary)">Maharashtra</div></div></div>
        <div class="sugg-item" onmousedown="setSugg('from','Nashik')"><div class="sugg-icon">N</div><div><div style="font-size:13px;font-weight:500">Nashik</div><div style="font-size:11px;color:var(--color-text-secondary)">Maharashtra</div></div></div>
      </div>
    </div>
    <div style="display:flex;align-items:flex-end;padding-bottom:1px">
      <button class="swap-btn" onclick="swapCities()" title="Swap cities">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M8 3L4 7l4 4"/><path d="M4 7h16"/><path d="M16 21l4-4-4-4"/><path d="M20 17H4"/></svg>
      </button>
    </div>
    <div class="sf" style="position:relative">
      <label>To</label>
      <input type="text" id="toInput" placeholder="Goa" value="Goa" oninput="showSugg('to',this.value)" onblur="hideSugg('to')" autocomplete="off">
      <div class="sugg" id="sugg-to" style="display:none">
        <div class="sugg-item" onmousedown="setSugg('to','Goa')"><div class="sugg-icon">G</div><div><div style="font-size:13px;font-weight:500">Goa (Panaji)</div><div style="font-size:11px;color:var(--color-text-secondary)">Goa</div></div></div>
        <div class="sugg-item" onmousedown="setSugg('to','Bangalore')"><div class="sugg-icon">B</div><div><div style="font-size:13px;font-weight:500">Bangalore</div><div style="font-size:11px;color:var(--color-text-secondary)">Karnataka</div></div></div>
        <div class="sugg-item" onmousedown="setSugg('to','Hyderabad')"><div class="sugg-icon">H</div><div><div style="font-size:13px;font-weight:500">Hyderabad</div><div style="font-size:11px;color:var(--color-text-secondary)">Telangana</div></div></div>
      </div>
    </div>
    <div class="sf"><label>Journey date</label><input type="date" id="journeyDate" value="2026-04-15"></div>
    <div class="sf pax-selector">
      <label>Passengers</label>
      <button class="pax-btn" id="paxBtn" onclick="togglePax()">1 Passenger</button>
      <div class="pax-drop" id="paxDrop" style="display:none">
        <div class="pax-row"><div><span style="font-size:13px">Adults</span><div style="font-size:11px;color:var(--color-text-secondary)">12+ yrs</div></div><div class="qty-c"><button class="qb" onclick="chgPax('a',-1)">−</button><span class="qv" id="paxA">1</span><button class="qb" onclick="chgPax('a',1)">+</button></div></div>
        <div class="pax-row"><div><span style="font-size:13px">Children</span><div style="font-size:11px;color:var(--color-text-secondary)">5–11 yrs</div></div><div class="qty-c"><button class="qb" onclick="chgPax('c',-1)">−</button><span class="qv" id="paxC">0</span><button class="qb" onclick="chgPax('c',1)">+</button></div></div>
        <button style="width:100%;margin-top:8px;background:var(--brand);color:#fff;border:none;border-radius:5px;padding:6px;font-size:12px;cursor:pointer" onclick="togglePax()">Done</button>
      </div>
    </div>
    <div style="display:flex;align-items:flex-end">
      <button class="btn-search" onclick="doSearch()">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        Search buses
      </button>
    </div>
  </div>
</div>

<!-- Landing sections — hidden when booking starts -->
<div id="landingSections">

<!-- Offer banner -->
<div style="margin:1rem 1.5rem 0;background:linear-gradient(90deg,#1239a0 0%,#1a56db 100%);border-radius:10px;padding:.85rem 1.25rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px">
  <div style="display:flex;align-items:center;gap:10px">
    <div style="width:32px;height:32px;background:rgba(255,255,255,.15);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M20 12V22H4V12"/><path d="M22 7H2v5h20V7z"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
    </div>
    <div>
      <div style="color:#fff;font-size:14px;font-weight:500">10% off on your first booking</div>
      <div style="color:rgba(255,255,255,.7);font-size:12px">Use code <strong style="color:#fff;font-weight:500">BUSGO10</strong> at checkout</div>
    </div>
  </div>
  <div style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);border-radius:6px;padding:4px 14px;color:#fff;font-size:12px;font-weight:500;cursor:pointer;white-space:nowrap">Claim offer</div>
</div>

<!-- Popular routes -->
<div style="margin:1.25rem 1.5rem 0">
  <div style="font-size:14px;font-weight:500;color:var(--color-text-primary);margin-bottom:.65rem">Popular routes</div>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <button onclick="setRoute('Mumbai','Goa')" style="border:1px solid var(--color-border-tertiary);border-radius:20px;padding:6px 14px;font-size:13px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;display:flex;align-items:center;gap:5px;transition:all .2s" onmouseover="this.style.borderColor='#1a56db';this.style.color='#1a56db'" onmouseout="this.style.borderColor='';this.style.color=''">Mumbai → Goa</button>
    <button onclick="setRoute('Pune','Mumbai')" style="border:1px solid var(--color-border-tertiary);border-radius:20px;padding:6px 14px;font-size:13px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;display:flex;align-items:center;gap:5px;transition:all .2s" onmouseover="this.style.borderColor='#1a56db';this.style.color='#1a56db'" onmouseout="this.style.borderColor='';this.style.color=''">Pune → Mumbai</button>
    <button onclick="setRoute('Mumbai','Bangalore')" style="border:1px solid var(--color-border-tertiary);border-radius:20px;padding:6px 14px;font-size:13px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;display:flex;align-items:center;gap:5px;transition:all .2s" onmouseover="this.style.borderColor='#1a56db';this.style.color='#1a56db'" onmouseout="this.style.borderColor='';this.style.color=''">Mumbai → Bangalore</button>
    <button onclick="setRoute('Delhi','Jaipur')" style="border:1px solid var(--color-border-tertiary);border-radius:20px;padding:6px 14px;font-size:13px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;display:flex;align-items:center;gap:5px;transition:all .2s" onmouseover="this.style.borderColor='#1a56db';this.style.color='#1a56db'" onmouseout="this.style.borderColor='';this.style.color=''">Delhi → Jaipur</button>
    <button onclick="setRoute('Hyderabad','Bangalore')" style="border:1px solid var(--color-border-tertiary);border-radius:20px;padding:6px 14px;font-size:13px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;display:flex;align-items:center;gap:5px;transition:all .2s" onmouseover="this.style.borderColor='#1a56db';this.style.color='#1a56db'" onmouseout="this.style.borderColor='';this.style.color=''">Hyderabad → Bangalore</button>
    <button onclick="setRoute('Chennai','Bangalore')" style="border:1px solid var(--color-border-tertiary);border-radius:20px;padding:6px 14px;font-size:13px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;display:flex;align-items:center;gap:5px;transition:all .2s" onmouseover="this.style.borderColor='#1a56db';this.style.color='#1a56db'" onmouseout="this.style.borderColor='';this.style.color=''">Chennai → Bangalore</button>
  </div>
</div>

<!-- Why BusGo -->
<div style="margin:1.5rem 1.5rem 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px">
  <div style="background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:10px;padding:1rem 1.1rem;display:flex;align-items:flex-start;gap:10px">
    <div style="width:36px;height:36px;background:#e8f0fd;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1a56db" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div>
      <div style="font-size:13px;font-weight:500;color:var(--color-text-primary);margin-bottom:2px">Live seat selection</div>
      <div style="font-size:12px;color:var(--color-text-secondary)">Choose your preferred seat in real time</div>
    </div>
  </div>
  <div style="background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:10px;padding:1rem 1.1rem;display:flex;align-items:flex-start;gap:10px">
    <div style="width:36px;height:36px;background:#dcfce7;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
    </div>
    <div>
      <div style="font-size:13px;font-weight:500;color:var(--color-text-primary);margin-bottom:2px">Safe & secure payment</div>
      <div style="font-size:12px;color:var(--color-text-secondary)">UPI, cards & wallets, all encrypted</div>
    </div>
  </div>
  <div style="background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:10px;padding:1rem 1.1rem;display:flex;align-items:flex-start;gap:10px">
    <div style="width:36px;height:36px;background:#fef3c7;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
    </div>
    <div>
      <div style="font-size:13px;font-weight:500;color:var(--color-text-primary);margin-bottom:2px">Instant confirmation</div>
      <div style="font-size:12px;color:var(--color-text-secondary)">Ticket in seconds, no waiting</div>
    </div>
  </div>
  <div style="background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:10px;padding:1rem 1.1rem;display:flex;align-items:flex-start;gap:10px">
    <div style="width:36px;height:36px;background:#fee2e2;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.69h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17z"/></svg>
    </div>
    <div>
      <div style="font-size:13px;font-weight:500;color:var(--color-text-primary);margin-bottom:2px">24/7 customer support</div>
      <div style="font-size:12px;color:var(--color-text-secondary)">Help available anytime you need</div>
    </div>
  </div>
</div>

<!-- Stats bar -->
<div style="margin:1.25rem 1.5rem 0;background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:10px;padding:1rem 1.5rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:12px;text-align:center">
  <div>
    <div style="font-size:20px;font-weight:500;color:#1a56db">10,000+</div>
    <div style="font-size:12px;color:var(--color-text-secondary);margin-top:2px">Bus operators</div>
  </div>
  <div style="border-left:0.5px solid var(--color-border-tertiary)">
    <div style="font-size:20px;font-weight:500;color:#1a56db">5 Cr+</div>
    <div style="font-size:12px;color:var(--color-text-secondary);margin-top:2px">Happy travellers</div>
  </div>
  <div style="border-left:0.5px solid var(--color-border-tertiary)">
    <div style="font-size:20px;font-weight:500;color:#1a56db">2,000+</div>
    <div style="font-size:12px;color:var(--color-text-secondary);margin-top:2px">Cities covered</div>
  </div>
  <div style="border-left:0.5px solid var(--color-border-tertiary)">
    <div style="font-size:20px;font-weight:500;color:#16a34a">4.7 ★</div>
    <div style="font-size:12px;color:var(--color-text-secondary);margin-top:2px">Average rating</div>
  </div>
</div>

</div><!-- end landingSections -->

<div id="bookingFlow" style="display:none">

<div class="step-bar">
  <div class="step done" id="step1"><div class="step-num" id="s1n"><span>✓</span></div><span>Search</span></div>
  <div class="step-line done"></div>
  <div class="step" id="step2" style="color:var(--brand)"><div class="step-num" style="border-color:var(--brand);color:var(--brand)">2</div><span>Select bus</span></div>
  <div class="step-line" id="sl2"></div>
  <div class="step" id="step3"><div class="step-num">3</div><span>Seats & points</span></div>
  <div class="step-line" id="sl3"></div>
  <div class="step" id="step4"><div class="step-num">4</div><span>Passengers</span></div>
  <div class="step-line" id="sl4"></div>
  <div class="step" id="step5"><div class="step-num">5</div><span>Payment</span></div>
</div>

<div id="viewSearch">
<div class="main">
  <aside class="filters">
    <div class="filter-hd">Filters <span class="filter-reset">Clear all</span></div>
    <div class="fsec">
      <div class="flabel">Departure time</div>
      <div class="time-grid">
        <div class="time-chip" onclick="this.classList.toggle('on')">Before 6am</div>
        <div class="time-chip on" onclick="this.classList.toggle('on')">6am–12pm</div>
        <div class="time-chip on" onclick="this.classList.toggle('on')">12pm–6pm</div>
        <div class="time-chip" onclick="this.classList.toggle('on')">After 6pm</div>
      </div>
    </div>
    <div class="fsec">
      <div class="flabel">Bus type</div>
      <div class="f-chips">
        <div class="fchip on" onclick="this.classList.toggle('on')">AC</div>
        <div class="fchip" onclick="this.classList.toggle('on')">Non-AC</div>
        <div class="fchip on" onclick="this.classList.toggle('on')">Sleeper</div>
        <div class="fchip" onclick="this.classList.toggle('on')">Seater</div>
        <div class="fchip" onclick="this.classList.toggle('on')">Volvo</div>
      </div>
    </div>
    <div class="fsec">
      <div class="flabel">Price range</div>
      <div class="price-range-row">
        <input class="pi" id="minP" value="200" type="number">
        <span style="font-size:12px;color:var(--color-text-secondary)">to</span>
        <input class="pi" id="maxP" value="2500" type="number">
      </div>
      <input type="range" class="range-sl" min="200" max="5000" value="2500" step="50" oninput="document.getElementById('maxP').value=this.value">
    </div>
    <div class="fsec">
      <div class="flabel">Rating</div>
      <div class="f-chips">
        <div class="fchip" onclick="this.classList.toggle('on')">4.5+</div>
        <div class="fchip on" onclick="this.classList.toggle('on')">4.0+</div>
        <div class="fchip" onclick="this.classList.toggle('on')">3.5+</div>
      </div>
    </div>
    <div class="fsec">
      <div class="flabel">Amenities</div>
      <div class="am-list">
        <label class="am-item"><input type="checkbox" checked> Live tracking</label>
        <label class="am-item"><input type="checkbox" checked> Wi-Fi on board</label>
        <label class="am-item"><input type="checkbox"> Charging points</label>
        <label class="am-item"><input type="checkbox"> Blanket & pillow</label>
        <label class="am-item"><input type="checkbox"> Reading light</label>
        <label class="am-item"><input type="checkbox"> Movie screen</label>
      </div>
    </div>
  </aside>

  <div>
    <div class="results-hd">
      <div class="res-count">Showing <strong>5 buses</strong> for Mumbai → Goa · 15 Apr</div>
      <div class="sort-row">
        <span style="font-size:12px;color:var(--color-text-secondary)">Sort:</span>
        <button class="s-btn on" onclick="setSort(this)">Departure</button>
        <button class="s-btn" onclick="setSort(this)">Price</button>
        <button class="s-btn" onclick="setSort(this)">Rating</button>
        <button class="s-btn" onclick="setSort(this)">Duration</button>
      </div>
    </div>

    <div class="buses">
      <div class="bus-card">
        <div class="bus-main">
          <div><div class="op-name">VRL Travels</div><span class="bus-type-badge badge-ac">AC Sleeper</span><div style="font-size:11px;color:var(--color-text-secondary);margin-top:3px">Mercedes Multi-Axle</div></div>
          <div class="time-block"><div style="display:flex;align-items:center;gap:12px"><div><div class="dep-time">21:30</div><div class="time-city">Mumbai</div></div><div class="dur-line" style="flex:1;min-width:60px"><div class="dur-track" style="flex:1"></div><div style="font-size:11px;white-space:nowrap">10h 30m</div><div class="dur-track" style="flex:1"></div></div><div><div class="arr-time">08:00</div><div class="time-city">Goa</div></div></div></div>
          <div class="seats-info"><div class="seats-num">12</div><div class="seats-label">seats left</div></div>
          <div class="price-col"><div class="orig-p">₹1,800</div><div class="main-p">₹1,450</div><div class="per-p">per seat</div><div class="rating-pill">★ 4.6</div></div>
          <div class="card-actions"><div class="urgency">Only 3 left!</div><button class="btn-view" onclick="selectBus('VRL Travels','AC Sleeper',1450,'21:30','08:00','10h 30m')">View seats</button><button class="btn-book" onclick="selectBus('VRL Travels','AC Sleeper',1450,'21:30','08:00','10h 30m')">Book now</button></div>
        </div>
        <div class="bus-extra"><span class="xtag">Wi-Fi</span><span class="xtag">Charging</span><span class="xtag">Live tracking</span><span class="xtag">AC</span><span class="xtag">Meals available</span><span class="discount-badge">19% OFF</span></div>
      </div>

      <div class="bus-card" style="border-color:rgba(26,86,219,.4)">
        <div style="background:var(--brand-light);padding:4px 12px;border-bottom:0.5px solid rgba(26,86,219,.15);font-size:11px;color:var(--brand);font-weight:500">Most booked today</div>
        <div class="bus-main">
          <div><div class="op-name">Neeta Tours</div><span class="bus-type-badge badge-vo">Volvo AC Sleeper</span><div style="font-size:11px;color:var(--color-text-secondary);margin-top:3px">Volvo 9600</div></div>
          <div class="time-block"><div style="display:flex;align-items:center;gap:12px"><div><div class="dep-time">22:00</div><div class="time-city">Mumbai</div></div><div class="dur-line" style="flex:1;min-width:60px"><div class="dur-track" style="flex:1"></div><div style="font-size:11px;white-space:nowrap">11h 00m</div><div class="dur-track" style="flex:1"></div></div><div><div class="arr-time">09:00</div><div class="time-city">Goa</div></div></div></div>
          <div class="seats-info"><div class="seats-num">8</div><div class="seats-label">seats left</div></div>
          <div class="price-col"><div class="main-p">₹1,650</div><div class="per-p">per seat</div><div class="rating-pill">★ 4.8</div></div>
          <div class="card-actions"><button class="btn-view" onclick="selectBus('Neeta Tours','Volvo AC Sleeper',1650,'22:00','09:00','11h 00m')">View seats</button><button class="btn-book" onclick="selectBus('Neeta Tours','Volvo AC Sleeper',1650,'22:00','09:00','11h 00m')">Book now</button></div>
        </div>
        <div class="bus-extra"><span class="xtag">Wi-Fi</span><span class="xtag">Charging</span><span class="xtag">Live tracking</span><span class="xtag">Blanket & pillow</span><span class="xtag">Screen</span></div>
      </div>

      <div class="bus-card">
        <div class="bus-main">
          <div><div class="op-name">Paulo Travels</div><span class="bus-type-badge badge-sl">AC Seater/Sleeper</span></div>
          <div class="time-block"><div style="display:flex;align-items:center;gap:12px"><div><div class="dep-time">23:00</div><div class="time-city">Mumbai</div></div><div class="dur-line" style="flex:1;min-width:60px"><div class="dur-track" style="flex:1"></div><div style="font-size:11px;white-space:nowrap">10h 00m</div><div class="dur-track" style="flex:1"></div></div><div><div class="arr-time">09:00</div><div class="time-city">Goa</div></div></div></div>
          <div class="seats-info"><div class="seats-num">21</div><div class="seats-label">seats left</div></div>
          <div class="price-col"><div class="orig-p">₹1,200</div><div class="main-p">₹950</div><div class="per-p">per seat</div><div class="rating-pill">★ 4.2</div></div>
          <div class="card-actions"><span class="discount-badge">21% OFF</span><button class="btn-view" onclick="selectBus('Paulo Travels','AC Seater/Sleeper',950,'23:00','09:00','10h 00m')">View seats</button><button class="btn-book" onclick="selectBus('Paulo Travels','AC Seater/Sleeper',950,'23:00','09:00','10h 00m')">Book now</button></div>
        </div>
        <div class="bus-extra"><span class="xtag">Live tracking</span><span class="xtag">AC</span><span class="xtag">Charging</span></div>
      </div>

      <div class="bus-card">
        <div class="bus-main">
          <div><div class="op-name">Orange Travels</div><span class="bus-type-badge badge-se">Non-AC Seater</span></div>
          <div class="time-block"><div style="display:flex;align-items:center;gap:12px"><div><div class="dep-time">07:00</div><div class="time-city">Mumbai</div></div><div class="dur-line" style="flex:1;min-width:60px"><div class="dur-track" style="flex:1"></div><div style="font-size:11px;white-space:nowrap">12h 30m</div><div class="dur-track" style="flex:1"></div></div><div><div class="arr-time">19:30</div><div class="time-city">Goa</div></div></div></div>
          <div class="seats-info"><div class="seats-num" style="color:var(--amber)">4</div><div class="seats-label">seats left</div></div>
          <div class="price-col"><div class="main-p" style="font-size:17px">₹600</div><div class="per-p">per seat</div><div class="rating-pill">★ 3.9</div></div>
          <div class="card-actions"><div class="urgency">Filling fast!</div><button class="btn-view" onclick="selectBus('Orange Travels','Non-AC Seater',600,'07:00','19:30','12h 30m')">View seats</button><button class="btn-book" onclick="selectBus('Orange Travels','Non-AC Seater',600,'07:00','19:30','12h 30m')">Book now</button></div>
        </div>
        <div class="bus-extra"><span class="xtag">Live tracking</span></div>
      </div>

      <div class="bus-card">
        <div class="bus-main">
          <div><div class="op-name">SRS Travels</div><span class="bus-type-badge badge-ac">AC Sleeper</span></div>
          <div class="time-block"><div style="display:flex;align-items:center;gap:12px"><div><div class="dep-time">20:30</div><div class="time-city">Mumbai</div></div><div class="dur-line" style="flex:1;min-width:60px"><div class="dur-track" style="flex:1"></div><div style="font-size:11px;white-space:nowrap">11h 30m</div><div class="dur-track" style="flex:1"></div></div><div><div class="arr-time">08:00</div><div class="time-city">Goa</div></div></div></div>
          <div class="seats-info"><div class="seats-num">16</div><div class="seats-label">seats left</div></div>
          <div class="price-col"><div class="orig-p">₹1,500</div><div class="main-p">₹1,250</div><div class="per-p">per seat</div><div class="rating-pill">★ 4.4</div></div>
          <div class="card-actions"><span class="discount-badge">17% OFF</span><button class="btn-view" onclick="selectBus('SRS Travels','AC Sleeper',1250,'20:30','08:00','11h 30m')">View seats</button><button class="btn-book" onclick="selectBus('SRS Travels','AC Sleeper',1250,'20:30','08:00','11h 30m')">Book now</button></div>
        </div>
        <div class="bus-extra"><span class="xtag">Wi-Fi</span><span class="xtag">Charging</span><span class="xtag">Live tracking</span><span class="xtag">AC</span></div>
      </div>
    </div>
  </div>
</div>
</div>

<div id="viewSeats" style="display:none;padding:1rem 1.5rem">
  <div style="display:flex;align-items:center;gap:8px;margin-bottom:.75rem">
    <button class="btn-back" onclick="goBack('search')">← Back</button>
    <span style="font-size:14px;color:var(--color-text-secondary)"><span id="sBusName" style="color:var(--color-text-primary);font-weight:500"></span> · <span id="sBusType"></span> · <span id="sDep"></span> – <span id="sArr"></span> · <span id="sDur"></span></span>
  </div>
  <div class="panel">
    <div class="panel-hd">Select your seats
      <div class="deck-tabs">
        <button class="dtab on" onclick="setDeck(this,'lower')">Lower deck</button>
        <button class="dtab" onclick="setDeck(this,'upper')">Upper deck</button>
      </div>
    </div>
    <div class="panel-body">
      <div class="seat-legend">
        <div class="leg-item"><div class="leg-box" style="background:#dcfce7;border:1.5px solid #16a34a"></div> Available</div>
        <div class="leg-item"><div class="leg-box" style="background:#fee2e2;border:1.5px solid #dc2626"></div> Booked</div>
        <div class="leg-item"><div class="leg-box" style="background:#1a56db;border:1.5px solid #1239a0"></div> Selected</div>
        <div class="leg-item"><div class="leg-box" style="background:#fce7f3;border:1.5px solid #db2777"></div> Ladies only</div>
      </div>
      <div class="seat-layout-wrap">
        <div><div class="bus-shell" id="seatGrid"></div></div>
        <div class="seat-info-panel">
          <div style="font-size:13px;font-weight:500;margin-bottom:.5rem">Selected seats</div>
          <div class="sel-seats-list" id="selSeatsList"><div class="no-sel">No seats selected. Click available seats to select.</div></div>
          <div class="price-preview" id="pricePreview" style="display:none">
            <div class="pp-row"><span>Seats selected</span><span id="ppCount">0</span></div>
            <div class="pp-row"><span>Base fare</span><span id="ppBase">₹0</span></div>
            <div class="pp-row" style="color:var(--green)"><span>Discount</span><span id="ppDisc">−₹0</span></div>
            <div class="pp-row"><span>GST (5%)</span><span id="ppGst">₹0</span></div>
            <div class="pp-row pp-total"><span>Total</span><span id="ppTotal">₹0</span></div>
          </div>
          <div class="next-btn-row" id="seatNextRow" style="display:none">
            <button class="btn-next" onclick="goToPoints()">Next: Boarding point →</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="viewPoints" style="display:none;padding:1rem 1.5rem">
  <div style="display:flex;align-items:center;gap:8px;margin-bottom:.75rem">
    <button class="btn-back" onclick="goBack('seats')">← Back</button>
    <span style="font-size:14px;font-weight:500">Boarding & dropping points</span>
  </div>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
    <div class="panel">
      <div class="panel-hd">Boarding point</div>
      <div class="panel-body">
        <div style="display:flex;flex-direction:column;gap:.75rem">
          <div class="bp-list" id="boardingList">
            <div class="bp-item sel" onclick="selPoint('b',this)"><div class="bp-name">Dadar Bus Stand</div><div class="bp-time">21:30 · 15 Apr</div></div>
            <div class="bp-item" onclick="selPoint('b',this)"><div class="bp-name">Borivali Flyover</div><div class="bp-time">21:55 · 15 Apr</div></div>
            <div class="bp-item" onclick="selPoint('b',this)"><div class="bp-name">Mira Road Toll</div><div class="bp-time">22:20 · 15 Apr</div></div>
            <div class="bp-item" onclick="selPoint('b',this)"><div class="bp-name">Thane Junction</div><div class="bp-time">22:45 · 15 Apr</div></div>
          </div>
          <div class="bp-map">
            <div class="map-placeholder">
              <div style="position:absolute;inset:0;background:#dce9f5"></div>
              <div style="position:absolute;top:30px;left:35%;width:40%;height:1.5px;background:#b8c8d8;transform:rotate(-15deg)"></div>
              <div style="position:absolute;top:50px;left:20%;width:60%;height:1.5px;background:#b8c8d8;transform:rotate(5deg)"></div>
              <div class="map-pin" style="top:28px;left:42%"><div class="map-pin-inner"></div></div>
              <div style="position:absolute;bottom:8px;left:50%;transform:translateX(-50%);font-size:11px;color:#555;background:rgba(255,255,255,.8);padding:2px 6px;border-radius:3px;white-space:nowrap" id="boardMapLabel">Dadar Bus Stand</div>
            </div>
            <div class="map-info" id="boardMapInfo">Dadar Bus Stand, Mumbai · 21:30</div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel">
      <div class="panel-hd">Dropping point</div>
      <div class="panel-body">
        <div style="display:flex;flex-direction:column;gap:.75rem">
          <div class="bp-list" id="droppingList">
            <div class="bp-item" onclick="selPoint('d',this)"><div class="bp-name">Panaji Bus Stand</div><div class="bp-time">08:00 · 16 Apr</div></div>
            <div class="bp-item sel" onclick="selPoint('d',this)"><div class="bp-name">Mapusa Bus Stand</div><div class="bp-time">07:30 · 16 Apr</div></div>
            <div class="bp-item" onclick="selPoint('d',this)"><div class="bp-name">Calangute</div><div class="bp-time">08:20 · 16 Apr</div></div>
            <div class="bp-item" onclick="selPoint('d',this)"><div class="bp-name">Margao Bus Stand</div><div class="bp-time">09:00 · 16 Apr</div></div>
          </div>
          <div class="bp-map">
            <div class="map-placeholder">
              <div style="position:absolute;inset:0;background:#dce9f5"></div>
              <div style="position:absolute;top:40px;left:25%;width:50%;height:1.5px;background:#b8c8d8;transform:rotate(10deg)"></div>
              <div class="map-pin" style="top:30px;left:55%"><div class="map-pin-inner"></div></div>
              <div style="position:absolute;bottom:8px;left:50%;transform:translateX(-50%);font-size:11px;color:#555;background:rgba(255,255,255,.8);padding:2px 6px;border-radius:3px;white-space:nowrap" id="dropMapLabel">Mapusa Bus Stand</div>
            </div>
            <div class="map-info" id="dropMapInfo">Mapusa Bus Stand, Goa · 07:30</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="next-btn-row">
    <button class="btn-next" onclick="goToPassengers()">Next: Passenger details →</button>
  </div>
</div>

<div id="viewPassengers" style="display:none;padding:1rem 1.5rem">
  <div style="display:flex;align-items:center;gap:8px;margin-bottom:.75rem">
    <button class="btn-back" onclick="goBack('points')">← Back</button>
    <span style="font-size:14px;font-weight:500">Passenger details</span>
  </div>
  <div class="panel">
    <div class="panel-hd">Passenger 1 (Seat <span id="pSeat1">L1</span>)</div>
    <div class="panel-body">
      <div class="autofill-bar"><span>Autofill from saved travellers</span><button class="btn-autofill" onclick="autofill()">Autofill</button></div>
      <div class="pass-form">
        <div class="fg"><label>First name</label><input type="text" id="pfn" placeholder="Rahul"></div>
        <div class="fg"><label>Last name</label><input type="text" id="pln" placeholder="Sharma"></div>
        <div class="fg"><label>Age</label><input type="number" id="page" placeholder="28" min="1" max="99"></div>
        <div class="fg"><label>Gender</label><select id="pgender"><option>Male</option><option>Female</option><option>Other</option></select></div>
        <div class="fg"><label>Mobile number</label><input type="tel" id="pmob" placeholder="+91 98765 43210"></div>
        <div class="fg"><label>Email ID</label><input type="email" id="pemail" placeholder="rahul@example.com"></div>
        <div class="fg fg-full"><label>GST details (optional)</label><input type="text" placeholder="GST number for business booking"></div>
      </div>
    </div>
  </div>
  <div class="next-btn-row">
    <button class="btn-next" onclick="goToPayment()">Next: Payment →</button>
  </div>
</div>

<div id="viewPayment" style="display:none;padding:1rem 1.5rem">
  <div style="display:flex;align-items:center;gap:8px;margin-bottom:.75rem">
    <button class="btn-back" onclick="goBack('passengers')">← Back</button>
    <span style="font-size:14px;font-weight:500">Secure payment</span>
  </div>
  <div style="display:grid;grid-template-columns:1fr 340px;gap:1rem">
    <div>
      <div class="panel">
        <div class="panel-hd">Payment method</div>
        <div class="panel-body">
          <div class="pay-opts">
            <div class="pay-opt on" onclick="selPay(this,'card')"><div style="font-size:14px;color:var(--brand);font-weight:500;margin-bottom:4px">CARD</div><div class="pay-lbl">Credit/Debit</div></div>
            <div class="pay-opt" onclick="selPay(this,'upi')"><div style="font-size:14px;color:#7c3aed;font-weight:500;margin-bottom:4px">UPI</div><div class="pay-lbl">UPI</div></div>
            <div class="pay-opt" onclick="selPay(this,'wallet')"><div style="font-size:14px;color:#d97706;font-weight:500;margin-bottom:4px">Wallet</div><div class="pay-lbl">Wallets</div></div>
            <div class="pay-opt" onclick="selPay(this,'nb')"><div style="font-size:14px;color:#059669;font-weight:500;margin-bottom:4px">NB</div><div class="pay-lbl">Net banking</div></div>
          </div>
          <div id="payCard">
            <div class="card-fields">
              <div class="fg fg-full"><label>Card number</label><input type="text" placeholder="4111 1111 1111 1111" maxlength="19"></div>
              <div class="fg"><label>Expiry</label><input type="text" placeholder="MM/YY" maxlength="5"></div>
              <div class="fg"><label>CVV</label><input type="text" placeholder="•••" maxlength="4"></div>
              <div class="fg fg-full"><label>Name on card</label><input type="text" placeholder="RAHUL SHARMA"></div>
            </div>
          </div>
          <div id="payUpi" style="display:none"><div class="fg" style="margin-bottom:1rem"><label>UPI ID</label><input type="text" placeholder="rahul@paytm"></div></div>
          <div id="payWallet" style="display:none"><div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:1rem"><div class="pay-opt" style="min-width:80px;flex:1"><div style="font-size:12px;color:#7c3aed;font-weight:500;margin-bottom:2px">PhonePe</div></div><div class="pay-opt" style="min-width:80px;flex:1"><div style="font-size:12px;color:#16a34a;font-weight:500;margin-bottom:2px">GPay</div></div><div class="pay-opt" style="min-width:80px;flex:1"><div style="font-size:12px;color:#0369a1;font-weight:500;margin-bottom:2px">Paytm</div></div><div class="pay-opt" style="min-width:80px;flex:1"><div style="font-size:12px;color:#dc2626;font-weight:500;margin-bottom:2px">Amazon Pay</div></div></div></div>
          <div id="payNb" style="display:none"><div class="fg" style="margin-bottom:1rem"><label>Select bank</label><select><option>State Bank of India</option><option>HDFC Bank</option><option>ICICI Bank</option><option>Axis Bank</option><option>Kotak Mahindra</option></select></div></div>
          <div class="promo-row">
            <input type="text" id="promoIn" placeholder="Promo code (try BUSGO10)">
            <button class="btn-promo" onclick="applyPromo()">Apply</button>
          </div>
          <div id="promoMsg" style="display:none;font-size:12px;color:var(--green);margin-bottom:.75rem">10% discount applied!</div>
          <button class="btn-pay" onclick="confirmPay()">Pay & confirm booking — <span id="payBtnAmt">₹0</span></button>
          <div class="sec-row">
            <div class="sec-badge">SSL Encrypted</div>
            <div class="sec-badge">PCI DSS</div>
            <div class="sec-badge">Safe & secure</div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="panel">
        <div class="panel-hd">Fare breakdown</div>
        <div class="panel-body">
          <div class="fare-box">
            <div class="fare-row"><span>Bus fare (<span id="fbSeats">1</span> seat)</span><span id="fbBase">₹0</span></div>
            <div class="fare-row"><span>Operator charges</span><span id="fbOp">₹0</span></div>
            <div class="fare-row fare-disc"><span>Discount</span><span id="fbDisc">−₹0</span></div>
            <div class="fare-row fare-disc" id="fbPromoRow" style="display:none"><span>Promo (BUSGO10)</span><span id="fbPromo">−₹0</span></div>
            <div class="fare-row"><span>GST (5%)</span><span id="fbGst">₹0</span></div>
            <div class="fare-row" style="color:var(--color-text-secondary)"><span>Convenience fee</span><span>₹30</span></div>
            <div class="fare-row fare-total"><span>Total payable</span><span id="fbTotal">₹0</span></div>
          </div>
          <div style="margin-top:.75rem;background:#f0fdf4;border-radius:var(--rs);padding:8px 10px;font-size:12px;color:#166534;border:0.5px solid #bbf7d0">Free cancellation before 24h of departure</div>
          <div style="margin-top:.5rem;background:var(--color-background-secondary);border-radius:var(--rs);padding:8px 10px">
            <div style="font-size:11px;color:var(--color-text-secondary);margin-bottom:4px;font-weight:500;text-transform:uppercase;letter-spacing:.4px">Booking summary</div>
            <div style="font-size:12px;margin-bottom:2px"><span id="sumBus" style="font-weight:500"></span></div>
            <div style="font-size:12px;color:var(--color-text-secondary)">Mumbai → Goa · 15 Apr · <span id="sumSeats"></span></div>
            <div style="font-size:12px;color:var(--color-text-secondary)">Boarding: Dadar Bus Stand · 21:30</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<div id="viewConfirm" style="display:none;padding:2rem 1.5rem">
  <div class="confirm-card">
    <div class="confirm-top">
      <div class="confirm-icon"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <div style="font-size:18px;font-weight:500;margin-bottom:.25rem">Booking confirmed!</div>
      <div style="font-size:13px;opacity:.8">Your ticket has been sent to <span id="confEmail"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d9abb8b1acb599bca1b8b4a9b5bcf7bab6b4">[email&#160;protected]</a></span></div>
      <div class="pnr-box"><div class="pnr-label">PNR / Booking ID</div><div class="pnr-val" id="pnrVal">BG-481953</div></div>
    </div>
    <div style="padding:1.25rem">
      <div class="ticket-grid">
        <div class="tg-item"><div class="tg-label">Operator</div><div class="tg-val" id="confBus">VRL Travels</div></div>
        <div class="tg-item"><div class="tg-label">Bus type</div><div class="tg-val" id="confType">AC Sleeper</div></div>
        <div class="tg-item"><div class="tg-label">Date</div><div class="tg-val">15 April 2026</div></div>
        <div class="tg-item"><div class="tg-label">Departure</div><div class="tg-val" id="confDep">21:30 — Dadar</div></div>
        <div class="tg-item"><div class="tg-label">Arrival</div><div class="tg-val" id="confArr">08:00 — Mapusa</div></div>
        <div class="tg-item"><div class="tg-label">Seat(s)</div><div class="tg-val" id="confSeats">L1</div></div>
        <div class="tg-item"><div class="tg-label">Passenger</div><div class="tg-val" id="confPass">Rahul Sharma</div></div>
        <div class="tg-item"><div class="tg-label">Amount paid</div><div class="tg-val" id="confAmt" style="color:var(--brand)">₹0</div></div>
      </div>
      <div style="display:flex;gap:8px;margin-bottom:.75rem;flex-wrap:wrap">
        <div class="tg-item" style="flex:1"><div class="tg-label">Status</div><div class="tg-val" style="color:var(--green)">✓ Confirmed</div></div>
        <div class="tg-item" style="flex:1"><div class="tg-label">Payment</div><div class="tg-val" style="color:var(--green)">✓ Paid</div></div>
      </div>
      <div class="confirm-actions">
        <button class="btn-dl">Download ticket</button>
        <button class="btn-share">Share ticket</button>
        <button class="btn-new" onclick="startOver()">New booking</button>
      </div>
      <div style="margin-top:.75rem;text-align:center;font-size:12px;color:var(--color-text-secondary)">Need help? Call 1800-102-0101 or chat with support</div>
    </div>
  </div>
</div>

</div>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
var pax={a:1,c:0};
var selBus={name:'',type:'',price:0,dep:'',arr:'',dur:''};
var selSeats=[];
var promoOn=false;

function showSugg(t,v){if(v.length>0)document.getElementById('sugg-'+t).style.display='block';else document.getElementById('sugg-'+t).style.display='none'}
function hideSugg(t){setTimeout(()=>document.getElementById('sugg-'+t).style.display='none',150)}
function setSugg(t,v){document.getElementById(t+'Input').value=v;document.getElementById('sugg-'+t).style.display='none'}
function swapCities(){var f=document.getElementById('fromInput').value,t=document.getElementById('toInput').value;document.getElementById('fromInput').value=t;document.getElementById('toInput').value=f}
function togglePax(){var d=document.getElementById('paxDrop');d.style.display=d.style.display==='none'?'block':'none'}
function chgPax(t,d){pax[t]=Math.max(0,pax[t]+d);if(t==='a')pax.a=Math.max(1,pax.a);document.getElementById('pax'+t.toUpperCase()).textContent=pax[t];var tot=pax.a+pax.c;document.getElementById('paxBtn').textContent=tot+(tot===1?' Passenger':' Passengers')}
document.addEventListener('click',e=>{if(!e.target.closest('.pax-selector'))document.getElementById('paxDrop').style.display='none'});

function doSearch(){
  document.getElementById('heroSection').style.paddingBottom='1rem';
  document.getElementById('landingSections').style.display='none';
  document.getElementById('bookingFlow').style.display='block';
  showView('search');setStep(2);
}

function setRoute(from,to){
  document.getElementById('fromInput').value=from;
  document.getElementById('toInput').value=to;
  doSearch();
}

function showView(v){
  ['search','seats','points','passengers','payment'].forEach(n=>{document.getElementById('view'+n.charAt(0).toUpperCase()+n.slice(1)).style.display=n===v?'block':'none'});
  document.getElementById('viewConfirm').style.display=v==='confirm'?'block':'none';
}

function setStep(n){
  [1,2,3,4,5].forEach(i=>{
    var el=document.getElementById('step'+i);
    var num=el.querySelector('.step-num');
    if(i<n){el.className='step done';el.style.color='';num.innerHTML='✓'}
    else if(i===n){el.className='step active';el.style.color='var(--brand)';num.style.borderColor='var(--brand)';num.style.color='var(--brand)';if(!num.innerHTML.match(/\d/))num.innerHTML=i}
    else{el.className='step';el.style.color='';num.style.borderColor='';num.style.color='';num.innerHTML=i}
  });
  [2,3,4].forEach(i=>{var el=document.getElementById('sl'+i);if(el)el.className='step-line'+(i<n?' done':'')});
}

function setSort(btn){document.querySelectorAll('.s-btn').forEach(b=>b.classList.remove('on'));btn.classList.add('on')}

var LAYOUT=[['L1','L2','','L3','L4'],['L5','L6','','L7','L8'],['L9','L10','','L11','L12'],['L13','L14','','L15','L16'],['L17','L18','','L19','L20']];
var bookedSeats=['L2','L7','L11','L15','L18'];
var ladiesSeats=['L4','L8'];

function buildSeatGrid(){
  var grid=document.getElementById('seatGrid');
  grid.innerHTML='';
  grid.style.display='grid';grid.style.gap='5px';
  LAYOUT.forEach(row=>{
    var rd=document.createElement('div');rd.className='seat-row';
    row.forEach(id=>{
      var s=document.createElement('div');
      if(id===''){s.className='seat aisle';s.textContent='aisle';}
      else{
        var st='avail';
        if(bookedSeats.includes(id))st='booked';
        else if(ladiesSeats.includes(id))st='ladies';
        if(selSeats.includes(id))st='selected';
        s.className='seat '+st;s.textContent=id;s.dataset.id=id;
        s.onclick=()=>clickSeat(id,s);
      }
      rd.appendChild(s);
    });
    grid.appendChild(rd);
  });
}

function clickSeat(id,el){
  if(el.classList.contains('booked'))return;
  if(el.classList.contains('selected')){
    el.classList.remove('selected');
    if(ladiesSeats.includes(id))el.classList.add('ladies');else el.classList.add('avail');
    selSeats=selSeats.filter(s=>s!==id);
  } else {
    if(selSeats.length>=4){alert('Max 4 seats per booking');return;}
    el.classList.remove('avail','ladies');el.classList.add('selected');selSeats.push(id);
  }
  updateSeatInfo();
}

function updateSeatInfo(){
  var list=document.getElementById('selSeatsList');
  var pp=document.getElementById('pricePreview');
  var nr=document.getElementById('seatNextRow');
  if(selSeats.length===0){list.innerHTML='<div class="no-sel">No seats selected. Click available seats to select.</div>';pp.style.display='none';nr.style.display='none';return;}
  list.innerHTML=selSeats.map(s=>'<span class="sel-seat-tag">'+s+' <span class="sel-seat-x" onclick="removeSeat(\''+s+'\')">×</span></span>').join('');
  pp.style.display='block';nr.style.display='flex';
  var base=selBus.price*selSeats.length;
  var disc=Math.round(base*0.1);var gst=Math.round((base-disc)*0.05);
  document.getElementById('ppCount').textContent=selSeats.length;
  document.getElementById('ppBase').textContent='₹'+base.toLocaleString('en-IN');
  document.getElementById('ppDisc').textContent='−₹'+disc.toLocaleString('en-IN');
  document.getElementById('ppGst').textContent='₹'+gst.toLocaleString('en-IN');
  document.getElementById('ppTotal').textContent='₹'+(base-disc+gst).toLocaleString('en-IN');
}

function removeSeat(id){
  var el=document.querySelector('.seat[data-id="'+id+'"]');
  if(el){el.classList.remove('selected');if(ladiesSeats.includes(id))el.classList.add('ladies');else el.classList.add('avail');}
  selSeats=selSeats.filter(s=>s!==id);updateSeatInfo();
}

function setDeck(btn){document.querySelectorAll('.dtab').forEach(t=>t.classList.remove('on'));btn.classList.add('on');buildSeatGrid()}

function selectBus(name,type,price,dep,arr,dur){
  selBus={name,type,price,dep,arr,dur};selSeats=[];
  document.getElementById('sBusName').textContent=name;document.getElementById('sBusType').textContent=type;
  document.getElementById('sDep').textContent=dep;document.getElementById('sArr').textContent=arr;document.getElementById('sDur').textContent=dur;
  buildSeatGrid();showView('seats');setStep(3);
}

function goToPoints(){if(selSeats.length===0){alert('Please select at least one seat');return;}showView('points');setStep(3);}

function selPoint(type,el){
  var listId=type==='b'?'boardingList':'droppingList';
  document.querySelectorAll('#'+listId+' .bp-item').forEach(i=>i.classList.remove('sel'));el.classList.add('sel');
  var name=el.querySelector('.bp-name').textContent;var time=el.querySelector('.bp-time').textContent;
  if(type==='b'){document.getElementById('boardMapLabel').textContent=name;document.getElementById('boardMapInfo').textContent=name+' · '+time;}
  else{document.getElementById('dropMapLabel').textContent=name;document.getElementById('dropMapInfo').textContent=name+' · '+time;}
}

function goToPassengers(){document.getElementById('pSeat1').textContent=selSeats[0]||'L1';showView('passengers');setStep(4);}
function autofill(){document.getElementById('pfn').value='Rahul';document.getElementById('pln').value='Sharma';document.getElementById('page').value='28';document.getElementById('pgender').value='Male';document.getElementById('pmob').value='+91 98765 43210';document.getElementById('pemail').value='rahul@example.com';}

function goToPayment(){
  updateFare(false);
  document.getElementById('sumBus').textContent=selBus.name+' ('+selBus.type+')';
  document.getElementById('sumSeats').textContent='Seat '+selSeats.join(', ');
  document.getElementById('confPass').textContent=(document.getElementById('pfn').value||'Rahul')+' '+(document.getElementById('pln').value||'Sharma');
  document.getElementById('confEmail').textContent=document.getElementById('pemail').value||'rahul@example.com';
  showView('payment');setStep(5);
}

function updateFare(promo){
  var n=selSeats.length||1;var base=selBus.price*n;var op=Math.round(base*0.03);var disc=Math.round(base*0.1);
  var promoAmt=promo?Math.round(base*0.1):0;var gst=Math.round((base+op-disc-promoAmt)*0.05);var total=base+op-disc-promoAmt+gst+30;
  document.getElementById('fbSeats').textContent=n;
  document.getElementById('fbBase').textContent='₹'+base.toLocaleString('en-IN');
  document.getElementById('fbOp').textContent='₹'+op.toLocaleString('en-IN');
  document.getElementById('fbDisc').textContent='−₹'+disc.toLocaleString('en-IN');
  document.getElementById('fbGst').textContent='₹'+gst.toLocaleString('en-IN');
  document.getElementById('fbTotal').textContent='₹'+total.toLocaleString('en-IN');
  document.getElementById('payBtnAmt').textContent='₹'+total.toLocaleString('en-IN');
  if(promo){document.getElementById('fbPromoRow').style.display='flex';document.getElementById('fbPromo').textContent='−₹'+promoAmt.toLocaleString('en-IN');}
  document.getElementById('confAmt').textContent='₹'+total.toLocaleString('en-IN');
  return total;
}

function selPay(el,type){
  document.querySelectorAll('.pay-opt').forEach(o=>o.classList.remove('on'));el.classList.add('on');
  document.getElementById('payCard').style.display=type==='card'?'block':'none';
  document.getElementById('payUpi').style.display=type==='upi'?'block':'none';
  document.getElementById('payWallet').style.display=type==='wallet'?'block':'none';
  document.getElementById('payNb').style.display=type==='nb'?'block':'none';
}

function applyPromo(){
  var code=document.getElementById('promoIn').value.trim().toUpperCase();
  var msg=document.getElementById('promoMsg');
  if(code==='BUSGO10'){promoOn=true;msg.textContent='10% discount applied!';msg.style.color='var(--green)';msg.style.display='block';updateFare(true);}
  else{msg.textContent='Invalid promo code';msg.style.color='var(--red)';msg.style.display='block';}
}

function confirmPay(){
  var btn=document.querySelector('.btn-pay');btn.textContent='Processing...';btn.disabled=true;
  setTimeout(()=>{
    document.getElementById('pnrVal').textContent='BG-'+Math.floor(100000+Math.random()*900000);
    document.getElementById('confBus').textContent=selBus.name;document.getElementById('confType').textContent=selBus.type;
    document.getElementById('confDep').textContent=selBus.dep+' — Dadar';document.getElementById('confArr').textContent=selBus.arr+' — Mapusa';
    document.getElementById('confSeats').textContent=selSeats.join(', ')||'L1';
    showView('confirm');btn.textContent='Pay & confirm booking';btn.disabled=false;
  },1800);
}

function goBack(to){
  showView(to);
  if(to==='search')setStep(2);else if(to==='seats')setStep(3);else if(to==='points')setStep(3);else if(to==='passengers')setStep(4);
}

function startOver(){
  document.getElementById('landingSections').style.display='block';
  document.getElementById('bookingFlow').style.display='none';
  document.getElementById('heroSection').style.paddingBottom='2.5rem';
}
</script>