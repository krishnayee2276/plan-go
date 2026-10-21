<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>SKYWAY – Flight Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet" />
<style>
  :root {
    --color-text-primary: #1a1a1a;
    --color-text-secondary: #6b7280;
    --color-text-tertiary: #9ca3af;
    --color-text-danger: #dc2626;
    --color-background-primary: #ffffff;
    --color-background-secondary: #f3f4f6;
    --color-border-tertiary: #e5e7eb;
    --color-border-secondary: #d1d5db;
    --color-border-danger: #dc2626;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Outfit', 'Segoe UI', sans-serif; color: var(--color-text-primary); background: #f9fafb; }
  #app { max-width: 960px; margin: 0 auto; padding: 1rem; }
  .header { display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 0.5px solid var(--color-border-tertiary); }
  .logo { background: #0B3EBF; color: #fff; font-weight: 700; font-size: 18px; padding: 6px 14px; border-radius: 8px; letter-spacing: 1px; }
  .nav-item { font-size: 13px; color: var(--color-text-secondary); cursor: pointer; padding: 4px 0; }
  .card { background: var(--color-background-primary); border: 0.5px solid var(--color-border-tertiary); border-radius: 12px; padding: 1.25rem; }
  label.field-label { font-size: 11px; font-weight: 500; color: var(--color-text-secondary); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px; display: block; }
  .input { width: 100%; border: 0.5px solid var(--color-border-secondary); border-radius: 8px; padding: 10px 12px; font-size: 15px; background: var(--color-background-primary); color: var(--color-text-primary); font-family: inherit; }
  .input:focus { outline: none; border-color: #0B3EBF; }
  .btn { background: #0B3EBF; color: #fff; border: none; border-radius: 8px; padding: 12px 28px; font-size: 15px; font-weight: 600; cursor: pointer; font-family: inherit; }
  .btn:hover { background: #0930a0; }
  .btn-sm { background: var(--color-background-secondary); color: var(--color-text-primary); border: 0.5px solid var(--color-border-secondary); border-radius: 6px; padding: 6px 14px; font-size: 13px; cursor: pointer; font-family: inherit; }
  .btn-outline { background: transparent; color: #0B3EBF; border: 1px solid #0B3EBF; border-radius: 8px; padding: 10px 22px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: inherit; }
  .pill { padding: 6px 16px; border-radius: 20px; font-size: 13px; cursor: pointer; font-family: inherit; font-weight: 400; border: 1px solid var(--color-border-secondary); background: transparent; color: var(--color-text-secondary); }
  .pill.active { background: #0B3EBF; color: #fff; border-color: #0B3EBF; font-weight: 600; }
  .sug { position: absolute; top: 100%; left: 0; right: 0; z-index: 100; background: var(--color-background-primary); border: 0.5px solid var(--color-border-secondary); border-radius: 8px; margin-top: 4px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); }
  .sug-item { padding: 10px 14px; cursor: pointer; border-bottom: 0.5px solid var(--color-border-tertiary); font-size: 14px; }
  .sug-item:hover { background: var(--color-background-secondary); }
  .sug-item .code { font-weight: 500; }
  .sug-item .name { font-size: 11px; color: var(--color-text-secondary); }
  .h2 { font-size: 18px; font-weight: 500; margin-bottom: 0.75rem; }
  .h3 { font-size: 15px; font-weight: 500; margin-bottom: 0.5rem; }
  .tag { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 500; }
  .tag-green { background: #EAF3DE; color: #3B6D11; }
  .tag-blue { background: #E6F1FB; color: #185FA5; }
  .tag-default { background: #F1EFE8; color: #5F5E5A; }
  .err { font-size: 12px; color: var(--color-text-danger); margin-top: 2px; }
  .step-bar { display: flex; align-items: center; gap: 0; margin-bottom: 1.5rem; overflow-x: auto; }
  .step-item { display: flex; align-items: center; gap: 6px; font-size: 13px; }
  .step-connector { width: 24px; height: 1px; background: var(--color-border-tertiary); margin: 0 6px; }
  .dot { width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; border: 1.5px solid; flex-shrink: 0; }
  .section { margin-bottom: 1.5rem; }
  .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
  .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
  input[type=range] { width: 100%; }
  select.input { appearance: auto; }
  .hidden { display: none !important; }
</style>
</head>
<body>
<div id="app"></div>

<script>
const AIRPORTS = [
  { code: "DEL", city: "New Delhi", name: "Indira Gandhi International" },
  { code: "BOM", city: "Mumbai", name: "Chhatrapati Shivaji International" },
  { code: "BLR", city: "Bangalore", name: "Kempegowda International" },
  { code: "HYD", city: "Hyderabad", name: "Rajiv Gandhi International" },
  { code: "MAA", city: "Chennai", name: "Chennai International" },
  { code: "CCU", city: "Kolkata", name: "Netaji Subhas International" },
  { code: "AMD", city: "Ahmedabad", name: "Sardar Vallabhbhai Patel Intl" },
  { code: "COK", city: "Kochi", name: "Cochin International" },
  { code: "DXB", city: "Dubai", name: "Dubai International" },
  { code: "LHR", city: "London", name: "Heathrow Airport" },
  { code: "JFK", city: "New York", name: "John F. Kennedy International" },
  { code: "SIN", city: "Singapore", name: "Changi Airport" },
];

const FLIGHTS = [
  { id: 1, airline: "IndiGo", code: "6E-204", logo: "6E", dep: "06:00", arr: "08:15", duration: "2h 15m", stops: 0, price: 4299, class: "Economy", baggage: "15 kg", meal: "Paid", seat: "Standard", aircraft: "A320" },
  { id: 2, airline: "Air India", code: "AI-807", logo: "AI", dep: "09:30", arr: "12:00", duration: "2h 30m", stops: 0, price: 5850, class: "Economy", baggage: "25 kg", meal: "Included", seat: "Standard", aircraft: "B787" },
  { id: 3, airline: "Vistara", code: "UK-995", logo: "UK", dep: "11:45", arr: "15:20", duration: "3h 35m", stops: 1, price: 3799, class: "Economy", baggage: "20 kg", meal: "Paid", seat: "Recliner", aircraft: "A321" },
  { id: 4, airline: "SpiceJet", code: "SG-116", logo: "SG", dep: "14:00", arr: "16:10", duration: "2h 10m", stops: 0, price: 3299, class: "Economy", baggage: "15 kg", meal: "Paid", seat: "Standard", aircraft: "B737" },
  { id: 5, airline: "Air India", code: "AI-503", logo: "AI", dep: "17:15", arr: "19:50", duration: "2h 35m", stops: 0, price: 6200, class: "Business", baggage: "35 kg", meal: "Included", seat: "Lie-flat", aircraft: "B777" },
  { id: 6, airline: "IndiGo", code: "6E-411", logo: "6E", dep: "21:00", arr: "23:10", duration: "2h 10m", stops: 0, price: 3950, class: "Economy", baggage: "15 kg", meal: "Paid", seat: "Standard", aircraft: "A320neo" },
];

const SEATS = ["1A","1B","1C","2A","2B","2C","3A","3B","3C","4A","4B","4C","5A","5B","5C","6A","6B","6C","7A","7B","7C","8A","8B","8C"];
const OCCUPIED = ["1A","2C","4B","5A","6C","7B"];
const airlineColor = { "6E": "#0B3EBF", "AI": "#D63626", "UK": "#7B2D9E", "SG": "#E2231A" };

const pnr = "PNR" + Math.random().toString(36).substr(2,6).toUpperCase();

const state = {
  step: "search",
  tripType: "one-way",
  from: { code: "DEL", city: "New Delhi" },
  to: { code: "BOM", city: "Mumbai" },
  depDate: "2026-04-20",
  retDate: "2026-04-25",
  passengers: { adult: 1, child: 0, infant: 0 },
  cabinClass: "Economy",
  fromQuery: "New Delhi (DEL)",
  toQuery: "Mumbai (BOM)",
  showFromSug: false,
  showToSug: false,
  showPaxDropdown: false,
  selectedFlight: null,
  expandedFlight: null,
  sortBy: "price",
  filterStops: "all",
  filterAirline: "all",
  maxPrice: 7000,
  passengerForm: { firstName: "", lastName: "", dob: "", email: "", phone: "", passport: "" },
  formErrors: {},
  selectedSeat: null,
  selectedMeal: null,
  extraBaggage: 0,
  payMethod: "upi",
  coupon: "",
  couponApplied: false,
  upiId: "",
  cardNum: "",
};

function pf(n) { return "₹" + n.toLocaleString("en-IN"); }

function getFilteredFlights() {
  return FLIGHTS
    .filter(f => state.filterStops === "all" || (state.filterStops === "0" ? f.stops === 0 : f.stops > 0))
    .filter(f => state.filterAirline === "all" || f.airline === state.filterAirline)
    .filter(f => f.price <= state.maxPrice)
    .sort((a, b) => {
      if (state.sortBy === "price") return a.price - b.price;
      if (state.sortBy === "duration") return a.duration.localeCompare(b.duration);
      if (state.sortBy === "departure") return a.dep.localeCompare(b.dep);
      return 0;
    });
}

function getTotals() {
  const addonTotal = (state.selectedSeat ? 299 : 0) + (state.selectedMeal ? 350 : 0) + (state.extraBaggage * 500);
  const discount = state.couponApplied ? Math.round((state.selectedFlight?.price || 0) * 0.1) : 0;
  const taxes = state.selectedFlight ? Math.round(state.selectedFlight.price * 0.18) : 0;
  const grandTotal = state.selectedFlight ? state.selectedFlight.price + addonTotal + taxes - discount : 0;
  return { addonTotal, discount, taxes, grandTotal };
}

function totalPax() { return state.passengers.adult + state.passengers.child + state.passengers.infant; }

function validateForm() {
  const e = {};
  if (!state.passengerForm.firstName) e.firstName = "Required";
  if (!state.passengerForm.lastName) e.lastName = "Required";
  if (!state.passengerForm.dob) e.dob = "Required";
  if (!state.passengerForm.email || !/\S+@\S+\.\S+/.test(state.passengerForm.email)) e.email = "Valid email required";
  if (!state.passengerForm.phone || state.passengerForm.phone.length < 10) e.phone = "Valid phone required";
  state.formErrors = e;
  return Object.keys(e).length === 0;
}

function render() {
  const app = document.getElementById("app");
  if (state.step === "search") app.innerHTML = renderSearch();
  else if (state.step === "results") app.innerHTML = renderResults();
  else if (state.step === "passenger") app.innerHTML = renderPassenger();
  else if (state.step === "addons") app.innerHTML = renderAddons();
  else if (state.step === "payment") app.innerHTML = renderPayment();
  else if (state.step === "confirm") app.innerHTML = renderConfirm();
  bindEvents();
}

function renderStepBar() {
  const steps = ["search","results","passenger","addons","payment","confirm"];
  const labels = ["Search","Flights","Passengers","Add-ons","Payment","Confirm"];
  const idx = steps.indexOf(state.step);
  return `<div class="step-bar">${labels.map((l, i) => {
    const done = i < idx, active = i === idx;
    const dotStyle = `background:${done?"#639922":active?"#0B3EBF":"var(--color-background-secondary)"};border-color:${done?"#639922":active?"#0B3EBF":"var(--color-border-secondary)"};color:${done||active?"#fff":"var(--color-text-tertiary)"}`;
    const textColor = done ? "#3B6D11" : active ? "#0B3EBF" : "var(--color-text-secondary)";
    const fw = active ? 500 : 400;
    return `<div style="display:flex;align-items:center">
      <div class="step-item" style="color:${textColor};font-weight:${fw}">
        <div class="dot" style="${dotStyle}">${done?"✓":i+1}</div>
        <span style="white-space:nowrap">${l}</span>
      </div>
      ${i < labels.length-1 ? '<div class="step-connector"></div>' : ''}
    </div>`;
  }).join("")}</div>`;
}

function renderSearch() {
  const tt = state.tripType;
  const cols = tt === "round-trip" ? "1fr 1fr 1fr 1fr" : "1fr 1fr 1fr";
  return `
  <div>
    <div class="header">
      <div class="logo">✈ SKYWAY</div>
      <div style="flex:1"></div>
      <span class="nav-item">My Trips</span>
      <span class="nav-item" style="margin-left:16px">Help</span>
    </div>
    <div style="margin-bottom:2rem">
      <h1 style="font-size:28px;font-weight:700;margin-bottom:4px">Find your perfect flight</h1>
      <p style="font-size:15px;color:var(--color-text-secondary)">Search across 500+ airlines for the best prices</p>
    </div>
    <div class="card">
      <div style="display:flex;gap:10px;margin-bottom:1.25rem;flex-wrap:wrap">
        ${["one-way","round-trip","multi-city"].map(t=>`<button class="pill ${tt===t?'active':''}" data-action="tripType" data-val="${t}">${t.charAt(0).toUpperCase()+t.slice(1).replace("-"," ")}</button>`).join("")}
      </div>
      <div style="display:grid;grid-template-columns:1fr auto 1fr;gap:12px;align-items:end;margin-bottom:16px">
        <div style="position:relative" id="fromRef">
          <label class="field-label">From</label>
          <input class="input" id="fromInput" value="${state.fromQuery}" placeholder="City or airport" autocomplete="off" />
          <div class="sug ${state.showFromSug?'':'hidden'}" id="fromSug">
            ${AIRPORTS.filter(a=>a.city.toLowerCase().includes(state.fromQuery.toLowerCase())||a.code.toLowerCase().includes(state.fromQuery.toLowerCase())).slice(0,5).map(a=>`<div class="sug-item" data-action="selectFrom" data-code="${a.code}" data-city="${a.city}" data-name="${a.name}"><span class="code">${a.code}</span> · ${a.city}<div class="name">${a.name}</div></div>`).join("")}
          </div>
        </div>
        <button data-action="swap" style="background:var(--color-background-secondary);border:0.5px solid var(--color-border-secondary);border-radius:8px;width:40px;height:40px;cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center;margin-bottom:0">⇄</button>
        <div style="position:relative" id="toRef">
          <label class="field-label">To</label>
          <input class="input" id="toInput" value="${state.toQuery}" placeholder="City or airport" autocomplete="off" />
          <div class="sug ${state.showToSug?'':'hidden'}" id="toSug">
            ${AIRPORTS.filter(a=>a.city.toLowerCase().includes(state.toQuery.toLowerCase())||a.code.toLowerCase().includes(state.toQuery.toLowerCase())).slice(0,5).map(a=>`<div class="sug-item" data-action="selectTo" data-code="${a.code}" data-city="${a.city}" data-name="${a.name}"><span class="code">${a.code}</span> · ${a.city}<div class="name">${a.name}</div></div>`).join("")}
          </div>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:${cols};gap:12px;margin-bottom:16px;flex-wrap:wrap">
        <div>
          <label class="field-label">Departure</label>
          <input type="date" class="input" id="depDate" value="${state.depDate}" />
        </div>
        ${tt==="round-trip"?`<div><label class="field-label">Return</label><input type="date" class="input" id="retDate" value="${state.retDate}" /></div>`:""}
        <div style="position:relative">
          <label class="field-label">Passengers</label>
          <button class="input" id="paxBtn" data-action="togglePax" style="text-align:left;cursor:pointer">${totalPax()} Passenger${totalPax()>1?"s":""} ▾</button>
          <div class="sug ${state.showPaxDropdown?'':'hidden'}" id="paxDropdown" style="padding:1rem">
            ${[["adult","Adults","12+ yrs"],["child","Children","2-12 yrs"],["infant","Infants","Under 2"]].map(([k,label,sub])=>`
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
              <div><div style="font-size:14px;font-weight:500">${label}</div><div style="font-size:12px;color:var(--color-text-secondary)">${sub}</div></div>
              <div style="display:flex;align-items:center;gap:10px">
                <button class="btn-sm" data-action="paxDec" data-key="${k}">−</button>
                <span style="min-width:16px;text-align:center">${state.passengers[k]}</span>
                <button class="btn-sm" data-action="paxInc" data-key="${k}">+</button>
              </div>
            </div>`).join("")}
            <button class="btn" style="width:100%" data-action="paxDone">Done</button>
          </div>
        </div>
        <div>
          <label class="field-label">Class</label>
          <select class="input" id="cabinClass">
            ${["Economy","Premium Economy","Business","First"].map(c=>`<option ${state.cabinClass===c?"selected":""}>${c}</option>`).join("")}
          </select>
        </div>
      </div>
      <div style="text-align:center">
        <button class="btn" data-action="searchFlights" style="padding:14px 60px;font-size:16px">Search Flights</button>
      </div>
    </div>
    <div style="margin-top:2rem">
      <div class="h2">Popular routes</div>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px">
        ${[["DEL → BOM","from ₹3,299","6E"],["BOM → BLR","from ₹2,850","AI"],["DEL → HYD","from ₹3,499","UK"],["BLR → CCU","from ₹4,100","SG"]].map(([route,price,code])=>`
        <div class="card" style="cursor:pointer;display:flex;flex-direction:column;gap:8px" data-action="searchFlights">
          <div style="width:36px;height:36px;border-radius:6px;background:${airlineColor[code]||"#0B3EBF"};display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:12px">${code}</div>
          <div style="font-size:15px;font-weight:500">${route}</div>
          <div style="font-size:13px;color:#0B3EBF;font-weight:600">${price}</div>
        </div>`).join("")}
      </div>
    </div>
  </div>`;
}

function renderResults() {
  const ff = getFilteredFlights();
  return `
  <div>
    <div class="header">
      <div class="logo">✈ SKYWAY</div>
      <button class="btn-sm" style="margin-left:auto" data-action="goSearch">← Modify</button>
    </div>
    ${renderStepBar()}
    <div style="margin-bottom:1rem;display:flex;gap:12px;align-items:center;flex-wrap:wrap">
      <div>
        <span style="font-size:20px;font-weight:700">${state.from.city} → ${state.to.city}</span>
        <span style="font-size:14px;color:var(--color-text-secondary);margin-left:10px">${state.depDate} · ${totalPax()} pax · ${state.cabinClass}</span>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:220px 1fr;gap:16px">
      <div class="card">
        <div class="h3">Filters</div>
        <div class="section">
          <label class="field-label">Max Price: ${pf(state.maxPrice)}</label>
          <input type="range" min="2000" max="8000" step="100" value="${state.maxPrice}" id="maxPrice" />
        </div>
        <div class="section">
          <label class="field-label">Stops</label>
          ${[["all","Any"],["0","Non-stop"],["1","1+ Stop"]].map(([v,l])=>`<label style="display:flex;align-items:center;gap:8px;margin-bottom:6px;font-size:14px;cursor:pointer"><input type="radio" name="stops" value="${v}" ${state.filterStops===v?"checked":""} data-action="filterStops"> ${l}</label>`).join("")}
        </div>
        <div class="section">
          <label class="field-label">Airlines</label>
          ${["all","IndiGo","Air India","Vistara","SpiceJet"].map(a=>`<label style="display:flex;align-items:center;gap:8px;margin-bottom:6px;font-size:14px;cursor:pointer"><input type="radio" name="airline" value="${a}" ${state.filterAirline===a?"checked":""} data-action="filterAirline"> ${a==="all"?"All airlines":a}</label>`).join("")}
        </div>
      </div>
      <div>
        <div style="display:flex;gap:10px;margin-bottom:12px;align-items:center;flex-wrap:wrap">
          <span style="font-size:14px;color:var(--color-text-secondary)">${ff.length} flights found · Sort by:</span>
          ${[["price","Price"],["duration","Duration"],["departure","Departure"]].map(([v,l])=>`<button class="pill ${state.sortBy===v?"active":""}" data-action="sortBy" data-val="${v}">${l}</button>`).join("")}
        </div>
        ${ff.length===0?`<div class="card" style="text-align:center;padding:2rem"><div style="font-size:32px;margin-bottom:8px">✈</div><div style="font-size:16px;font-weight:500">No flights match your filters</div><div style="font-size:14px;color:var(--color-text-secondary);margin-top:4px">Try adjusting price or stop filters</div></div>`:ff.map(f=>renderFlightCard(f)).join("")}
      </div>
    </div>
  </div>`;
}

function renderFlightCard(f) {
  const expanded = state.expandedFlight === f.id;
  return `
  <div class="card" style="margin-bottom:12px">
    <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
      <div style="width:48px;height:48px;border-radius:8px;background:${airlineColor[f.logo]||"#0B3EBF"};display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:13px;flex-shrink:0">${f.logo}</div>
      <div style="min-width:120px">
        <div style="font-size:13px;color:var(--color-text-secondary)">${f.airline}</div>
        <div style="font-size:12px;color:var(--color-text-tertiary)">${f.code} · ${f.aircraft}</div>
      </div>
      <div style="text-align:center;min-width:60px">
        <div style="font-size:22px;font-weight:700">${f.dep}</div>
        <div style="font-size:11px;color:var(--color-text-secondary)">${state.from.code}</div>
      </div>
      <div style="flex:1;min-width:80px;text-align:center">
        <div style="font-size:11px;color:var(--color-text-secondary);margin-bottom:4px">${f.duration}</div>
        <div style="height:1px;background:var(--color-border-secondary);position:relative">
          ${f.stops>0?`<div style="position:absolute;top:-3px;left:50%;width:6px;height:6px;border-radius:50%;background:#BA7517;margin-left:-3px"></div>`:""}
        </div>
        <div style="font-size:11px;color:${f.stops===0?"#3B6D11":"#BA7517"};margin-top:4px;font-weight:500">${f.stops===0?"Non-stop":`${f.stops} stop`}</div>
      </div>
      <div style="text-align:center;min-width:60px">
        <div style="font-size:22px;font-weight:700">${f.arr}</div>
        <div style="font-size:11px;color:var(--color-text-secondary)">${state.to.code}</div>
      </div>
      <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end;margin-left:auto">
        <div style="font-size:22px;font-weight:700;color:#0B3EBF">${pf(f.price)}</div>
        <div style="font-size:11px;color:var(--color-text-secondary)">per person · ${f.class}</div>
        <div style="display:flex;gap:8px">
          <button class="btn-sm" data-action="toggleExpand" data-id="${f.id}">${expanded?"Less ▲":"Details ▼"}</button>
          <button class="btn" data-action="bookFlight" data-id="${f.id}">Book Now</button>
        </div>
      </div>
    </div>
    ${expanded?`<div style="margin-top:16px;padding-top:16px;border-top:0.5px solid var(--color-border-tertiary)">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px">
        ${[{icon:"🧳",label:"Baggage",val:f.baggage+" check-in"},{icon:"🍽️",label:"Meal",val:f.meal},{icon:"💺",label:"Seat",val:f.seat},{icon:"✈️",label:"Aircraft",val:f.aircraft},{icon:"⏱️",label:"Duration",val:f.duration},{icon:"🔄",label:"Cancellation",val:"₹2,500 fee"}].map(item=>`<div style="display:flex;gap:10px;align-items:flex-start"><span style="font-size:18px">${item.icon}</span><div><div style="font-size:12px;color:var(--color-text-secondary)">${item.label}</div><div style="font-size:14px;font-weight:500">${item.val}</div></div></div>`).join("")}
      </div>
      ${f.stops>0?`<div style="margin-top:12px;padding:10px;background:var(--color-background-secondary);border-radius:8px"><div style="font-size:12px;font-weight:500;color:#BA7517">⏳ Layover: 1h 40m at Hyderabad (HYD)</div></div>`:""}
    </div>`:""}
  </div>`;
}

function renderPassenger() {
  const { taxes } = getTotals();
  const sf = state.selectedFlight;
  return `
  <div>
    <div class="header">
      <div class="logo">✈ SKYWAY</div>
      <button class="btn-sm" style="margin-left:auto" data-action="goResults">← Back</button>
    </div>
    ${renderStepBar()}
    <div style="display:grid;grid-template-columns:1fr 280px;gap:16px">
      <div>
        <div class="h2">Passenger Details</div>
        <div class="card">
          <div class="tag tag-blue" style="margin-bottom:12px">Adult 1</div>
          <div class="grid-2">
            ${[["firstName","First Name","text"],["lastName","Last Name","text"],["dob","Date of Birth","date"],["email","Email Address","email"],["phone","Phone Number","tel"],["passport","Passport Number (optional)","text"]].map(([k,l,t])=>`
            <div ${k==="email"?'style="grid-column:1/-1"':""}>
              <label class="field-label">${l}</label>
              <input type="${t}" class="input pform" data-key="${k}" value="${state.passengerForm[k]}" placeholder="${l}" style="${state.formErrors[k]?"border-color:var(--color-border-danger)":""}" />
              ${state.formErrors[k]?`<div class="err">${state.formErrors[k]}</div>`:""}
            </div>`).join("")}
          </div>
        </div>
        <div style="margin-top:1rem;display:flex;justify-content:flex-end">
          <button class="btn" data-action="goAddons">Continue to Add-ons →</button>
        </div>
      </div>
      <div>
        <div class="card" style="position:sticky;top:16px">
          <div style="font-size:13px;font-weight:500;color:var(--color-text-secondary);margin-bottom:8px">Selected Flight</div>
          ${sf?`<div style="display:flex;align-items:center;gap:10px;margin-bottom:12px">
            <div style="width:36px;height:36px;border-radius:6px;background:${airlineColor[sf.logo]};display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:12px">${sf.logo}</div>
            <div><div style="font-size:14px;font-weight:500">${sf.airline} · ${sf.code}</div><div style="font-size:12px;color:var(--color-text-secondary)">${sf.dep} → ${sf.arr} · ${sf.duration}</div></div>
          </div>
          <div style="border-top:0.5px solid var(--color-border-tertiary);padding-top:10px;font-size:14px">
            <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="color:var(--color-text-secondary)">Base fare</span><span>${pf(sf.price)}</span></div>
            <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="color:var(--color-text-secondary)">Taxes (18%)</span><span>${pf(taxes)}</span></div>
            <div style="display:flex;justify-content:space-between;font-weight:600;border-top:0.5px solid var(--color-border-tertiary);padding-top:8px;margin-top:4px;font-size:16px;color:#0B3EBF"><span>Total</span><span>${pf(sf.price+taxes)}</span></div>
          </div>`:""}
        </div>
      </div>
    </div>
  </div>`;
}

function renderAddons() {
  const { taxes, grandTotal } = getTotals();
  const sf = state.selectedFlight;
  return `
  <div>
    <div class="header">
      <div class="logo">✈ SKYWAY</div>
      <button class="btn-sm" style="margin-left:auto" data-action="goPassenger">← Back</button>
    </div>
    ${renderStepBar()}
    <div style="display:grid;grid-template-columns:1fr 280px;gap:16px">
      <div>
        <div class="h2">Customize Your Journey</div>
        <div class="card" style="margin-bottom:16px">
          <div class="h3">💺 Select Your Seat</div>
          <div style="font-size:13px;color:var(--color-text-secondary);margin-bottom:12px">Seat selection +₹299</div>
          <div style="display:flex;gap:12px;margin-bottom:8px;font-size:12px">
            ${[["#E6F1FB","#185FA5","Available"],["#EAF3DE","#3B6D11","Selected"],["var(--color-background-secondary)","var(--color-text-secondary)","Occupied"]].map(([bg,c,l])=>`<div style="display:flex;align-items:center;gap:4px"><div style="width:14px;height:14px;border-radius:3px;background:${bg};border:1px solid ${c}"></div><span>${l}</span></div>`).join("")}
          </div>
          <div style="display:grid;grid-template-columns:repeat(3,44px);gap:6px">
            ${SEATS.map(s=>{
              const occupied = OCCUPIED.includes(s), sel = state.selectedSeat===s;
              return `<button ${occupied?"disabled":""} data-action="selectSeat" data-seat="${s}" style="height:38px;border-radius:6px;border:1px solid ${occupied?"var(--color-border-tertiary)":sel?"#3B6D11":"#185FA5"};background:${occupied?"var(--color-background-secondary)":sel?"#EAF3DE":"#E6F1FB"};color:${occupied?"var(--color-text-tertiary)":sel?"#3B6D11":"#185FA5"};cursor:${occupied?"default":"pointer"};font-size:11px;font-weight:500;font-family:inherit">${s}</button>`;
            }).join("")}
          </div>
        </div>
        <div class="card" style="margin-bottom:16px">
          <div class="h3">🍽️ Meal Preference</div>
          <div style="font-size:13px;color:var(--color-text-secondary);margin-bottom:12px">Add meal +₹350</div>
          <div class="grid-2">
            ${["Vegetarian","Non-Vegetarian","Vegan","Jain"].map(m=>`
            <label style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;border:1px solid ${state.selectedMeal===m?"#0B3EBF":"var(--color-border-secondary)"};cursor:pointer;background:${state.selectedMeal===m?"#E6F1FB":"transparent"}">
              <input type="radio" name="meal" value="${m}" ${state.selectedMeal===m?"checked":""} data-action="selectMeal"> <span style="font-size:14px">${m}</span>
            </label>`).join("")}
          </div>
        </div>
        <div class="card">
          <div class="h3">🧳 Extra Baggage</div>
          <div style="font-size:13px;color:var(--color-text-secondary);margin-bottom:12px">₹500 per 5 kg</div>
          <div style="display:flex;align-items:center;gap:16px">
            <button class="btn-sm" data-action="baggageDec">−</button>
            <span style="font-size:16px;font-weight:500">${state.extraBaggage*5} kg extra</span>
            <button class="btn-sm" data-action="baggageInc">+</button>
            ${state.extraBaggage>0?`<span style="font-size:14px;color:#0B3EBF">+${pf(state.extraBaggage*500)}</span>`:""}
          </div>
        </div>
        <div style="margin-top:1rem;display:flex;justify-content:flex-end">
          <button class="btn" data-action="goPayment">Continue to Payment →</button>
        </div>
      </div>
      <div>
        <div class="card" style="position:sticky;top:16px">
          <div style="font-size:13px;font-weight:500;color:var(--color-text-secondary);margin-bottom:8px">Booking Summary</div>
          ${sf?`<div style="font-size:14px">
            <div style="font-weight:500;margin-bottom:8px">${sf.airline} ${sf.code}</div>
            <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="color:var(--color-text-secondary)">Base fare</span><span>${pf(sf.price)}</span></div>
            ${state.selectedSeat?`<div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="color:var(--color-text-secondary)">Seat</span><span>₹299</span></div>`:""}
            ${state.selectedMeal?`<div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="color:var(--color-text-secondary)">Meal</span><span>₹350</span></div>`:""}
            ${state.extraBaggage>0?`<div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="color:var(--color-text-secondary)">Baggage</span><span>${pf(state.extraBaggage*500)}</span></div>`:""}
            <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="color:var(--color-text-secondary)">Taxes</span><span>${pf(Math.round(sf.price*0.18))}</span></div>
            <div style="display:flex;justify-content:space-between;font-weight:600;border-top:0.5px solid var(--color-border-tertiary);padding-top:8px;margin-top:4px;font-size:16px;color:#0B3EBF"><span>Total</span><span>${pf(grandTotal)}</span></div>
          </div>`:""}
        </div>
      </div>
    </div>
  </div>`;
}

function renderPayment() {
  const { taxes, discount, grandTotal } = getTotals();
  const sf = state.selectedFlight;
  const pm = state.payMethod;
  return `
  <div>
    <div class="header">
      <div class="logo">✈ SKYWAY</div>
      <button class="btn-sm" style="margin-left:auto" data-action="goAddons">← Back</button>
    </div>
    ${renderStepBar()}
    <div style="display:grid;grid-template-columns:1fr 280px;gap:16px">
      <div>
        <div class="h2">Secure Payment</div>
        <div class="card" style="margin-bottom:16px">
          <div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap">
            ${[["upi","UPI"],["card","Card"],["netbanking","Net Banking"],["wallet","Wallet"]].map(([v,l])=>`<button class="pill ${pm===v?"active":""}" data-action="setPayMethod" data-val="${v}">${l}</button>`).join("")}
          </div>
          ${pm==="upi"?`<div>
            <label class="field-label">UPI ID</label>
            <input class="input" id="upiId" value="${state.upiId}" placeholder="yourname@upi" />
            <div style="font-size:12px;color:var(--color-text-secondary);margin-top:6px">Supports BHIM, PhonePe, Google Pay, Paytm</div>
          </div>`:""}
          ${pm==="card"?`<div style="display:grid;gap:12px">
            <div><label class="field-label">Card Number</label><input class="input" id="cardNum" value="${state.cardNum}" placeholder="0000 0000 0000 0000" maxlength="19" /></div>
            <div class="grid-2">
              <div><label class="field-label">Expiry</label><input class="input" placeholder="MM/YY" /></div>
              <div><label class="field-label">CVV</label><input class="input" placeholder="•••" type="password" maxlength="3" /></div>
            </div>
            <div><label class="field-label">Name on Card</label><input class="input" placeholder="As on card" /></div>
          </div>`:""}
          ${pm==="netbanking"?`<div>
            <label class="field-label">Select Bank</label>
            <select class="input">
              ${["SBI","HDFC Bank","ICICI Bank","Axis Bank","Kotak Mahindra","Other Banks"].map(b=>`<option>${b}</option>`).join("")}
            </select>
          </div>`:""}
          ${pm==="wallet"?`<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
            ${["Paytm","PhonePe","Amazon Pay","MobiKwik"].map(w=>`<label style="display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:8px;border:0.5px solid var(--color-border-secondary);cursor:pointer;font-size:14px"><input type="radio" name="wallet"> ${w}</label>`).join("")}
          </div>`:""}
        </div>
        <div class="card" style="margin-bottom:16px">
          <div class="h3">Have a Coupon?</div>
          <div style="display:flex;gap:10px">
            <input class="input" id="couponInput" placeholder="Enter coupon code" value="${state.coupon}" style="flex:1" />
            <button class="btn-outline" data-action="applyCoupon">Apply</button>
          </div>
          ${state.couponApplied?`<div style="font-size:13px;color:#3B6D11;margin-top:6px">✓ Coupon SKY10 applied — 10% off!</div>`:`<div style="font-size:12px;color:var(--color-text-secondary);margin-top:4px">Try: SKY10 for 10% discount</div>`}
        </div>
        <div style="text-align:right">
          <button class="btn" data-action="goConfirm" style="padding:14px 40px;font-size:16px">Pay ${pf(grandTotal)} →</button>
          <div style="font-size:12px;color:var(--color-text-secondary);margin-top:6px">🔒 256-bit SSL secured payment</div>
        </div>
      </div>
      <div>
        <div class="card" style="position:sticky;top:16px">
          <div style="font-size:13px;font-weight:500;color:var(--color-text-secondary);margin-bottom:12px">Fare Breakdown</div>
          ${sf?`<div style="font-size:14px">
            ${[
              ["Base fare", sf.price],
              ...(state.selectedSeat?[["Seat selection",299]]:[]),
              ...(state.selectedMeal?[["Meal",350]]:[]),
              ...(state.extraBaggage>0?[["Extra baggage",state.extraBaggage*500]]:[]),
              ["Taxes & fees", taxes],
              ...(state.couponApplied?[["Discount (SKY10)",-discount]]:[]),
            ].map(([l,v])=>`<div style="display:flex;justify-content:space-between;margin-bottom:6px;color:${v<0?"#3B6D11":"inherit"}"><span style="color:var(--color-text-secondary)">${l}</span><span>${v<0?"−"+pf(-v):pf(v)}</span></div>`).join("")}
            <div style="display:flex;justify-content:space-between;font-weight:600;border-top:0.5px solid var(--color-border-tertiary);padding-top:8px;margin-top:4px;font-size:18px;color:#0B3EBF"><span>Total</span><span>${pf(grandTotal)}</span></div>
          </div>`:""}
        </div>
      </div>
    </div>
  </div>`;
}

function renderConfirm() {
  const { grandTotal } = getTotals();
  const sf = state.selectedFlight;
  return `
  <div>
    <div class="header">
      <div class="logo">✈ SKYWAY</div>
    </div>
    <div style="text-align:center;padding:1.5rem 0 2rem">
      <div style="width:64px;height:64px;border-radius:50%;background:#EAF3DE;display:flex;align-items:center;justify-content:center;font-size:28px;margin:0 auto 1rem">✓</div>
      <h1 style="font-size:26px;font-weight:700;margin-bottom:4px">Booking Confirmed!</h1>
      <p style="color:var(--color-text-secondary);font-size:15px;margin:0">Your e-ticket has been sent to ${state.passengerForm.email||"your email"}</p>
    </div>
    <div style="max-width:600px;margin:0 auto">
      <div class="card" style="margin-bottom:16px">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
          <div>
            <div style="font-size:11px;color:var(--color-text-secondary);font-weight:500;text-transform:uppercase;letter-spacing:0.8px">PNR Number</div>
            <div style="font-size:28px;font-weight:800;letter-spacing:3px;color:#0B3EBF">${pnr}</div>
          </div>
          <div style="width:52px;height:52px;border-radius:8px;background:${airlineColor[sf?.logo]};display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:16px">${sf?.logo}</div>
        </div>
        <div style="display:flex;align-items:center;gap:16px;padding:16px 0;border-top:0.5px solid var(--color-border-tertiary);border-bottom:0.5px solid var(--color-border-tertiary)">
          <div style="text-align:center">
            <div style="font-size:28px;font-weight:700">${sf?.dep}</div>
            <div style="font-size:12px;color:var(--color-text-secondary)">${state.from.code}</div>
            <div style="font-size:11px;color:var(--color-text-tertiary)">${state.depDate}</div>
          </div>
          <div style="flex:1;text-align:center">
            <div style="font-size:11px;color:var(--color-text-secondary)">${sf?.duration}</div>
            <div style="border-top:1px dashed var(--color-border-secondary);margin:4px 0;position:relative">
              <span style="position:absolute;right:-4px;top:-7px;font-size:14px">✈</span>
            </div>
            <div style="font-size:11px;color:#3B6D11;font-weight:500">Non-stop</div>
          </div>
          <div style="text-align:center">
            <div style="font-size:28px;font-weight:700">${sf?.arr}</div>
            <div style="font-size:12px;color:var(--color-text-secondary)">${state.to.code}</div>
            <div style="font-size:11px;color:var(--color-text-tertiary)">${state.depDate}</div>
          </div>
        </div>
        <div class="grid-3" style="margin-top:16px">
          ${[["Passenger",`${state.passengerForm.firstName||"John"} ${state.passengerForm.lastName||"Doe"}`],["Seat",state.selectedSeat||"Not selected"],["Class",sf?.class],["Airline",sf?.airline],["Flight",sf?.code],["Baggage",sf?.baggage]].map(([l,v])=>`<div><div style="font-size:11px;color:var(--color-text-secondary);margin-bottom:2px">${l}</div><div style="font-size:14px;font-weight:500">${v}</div></div>`).join("")}
        </div>
      </div>
      <div class="card" style="margin-bottom:16px">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:15px;font-weight:500">Amount Paid</span>
          <span style="font-size:22px;font-weight:700;color:#0B3EBF">${pf(grandTotal)}</span>
        </div>
      </div>
      <div style="display:flex;gap:12px;justify-content:center">
        <button class="btn" style="padding:12px 28px" onclick="alert('Downloading e-ticket PDF...')">⬇ Download E-Ticket</button>
        <button class="btn-outline" data-action="bookAnother">Book Another Flight</button>
      </div>
    </div>
  </div>`;
}

function bindEvents() {
  // Generic data-action handlers
  document.querySelectorAll("[data-action]").forEach(el => {
    el.addEventListener("click", handleAction);
  });

  // From input
  const fromInput = document.getElementById("fromInput");
  if (fromInput) {
    fromInput.addEventListener("input", e => {
      state.fromQuery = e.target.value;
      state.showFromSug = true;
      render();
    });
    fromInput.addEventListener("focus", () => { state.showFromSug = true; render(); });
  }

  // To input
  const toInput = document.getElementById("toInput");
  if (toInput) {
    toInput.addEventListener("input", e => {
      state.toQuery = e.target.value;
      state.showToSug = true;
      render();
    });
    toInput.addEventListener("focus", () => { state.showToSug = true; render(); });
  }

  // Date inputs
  const depDate = document.getElementById("depDate");
  if (depDate) depDate.addEventListener("change", e => { state.depDate = e.target.value; });
  const retDate = document.getElementById("retDate");
  if (retDate) retDate.addEventListener("change", e => { state.retDate = e.target.value; });

  // Cabin class
  const cabinClass = document.getElementById("cabinClass");
  if (cabinClass) cabinClass.addEventListener("change", e => { state.cabinClass = e.target.value; });

  // Max price range
  const maxPrice = document.getElementById("maxPrice");
  if (maxPrice) maxPrice.addEventListener("input", e => { state.maxPrice = +e.target.value; render(); });

  // Filter radios
  document.querySelectorAll("[data-action=filterStops]").forEach(el => {
    el.addEventListener("change", () => { state.filterStops = el.value; render(); });
  });
  document.querySelectorAll("[data-action=filterAirline]").forEach(el => {
    el.addEventListener("change", () => { state.filterAirline = el.value; render(); });
  });

  // Passenger form inputs
  document.querySelectorAll(".pform").forEach(el => {
    el.addEventListener("input", e => { state.passengerForm[el.dataset.key] = e.target.value; });
  });

  // Meal radios
  document.querySelectorAll("[data-action=selectMeal]").forEach(el => {
    el.addEventListener("change", () => {
      state.selectedMeal = state.selectedMeal === el.value ? null : el.value;
      render();
    });
  });

  // UPI/card inputs
  const upiId = document.getElementById("upiId");
  if (upiId) upiId.addEventListener("input", e => { state.upiId = e.target.value; });
  const cardNum = document.getElementById("cardNum");
  if (cardNum) cardNum.addEventListener("input", e => {
    state.cardNum = e.target.value.replace(/\D/g,"").replace(/(.{4})/g,"$1 ").trim();
    e.target.value = state.cardNum;
  });

  // Coupon input
  const couponInput = document.getElementById("couponInput");
  if (couponInput) couponInput.addEventListener("input", e => { state.coupon = e.target.value; });

  // Click outside to close dropdowns
  document.addEventListener("click", handleOutsideClick, { once: true });
}

function handleOutsideClick(e) {
  const fromRef = document.getElementById("fromRef");
  const toRef = document.getElementById("toRef");
  const paxBtn = document.getElementById("paxBtn");
  const paxDropdown = document.getElementById("paxDropdown");

  if (fromRef && !fromRef.contains(e.target)) { state.showFromSug = false; }
  if (toRef && !toRef.contains(e.target)) { state.showToSug = false; }
  if (paxBtn && paxDropdown && !paxBtn.contains(e.target) && !paxDropdown.contains(e.target)) {
    state.showPaxDropdown = false;
  }
  render();
}

function handleAction(e) {
  const action = e.currentTarget.dataset.action;
  if (!action) return;

  if (action === "tripType") { state.tripType = e.currentTarget.dataset.val; render(); }
  else if (action === "swap") {
    const tmp = {...state.from}; state.from = {...state.to}; state.to = tmp;
    const tq = state.toQuery; state.toQuery = state.fromQuery; state.fromQuery = tq;
    render();
  }
  else if (action === "selectFrom") {
    const d = e.currentTarget.dataset;
    state.from = { code: d.code, city: d.city };
    state.fromQuery = `${d.city} (${d.code})`;
    state.showFromSug = false;
    render();
  }
  else if (action === "selectTo") {
    const d = e.currentTarget.dataset;
    state.to = { code: d.code, city: d.city };
    state.toQuery = `${d.city} (${d.code})`;
    state.showToSug = false;
    render();
  }
  else if (action === "togglePax") { state.showPaxDropdown = !state.showPaxDropdown; render(); }
  else if (action === "paxDec") {
    const k = e.currentTarget.dataset.key;
    state.passengers[k] = Math.max(k==="adult"?1:0, state.passengers[k]-1);
    render();
  }
  else if (action === "paxInc") {
    const k = e.currentTarget.dataset.key;
    state.passengers[k] = state.passengers[k]+1;
    render();
  }
  else if (action === "paxDone") { state.showPaxDropdown = false; render(); }
  else if (action === "searchFlights") { state.step = "results"; render(); }
  else if (action === "goSearch") { state.step = "search"; render(); }
  else if (action === "goResults") { state.step = "results"; render(); }
  else if (action === "goPassenger") { state.step = "passenger"; render(); }
  else if (action === "goAddons") { state.step = "addons"; render(); }
  else if (action === "goPayment") { state.step = "payment"; render(); }
  else if (action === "goConfirm") { state.step = "confirm"; render(); }
  else if (action === "bookAnother") { state.step = "search"; state.selectedFlight = null; render(); }
  else if (action === "sortBy") { state.sortBy = e.currentTarget.dataset.val; render(); }
  else if (action === "toggleExpand") {
    const id = +e.currentTarget.dataset.id;
    state.expandedFlight = state.expandedFlight === id ? null : id;
    render();
  }
  else if (action === "bookFlight") {
    const id = +e.currentTarget.dataset.id;
    state.selectedFlight = FLIGHTS.find(f => f.id === id);
    state.step = "passenger";
    render();
  }
  else if (action === "selectSeat") {
    const s = e.currentTarget.dataset.seat;
    state.selectedSeat = state.selectedSeat === s ? null : s;
    render();
  }
  else if (action === "baggageDec") { state.extraBaggage = Math.max(0, state.extraBaggage-1); render(); }
  else if (action === "baggageInc") { state.extraBaggage = Math.min(4, state.extraBaggage+1); render(); }
  else if (action === "setPayMethod") { state.payMethod = e.currentTarget.dataset.val; render(); }
  else if (action === "applyCoupon") {
    const inp = document.getElementById("couponInput");
    if (inp) state.coupon = inp.value;
    if (state.coupon.toLowerCase() === "sky10") state.couponApplied = true;
    render();
  }
  else if (action === "goAddons") {
    if (validateForm()) { state.step = "addons"; render(); }
    else render();
  }
}

// Override goAddons to also validate
document.addEventListener("click", e => {
  const el = e.target.closest("[data-action='goAddons']");
  if (el && state.step === "passenger") {
    e.stopImmediatePropagation();
    if (validateForm()) { state.step = "addons"; render(); }
    else render();
  }
}, true);

render();
</script>
</body>
</html>
