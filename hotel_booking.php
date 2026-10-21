<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>StayNest – Find Your Perfect Stay</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  :root{
    --brand:#fae013;--brand2:#1c1450;--brand2-light:#2d1f72;
    --radius:12px;--radius-sm:8px;
    --shadow:0 2px 12px rgba(28,20,80,0.10);
    --font-body:'DM Sans',system-ui,sans-serif;
    --font-display:'Playfair Display',serif;
  }
  body{font-family:var(--font-body);color:#1a1a2e;background:#f4f2f9;font-size:14px}
  .page{max-width:1280px;margin:0 auto;padding:0 0 3rem}

  /* NAV */
  nav{background:var(--brand2);padding:0 2rem;display:flex;align-items:center;justify-content:space-between;height:56px;position:sticky;top:0;z-index:100;box-shadow:0 2px 12px rgba(0,0,0,0.2)}
  .logo{color:#fff;font-size:20px;font-weight:600;display:flex;align-items:center;gap:8px;font-family:var(--font-display)}
  .logo-dot{width:10px;height:10px;background:var(--brand);border-radius:50%}
  .nav-links{display:flex;align-items:center;gap:1.5rem}
  .nav-links a{color:rgba(255,255,255,0.75);font-size:13px;text-decoration:none;cursor:pointer;transition:color .2s;padding:4px 0;border-bottom:2px solid transparent}
  .nav-links a:hover{color:#fff;border-bottom-color:var(--brand)}
  .nav-right{display:flex;align-items:center;gap:12px}
  .btn-nav{background:var(--brand);color:var(--brand2);border:none;padding:7px 18px;border-radius:6px;font-size:13px;font-weight:600;cursor:pointer;transition:opacity .2s}
  .btn-nav:hover{opacity:.85}

  /* CURRENCY SELECTOR - always visible */
  .currency-wrap{position:relative;display:flex;align-items:center;gap:0}
  .currency-flag{font-size:15px;position:absolute;left:8px;pointer-events:none;z-index:1}
  .currency{color:#fff;font-size:12px;font-weight:600;cursor:pointer;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);border-radius:6px;padding:5px 10px 5px 28px;appearance:none;-webkit-appearance:none;outline:none;transition:background .2s;min-width:90px}
  .currency:hover{background:rgba(255,255,255,0.25)}
  .currency option{background:#1c1450;color:#fff}

  /* HERO */
  .hero{background:linear-gradient(135deg,var(--brand2) 0%,var(--brand2-light) 60%,#2a1a8a 100%);padding:3.5rem 2rem 5rem;text-align:center;position:relative;overflow:hidden}
  .hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")}
  .hero h1{color:#fff;font-size:clamp(26px,4vw,44px);font-weight:600;margin-bottom:.5rem;position:relative;font-family:var(--font-display)}
  .hero p{color:rgba(255,255,255,0.7);font-size:15px;margin-bottom:2rem;position:relative}
  .hero-tabs{display:flex;justify-content:center;gap:8px;margin-bottom:1.5rem;position:relative}
  .hero-tab{background:rgba(255,255,255,0.12);color:rgba(255,255,255,0.7);border:none;padding:7px 18px;border-radius:20px;font-size:13px;cursor:pointer;transition:all .2s;font-family:var(--font-body)}
  .hero-tab.active{background:var(--brand);color:var(--brand2);font-weight:600}
  .hero-tab:hover:not(.active){background:rgba(255,255,255,0.2);color:#fff}

  /* SEARCH BOX */
  .search-box{background:#fff;border-radius:var(--radius);padding:1.25rem 1.5rem;display:grid;grid-template-columns:2fr 1.2fr 1.2fr 1fr auto;gap:12px;align-items:end;max-width:960px;margin:0 auto;position:relative;box-shadow:0 8px 40px rgba(28,20,80,0.25)}
  .search-field label{display:block;font-size:11px;color:#888;font-weight:600;margin-bottom:4px;text-transform:uppercase;letter-spacing:.5px}
  .search-field input,.search-field select{width:100%;border:1.5px solid #e8e6f0;border-radius:8px;padding:9px 12px;font-size:14px;outline:none;transition:border-color .2s;background:#fafafa;color:#1a1a2e;font-family:var(--font-body)}
  .search-field input:focus,.search-field select:focus{border-color:var(--brand2)}
  .guest-selector{position:relative}
  .guest-btn{width:100%;border:1.5px solid #e8e6f0;border-radius:8px;padding:9px 12px;font-size:14px;background:#fafafa;cursor:pointer;text-align:left;color:#1a1a2e;font-family:var(--font-body);transition:border-color .2s}
  .guest-btn:hover{border-color:var(--brand2)}
  .guest-dropdown{position:absolute;top:calc(100% + 8px);left:0;right:0;background:#fff;border:1px solid #e0ddf2;border-radius:var(--radius-sm);padding:12px;z-index:50;box-shadow:0 8px 30px rgba(28,20,80,0.15);min-width:220px}
  .guest-row{display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f0eef8}
  .guest-row:last-child{border-bottom:none}
  .guest-row span{font-size:13px;font-weight:500}
  .guest-row small{color:#999;font-size:11px;display:block}
  .qty-ctrl{display:flex;align-items:center;gap:8px}
  .qty-btn{width:28px;height:28px;border-radius:50%;border:1.5px solid #d0cce8;background:none;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--brand2);font-weight:600;transition:all .2s}
  .qty-btn:hover{background:var(--brand2);color:#fff;border-color:var(--brand2)}
  .qty-val{font-size:14px;font-weight:600;min-width:20px;text-align:center}
  .search-btn{background:var(--brand2);color:#fff;border:none;border-radius:8px;padding:11px 24px;font-size:14px;font-weight:600;cursor:pointer;white-space:nowrap;transition:all .2s;display:flex;align-items:center;gap:6px;font-family:var(--font-body)}
  .search-btn:hover{background:var(--brand2-light);transform:translateY(-1px)}
  .search-icon{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:2.5;stroke-linecap:round}

  /* SUGGESTIONS */
  .suggestions{position:absolute;top:calc(100% + 4px);left:0;right:0;background:#fff;border:1px solid #e0ddf2;border-radius:8px;overflow:hidden;z-index:60;box-shadow:0 8px 24px rgba(28,20,80,0.12)}
  .sug-item{padding:10px 14px;font-size:13px;cursor:pointer;display:flex;align-items:center;gap:10px;transition:background .15s}
  .sug-item:hover{background:#f5f3ff}
  .sug-icon{width:36px;height:36px;border-radius:8px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center}
  .sug-icon img{width:100%;height:100%;object-fit:cover}
  .sug-text strong{display:block;font-size:13px;color:#1a1a2e;font-weight:600}
  .sug-text small{color:#999;font-size:11px}

  /* TRUST BAR */
  .trust-bar{background:rgba(255,255,255,0.07);border-top:1px solid rgba(255,255,255,0.08);padding:.75rem 2rem;display:flex;justify-content:center;gap:2.5rem;position:relative;flex-wrap:wrap}
  .trust-item{display:flex;align-items:center;gap:6px;color:rgba(255,255,255,0.65);font-size:12px}
  .trust-dot{width:6px;height:6px;background:var(--brand);border-radius:50%}

  /* MAIN CONTENT */
  .main{padding:1.5rem 2rem;display:grid;grid-template-columns:240px 1fr;gap:1.5rem}

  /* FILTERS */
  .filters{background:#fff;border-radius:var(--radius);padding:1.25rem;border:1px solid #e8e4f5;height:fit-content;position:sticky;top:72px}
  .filter-title{font-size:15px;font-weight:600;margin-bottom:1rem;display:flex;align-items:center;justify-content:space-between;font-family:var(--font-display)}
  .filter-reset{font-size:11px;color:var(--brand2);cursor:pointer;font-weight:500;font-family:var(--font-body)}
  .filter-section{margin-bottom:1.25rem;border-bottom:1px solid #f0eef8;padding-bottom:1.25rem}
  .filter-section:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0}
  .filter-label{font-size:11px;color:#888;font-weight:600;margin-bottom:.6rem;text-transform:uppercase;letter-spacing:.5px}
  .price-range{display:flex;gap:8px;align-items:center;margin-bottom:8px}
  .price-input{width:80px;border:1px solid #e8e4f5;border-radius:6px;padding:5px 8px;font-size:12px;background:#f8f6ff;color:#1a1a2e;outline:none;font-family:var(--font-body)}
  .range-slider{width:100%;accent-color:var(--brand2);margin-top:4px;cursor:pointer}
  .stars-row{display:flex;gap:6px;flex-wrap:wrap}
  .star-chip{border:1px solid #e8e4f5;border-radius:6px;padding:4px 10px;font-size:12px;cursor:pointer;background:#f8f6ff;transition:all .2s;display:flex;align-items:center;gap:3px;color:#1a1a2e;user-select:none}
  .star-chip.active{background:var(--brand2);color:#fff;border-color:var(--brand2)}
  .star-chip:hover:not(.active){border-color:var(--brand2);color:var(--brand2)}
  .amenity-list{display:flex;flex-direction:column;gap:6px}
  .amenity-item{display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;color:#1a1a2e}
  .amenity-item input[type=checkbox]{accent-color:var(--brand2);width:14px;height:14px;cursor:pointer}
  .prop-types{display:flex;flex-wrap:wrap;gap:6px}
  .prop-chip{border:1px solid #e8e4f5;border-radius:20px;padding:4px 10px;font-size:12px;cursor:pointer;background:#f8f6ff;transition:all .2s;color:#1a1a2e;user-select:none}
  .prop-chip.active{background:var(--brand2);color:#fff;border-color:var(--brand2)}
  .prop-chip:hover:not(.active){border-color:var(--brand2);color:var(--brand2)}

  /* SORT & RESULTS */
  .results-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;flex-wrap:wrap;gap:8px}
  .results-count{font-size:14px;color:#666}
  .results-count strong{color:#1a1a2e;font-weight:600}
  .sort-bar{display:flex;align-items:center;gap:8px}
  .sort-label{font-size:12px;color:#888}
  .sort-btn{border:1px solid #e8e4f5;border-radius:6px;padding:5px 12px;font-size:12px;background:#f8f6ff;cursor:pointer;transition:all .2s;color:#1a1a2e;font-family:var(--font-body)}
  .sort-btn.active{background:var(--brand2);color:#fff;border-color:var(--brand2)}
  .sort-btn:hover:not(.active){border-color:var(--brand2);color:var(--brand2)}

  /* HOTEL CARDS */
  .hotels{display:flex;flex-direction:column;gap:1rem}
  .hotel-card{background:#fff;border-radius:var(--radius);overflow:hidden;display:grid;grid-template-columns:240px 1fr;border:1px solid #e8e4f5;transition:box-shadow .2s,transform .2s;cursor:pointer}
  .hotel-card:hover{box-shadow:0 8px 30px rgba(28,20,80,0.12);transform:translateY(-2px)}
  .hotel-img{position:relative;overflow:hidden;height:100%;min-height:180px}
  .hotel-img img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s}
  .hotel-card:hover .hotel-img img{transform:scale(1.04)}
  .hotel-img-placeholder{width:100%;height:180px;display:flex;align-items:center;justify-content:center;font-size:40px;background:#e8e4f5}
  .badge{position:absolute;top:10px;left:10px;background:#e74c3c;color:#fff;font-size:11px;font-weight:600;padding:3px 8px;border-radius:4px}
  .badge-green{background:#27ae60}
  .wishlist-btn{position:absolute;top:10px;right:10px;width:32px;height:32px;background:rgba(255,255,255,0.95);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:15px;transition:all .2s;box-shadow:0 2px 8px rgba(0,0,0,0.1)}
  .wishlist-btn:hover{transform:scale(1.2)}
  .hotel-info{padding:1.1rem 1.25rem;display:flex;flex-direction:column;justify-content:space-between}
  .hotel-top{display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:.5rem}
  .hotel-name{font-size:16px;font-weight:600;line-height:1.3;font-family:var(--font-display)}
  .hotel-type{display:inline-block;background:#f0eef9;color:var(--brand2);font-size:11px;padding:2px 7px;border-radius:4px;margin-top:3px;font-weight:500}
  .hotel-rating{display:flex;flex-direction:column;align-items:flex-end;flex-shrink:0}
  .rating-score{background:var(--brand2);color:#fff;font-size:14px;font-weight:600;padding:4px 10px;border-radius:6px}
  .rating-label{font-size:11px;color:#888;margin-top:2px}
  .hotel-loc{font-size:12px;color:#888;margin-bottom:.5rem;display:flex;align-items:center;gap:4px}
  .hotel-amenities{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:.75rem}
  .am-tag{background:#f4f2f9;color:#666;font-size:11px;padding:3px 8px;border-radius:4px;display:flex;align-items:center;gap:3px}
  .hotel-bottom{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:8px}
  .price-block .orig-price{font-size:12px;color:#bbb;text-decoration:line-through}
  .price-block .price{font-size:22px;font-weight:600;color:var(--brand2);line-height:1;font-family:var(--font-display)}
  .price-block .per{font-size:11px;color:#888}
  .card-actions{display:flex;gap:8px}
  .btn-detail{border:1.5px solid var(--brand2);color:var(--brand2);background:none;border-radius:7px;padding:7px 14px;font-size:12px;cursor:pointer;transition:all .2s;font-family:var(--font-body);font-weight:500}
  .btn-detail:hover{background:var(--brand2);color:#fff}
  .btn-book{background:var(--brand2);color:#fff;border:none;border-radius:7px;padding:7px 14px;font-size:12px;cursor:pointer;transition:all .2s;font-family:var(--font-body);font-weight:500}
  .btn-book:hover{background:var(--brand2-light)}
  .urgency{font-size:11px;color:#e74c3c;font-weight:600;margin-bottom:4px;display:flex;align-items:center;gap:4px}

  /* DETAIL PANEL */
  .detail-panel{display:none;background:#fff;border-radius:var(--radius);border:1px solid #e8e4f5;overflow:hidden;margin-bottom:1rem}
  .detail-panel.open{display:block}
  .detail-gallery{display:grid;grid-template-columns:2fr 1fr 1fr;gap:4px;height:260px}
  .gal-main{border-radius:var(--radius-sm) 0 0 var(--radius-sm);overflow:hidden}
  .gal-main img{width:100%;height:100%;object-fit:cover;display:block}
  .gal-col{display:grid;grid-template-rows:1fr 1fr;gap:4px}
  .gal-sm{overflow:hidden;position:relative}
  .gal-sm img{width:100%;height:100%;object-fit:cover;display:block}
  .gal-sm:first-child{border-radius:0 var(--radius-sm) 0 0}
  .gal-sm:last-child{border-radius:0 0 var(--radius-sm) 0;cursor:pointer}
  .gal-more{position:absolute;inset:0;background:rgba(28,20,80,0.55);display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:600;border-radius:0 0 var(--radius-sm) 0}
  .detail-body{padding:1.25rem 1.5rem}
  .detail-title{font-size:20px;font-weight:600;margin-bottom:.25rem;font-family:var(--font-display)}
  .detail-meta{display:flex;align-items:center;gap:12px;margin-bottom:1rem;flex-wrap:wrap}
  .detail-meta span{font-size:12px;color:#888}
  .detail-tabs{display:flex;gap:0;border-bottom:1px solid #e8e4f5;margin-bottom:1rem}
  .dtab{padding:8px 16px;font-size:13px;cursor:pointer;border-bottom:2px solid transparent;color:#888;transition:all .2s;font-weight:500}
  .dtab.active{color:var(--brand2);border-bottom-color:var(--brand2);font-weight:600}
  .rooms-grid{display:flex;flex-direction:column;gap:8px}
  .room-card{border:1.5px solid #e8e4f5;border-radius:var(--radius-sm);padding:12px;display:grid;grid-template-columns:80px 1fr auto;align-items:center;gap:12px;transition:border-color .2s;cursor:pointer}
  .room-card:hover{border-color:var(--brand2)}
  .room-card.selected{border-color:var(--brand2);background:#f5f3ff}
  .room-thumb{width:80px;height:64px;border-radius:6px;overflow:hidden;flex-shrink:0}
  .room-thumb img{width:100%;height:100%;object-fit:cover}
  .room-info{flex:1}
  .room-name{font-size:14px;font-weight:600;margin-bottom:3px;font-family:var(--font-display)}
  .room-feats{display:flex;gap:6px;flex-wrap:wrap}
  .room-feat{font-size:11px;color:#888;background:#f4f2f9;padding:2px 7px;border-radius:4px}
  .room-price{text-align:right;flex-shrink:0}
  .room-price .r-price{font-size:17px;font-weight:600;color:var(--brand2)}
  .room-price .r-per{font-size:11px;color:#888}
  .btn-select{background:var(--brand2);color:#fff;border:none;border-radius:6px;padding:7px 14px;font-size:12px;cursor:pointer;margin-top:6px;transition:background .2s;font-family:var(--font-body);font-weight:500}
  .btn-select:hover{background:var(--brand2-light)}
  .reviews-list{display:flex;flex-direction:column;gap:10px}
  .review-item{border-bottom:1px solid #f0eef8;padding-bottom:10px}
  .review-item:last-child{border-bottom:none}
  .reviewer{display:flex;align-items:center;gap:8px;margin-bottom:4px}
  .reviewer-av{width:34px;height:34px;border-radius:50%;background:var(--brand2);color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;overflow:hidden}
  .reviewer-av img{width:100%;height:100%;object-fit:cover}
  .reviewer-name{font-size:13px;font-weight:600}
  .reviewer-date{font-size:11px;color:#aaa}
  .review-stars{color:#f5a623;font-size:12px}
  .review-text{font-size:13px;color:#666;line-height:1.5}
  .cancel-policy{background:#f8f6ff;border-radius:var(--radius-sm);padding:12px;margin-top:12px}
  .cancel-policy h4{font-size:13px;font-weight:600;margin-bottom:4px;display:flex;align-items:center;gap:6px}
  .cancel-policy p{font-size:12px;color:#888;line-height:1.5}
  .trust-indicators{display:flex;gap:12px;flex-wrap:wrap;margin-top:10px}
  .trust-badge{display:flex;align-items:center;gap:6px;font-size:12px;color:#666;background:#f8f6ff;border-radius:6px;padding:6px 10px}

  /* CHECKOUT */
  .checkout-panel{display:none;background:#fff;border-radius:var(--radius);border:1px solid #e8e4f5;padding:1.5rem;margin-bottom:1rem}
  .checkout-panel.open{display:block}
  .checkout-grid{display:grid;grid-template-columns:1fr 340px;gap:1.5rem}
  .section-title{font-size:15px;font-weight:600;margin-bottom:1rem;padding-bottom:.5rem;border-bottom:1px solid #e8e4f5;font-family:var(--font-display)}
  .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:1.25rem}
  .form-group{display:flex;flex-direction:column;gap:4px}
  .form-group label{font-size:11px;color:#888;text-transform:uppercase;letter-spacing:.4px;font-weight:600}
  .form-group input,.form-group select{border:1px solid #e8e4f5;border-radius:6px;padding:8px 10px;font-size:13px;background:#f8f6ff;color:#1a1a2e;outline:none;transition:border-color .2s;font-family:var(--font-body)}
  .form-group input:focus,.form-group select:focus{border-color:var(--brand2)}
  .form-full{grid-column:1/-1}
  .payment-opts{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:1.25rem}
  .pay-opt{border:1.5px solid #e8e4f5;border-radius:8px;padding:10px;text-align:center;cursor:pointer;transition:all .2s;background:#f8f6ff}
  .pay-opt.active{border-color:var(--brand2);background:#f0eeff}
  .pay-opt:hover:not(.active){border-color:var(--brand2-light)}
  .pay-opt-icon{font-size:20px;margin-bottom:4px}
  .pay-opt-label{font-size:11px;color:#888;font-weight:500}
  .card-fields{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:1rem}
  .promo-row{display:flex;gap:8px;margin-bottom:1.25rem}
  .promo-row input{flex:1;border:1px solid #e8e4f5;border-radius:6px;padding:8px 10px;font-size:13px;background:#f8f6ff;color:#1a1a2e;outline:none;font-family:var(--font-body)}
  .promo-row input:focus{border-color:var(--brand2)}
  .btn-promo{background:none;border:1.5px solid var(--brand2);color:var(--brand2);border-radius:6px;padding:8px 14px;font-size:12px;cursor:pointer;font-weight:600;transition:all .2s;font-family:var(--font-body)}
  .btn-promo:hover{background:var(--brand2);color:#fff}
  .btn-confirm{width:100%;background:var(--brand2);color:#fff;border:none;border-radius:8px;padding:13px;font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;margin-top:8px;font-family:var(--font-body)}
  .btn-confirm:hover{background:var(--brand2-light)}
  .security-badges{display:flex;justify-content:center;gap:12px;margin-top:10px;flex-wrap:wrap}
  .sec-badge{display:flex;align-items:center;gap:4px;font-size:11px;color:#888}
  .booking-summary{background:#f8f6ff;border-radius:var(--radius-sm);padding:1rem;border:1px solid #e8e4f5}
  .summary-hotel{display:flex;gap:10px;margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid #e8e4f5}
  .sum-img{width:64px;height:64px;border-radius:8px;overflow:hidden;flex-shrink:0}
  .sum-img img{width:100%;height:100%;object-fit:cover}
  .sum-name{font-size:13px;font-weight:600;font-family:var(--font-display)}
  .sum-room{font-size:12px;color:#888}
  .sum-dates{font-size:12px;color:#888;margin-top:3px}
  .price-breakdown{display:flex;flex-direction:column;gap:6px}
  .pb-row{display:flex;justify-content:space-between;font-size:13px}
  .pb-row.total{font-weight:600;font-size:15px;padding-top:8px;border-top:1px solid #e8e4f5;margin-top:4px}
  .pb-row.discount{color:#27ae60}
  .pb-row.promo-applied{color:var(--brand2);font-weight:600}

  /* EXTRA FEATURES */
  .ai-rec-bar{background:#fff;border-radius:var(--radius);border:1px solid #e8e4f5;padding:1rem 1.5rem;margin-bottom:1rem;display:flex;align-items:center;gap:12px;flex-wrap:wrap}
  .ai-spark{width:38px;height:38px;background:linear-gradient(135deg,var(--brand2),var(--brand2-light));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
  .ai-text strong{font-size:14px;font-weight:600;display:block;margin-bottom:2px;font-family:var(--font-display)}
  .ai-text span{font-size:12px;color:#888}
  .ai-chips{display:flex;gap:6px;flex-wrap:wrap;margin-left:auto}
  .ai-chip{border:1.5px solid #e8e4f5;border-radius:16px;padding:5px 14px;font-size:12px;cursor:pointer;background:#f8f6ff;transition:all .2s;color:#1a1a2e;font-weight:500;font-family:var(--font-body)}
  .ai-chip:hover{border-color:var(--brand2);color:var(--brand2);background:#f0eeff}

  /* ENHANCED LIVE CHAT */
  .chat-bubble{position:fixed;bottom:24px;right:24px;width:56px;height:56px;background:linear-gradient(135deg,var(--brand2),#3a2a9a);border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 4px 20px rgba(28,20,80,0.4);z-index:200;transition:all .3s}
  .chat-bubble:hover{transform:scale(1.1);box-shadow:0 6px 24px rgba(28,20,80,0.5)}
  .chat-bubble svg{width:24px;height:24px;fill:none;stroke:#fff;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
  .chat-badge{position:absolute;top:-4px;right:-4px;width:18px;height:18px;background:#e74c3c;border-radius:50%;font-size:10px;font-weight:700;color:#fff;display:flex;align-items:center;justify-content:center;border:2px solid #f4f2f9}
  .chat-win{position:fixed;bottom:90px;right:24px;width:320px;background:#fff;border-radius:16px;border:1px solid #e8e4f5;box-shadow:0 12px 40px rgba(28,20,80,0.18);z-index:200;display:none;overflow:hidden;transform-origin:bottom right;transition:all .3s}
  .chat-win.open{display:block;animation:chatIn .25s ease}
  @keyframes chatIn{from{opacity:0;transform:scale(0.9) translateY(10px)}to{opacity:1;transform:scale(1) translateY(0)}}
  .chat-head{background:linear-gradient(135deg,var(--brand2),#3a2a9a);color:#fff;padding:14px 16px;display:flex;align-items:center;gap:10px}
  .chat-av{width:36px;height:36px;border-radius:50%;overflow:hidden;flex-shrink:0;border:2px solid rgba(250,224,19,0.6)}
  .chat-av img{width:100%;height:100%;object-fit:cover}
  .chat-online{width:8px;height:8px;background:#2ecc71;border-radius:50%;margin-left:auto;flex-shrink:0;box-shadow:0 0 0 2px rgba(46,204,113,0.3)}
  .chat-head-info strong{font-size:13px;display:block;font-weight:600}
  .chat-head-info small{font-size:11px;opacity:.8}
  .chat-close{background:none;border:none;color:rgba(255,255,255,0.7);cursor:pointer;font-size:18px;margin-left:8px;padding:0;line-height:1}
  .chat-close:hover{color:#fff}
  .chat-msgs{padding:12px;min-height:160px;max-height:280px;overflow-y:auto;display:flex;flex-direction:column;gap:6px;background:#fafafa}
  .chat-msg{background:#fff;border-radius:12px 12px 12px 2px;padding:8px 12px;font-size:12px;color:#444;line-height:1.5;box-shadow:0 1px 4px rgba(0,0,0,0.06);max-width:85%;width:fit-content}
  .chat-msg.user-msg{background:var(--brand2);color:#fff;border-radius:12px 12px 2px 12px;align-self:flex-end}
  .chat-typing{display:flex;gap:4px;align-items:center;padding:8px 12px;background:#fff;border-radius:12px;width:fit-content;box-shadow:0 1px 4px rgba(0,0,0,0.06)}
  .chat-typing span{width:6px;height:6px;background:#ccc;border-radius:50%;animation:typingDot 1.2s infinite}
  .chat-typing span:nth-child(2){animation-delay:.2s}
  .chat-typing span:nth-child(3){animation-delay:.4s}
  @keyframes typingDot{0%,60%,100%{transform:translateY(0)}30%{transform:translateY(-5px)}}
  .chat-quick{padding:8px 12px;display:flex;gap:6px;flex-wrap:wrap;border-top:1px solid #f0eef8;background:#fff}
  .chat-q{border:1px solid #e8e4f5;border-radius:12px;padding:4px 10px;font-size:11px;cursor:pointer;color:var(--brand2);background:#f8f6ff;font-weight:500;transition:all .2s;font-family:var(--font-body)}
  .chat-q:hover{background:var(--brand2);color:#fff;border-color:var(--brand2)}
  .chat-input-row{display:flex;border-top:1px solid #f0eef8;padding:8px 10px;gap:6px;align-items:center;background:#fff}
  .chat-input-row input{flex:1;border:none;outline:none;font-size:13px;background:transparent;color:#1a1a2e;font-family:var(--font-body)}
  .chat-send{background:var(--brand2);color:#fff;border:none;border-radius:8px;padding:6px 12px;font-size:13px;cursor:pointer;transition:background .2s;font-weight:600}
  .chat-send:hover{background:var(--brand2-light)}

  /* RECENTLY VIEWED */
  .rec-viewed{padding:0 2rem 1.5rem}
  .rec-viewed h3{font-size:16px;font-weight:600;margin-bottom:.75rem;color:#1a1a2e;font-family:var(--font-display)}
  .rec-scroll{display:flex;gap:10px;overflow-x:auto;padding-bottom:6px;scrollbar-width:thin}
  .rec-card{flex-shrink:0;width:160px;background:#fff;border-radius:var(--radius-sm);border:1px solid #e8e4f5;overflow:hidden;cursor:pointer;transition:all .2s}
  .rec-card:hover{box-shadow:var(--shadow);transform:translateY(-2px)}
  .rec-img{height:90px;overflow:hidden}
  .rec-img img{width:100%;height:100%;object-fit:cover;transition:transform .3s}
  .rec-card:hover .rec-img img{transform:scale(1.05)}
  .rec-info{padding:8px}
  .rec-name{font-size:12px;font-weight:600;margin-bottom:2px;font-family:var(--font-display)}
  .rec-price{font-size:11px;color:var(--brand2);font-weight:600}

  @media(max-width:768px){
    .main{grid-template-columns:1fr;padding:1rem}
    .filters{display:none}
    .search-box{grid-template-columns:1fr;padding:1rem}
    .hotel-card{grid-template-columns:1fr}
    .hotel-img{min-height:160px}
    .checkout-grid{grid-template-columns:1fr}
    .detail-gallery{height:180px}
    .gal-col{display:none}
    .nav-links{display:none}
    .hero{padding:2rem 1rem 4rem}
    .rec-viewed{padding:0 1rem 1.5rem}
    .payment-opts{grid-template-columns:1fr 1fr}
    .ai-chips{display:none}
  }
</style>
</head>
<body>
<div class="page">
  <!-- NAV -->
  <nav>
    <div class="logo">
      <div class="logo-dot"></div>
      StayNest
    </div>

    <div class="nav-right">
      <div class="currency-wrap">
        <span class="currency-flag" id="currFlag">🇮🇳</span>
        <select class="currency" id="currencySelect" onchange="changeCurrency(this.value)">
          <option value="INR">INR</option>
          <option value="USD">USD</option>
          <option value="EUR">EUR</option>
        </select>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <div class="hero">
    <h1>Find Your Perfect Stay</h1>
    <p>Search 2M+ properties across 190+ countries</p>
    <div class="hero-tabs">
      <button class="hero-tab active" onclick="switchHeroTab(this)">Hotels</button>
      <button class="hero-tab" onclick="switchHeroTab(this)">Resorts</button>
      <button class="hero-tab" onclick="switchHeroTab(this)">Villas</button>
      <button class="hero-tab" onclick="switchHeroTab(this)">Apartments</button>
    </div>
    <div class="search-box">
      <div class="search-field" style="position:relative">
        <label>Destination</label>
        <input type="text" id="destInput" placeholder="City, hotel or landmark" oninput="showSuggestions()" onblur="hideSuggestions()" autocomplete="off">
        <div class="suggestions" id="suggestions" style="display:none">
          <div class="sug-item" onmousedown="selectDest('Mumbai, India')">
            <div class="sug-icon"><img src="https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=72&h=72&fit=crop" alt="Mumbai"></div>
            <div class="sug-text"><strong>Mumbai</strong><small>India · 1,240 hotels</small></div>
          </div>
          <div class="sug-item" onmousedown="selectDest('Goa, India')">
            <div class="sug-icon"><img src="https://images.unsplash.com/photo-1587922546307-776227941871?w=72&h=72&fit=crop" alt="Goa"></div>
            <div class="sug-text"><strong>Goa</strong><small>India · 890 hotels</small></div>
          </div>
          <div class="sug-item" onmousedown="selectDest('New Delhi, India')">
            <div class="sug-icon"><img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=72&h=72&fit=crop" alt="Delhi"></div>
            <div class="sug-text"><strong>New Delhi</strong><small>India · 2,100 hotels</small></div>
          </div>
          <div class="sug-item" onmousedown="selectDest('Udaipur, India')">
            <div class="sug-icon"><img src="https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=72&h=72&fit=crop" alt="Udaipur"></div>
            <div class="sug-text"><strong>Udaipur</strong><small>India · 430 hotels</small></div>
          </div>
          <div class="sug-item" onmousedown="selectDest('Jaipur, India')">
            <div class="sug-icon"><img src="https://images.unsplash.com/photo-1477587458883-47145ed94245?w=72&h=72&fit=crop" alt="Jaipur"></div>
            <div class="sug-text"><strong>Jaipur</strong><small>India · 560 hotels</small></div>
          </div>
        </div>
      </div>
      <div class="search-field">
        <label>Check-in</label>
        <input type="date" id="checkin" value="2026-04-15" onchange="updateDates()">
      </div>
      <div class="search-field">
        <label>Check-out</label>
        <input type="date" id="checkout" value="2026-04-18" onchange="updateDates()">
      </div>
      <div class="search-field guest-selector">
        <label>Guests & Rooms</label>
        <button class="guest-btn" id="guestBtn" onclick="toggleGuests()">2 Adults · 1 Room</button>
        <div class="guest-dropdown" id="guestDropdown" style="display:none">
          <div class="guest-row">
            <div><span>Adults</span><small>13+ years</small></div>
            <div class="qty-ctrl">
              <button class="qty-btn" onclick="changeQty('adults',-1)">−</button>
              <span class="qty-val" id="adultsVal">2</span>
              <button class="qty-btn" onclick="changeQty('adults',1)">+</button>
            </div>
          </div>
          <div class="guest-row">
            <div><span>Children</span><small>0–12 years</small></div>
            <div class="qty-ctrl">
              <button class="qty-btn" onclick="changeQty('children',-1)">−</button>
              <span class="qty-val" id="childrenVal">0</span>
              <button class="qty-btn" onclick="changeQty('children',1)">+</button>
            </div>
          </div>
          <div class="guest-row">
            <div><span>Rooms</span></div>
            <div class="qty-ctrl">
              <button class="qty-btn" onclick="changeQty('rooms',-1)">−</button>
              <span class="qty-val" id="roomsVal">1</span>
              <button class="qty-btn" onclick="changeQty('rooms',1)">+</button>
            </div>
          </div>
          <button style="width:100%;margin-top:10px;background:var(--brand2);color:#fff;border:none;border-radius:6px;padding:8px;font-size:13px;cursor:pointer;font-weight:600" onclick="toggleGuests()">Done</button>
        </div>
      </div>
      <button class="search-btn" onclick="doSearch()">
        <svg class="search-icon" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        Search
      </button>
    </div>
    <div class="trust-bar">
      <div class="trust-item"><div class="trust-dot"></div> Free cancellation available</div>
      <div class="trust-item"><div class="trust-dot"></div> Best price guaranteed</div>
      <div class="trust-item"><div class="trust-dot"></div> 24/7 customer support</div>
      <div class="trust-item"><div class="trust-dot"></div> Secure payments</div>
    </div>
  </div>

  <!-- RECENTLY VIEWED -->
  <div class="rec-viewed" style="padding-top:1.5rem">
    <h3>Recently Viewed</h3>
    <div class="rec-scroll">
      <div class="rec-card" onclick="openDetail(this,'Taj Lake Palace','★★★★★','Lake Pichola, Udaipur',9.4)">
        <div class="rec-img"><img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=320&h=180&fit=crop" alt="Taj Lake Palace"></div>
        <div class="rec-info"><div class="rec-name">Taj Lake Palace</div><div class="rec-price" id="rv1">₹12,500/night</div></div>
      </div>
      <div class="rec-card" onclick="openDetail(this,'Leela Goa','★★★★★','Cavelossim Beach, Goa',9.1)">
        <div class="rec-img"><img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=320&h=180&fit=crop" alt="Leela Goa"></div>
        <div class="rec-info"><div class="rec-name">Leela Goa</div><div class="rec-price" id="rv2">₹8,200/night</div></div>
      </div>
      <div class="rec-card" onclick="openDetail(this,'ITC Maurya','★★★★★','Diplomatic Enclave, Delhi',9.0)">
        <div class="rec-img"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=320&h=180&fit=crop" alt="ITC Maurya"></div>
        <div class="rec-info"><div class="rec-name">ITC Maurya</div><div class="rec-price" id="rv3">₹9,800/night</div></div>
      </div>
      <div class="rec-card" onclick="openDetail(this,'Wildflower Hall','★★★★★','Mashobra, Shimla',8.9)">
        <div class="rec-img"><img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=320&h=180&fit=crop" alt="Wildflower Hall"></div>
        <div class="rec-info"><div class="rec-name">Wildflower Hall</div><div class="rec-price" id="rv4">₹15,000/night</div></div>
      </div>
      <div class="rec-card" onclick="openDetail(this,'Vivanta Beachside','★★★★','Marine Drive, Chennai',8.5)">
        <div class="rec-img"><img src="https://images.unsplash.com/photo-1439130490301-25e322d88054?w=320&h=180&fit=crop" alt="Vivanta Beachside"></div>
        <div class="rec-info"><div class="rec-name">Vivanta Beachside</div><div class="rec-price" id="rv5">₹6,500/night</div></div>
      </div>
    </div>
  </div>

  <!-- AI RECOMMENDATIONS -->
  <div style="padding:0 2rem;margin-bottom:1rem">
    <div class="ai-rec-bar">
      <div class="ai-spark">✦</div>
      <div class="ai-text">
        <strong>AI Picks for You</strong>
        <span>Based on your searches and preferences</span>
      </div>
      <div class="ai-chips">
        <button class="ai-chip" onclick="triggerChatPrompt('Recommend me romantic hotels in Udaipur under ₹10,000 per night')">Romantic getaways ↗</button>
        <button class="ai-chip" onclick="triggerChatPrompt('Show family-friendly beach resorts in India for April 2026')">Family beach trips ↗</button>
        <button class="ai-chip" onclick="triggerChatPrompt('Find me luxury business hotels in Mumbai near the airport')">Business stays ↗</button>
      </div>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main">
    <!-- FILTERS -->
    <aside class="filters">
      <div class="filter-title">Filters <span class="filter-reset" onclick="resetFilters()">Reset all</span></div>
      <div class="filter-section">
        <div class="filter-label">Price per night</div>
        <div class="price-range">
          <input class="price-input" id="minPrice" value="500" type="number">
          <span style="color:#aaa;font-size:12px">–</span>
          <input class="price-input" id="maxPrice" value="25000" type="number">
        </div>
        <input type="range" class="range-slider" min="500" max="50000" value="25000" id="priceRange" oninput="document.getElementById('maxPrice').value=this.value;filterHotels()">
      </div>
      <div class="filter-section">
        <div class="filter-label">Star rating</div>
        <div class="stars-row">
          <div class="star-chip" onclick="toggleStar(this,'5')">★★★★★</div>
          <div class="star-chip" onclick="toggleStar(this,'4')">★★★★</div>
          <div class="star-chip" onclick="toggleStar(this,'3')">★★★</div>
          <div class="star-chip" onclick="toggleStar(this,'2')">★★</div>
        </div>
      </div>
      <div class="filter-section">
        <div class="filter-label">Amenities</div>
        <div class="amenity-list">
          <label class="amenity-item"><input type="checkbox" onchange="filterHotels()"> Free WiFi</label>
          <label class="amenity-item"><input type="checkbox" onchange="filterHotels()"> Swimming Pool</label>
          <label class="amenity-item"><input type="checkbox" onchange="filterHotels()"> Free Breakfast</label>
          <label class="amenity-item"><input type="checkbox" onchange="filterHotels()"> Free Parking</label>
          <label class="amenity-item"><input type="checkbox" onchange="filterHotels()"> Spa</label>
          <label class="amenity-item"><input type="checkbox" onchange="filterHotels()"> Pet Friendly</label>
          <label class="amenity-item"><input type="checkbox" onchange="filterHotels()"> Airport Shuttle</label>
        </div>
      </div>
      <div class="filter-section">
        <div class="filter-label">Property type</div>
        <div class="prop-types">
          <div class="prop-chip" onclick="toggleProp(this)">Hotel</div>
          <div class="prop-chip" onclick="toggleProp(this)">Resort</div>
          <div class="prop-chip" onclick="toggleProp(this)">Villa</div>
          <div class="prop-chip" onclick="toggleProp(this)">Hostel</div>
          <div class="prop-chip" onclick="toggleProp(this)">Apartment</div>
          <div class="prop-chip" onclick="toggleProp(this)">Boutique</div>
        </div>
      </div>
    </aside>

    <!-- RESULTS -->
    <div>
      <div class="results-header">
        <div class="results-count">Showing <strong id="resultCount">6</strong> properties in <strong id="destLabel">India</strong></div>
        <div class="sort-bar">
          <span class="sort-label">Sort:</span>
          <button class="sort-btn active" onclick="sortBy('popular',this)">Popular</button>
          <button class="sort-btn" onclick="sortBy('price-asc',this)">Price ↑</button>
          <button class="sort-btn" onclick="sortBy('price-desc',this)">Price ↓</button>
          <button class="sort-btn" onclick="sortBy('rating',this)">Rating</button>
        </div>
      </div>

      <!-- DETAIL PANEL -->
      <div class="detail-panel" id="detailPanel">
        <div class="detail-gallery">
          <div class="gal-main"><img id="galMain" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=520&fit=crop" alt="Hotel"></div>
          <div class="gal-col">
            <div class="gal-sm"><img id="galSm1" src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&h=260&fit=crop" alt="Room"></div>
            <div class="gal-sm"><img id="galSm2" src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=400&h=260&fit=crop" alt="View"><div class="gal-more">+12 photos</div></div>
          </div>
        </div>
        <div class="detail-body">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;flex-wrap:wrap">
            <div>
              <div class="detail-title" id="detailName">The Grand Oberoi</div>
              <div class="detail-meta">
                <span id="detailStars">★★★★★</span>
                <span id="detailLoc">📍 Nariman Point, Mumbai</span>
                <span style="background:#e6f9ee;color:#27ae60;padding:2px 7px;border-radius:4px;font-size:11px;font-weight:500">Free cancellation</span>
              </div>
            </div>
            <div style="text-align:right">
              <div style="background:var(--brand2);color:#fff;padding:6px 14px;border-radius:8px;font-size:18px;font-weight:600;display:inline-block" id="detailScore">9.2</div>
              <div style="font-size:11px;color:#888;margin-top:3px">Exceptional · 1,204 reviews</div>
            </div>
          </div>
          <div class="detail-tabs">
            <div class="dtab active" onclick="switchTab(this,'rooms')">Rooms</div>
            <div class="dtab" onclick="switchTab(this,'reviews')">Reviews</div>
            <div class="dtab" onclick="switchTab(this,'amenities')">Amenities</div>
            <div class="dtab" onclick="switchTab(this,'policies')">Policies</div>
          </div>
          <div id="tab-rooms" class="tab-content">
            <div class="rooms-grid">
              <div class="room-card selected" id="room1" onclick="selectRoom(this,'Deluxe King Room',7500)">
                <div class="room-thumb"><img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=160&h=128&fit=crop" alt="Deluxe King"></div>
                <div class="room-info">
                  <div class="room-name">Deluxe King Room</div>
                  <div class="room-feats"><span class="room-feat">1 King Bed</span><span class="room-feat">City View</span><span class="room-feat">35 m²</span><span class="room-feat">Free WiFi</span></div>
                </div>
                <div class="room-price">
                  <div class="r-price" id="rp1">₹7,500</div>
                  <div class="r-per">per night</div>
                  <button class="btn-select">Select</button>
                </div>
              </div>
              <div class="room-card" id="room2" onclick="selectRoom(this,'Premier Sea View Suite',12000)">
                <div class="room-thumb"><img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=160&h=128&fit=crop" alt="Sea View Suite"></div>
                <div class="room-info">
                  <div class="room-name">Premier Sea View Suite</div>
                  <div class="room-feats"><span class="room-feat">1 King Bed</span><span class="room-feat">Sea View</span><span class="room-feat">58 m²</span><span class="room-feat">Lounge Access</span></div>
                </div>
                <div class="room-price">
                  <div class="r-price" id="rp2">₹12,000</div>
                  <div class="r-per">per night</div>
                  <button class="btn-select">Select</button>
                </div>
              </div>
              <div class="room-card" id="room3" onclick="selectRoom(this,'Presidential Suite',28000)">
                <div class="room-thumb"><img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=160&h=128&fit=crop" alt="Presidential Suite"></div>
                <div class="room-info">
                  <div class="room-name">Presidential Suite</div>
                  <div class="room-feats"><span class="room-feat">2 Bedrooms</span><span class="room-feat">Panoramic View</span><span class="room-feat">120 m²</span><span class="room-feat">Private Pool</span></div>
                </div>
                <div class="room-price">
                  <div class="r-price" id="rp3">₹28,000</div>
                  <div class="r-per">per night</div>
                  <button class="btn-select">Select</button>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-reviews" class="tab-content" style="display:none">
            <div class="reviews-list">
              <div class="review-item">
                <div class="reviewer">
                  <div class="reviewer-av"><img src="https://i.pravatar.cc/68?img=47" alt="Ananya"></div>
                  <div><div class="reviewer-name">Ananya S.</div><div class="reviewer-date">March 2026</div></div>
                  <div class="review-stars" style="margin-left:auto">★★★★★</div>
                </div>
                <div class="review-text">Absolutely stunning hotel. The sea-view suite was breathtaking and the staff went above and beyond. The breakfast buffet had incredible variety. Would book again without hesitation.</div>
              </div>
              <div class="review-item">
                <div class="reviewer">
                  <div class="reviewer-av"><img src="https://i.pravatar.cc/68?img=12" alt="Rahul"></div>
                  <div><div class="reviewer-name">Rahul K.</div><div class="reviewer-date">February 2026</div></div>
                  <div class="review-stars" style="margin-left:auto">★★★★</div>
                </div>
                <div class="review-text">Great location, superb food. The room was spacious and clean. Service was attentive though check-in took a while. Overall a fantastic stay for a business trip.</div>
              </div>
              <div class="review-item">
                <div class="reviewer">
                  <div class="reviewer-av"><img src="https://i.pravatar.cc/68?img=32" alt="Priya"></div>
                  <div><div class="reviewer-name">Priya M.</div><div class="reviewer-date">January 2026</div></div>
                  <div class="review-stars" style="margin-left:auto">★★★★★</div>
                </div>
                <div class="review-text">Celebrated our anniversary here. The hotel arranged a special surprise in our room — thoughtful details everywhere. Worth every rupee for such a luxurious experience.</div>
              </div>
            </div>
          </div>
          <div id="tab-amenities" class="tab-content" style="display:none">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:8px">
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">📶 Free WiFi</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🏊 Pool</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">💆 Spa</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🍳 Breakfast</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🚗 Valet Parking</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🏋️ Gym</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🍽️ Restaurant</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🍸 Bar</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🛎️ Room Service</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">✈️ Airport Shuttle</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">🎭 Concierge</div>
              <div class="am-tag" style="background:#f4f2f9;padding:8px 10px;border-radius:8px;font-size:12px">👔 Business Center</div>
            </div>
          </div>
          <div id="tab-policies" class="tab-content" style="display:none">
            <div class="cancel-policy">
              <h4>✅ Cancellation Policy</h4>
              <p>Free cancellation until 24 hours before check-in. After that, the first night's charge applies. No-show results in full booking charge.</p>
            </div>
            <div class="trust-indicators">
              <div class="trust-badge">🔒 SSL Secured</div>
              <div class="trust-badge">✅ Verified Property</div>
              <div class="trust-badge">🏅 Best Price Guarantee</div>
              <div class="trust-badge">📞 24/7 Support</div>
            </div>
          </div>
          <div style="display:flex;gap:8px;margin-top:1.25rem">
            <button class="btn-detail" onclick="closeDetail()">✕ Close</button>
            <button class="btn-book" style="flex:1" onclick="openCheckout()">Book This Room →</button>
          </div>
        </div>
      </div>

      <!-- CHECKOUT PANEL -->
      <div class="checkout-panel" id="checkoutPanel">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem">
          <div style="font-size:17px;font-weight:600;font-family:var(--font-display)">Complete Your Booking</div>
          <button onclick="closeCheckout()" style="background:none;border:none;color:#aaa;cursor:pointer;font-size:22px;padding:0;line-height:1">×</button>
        </div>
        <div class="checkout-grid">
          <div>
            <div class="section-title">Guest Details</div>
            <div class="form-grid">
              <div class="form-group"><label>First name</label><input type="text" placeholder="Rahul" id="fname"></div>
              <div class="form-group"><label>Last name</label><input type="text" placeholder="Sharma" id="lname"></div>
              <div class="form-group"><label>Email</label><input type="email" placeholder="rahul@example.com" id="femail"></div>
              <div class="form-group"><label>Phone</label><input type="tel" placeholder="+91 98765 43210" id="fphone"></div>
              <div class="form-group form-full"><label>Special requests (optional)</label><input type="text" placeholder="Early check-in, high floor, etc."></div>
            </div>
            <div class="section-title">Payment Method</div>
            <div class="payment-opts">
              <div class="pay-opt active" onclick="selectPay(this,'card')"><div class="pay-opt-icon">💳</div><div class="pay-opt-label">Credit/Debit Card</div></div>
              <div class="pay-opt" onclick="selectPay(this,'upi')"><div class="pay-opt-icon">📱</div><div class="pay-opt-label">UPI</div></div>
              <div class="pay-opt" onclick="selectPay(this,'wallet')"><div class="pay-opt-icon">👝</div><div class="pay-opt-label">Wallets</div></div>
            </div>
            <div id="cardFields">
              <div class="card-fields">
                <div class="form-group form-full"><label>Card number</label><input type="text" placeholder="1234 5678 9012 3456" maxlength="19" oninput="fmtCard(this)"></div>
                <div class="form-group"><label>Expiry</label><input type="text" placeholder="MM/YY" maxlength="5" oninput="fmtExpiry(this)"></div>
                <div class="form-group"><label>CVV</label><input type="password" placeholder="•••" maxlength="4"></div>
              </div>
            </div>
            <div id="upiFields" style="display:none"><div class="form-group" style="margin-bottom:1rem"><label>UPI ID</label><input type="text" placeholder="yourname@upi"></div></div>
            <div id="walletFields" style="display:none">
              <div style="display:flex;gap:8px;margin-bottom:1rem;flex-wrap:wrap">
                <div class="pay-opt" style="flex:1;min-width:80px" onclick="selectWallet(this)"><div class="pay-opt-icon">P</div><div class="pay-opt-label">PhonePe</div></div>
                <div class="pay-opt" style="flex:1;min-width:80px" onclick="selectWallet(this)"><div class="pay-opt-icon">G</div><div class="pay-opt-label">GPay</div></div>
                <div class="pay-opt" style="flex:1;min-width:80px" onclick="selectWallet(this)"><div class="pay-opt-icon">P</div><div class="pay-opt-label">Paytm</div></div>
              </div>
            </div>
            <div class="promo-row">
              <input type="text" id="promoInput" placeholder="Promo code (try STAYNEST20)">
              <button class="btn-promo" onclick="applyPromo()">Apply</button>
            </div>
            <div id="promoMsg" style="font-size:12px;color:#27ae60;margin-bottom:.75rem;display:none;font-weight:500">✅ 20% discount applied!</div>
            <button class="btn-confirm" onclick="confirmBooking()">Confirm & Pay <span id="confirmAmt">₹23,700</span></button>
            <div class="security-badges">
              <div class="sec-badge">🔒 SSL Encrypted</div>
              <div class="sec-badge">✅ PCI DSS Compliant</div>
              <div class="sec-badge">🛡️ Fraud Protection</div>
            </div>
          </div>
          <div>
            <div class="section-title">Booking Summary</div>
            <div class="booking-summary">
              <div class="summary-hotel">
                <div class="sum-img"><img id="sumImg" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=128&h=128&fit=crop" alt="Hotel"></div>
                <div>
                  <div class="sum-name" id="sumName">The Grand Oberoi</div>
                  <div class="sum-room" id="sumRoom">Deluxe King Room</div>
                  <div class="sum-dates" id="sumDates">Apr 15 – Apr 18, 2026 · 3 nights</div>
                </div>
              </div>
              <div class="price-breakdown">
                <div class="pb-row"><span id="pbRoomLabel">₹7,500 × 3 nights</span><span id="pbRoomAmt">₹22,500</span></div>
                <div class="pb-row"><span>Taxes & fees (12%)</span><span id="pbTax">₹2,700</span></div>
                <div class="pb-row discount"><span>Early bird discount</span><span>−₹1,500</span></div>
                <div class="pb-row promo-applied" id="promoRow" style="display:none"><span>Promo STAYNEST20</span><span id="promoAmt">−₹4,500</span></div>
                <div class="pb-row total"><span>Total</span><span id="pbTotal">₹23,700</span></div>
              </div>
              <div style="margin-top:12px;background:#e6f9ee;border-radius:6px;padding:8px 10px;font-size:12px;color:#1a7a40;font-weight:500">
                ✅ Free cancellation until Apr 14, 2026
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- HOTEL LISTINGS -->
      <div class="hotels" id="hotelList">

        <!-- Hotel 1 -->
        <div class="hotel-card" onclick="openDetail(this,'The Grand Oberoi','★★★★★','Nariman Point, Mumbai',9.2,'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=520&fit=crop')">
          <div class="hotel-img">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=480&h=360&fit=crop" alt="The Grand Oberoi">
            <div class="badge">25% OFF</div>
            <button class="wishlist-btn" onclick="event.stopPropagation();toggleWishlist(this)">🤍</button>
          </div>
          <div class="hotel-info">
            <div>
              <div class="hotel-top">
                <div><div class="hotel-name">The Grand Oberoi</div><span class="hotel-type">5-Star Hotel</span></div>
                <div class="hotel-rating"><div class="rating-score">9.2</div><div class="rating-label">Exceptional</div></div>
              </div>
              <div class="hotel-loc">📍 Nariman Point, Mumbai · 0.4 km from city center</div>
              <div class="hotel-amenities">
                <span class="am-tag">📶 WiFi</span><span class="am-tag">🏊 Pool</span><span class="am-tag">💆 Spa</span><span class="am-tag">🍳 Breakfast</span><span class="am-tag">🚗 Parking</span>
              </div>
            </div>
            <div class="hotel-bottom">
              <div class="price-block">
                <div class="urgency">🔥 Only 2 rooms left!</div>
                <div class="orig-price" id="op1">₹10,000</div>
                <div class="price" id="pr1">₹7,500</div>
                <div class="per">per night · excl. taxes</div>
              </div>
              <div class="card-actions">
                <button class="btn-detail" onclick="event.stopPropagation();openDetail(this,'The Grand Oberoi','★★★★★','Nariman Point, Mumbai',9.2,'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=520&fit=crop')">View Details</button>
                <button class="btn-book" onclick="event.stopPropagation();openCheckout()">Book Now</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Hotel 2 -->
        <div class="hotel-card" onclick="openDetail(this,'Taj Holiday Village Resort','★★★★★','Candolim Beach, Goa',9.0,'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&h=520&fit=crop')">
          <div class="hotel-img">
            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=480&h=360&fit=crop" alt="Taj Holiday Village">
            <div class="badge badge-green">Free Breakfast</div>
            <button class="wishlist-btn" onclick="event.stopPropagation();toggleWishlist(this)">🤍</button>
          </div>
          <div class="hotel-info">
            <div>
              <div class="hotel-top">
                <div><div class="hotel-name">Taj Holiday Village Resort</div><span class="hotel-type">5-Star Resort</span></div>
                <div class="hotel-rating"><div class="rating-score">9.0</div><div class="rating-label">Exceptional</div></div>
              </div>
              <div class="hotel-loc">📍 Candolim Beach, Goa · Beachfront</div>
              <div class="hotel-amenities">
                <span class="am-tag">📶 WiFi</span><span class="am-tag">🏊 Pool</span><span class="am-tag">🍳 Breakfast</span><span class="am-tag">🌊 Beach Access</span>
              </div>
            </div>
            <div class="hotel-bottom">
              <div class="price-block">
                <div class="price" id="pr2">₹8,200</div>
                <div class="per">per night · incl. breakfast</div>
              </div>
              <div class="card-actions">
                <button class="btn-detail" onclick="event.stopPropagation();openDetail(this,'Taj Holiday Village Resort','★★★★★','Candolim Beach, Goa',9.0,'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&h=520&fit=crop')">View Details</button>
                <button class="btn-book" onclick="event.stopPropagation();openCheckout()">Book Now</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Hotel 3 -->
        <div class="hotel-card" onclick="openDetail(this,'The Lalit New Delhi','★★★★','Connaught Place, Delhi',8.7,'https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=800&h=520&fit=crop')">
          <div class="hotel-img">
            <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=480&h=360&fit=crop" alt="The Lalit New Delhi">
            <button class="wishlist-btn" onclick="event.stopPropagation();toggleWishlist(this)">🤍</button>
          </div>
          <div class="hotel-info">
            <div>
              <div class="hotel-top">
                <div><div class="hotel-name">The Lalit New Delhi</div><span class="hotel-type">4-Star Hotel</span></div>
                <div class="hotel-rating"><div class="rating-score">8.7</div><div class="rating-label">Excellent</div></div>
              </div>
              <div class="hotel-loc">📍 Connaught Place, Delhi · Near Metro</div>
              <div class="hotel-amenities">
                <span class="am-tag">📶 WiFi</span><span class="am-tag">🏋️ Gym</span><span class="am-tag">🍽️ Restaurant</span><span class="am-tag">🚗 Parking</span>
              </div>
            </div>
            <div class="hotel-bottom">
              <div class="price-block">
                <div class="urgency">⚡ 15% off today only</div>
                <div class="orig-price" id="op3">₹5,800</div>
                <div class="price" id="pr3">₹4,930</div>
                <div class="per">per night · excl. taxes</div>
              </div>
              <div class="card-actions">
                <button class="btn-detail" onclick="event.stopPropagation();openDetail(this,'The Lalit New Delhi','★★★★','Connaught Place, Delhi',8.7,'https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=800&h=520&fit=crop')">View Details</button>
                <button class="btn-book" onclick="event.stopPropagation();openCheckout()">Book Now</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Hotel 4 -->
        <div class="hotel-card" onclick="openDetail(this,'Udaivilas Palace Resort','★★★★★','Lake Pichola, Udaipur',9.5,'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=800&h=520&fit=crop')">
          <div class="hotel-img">
            <img src="https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=480&h=360&fit=crop" alt="Udaivilas Palace">
            <div class="badge" style="background:#8e44ad">Top Rated</div>
            <button class="wishlist-btn" onclick="event.stopPropagation();toggleWishlist(this)">❤️</button>
          </div>
          <div class="hotel-info">
            <div>
              <div class="hotel-top">
                <div><div class="hotel-name">Udaivilas Palace Resort</div><span class="hotel-type">5-Star Palace</span></div>
                <div class="hotel-rating"><div class="rating-score">9.5</div><div class="rating-label">Exceptional</div></div>
              </div>
              <div class="hotel-loc">📍 Lake Pichola, Udaipur · Lakefront</div>
              <div class="hotel-amenities">
                <span class="am-tag">📶 WiFi</span><span class="am-tag">🏊 Pool</span><span class="am-tag">💆 Spa</span><span class="am-tag">🚣 Boat Rides</span><span class="am-tag">🍳 Breakfast</span>
              </div>
            </div>
            <div class="hotel-bottom">
              <div class="price-block">
                <div class="orig-price" id="op4">₹18,000</div>
                <div class="price" id="pr4">₹15,000</div>
                <div class="per">per night · incl. breakfast</div>
              </div>
              <div class="card-actions">
                <button class="btn-detail" onclick="event.stopPropagation();openDetail(this,'Udaivilas Palace Resort','★★★★★','Lake Pichola, Udaipur',9.5,'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=800&h=520&fit=crop')">View Details</button>
                <button class="btn-book" onclick="event.stopPropagation();openCheckout()">Book Now</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Hotel 5 -->
        <div class="hotel-card" onclick="openDetail(this,'Wildflower Hall, Shimla','★★★★★','Mashobra, Shimla',8.9,'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&h=520&fit=crop')">
          <div class="hotel-img">
            <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=480&h=360&fit=crop" alt="Wildflower Hall">
            <button class="wishlist-btn" onclick="event.stopPropagation();toggleWishlist(this)">🤍</button>
          </div>
          <div class="hotel-info">
            <div>
              <div class="hotel-top">
                <div><div class="hotel-name">Wildflower Hall, Shimla</div><span class="hotel-type">5-Star Retreat</span></div>
                <div class="hotel-rating"><div class="rating-score">8.9</div><div class="rating-label">Excellent</div></div>
              </div>
              <div class="hotel-loc">📍 Mashobra, Shimla · Mountain Views</div>
              <div class="hotel-amenities">
                <span class="am-tag">📶 WiFi</span><span class="am-tag">🛷 Activities</span><span class="am-tag">💆 Spa</span><span class="am-tag">🍳 Breakfast</span>
              </div>
            </div>
            <div class="hotel-bottom">
              <div class="price-block">
                <div class="orig-price" id="op5">₹18,000</div>
                <div class="price" id="pr5">₹15,000</div>
                <div class="per">per night · incl. all meals</div>
              </div>
              <div class="card-actions">
                <button class="btn-detail" onclick="event.stopPropagation();openDetail(this,'Wildflower Hall, Shimla','★★★★★','Mashobra, Shimla',8.9,'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&h=520&fit=crop')">View Details</button>
                <button class="btn-book" onclick="event.stopPropagation();openCheckout()">Book Now</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Hotel 6 -->
        <div class="hotel-card" onclick="openDetail(this,'ibis Styles Jaipur','★★★','MI Road, Jaipur',7.8,'https://images.unsplash.com/photo-1477587458883-47145ed94245?w=800&h=520&fit=crop')">
          <div class="hotel-img">
            <img src="https://images.unsplash.com/photo-1477587458883-47145ed94245?w=480&h=360&fit=crop" alt="ibis Styles Jaipur">
            <div class="badge badge-green">Budget Pick</div>
            <button class="wishlist-btn" onclick="event.stopPropagation();toggleWishlist(this)">🤍</button>
          </div>
          <div class="hotel-info">
            <div>
              <div class="hotel-top">
                <div><div class="hotel-name">ibis Styles Jaipur</div><span class="hotel-type">3-Star Hotel</span></div>
                <div class="hotel-rating"><div class="rating-score">7.8</div><div class="rating-label">Good</div></div>
              </div>
              <div class="hotel-loc">📍 MI Road, Jaipur · Near Hawa Mahal</div>
              <div class="hotel-amenities">
                <span class="am-tag">📶 WiFi</span><span class="am-tag">🍽️ Restaurant</span><span class="am-tag">🚗 Parking</span>
              </div>
            </div>
            <div class="hotel-bottom">
              <div class="price-block">
                <div class="price" id="pr6">₹2,800</div>
                <div class="per">per night · excl. taxes</div>
              </div>
              <div class="card-actions">
                <button class="btn-detail" onclick="event.stopPropagation();openDetail(this,'ibis Styles Jaipur','★★★','MI Road, Jaipur',7.8,'https://images.unsplash.com/photo-1477587458883-47145ed94245?w=800&h=520&fit=crop')">View Details</button>
                <button class="btn-book" onclick="event.stopPropagation();openCheckout()">Book Now</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- LIVE CHAT -->
<div class="chat-bubble" onclick="toggleChat()">
  <span class="chat-badge" id="chatBadge">1</span>
  <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
</div>
<div class="chat-win" id="chatWin">
  <div class="chat-head">
    <div class="chat-av"><img src="https://i.pravatar.cc/72?img=10" alt="Aria"></div>
    <div class="chat-head-info"><strong>Aria · StayNest AI</strong><small>Your travel assistant</small></div>
    <div class="chat-online"></div>
    <button class="chat-close" onclick="event.stopPropagation();toggleChat()">×</button>
  </div>
  <div class="chat-msgs" id="chatMsgs">
    <div class="chat-msg">👋 Hi! I'm Aria, your StayNest AI assistant. I can help you find perfect hotels, compare prices, check availability, or answer any travel questions!</div>
  </div>
  <div class="chat-quick" id="chatQuick">
    <button class="chat-q" onclick="quickChat('Best hotels in Goa under ₹8,000?')">🏖️ Goa under ₹8k</button>
    <button class="chat-q" onclick="quickChat('Any romantic getaways near Mumbai?')">💑 Romantic stays</button>
    <button class="chat-q" onclick="quickChat('Which hotels offer free cancellation?')">✅ Free cancellation</button>
  </div>
  <div class="chat-input-row">
    <input type="text" placeholder="Ask me anything about hotels..." id="chatInput" onkeydown="if(event.key==='Enter')sendChat()">
    <button class="chat-send" onclick="sendChat()">↑</button>
  </div>
</div>

<script>
  var qty={adults:2,children:0,rooms:1};
  var selectedRoomName='Deluxe King Room';
  var selectedPrice=7500;
  var promoApplied=false;
  var currency='INR';
  var rates={INR:1,USD:0.012,EUR:0.011};
  var symbols={INR:'₹',USD:'$',EUR:'€'};
  var currFlags={INR:'🇮🇳',USD:'🇺🇸',EUR:'🇪🇺'};
  var currentDetail=null;
  var currentDetailImg='https://images.unsplash.com/photo-1566073771259-6a8506099945?w=128&h=128&fit=crop';

  function fmt(n){
    var s=symbols[currency];
    var v=Math.round(n*rates[currency]);
    if(currency==='INR') return s+v.toLocaleString('en-IN');
    return s+v.toLocaleString('en-US',{minimumFractionDigits:currency==='INR'?0:2,maximumFractionDigits:2});
  }

  function changeCurrency(c){
    currency=c;
    document.getElementById('currFlag').textContent=currFlags[c];
    var prices={pr1:7500,pr2:8200,pr3:4930,pr4:15000,pr5:15000,pr6:2800,op1:10000,op3:5800,op4:18000,op5:18000};
    var rv={rv1:12500,rv2:8200,rv3:9800,rv4:15000,rv5:6500};
    Object.entries(prices).forEach(([id,v])=>{var el=document.getElementById(id);if(el)el.textContent=fmt(v)});
    Object.entries(rv).forEach(([id,v])=>{var el=document.getElementById(id);if(el)el.textContent=fmt(v)+'/night'});
    [['rp1',7500],['rp2',12000],['rp3',28000]].forEach(([id,v])=>{var el=document.getElementById(id);if(el)el.textContent=fmt(v)});
    updateSummary();
  }

  function showSuggestions(){document.getElementById('suggestions').style.display='block'}
  function hideSuggestions(){setTimeout(()=>{document.getElementById('suggestions').style.display='none'},180)}
  function selectDest(d){
    document.getElementById('destInput').value=d;
    document.getElementById('suggestions').style.display='none';
    document.getElementById('destLabel').textContent=d.split(',')[0];
  }

  function toggleGuests(){
    var d=document.getElementById('guestDropdown');
    d.style.display=d.style.display==='none'?'block':'none';
  }
  function changeQty(type,delta){
    qty[type]=Math.max(0,qty[type]+delta);
    if(type==='adults')qty.adults=Math.max(1,qty.adults);
    if(type==='rooms')qty.rooms=Math.max(1,qty.rooms);
    document.getElementById(type+'Val').textContent=qty[type];
    document.getElementById('guestBtn').textContent=qty.adults+' Adult'+(qty.adults>1?'s':'')+' · '+qty.rooms+' Room'+(qty.rooms>1?'s':'');
  }

  function doSearch(){
    var dest=document.getElementById('destInput').value||'India';
    document.getElementById('destLabel').textContent=dest.split(',')[0];
    var list=document.getElementById('hotelList');
    list.style.opacity='0.4';list.style.transform='translateY(6px)';
    setTimeout(()=>{list.style.transition='all 0.4s ease';list.style.opacity='1';list.style.transform='translateY(0)'},600);
  }

  function switchHeroTab(el){
    document.querySelectorAll('.hero-tab').forEach(t=>t.classList.remove('active'));
    el.classList.add('active');
  }

  function toggleStar(el){el.classList.toggle('active')}
  function toggleProp(el){el.classList.toggle('active')}
  function resetFilters(){
    document.querySelectorAll('.star-chip,.prop-chip').forEach(e=>e.classList.remove('active'));
    document.querySelectorAll('.amenity-item input').forEach(e=>e.checked=false);
    document.getElementById('priceRange').value=25000;
    document.getElementById('maxPrice').value=25000;
  }
  function filterHotels(){}

  function sortBy(type,btn){
    document.querySelectorAll('.sort-btn').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    var list=document.getElementById('hotelList');
    list.style.opacity='0.6';
    setTimeout(()=>{list.style.opacity='1'},300);
  }

  function openDetail(el,name,stars,loc,score,imgUrl){
    var panel=document.getElementById('detailPanel');
    panel.classList.add('open');
    document.getElementById('detailName').textContent=name;
    document.getElementById('detailStars').textContent=stars;
    document.getElementById('detailLoc').textContent='📍 '+loc;
    document.getElementById('detailScore').textContent=score;
    if(imgUrl){
      document.getElementById('galMain').src=imgUrl;
    }
    currentDetail=name;
    currentDetailImg=imgUrl||'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=128&h=128&fit=crop';
    panel.scrollIntoView({behavior:'smooth',block:'start'});
    // reset tabs
    document.querySelectorAll('.dtab').forEach(t=>t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c=>c.style.display='none');
    document.querySelector('.dtab').classList.add('active');
    document.getElementById('tab-rooms').style.display='block';
  }
  function closeDetail(){document.getElementById('detailPanel').classList.remove('open')}

  function switchTab(el,tab){
    document.querySelectorAll('.dtab').forEach(t=>t.classList.remove('active'));
    el.classList.add('active');
    document.querySelectorAll('.tab-content').forEach(c=>c.style.display='none');
    document.getElementById('tab-'+tab).style.display='block';
  }

  function selectRoom(el,name,price){
    document.querySelectorAll('.room-card').forEach(r=>r.classList.remove('selected'));
    el.classList.add('selected');
    selectedRoomName=name;selectedPrice=price;
    updateSummary();
  }

  function openCheckout(){
    var panel=document.getElementById('checkoutPanel');
    panel.classList.add('open');
    updateSummary();
    panel.scrollIntoView({behavior:'smooth',block:'start'});
  }
  function closeCheckout(){document.getElementById('checkoutPanel').classList.remove('open')}

  function updateSummary(){
    var ci=document.getElementById('checkin').value;
    var co=document.getElementById('checkout').value;
    var nights=Math.max(1,Math.round((new Date(co)-new Date(ci))/(1000*60*60*24)))||3;
    var base=selectedPrice*nights;
    var tax=Math.round(base*0.12);
    var disc=1500;
    var promo=promoApplied?Math.round(base*0.2):0;
    var total=base+tax-disc-promo;
    document.getElementById('sumName').textContent=currentDetail||'The Grand Oberoi';
    document.getElementById('sumRoom').textContent=selectedRoomName;
    if(currentDetailImg)document.getElementById('sumImg').src=currentDetailImg.replace('w=800&h=520','w=128&h=128');
    // dates
    if(ci&&co){
      var d1=new Date(ci),d2=new Date(co);
      var mo=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      document.getElementById('sumDates').textContent=mo[d1.getMonth()]+' '+d1.getDate()+' – '+mo[d2.getMonth()]+' '+d2.getDate()+', '+d2.getFullYear()+' · '+nights+' night'+(nights>1?'s':'');
    }
    document.getElementById('pbRoomLabel').textContent=fmt(selectedPrice)+' × '+nights+' night'+(nights>1?'s':'');
    document.getElementById('pbRoomAmt').textContent=fmt(base);
    document.getElementById('pbTax').textContent=fmt(tax);
    if(promoApplied){document.getElementById('promoRow').style.display='flex';document.getElementById('promoAmt').textContent='−'+fmt(promo)}
    else{document.getElementById('promoRow').style.display='none'}
    document.getElementById('pbTotal').textContent=fmt(total);
    document.getElementById('confirmAmt').textContent=fmt(total);
  }

  function updateDates(){updateSummary()}

  function applyPromo(){
    var code=document.getElementById('promoInput').value.trim().toUpperCase();
    var msg=document.getElementById('promoMsg');
    if(code==='STAYNEST20'){
      promoApplied=true;
      msg.style.color='#27ae60';
      msg.textContent='✅ 20% discount applied!';
      msg.style.display='block';
      updateSummary();
    } else {
      msg.style.color='#e74c3c';
      msg.textContent='❌ Invalid promo code';
      msg.style.display='block';
    }
  }

  function selectPay(el,type){
    document.querySelectorAll('.pay-opt').forEach(o=>o.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('cardFields').style.display=type==='card'?'block':'none';
    document.getElementById('upiFields').style.display=type==='upi'?'block':'none';
    document.getElementById('walletFields').style.display=type==='wallet'?'block':'none';
  }
  function selectWallet(el){
    document.querySelectorAll('#walletFields .pay-opt').forEach(o=>o.classList.remove('active'));
    el.classList.add('active');
  }

  function fmtCard(inp){
    var v=inp.value.replace(/\D/g,'').substring(0,16);
    inp.value=v.replace(/(.{4})/g,'$1 ').trim();
  }
  function fmtExpiry(inp){
    var v=inp.value.replace(/\D/g,'');
    if(v.length>=3)v=v.substring(0,2)+'/'+v.substring(2,4);
    inp.value=v;
  }

  function confirmBooking(){
    var fname=document.getElementById('fname').value.trim();
    var femail=document.getElementById('femail').value.trim();
    if(!fname||!femail){
      alert('Please fill in your name and email to continue.');
      return;
    }
    var btn=document.querySelector('.btn-confirm');
    btn.textContent='⏳ Processing...';btn.disabled=true;
    setTimeout(()=>{
      btn.textContent='✅ Booking Confirmed!';
      btn.style.background='#27ae60';
      // Show confirmation in chat
      setTimeout(()=>{
        openChat();
        addChatMsg('🎉 Your booking at '+document.getElementById('sumName').textContent+' is confirmed! Booking ID: SN'+Math.floor(Math.random()*900000+100000)+'. Check your email for details.',false);
      },500);
      setTimeout(()=>{
        btn.textContent='Confirm & Pay '+document.getElementById('confirmAmt').textContent;
        btn.disabled=false;btn.style.background='';
      },4000);
    },2000);
  }

  function toggleWishlist(btn){
    btn.textContent=btn.textContent==='🤍'?'❤️':'🤍';
    if(btn.textContent==='❤️'){
      btn.style.background='#ffebeb';
      btn.style.transform='scale(1.3)';
      setTimeout(()=>btn.style.transform='',300);
    } else {
      btn.style.background='rgba(255,255,255,0.95)';
    }
  }

  // CHAT
  var chatOpen=false;
  var aiReplies=[
    "Great choice! I'd recommend checking out the Taj Holiday Village in Goa for a perfect beach getaway. It has an amazing pool and direct beach access.",
    "Based on your preferences, the Udaivilas Palace in Udaipur is receiving rave reviews this season — stunning lakefront views and Rajasthani heritage architecture.",
    "For business travel, ITC Maurya in Delhi offers excellent executive rooms with fast WiFi, business center, and is close to Diplomatic Enclave.",
    "The best deals right now are in Jaipur! The ibis Styles Jaipur is a budget gem near Hawa Mahal with great reviews.",
    "I can help with that! Most properties on StayNest offer free cancellation up to 24 hours before check-in. Look for the green 'Free cancellation' badge.",
    "Happy to help! For a romantic getaway, I'd suggest the Wildflower Hall in Shimla — it's nestled in cedar forests with mountain views. Perfect for couples! 🌲"
  ];
  var replyIdx=0;

  function openChat(){
    var win=document.getElementById('chatWin');
    win.classList.add('open');
    chatOpen=true;
    document.getElementById('chatBadge').style.display='none';
  }

  function toggleChat(){
    var win=document.getElementById('chatWin');
    chatOpen=!chatOpen;
    if(chatOpen){win.classList.add('open');document.getElementById('chatBadge').style.display='none';}
    else{win.classList.remove('open');}
  }

  function addChatMsg(text,isUser){
    var msgs=document.getElementById('chatMsgs');
    var div=document.createElement('div');
    div.className='chat-msg'+(isUser?' user-msg':'');
    div.textContent=text;
    msgs.appendChild(div);
    msgs.scrollTop=msgs.scrollHeight;
  }

  function showTyping(){
    var msgs=document.getElementById('chatMsgs');
    var t=document.createElement('div');
    t.className='chat-typing';t.id='chatTyping';
    t.innerHTML='<span></span><span></span><span></span>';
    msgs.appendChild(t);
    msgs.scrollTop=msgs.scrollHeight;
  }
  function hideTyping(){
    var t=document.getElementById('chatTyping');
    if(t)t.remove();
  }

  function sendChat(){
    var inp=document.getElementById('chatInput');
    var msg=inp.value.trim();
    if(!msg)return;
    addChatMsg(msg,true);
    inp.value='';
    document.getElementById('chatQuick').style.display='none';
    showTyping();
    var delay=900+Math.random()*600;
    setTimeout(()=>{
      hideTyping();
      var reply=aiReplies[replyIdx%aiReplies.length];
      replyIdx++;
      addChatMsg(reply,false);
    },delay);
  }

  function quickChat(msg){
    openChat();
    document.getElementById('chatInput').value=msg;
    sendChat();
  }

  function triggerChatPrompt(msg){
    openChat();
    document.getElementById('chatInput').value=msg;
    sendChat();
  }

  function showNavAlert(section){
    if(section==='My Trips'){
      openChat();
      addChatMsg('You asked about My Trips — I can help you view past bookings or plan new ones. What would you like to do?',false);
    } else {
      addChatMsg&&null;
      // just visual feedback
      document.getElementById('destInput').focus();
      document.getElementById('destInput').placeholder='Search '+section+'...';
    }
  }

  document.addEventListener('click',function(e){
    if(!e.target.closest('.guest-selector'))document.getElementById('guestDropdown').style.display='none';
  });

  // Init
  updateSummary();
</script>
</body>
</html>
