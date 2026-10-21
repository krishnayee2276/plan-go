<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Plan&Go — Premium Car Rentals</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --gold: #FAE013;
    --gold-light: #FFF075;
    --gold-dark: #C4AD00;
    --dark: #0E0B2A;
    --dark2: #1c1450;
    --dark3: #251A6A;
    --dark4: #2E2280;
    --mid: #4A3FA8;
    --muted: #8B82C4;
    --light: #F0EEFF;
    --white: #FFFFFF;
    --accent: #FAE013;
    --green: #2ECC71;
    --radius: 12px;
    --radius-lg: 20px;
    --shadow: 0 8px 40px rgba(10,8,40,0.6);
    --shadow-sm: 0 4px 20px rgba(10,8,40,0.4);
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--dark);
    color: var(--light);
    overflow-x: hidden;
    line-height: 1.6;
  }

  /* SCROLLBAR */
  ::-webkit-scrollbar { width: 6px; }
  ::-webkit-scrollbar-track { background: var(--dark2); }
  ::-webkit-scrollbar-thumb { background: var(--gold-dark); border-radius: 3px; }

  /* ── HEADER ── */
  header {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    padding: 0 5%;
    background: linear-gradient(180deg, rgba(14,11,42,0.98) 0%, rgba(14,11,42,0.88) 100%);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(250,224,19,0.15);
    height: 72px;
    display: flex; align-items: center; justify-content: space-between;
    transition: all 0.3s ease;
  }

  .logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    font-weight: 300;
    letter-spacing: 2px;
    color: var(--white);
    text-decoration: none;
  }
  .logo span { color: var(--gold); font-weight: 600; }

  nav { display: flex; align-items: center; gap: 32px; }
  nav a {
    font-size: 13px; font-weight: 500; letter-spacing: 1px;
    text-transform: uppercase; color: rgba(240,238,255,0.65);
    text-decoration: none; transition: color 0.3s;
  }
  nav a:hover { color: var(--gold); }

  .nav-cta {
    background: var(--gold); color: var(--dark) !important;
    padding: 10px 24px; border-radius: 50px;
    font-weight: 600 !important;
    transition: all 0.3s !important;
  }
  .nav-cta:hover { background: var(--gold-light) !important; transform: translateY(-1px); }

  .hamburger {
    display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 4px;
  }
  .hamburger span {
    display: block; width: 24px; height: 2px;
    background: var(--gold); border-radius: 2px;
    transition: all 0.3s;
  }

  /* ── HERO ── */
  .hero {
    position: relative; min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
    background: var(--dark);
  }

  .hero-bg {
    position: absolute; inset: 0;
    background-image: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1800&q=80');
    background-size: cover; background-position: center 60%;
    transform: scale(1.05);
    transition: transform 8s ease;
  }
  .hero-bg::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(
      135deg,
      rgba(14,11,42,0.93) 0%,
      rgba(28,20,80,0.68) 50%,
      rgba(14,11,42,0.88) 100%
    );
  }

  .hero-content {
    position: relative; z-index: 2;
    text-align: center; padding: 100px 5% 60px;
    max-width: 900px;
    animation: heroFade 1s ease forwards;
  }

  @keyframes heroFade {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .hero-tag {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(250,224,19,0.1); border: 1px solid rgba(250,224,19,0.3);
    color: var(--gold-light); font-size: 12px; font-weight: 500;
    letter-spacing: 2px; text-transform: uppercase;
    padding: 8px 20px; border-radius: 50px;
    margin-bottom: 28px;
  }
  .hero-tag::before { content: '◆'; font-size: 8px; }

  .hero h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(40px, 7vw, 86px);
    font-weight: 300; line-height: 1.05;
    margin-bottom: 20px; color: var(--white);
  }
  .hero h1 em { font-style: italic; color: var(--gold); }

  .hero p {
    font-size: 17px; color: rgba(245,244,240,0.7);
    max-width: 540px; margin: 0 auto 48px;
    font-weight: 300; line-height: 1.8;
  }

  /* ── BOOKING FORM ── */
  .booking-wrapper {
    position: relative; z-index: 2;
    width: 100%; max-width: 1100px;
    margin: 0 auto; padding: 0 5%;
  }

  .booking-card {
    background: rgba(28,20,80,0.96);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(250,224,19,0.2);
    border-radius: var(--radius-lg);
    padding: 36px 40px;
    box-shadow: var(--shadow);
  }

  .booking-title {
    font-size: 13px; font-weight: 600; letter-spacing: 2px;
    text-transform: uppercase; color: var(--gold);
    margin-bottom: 24px;
    display: flex; align-items: center; gap: 10px;
  }
  .booking-title::after {
    content: ''; flex: 1; height: 1px;
    background: rgba(250,224,19,0.2);
  }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    gap: 16px;
    align-items: end;
  }

  .form-group { display: flex; flex-direction: column; gap: 8px; }
  .form-group label {
    font-size: 11px; font-weight: 600; letter-spacing: 1.5px;
    text-transform: uppercase; color: var(--muted);
  }

  .form-group input, .form-group select {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 14px 16px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px; color: var(--light);
    transition: all 0.25s; width: 100%;
    -webkit-appearance: none; appearance: none;
  }
  .form-group input:focus, .form-group select:focus {
    outline: none; border-color: var(--gold);
    background: rgba(250,224,19,0.06);
    box-shadow: 0 0 0 3px rgba(250,224,19,0.12);
  }
  .form-group select option { background: var(--dark3); color: var(--light); }

  .select-wrap { position: relative; }
  .select-wrap::after {
    content: '▾'; position: absolute; right: 14px; top: 50%;
    transform: translateY(-50%); color: var(--gold);
    font-size: 12px; pointer-events: none;
  }

  .search-btn {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
    color: var(--dark); border: none; border-radius: 10px;
    padding: 14px 28px; font-family: 'DM Sans', sans-serif;
    font-size: 14px; font-weight: 700; letter-spacing: 0.5px;
    cursor: pointer; transition: all 0.3s;
    width: 100%;
  }
  .search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250,224,19,0.35);
  }
  .search-btn:active { transform: translateY(0); }

  /* ── SECTION STYLES ── */
  section { padding: 100px 5%; }

  .section-tag {
    display: inline-block; font-size: 11px; font-weight: 600;
    letter-spacing: 3px; text-transform: uppercase;
    color: var(--gold); margin-bottom: 12px;
  }

  .section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(32px, 4vw, 52px);
    font-weight: 300; color: var(--white); line-height: 1.2;
    margin-bottom: 16px;
  }

  .section-sub {
    font-size: 15px; color: var(--muted); font-weight: 300;
    max-width: 500px;
  }

  /* ── CAR LISTINGS ── */
  .listings-section { background: var(--dark); padding-top: 80px; }

  .listings-header {
    display: flex; align-items: flex-end;
    justify-content: space-between; margin-bottom: 48px; gap: 20px;
    flex-wrap: wrap;
  }

  /* FILTERS */
  .filters-bar {
    display: flex; gap: 12px; flex-wrap: wrap;
    margin-bottom: 40px; align-items: center;
  }

  .filter-label {
    font-size: 12px; font-weight: 600; letter-spacing: 1px;
    text-transform: uppercase; color: var(--muted);
    margin-right: 4px;
  }

  .filter-group { display: flex; gap: 8px; flex-wrap: wrap; }

  .filter-btn {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    color: var(--muted); font-family: 'DM Sans', sans-serif;
    font-size: 13px; font-weight: 500;
    padding: 8px 18px; border-radius: 50px;
    cursor: pointer; transition: all 0.25s;
  }
  .filter-btn:hover {
    border-color: rgba(250,224,19,0.4);
    color: var(--gold-light);
  }
  .filter-btn.active {
    background: rgba(250,224,19,0.12);
    border-color: var(--gold);
    color: var(--gold-light);
  }

  .price-filter {
    display: flex; align-items: center; gap: 12px;
  }
  .price-filter input[type="range"] {
    width: 120px; accent-color: var(--gold); cursor: pointer;
  }
  .price-val {
    font-size: 13px; font-weight: 600; color: var(--gold);
    min-width: 70px;
  }

  /* CAR GRID */
  .cars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
  }

  .car-card {
    background: var(--dark2);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
  }
  .car-card:hover {
    transform: translateY(-6px);
    border-color: rgba(250,224,19,0.3);
    box-shadow: 0 20px 60px rgba(10,8,40,0.5), 0 0 0 1px rgba(250,224,19,0.1);
  }

  .car-img-wrap {
    position: relative; height: 200px; overflow: hidden;
    background: var(--dark3);
  }
  .car-img-wrap img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
  }
  .car-card:hover .car-img-wrap img { transform: scale(1.06); }

  .car-badge {
    position: absolute; top: 14px; left: 14px;
    background: rgba(14,11,42,0.85); backdrop-filter: blur(10px);
    border: 1px solid rgba(250,224,19,0.3);
    color: var(--gold-light); font-size: 11px; font-weight: 600;
    letter-spacing: 1px; text-transform: uppercase;
    padding: 5px 12px; border-radius: 50px;
  }

  .car-rating {
    position: absolute; top: 14px; right: 14px;
    background: rgba(14,11,42,0.85); backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 5px 10px; border-radius: 50px;
    font-size: 12px; font-weight: 600;
    display: flex; align-items: center; gap: 4px;
    color: var(--white);
  }
  .star { color: var(--gold); font-size: 11px; }

  .car-body { padding: 20px 22px 22px; }

  .car-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px; font-weight: 500; color: var(--white);
    margin-bottom: 4px;
  }

  .car-type-label {
    font-size: 12px; color: var(--muted); font-weight: 400;
    margin-bottom: 16px;
  }

  .car-specs {
    display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 18px;
  }

  .spec-pill {
    display: flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 6px; padding: 5px 10px;
    font-size: 12px; color: rgba(245,244,240,0.7);
  }
  .spec-pill .icon { font-size: 13px; }

  .car-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 16px;
    border-top: 1px solid rgba(255,255,255,0.07);
  }

  .car-price .amount {
    font-family: 'Cormorant Garamond', serif;
    font-size: 32px; font-weight: 500; color: var(--gold);
    line-height: 1;
  }
  .car-price .per {
    font-size: 12px; color: var(--muted); font-weight: 400;
    margin-top: 2px;
  }

  .book-btn {
    background: transparent;
    border: 1px solid rgba(250,224,19,0.4);
    color: var(--gold-light); font-family: 'DM Sans', sans-serif;
    font-size: 13px; font-weight: 600; letter-spacing: 0.5px;
    padding: 11px 24px; border-radius: 50px;
    cursor: pointer; transition: all 0.3s;
  }
  .book-btn:hover {
    background: var(--gold); color: var(--dark);
    border-color: var(--gold);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(250,224,19,0.3);
  }

  .hidden-card { display: none !important; }

  /* ── WHY CHOOSE US ── */
  .why-section { background: var(--dark2); }

  .features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 28px; margin-top: 56px;
  }

  .feature-card {
    background: var(--dark3);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: var(--radius);
    padding: 32px 28px;
    transition: all 0.3s;
    position: relative; overflow: hidden;
  }
  .feature-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
    opacity: 0; transition: opacity 0.3s;
  }
  .feature-card:hover { transform: translateY(-4px); border-color: rgba(250,224,19,0.2); }
  .feature-card:hover::before { opacity: 1; }

  .feature-icon {
    width: 52px; height: 52px;
    background: rgba(250,224,19,0.1); border: 1px solid rgba(250,224,19,0.2);
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    font-size: 24px; margin-bottom: 20px;
  }
  .feature-card h3 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px; font-weight: 500; color: var(--white); margin-bottom: 10px;
  }
  .feature-card p { font-size: 14px; color: var(--muted); line-height: 1.7; }

  /* ── REVIEWS ── */
  .reviews-section { background: var(--dark); }

  .reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px; margin-top: 52px;
  }

  .review-card {
    background: var(--dark2);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: var(--radius);
    padding: 28px; transition: all 0.3s;
    position: relative;
  }
  .review-card::before {
    content: '"'; position: absolute; top: 16px; right: 22px;
    font-family: 'Cormorant Garamond', serif;
    font-size: 80px; color: rgba(250,224,19,0.08);
    line-height: 1;
  }
  .review-card:hover { border-color: rgba(250,224,19,0.2); transform: translateY(-3px); }

  .review-stars { display: flex; gap: 3px; margin-bottom: 16px; }
  .review-stars span { color: var(--gold); font-size: 14px; }

  .review-text {
    font-size: 14px; color: rgba(240,238,255,0.75);
    line-height: 1.8; margin-bottom: 22px; font-style: italic;
  }

  .reviewer {
    display: flex; align-items: center; gap: 12px;
  }
  .reviewer-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    overflow: hidden; flex-shrink: 0;
    border: 2px solid rgba(250,224,19,0.3);
  }
  .reviewer-avatar img { width: 100%; height: 100%; object-fit: cover; }

  .reviewer-name { font-size: 14px; font-weight: 600; color: var(--white); }
  .reviewer-meta { font-size: 12px; color: var(--muted); }

  /* ── FAQ ── */
  .faq-section { background: var(--dark2); }
  .faq-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
    margin-top: 52px;
  }

  .faq-item {
    background: var(--dark3);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: var(--radius); overflow: hidden;
    transition: border-color 0.3s;
  }
  .faq-item.open { border-color: rgba(250,224,19,0.25); }

  .faq-q {
    display: flex; justify-content: space-between; align-items: center;
    padding: 20px 24px; cursor: pointer; gap: 16px;
    font-size: 15px; font-weight: 500; color: var(--light);
    transition: color 0.3s;
  }
  .faq-q:hover { color: var(--gold-light); }

  .faq-toggle {
    width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
    background: rgba(250,224,19,0.1); border: 1px solid rgba(250,224,19,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: var(--gold);
    transition: all 0.3s;
  }
  .faq-item.open .faq-toggle { background: var(--gold); color: var(--dark); transform: rotate(45deg); }

  .faq-a {
    padding: 0 24px; max-height: 0; overflow: hidden;
    transition: all 0.35s ease;
    font-size: 14px; color: var(--muted); line-height: 1.8;
  }
  .faq-item.open .faq-a { max-height: 200px; padding-bottom: 20px; }

  /* ── FOOTER ── */
  footer {
    background: var(--dark2);
    padding: 70px 6% 0;
  }

  .footer-main {
    display: grid;
    grid-template-columns: 1.2fr 1.2fr 1.4fr;
    gap: 60px;
    padding-bottom: 60px;
  }

  .footer-col-title {
    font-size: 20px; font-weight: 700;
    color: var(--white); margin-bottom: 18px;
    padding-bottom: 14px;
    border-bottom: 2px solid rgba(255,255,255,0.15);
    letter-spacing: 0.3px;
  }

  .footer-links { list-style: none; }
  .footer-links li { margin-bottom: 12px; }
  .footer-links a {
    font-size: 14px; color: rgba(240,238,255,0.75);
    text-decoration: none; transition: color 0.25s;
    display: inline-block;
  }
  .footer-links a:hover { color: var(--gold); }

  /* Newsletter */
  .newsletter-text {
    font-size: 14px; font-weight: 600;
    color: rgba(240,238,255,0.85); margin-bottom: 16px; line-height: 1.6;
  }
  .newsletter-form { display: flex; flex-direction: column; gap: 10px; }
  .newsletter-input {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 6px; padding: 13px 16px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px; color: var(--light);
    transition: border-color 0.25s;
    outline: none;
  }
  .newsletter-input::placeholder { color: rgba(200,195,240,0.45); }
  .newsletter-input:focus { border-color: rgba(250,224,19,0.5); }
  .newsletter-btn {
    background: var(--gold); color: var(--dark);
    border: none; border-radius: 6px;
    padding: 13px; font-family: 'DM Sans', sans-serif;
    font-size: 13px; font-weight: 800; letter-spacing: 2px;
    text-transform: uppercase; cursor: pointer;
    transition: all 0.3s;
  }
  .newsletter-btn:hover { background: var(--gold-light); transform: translateY(-1px); }

  /* Contact */
  .contact-item {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 14px;
    font-size: 14px; color: rgba(240,238,255,0.8);
  }
  .contact-icon {
    width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
    background: var(--gold); display: flex; align-items: center;
    justify-content: center; font-size: 15px;
  }

  /* Social Icons */
  .footer-socials { display: flex; gap: 10px; margin-top: 24px; }
  .footer-social-btn {
    width: 42px; height: 42px; border-radius: 50%;
    background: rgba(255,255,255,0.1);
    border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: var(--white); transition: all 0.3s;
    text-decoration: none;
  }
  .footer-social-btn:hover { background: var(--gold); color: var(--dark); transform: translateY(-2px); }

  /* Footer Bottom Bar */
  .footer-bottom {
    background: var(--gold);
    margin: 0 -6%;
    padding: 16px 6%;
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 8px;
  }
  .footer-bottom span {
    font-size: 13px; font-weight: 600; color: var(--dark);
  }

  /* ── MODAL ── */
  .modal-overlay {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.88); backdrop-filter: blur(10px);
    display: none; align-items: center; justify-content: center;
    padding: 16px; overflow-y: auto;
  }
  .modal-overlay.open { display: flex; }

  .modal {
    background: var(--dark2); border: 1px solid rgba(250,224,19,0.2);
    border-radius: 20px; width: 100%; max-width: 580px;
    animation: modalIn 0.35s cubic-bezier(0.4,0,0.2,1);
    overflow: hidden; position: relative; margin: auto;
  }
  @keyframes modalIn {
    from { opacity: 0; transform: scale(0.93) translateY(24px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
  }

  /* Step progress bar */
  .modal-progress {
    display: flex; background: var(--dark3); padding: 0;
  }
  .modal-step-tab {
    flex: 1; padding: 14px 8px; text-align: center;
    font-size: 12px; font-weight: 600; letter-spacing: 1px;
    text-transform: uppercase; color: var(--muted);
    border-bottom: 3px solid transparent; transition: all 0.3s;
  }
  .modal-step-tab.active { color: var(--gold); border-bottom-color: var(--gold); }
  .modal-step-tab.done   { color: var(--gold-dark); }

  .modal-body { padding: 32px 36px 36px; }

  /* Car summary bar */
  .modal-car-bar {
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(250,224,19,0.07); border: 1px solid rgba(250,224,19,0.18);
    border-radius: 12px; padding: 14px 18px; margin-bottom: 28px; gap: 12px;
    flex-wrap: wrap;
  }
  .modal-car-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px; font-weight: 500; color: var(--white);
  }
  .modal-car-price {
    font-size: 18px; font-weight: 700; color: var(--gold);
    font-family: 'Cormorant Garamond', serif;
  }

  .modal-section-title {
    font-size: 16px; font-weight: 700; color: var(--white);
    margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
  }
  .modal-section-title span {
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--gold); color: var(--dark);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; flex-shrink: 0;
  }

  /* Form fields inside modal */
  .mform-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
  .mform-grid.single { grid-template-columns: 1fr; }
  .mform-group { display: flex; flex-direction: column; gap: 7px; }
  .mform-group label {
    font-size: 11px; font-weight: 600; letter-spacing: 1.2px;
    text-transform: uppercase; color: var(--muted);
  }
  .mform-group input, .mform-group select {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 10px; padding: 13px 14px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px; color: var(--light);
    transition: all 0.25s; -webkit-appearance: none; appearance: none;
    outline: none;
  }
  .mform-group input:focus, .mform-group select:focus {
    border-color: var(--gold); background: rgba(250,224,19,0.05);
    box-shadow: 0 0 0 3px rgba(250,224,19,0.1);
  }
  .mform-group input::placeholder { color: rgba(200,195,240,0.35); }
  .mform-group select option { background: var(--dark3); }

  /* Card icons row */
  .card-icons { display: flex; gap: 8px; margin-top: 6px; flex-wrap: wrap; }
  .card-icon {
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);
    border-radius: 6px; padding: 4px 10px;
    font-size: 12px; font-weight: 600; color: var(--muted);
  }

  /* Order summary */
  .order-summary {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px; padding: 20px; margin-bottom: 24px;
  }
  .order-row {
    display: flex; justify-content: space-between;
    font-size: 14px; color: rgba(240,238,255,0.75);
    padding: 6px 0; border-bottom: 1px solid rgba(255,255,255,0.06);
  }
  .order-row:last-child { border-bottom: none; }
  .order-row.total {
    font-size: 16px; font-weight: 700; color: var(--white);
    margin-top: 8px; padding-top: 14px;
    border-top: 1px solid rgba(250,224,19,0.25);
    border-bottom: none;
  }
  .order-row.total span:last-child { color: var(--gold); }

  /* Modal navigation buttons */
  .modal-nav {
    display: flex; gap: 12px; justify-content: flex-end; margin-top: 28px;
  }
  .btn-back {
    background: transparent; border: 1px solid rgba(255,255,255,0.15);
    color: var(--muted); border-radius: 50px;
    padding: 13px 28px; font-family: 'DM Sans', sans-serif;
    font-size: 14px; cursor: pointer; transition: all 0.3s;
  }
  .btn-back:hover { border-color: rgba(255,255,255,0.3); color: var(--light); }
  .btn-next {
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    color: var(--dark); border: none; border-radius: 50px;
    padding: 13px 36px; font-family: 'DM Sans', sans-serif;
    font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.3s;
    display: flex; align-items: center; gap: 8px;
  }
  .btn-next:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(250,224,19,0.3); }
  .btn-next:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

  .modal-close-btn {
    position: absolute; top: 16px; right: 18px;
    background: rgba(255,255,255,0.07); border: none;
    color: var(--muted); font-size: 18px; cursor: pointer;
    width: 34px; height: 34px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; z-index: 10;
  }
  .modal-close-btn:hover { background: rgba(255,255,255,0.14); color: var(--light); }

  /* Success screen */
  .success-screen { text-align: center; padding: 20px 0 8px; }
  .success-icon { font-size: 60px; margin-bottom: 16px; }
  .success-screen h2 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 32px; font-weight: 400; color: var(--white); margin-bottom: 10px;
  }
  .success-screen p { font-size: 15px; color: var(--muted); line-height: 1.7; margin-bottom: 28px; }
  .booking-ref {
    background: rgba(250,224,19,0.08); border: 1px solid rgba(250,224,19,0.2);
    border-radius: 10px; padding: 14px 20px; margin-bottom: 24px;
    font-size: 13px; color: var(--muted);
  }
  .booking-ref strong { color: var(--gold); font-size: 20px; display: block; margin-top: 4px; letter-spacing: 3px; }

  /* ── TOAST ── */
  .toast {
    position: fixed; bottom: 30px; right: 30px; z-index: 10000;
    background: var(--dark2); border: 1px solid rgba(250,224,19,0.3);
    border-left: 4px solid var(--gold);
    border-radius: 12px; padding: 16px 22px;
    font-size: 14px; color: var(--light);
    display: flex; align-items: center; gap: 12px;
    transform: translateX(120%); transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    max-width: 320px; box-shadow: var(--shadow);
  }
  .toast.show { transform: translateX(0); }
  .toast-icon { font-size: 20px; }
  .toast-title { font-weight: 600; color: var(--white); font-size: 14px; }
  .toast-msg { font-size: 12px; color: var(--muted); margin-top: 2px; }

  /* ── RESPONSIVE ── */
  @media (max-width: 900px) {
    .form-grid { grid-template-columns: 1fr 1fr; }
    .footer-main { grid-template-columns: 1fr 1fr; gap: 40px; }
    .faq-grid { grid-template-columns: 1fr; }
    nav { display: none; }
    .hamburger { display: flex; }
    .mform-grid { grid-template-columns: 1fr; }
  }

  @media (max-width: 600px) {
    .form-grid { grid-template-columns: 1fr; }
    .footer-main { grid-template-columns: 1fr; gap: 32px; }
    .booking-card { padding: 24px 20px; }
    section { padding: 70px 5%; }
    .hero-content { padding: 120px 5% 40px; }
    .modal-body { padding: 22px 20px 28px; }
    .footer-bottom { flex-direction: column; text-align: center; }
    .mform-grid { grid-template-columns: 1fr; }
  }

  /* mobile nav */
  .mobile-nav {
    position: fixed; inset: 0; z-index: 999;
    background: rgba(13,13,15,0.98); backdrop-filter: blur(20px);
    display: none; flex-direction: column; align-items: center; justify-content: center; gap: 32px;
  }
  .mobile-nav.open { display: flex; }
  .mobile-nav a {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px; font-weight: 300; color: var(--light);
    text-decoration: none; transition: color 0.3s;
    letter-spacing: 2px;
  }
  .mobile-nav a:hover { color: var(--gold); }
  .mobile-nav-close {
    position: absolute; top: 24px; right: 5%;
    background: none; border: none; color: var(--light);
    font-size: 28px; cursor: pointer;
  }

  /* ── PAYMENT OPTION CARDS ── */
  .pay-options { display: flex; flex-direction: column; gap: 12px; }
  .pay-card {
    display: flex; align-items: center; gap: 16px;
    background: rgba(255,255,255,0.04);
    border: 2px solid rgba(255,255,255,0.1);
    border-radius: 14px; padding: 18px 20px;
    cursor: pointer; transition: all 0.25s;
  }
  .pay-card:hover { border-color: rgba(250,224,19,0.4); background: rgba(250,224,19,0.04); }
  .pay-card.selected { border-color: var(--gold); background: rgba(250,224,19,0.08); }
  .pay-card-icon { font-size: 28px; flex-shrink: 0; }
  .pay-card-info { flex: 1; }
  .pay-card-title { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 3px; }
  .pay-card-sub { font-size: 12px; color: var(--muted); }
  .pay-card-check {
    width: 26px; height: 26px; border-radius: 50%;
    background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.15);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; color: transparent; font-weight: 700; transition: all 0.25s; flex-shrink: 0;
  }
  .pay-card.selected .pay-card-check { background: var(--gold); border-color: var(--gold); color: var(--dark); }
  .pay-info-box { background: rgba(250,224,19,0.06); border: 1px solid rgba(250,224,19,0.18); border-radius: 12px; padding: 18px 20px; }
  .pay-info-row { font-size: 13px; color: rgba(240,238,255,0.8); padding: 7px 0; border-bottom: 1px solid rgba(255,255,255,0.06); line-height: 1.6; }
  .pay-info-row:last-child { border-bottom: none; padding-bottom: 0; }
  .online-sub-label { font-size: 12px; font-weight: 600; letter-spacing: 1.2px; text-transform: uppercase; color: var(--muted); margin-bottom: 12px; }
  .online-options { display: flex; gap: 10px; flex-wrap: wrap; }
  .online-opt {
    display: flex; flex-direction: column; align-items: center; gap: 4px;
    background: rgba(255,255,255,0.04); border: 1.5px solid rgba(255,255,255,0.1);
    border-radius: 12px; padding: 14px 18px; cursor: pointer; transition: all 0.25s; flex: 1; min-width: 90px; text-align: center;
  }
  .online-opt:hover { border-color: rgba(250,224,19,0.4); }
  .online-opt.selected { border-color: var(--gold); background: rgba(250,224,19,0.08); }
  .online-opt-icon { font-size: 22px; }
  .online-opt-name { font-size: 13px; font-weight: 700; color: var(--white); }
  .online-opt-sub { font-size: 11px; color: var(--muted); }
  .upi-app-badge {
    display: flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.12);
    border-radius: 8px; padding: 8px 14px; font-size: 13px; font-weight: 600;
    color: var(--light); cursor: pointer; transition: all 0.2s;
  }
  .upi-app-badge span { font-weight: 800; font-size: 15px; }
  .upi-app-badge:hover { border-color: rgba(250,224,19,0.4); color: var(--gold-light); }
  .upi-app-badge.selected { border-color: var(--gold); background: rgba(250,224,19,0.1); color: var(--gold-light); }


  .reveal {
    opacity: 0; transform: translateY(24px);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .reveal.visible { opacity: 1; transform: translateY(0); }
  .reveal-delay-1 { transition-delay: 0.1s; }
  .reveal-delay-2 { transition-delay: 0.2s; }
  .reveal-delay-3 { transition-delay: 0.3s; }

  /* ── LOCATION & PICKUP HUB ── */
  .location-section { background: var(--dark); padding: 100px 5%; }
  .loc-search-wrap { display: flex; gap: 12px; max-width: 580px; margin: 36px 0 48px; }
  .loc-search-input {
    flex: 1; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12);
    border-radius: 50px; padding: 15px 24px; font-family: 'DM Sans', sans-serif;
    font-size: 15px; color: var(--light); outline: none; transition: all 0.25s;
  }
  .loc-search-input::placeholder { color: rgba(200,195,240,0.4); }
  .loc-search-input:focus { border-color: var(--gold); background: rgba(250,224,19,0.04); box-shadow: 0 0 0 3px rgba(250,224,19,0.1); }
  .loc-search-btn {
    background: var(--gold); color: var(--dark); border: none; border-radius: 50px;
    padding: 15px 28px; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 700;
    cursor: pointer; transition: all 0.3s; white-space: nowrap;
  }
  .loc-search-btn:hover { background: var(--gold-light); transform: translateY(-1px); }
  .loc-stats {
    display: flex; margin-bottom: 52px; border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px; overflow: hidden; background: var(--dark2);
  }
  .loc-stat { flex: 1; padding: 22px 16px; text-align: center; border-right: 1px solid rgba(255,255,255,0.08); transition: background 0.3s; }
  .loc-stat:last-child { border-right: none; }
  .loc-stat:hover { background: rgba(250,224,19,0.05); }
  .loc-stat-num { font-family: 'Cormorant Garamond', serif; font-size: 30px; font-weight: 600; color: var(--gold); }
  .loc-stat-label { font-size: 11px; color: var(--muted); font-weight: 500; margin-top: 4px; letter-spacing: 0.3px; }
  .loc-tabs { display: flex; gap: 8px; margin-bottom: 36px; flex-wrap: wrap; }
  .loc-tab {
    display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.04);
    border: 1.5px solid rgba(255,255,255,0.1); color: var(--muted);
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600;
    padding: 10px 20px; border-radius: 50px; cursor: pointer; transition: all 0.25s;
  }
  .loc-tab:hover { border-color: rgba(250,224,19,0.4); color: var(--gold-light); }
  .loc-tab.active { background: rgba(250,224,19,0.12); border-color: var(--gold); color: var(--gold-light); }
  .loc-tab .tc { background: rgba(250,224,19,0.2); color: var(--gold); font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 50px; }
  .loc-map-wrap { border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); margin-bottom: 52px; box-shadow: 0 20px 60px rgba(10,8,40,0.5); }
  #plangoMap { width: 100%; height: 460px; }
  .leaflet-popup-content-wrapper { background: #1c1450 !important; border: 1px solid rgba(250,224,19,0.3) !important; border-radius: 12px !important; box-shadow: 0 8px 32px rgba(10,8,40,0.6) !important; color: #F0EEFF !important; }
  .leaflet-popup-tip { background: #1c1450 !important; }
  .leaflet-popup-content { margin: 14px 18px !important; font-family: 'DM Sans', sans-serif; }
  .map-popup-city { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 5px; }
  .map-popup-info { font-size: 12px; color: #8B82C4; margin-bottom: 2px; }
  .map-popup-btn { display:inline-block; margin-top:10px; background: #FAE013; color: #0E0B2A; font-size:12px; font-weight:700; padding:6px 14px; border-radius:50px; cursor:pointer; border:none; font-family:'DM Sans',sans-serif; }
  .city-cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 22px; }
  .city-card { background: var(--dark2); border: 1px solid rgba(255,255,255,0.08); border-radius: 18px; overflow: hidden; transition: all 0.35s cubic-bezier(0.4,0,0.2,1); }
  .city-card:hover { transform: translateY(-5px); border-color: rgba(250,224,19,0.28); box-shadow: 0 16px 50px rgba(10,8,40,0.45); }
  .city-card.coming-soon:hover { transform: none; border-color: rgba(255,255,255,0.1); box-shadow: none; }
  .city-card-img { height: 140px; position: relative; overflow: hidden; background: var(--dark3); }
  .city-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
  .city-card:hover .city-card-img img { transform: scale(1.06); }
  .city-card-img-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(28,20,80,0.85) 100%); }
  .city-card-region { position: absolute; top: 12px; left: 14px; background: rgba(14,11,42,0.82); backdrop-filter: blur(8px); border: 1px solid rgba(250,224,19,0.25); color: #E8C97A; font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 4px 12px; border-radius: 50px; }
  .city-status-badge { position: absolute; top: 12px; right: 14px; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 50px; }
  .status-active { background: rgba(46,204,113,0.18); border: 1px solid rgba(46,204,113,0.4); color: #2ecc71; }
  .status-soon   { background: rgba(255,165,0,0.15);  border: 1px solid rgba(255,165,0,0.35);  color: #ffa500; }
  .city-card-body { padding: 20px 22px 22px; }
  .city-card-name { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 600; color: var(--white); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
  .city-detail-row { display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: rgba(240,238,255,0.7); margin-bottom: 8px; line-height: 1.5; }
  .city-detail-row .di { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
  .city-pickup-tags { display: flex; gap: 6px; flex-wrap: wrap; margin: 14px 0; }
  .pickup-tag { display: flex; align-items: center; gap: 5px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 6px; padding: 5px 10px; font-size: 11px; font-weight: 600; color: rgba(240,238,255,0.65); }
  .city-card-footer { display: flex; gap: 10px; padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.07); }
  .city-map-btn { flex: 1; background: rgba(250,224,19,0.08); border: 1px solid rgba(250,224,19,0.25); color: #E8C97A; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600; padding: 10px 16px; border-radius: 50px; cursor: pointer; transition: all 0.3s; }
  .city-map-btn:hover { background: var(--gold); color: var(--dark); border-color: var(--gold); }
  .city-book-btn { flex: 1; background: var(--gold); color: var(--dark); border: none; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700; padding: 10px 16px; border-radius: 50px; cursor: pointer; transition: all 0.3s; }
  .city-book-btn:hover { background: var(--gold-light); transform: translateY(-1px); box-shadow: 0 6px 18px rgba(250,224,19,0.3); }
  .coming-soon-body { padding: 32px 24px; text-align: center; }
  .coming-soon-icon { font-size: 36px; margin-bottom: 12px; }
  .coming-soon-city { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 600; color: var(--white); margin-bottom: 8px; }
  .coming-soon-text { font-size: 13px; color: var(--muted); line-height: 1.6; margin-bottom: 16px; }
  .coming-soon-notify { background: transparent; border: 1px solid rgba(250,224,19,0.3); color: #E8C97A; font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 600; padding: 9px 20px; border-radius: 50px; cursor: pointer; transition: all 0.3s; }
  .coming-soon-notify:hover { background: rgba(250,224,19,0.1); }
  .no-city-result { grid-column: 1/-1; text-align: center; padding: 60px 20px; color: var(--muted); font-size: 15px; }
  .no-city-result .emoji { font-size: 48px; display: block; margin-bottom: 16px; }
  .pickup-points-section { margin-top: 56px; padding-top: 56px; border-top: 1px solid rgba(255,255,255,0.08); }
  .pickup-types-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 18px; margin-top: 36px; }
  .pickup-type-card { background: var(--dark2); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 28px 22px; text-align: center; transition: all 0.3s; }
  .pickup-type-card:hover { border-color: rgba(250,224,19,0.25); transform: translateY(-3px); }
  .pickup-type-icon { font-size: 34px; margin-bottom: 14px; }
  .pickup-type-name { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 8px; }
  .pickup-type-desc { font-size: 13px; color: var(--muted); line-height: 1.6; }
</style>
</head>
<body>

<!-- HEADER -->
<header id="header">
  <a href="#" class="logo">Plan<span>&Go</span></a>
  <nav>
    <a href="#listings">Fleet</a>
    <a href="#locations">Locations</a>
    <a href="#why">About</a>
    <a href="#reviews">Reviews</a>
    <a href="#faq">FAQ</a>
    <a href="tel:+919624341040">+91 96243 41040</a>
    <a href="#listings" class="nav-cta">Book Now</a>
  </nav>
  <div class="hamburger" id="hamburger" onclick="toggleMobileNav()">
    <span></span><span></span><span></span>
  </div>
</header>

<!-- MOBILE NAV -->
<div class="mobile-nav" id="mobileNav">
  <button class="mobile-nav-close" onclick="toggleMobileNav()">✕</button>
  <a href="#listings" onclick="toggleMobileNav()">Fleet</a>
  <a href="#why" onclick="toggleMobileNav()">About</a>
  <a href="#reviews" onclick="toggleMobileNav()">Reviews</a>
  <a href="#faq" onclick="toggleMobileNav()">FAQ</a>
  <a href="#listings" onclick="toggleMobileNav()">Book Now →</a>
</div>

<!-- HERO -->
<section class="hero" id="hero">
  <div class="hero-bg" id="heroBg"></div>
  <div style="position:relative;z-index:2;width:100%;display:flex;flex-direction:column;align-items:center;">
    <div class="hero-content">
      <div class="hero-tag">Premium Car Rentals</div>
      <h1>Rent a Car for<br><em>Your Journey</em></h1>
      <p>From city escapes to coastal road trips — discover our curated fleet of premium vehicles, ready when you are.</p>
    </div>

    <!-- BOOKING FORM -->
    <div class="booking-wrapper">
      <div class="booking-card">
        <div class="booking-title">Search Available Cars</div>
        <div class="form-grid" id="bookingForm">
          <div class="form-group">
            <label>Pickup Location</label>
            <input type="text" placeholder="City or Airport" id="pickupLoc" value="">
          </div>
          <div class="form-group">
            <label>Drop Location</label>
            <input type="text" placeholder="City or Airport" id="dropLoc" value="">
          </div>
          <div class="form-group">
            <label>Pickup Date</label>
            <input type="date" id="pickupDate">
          </div>
          <div class="form-group">
            <label>Return Date</label>
            <input type="date" id="returnDate">
          </div>
          <div class="form-group">
            <label>Car Type</label>
            <div class="select-wrap">
              <select id="carTypeForm">
                <option value="">Any Type</option>
                <option>Sedan</option>
                <option>SUV</option>
                <option>Luxury</option>
                <option>Sports</option>
                <option>Electric</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Search</label>
            <button class="search-btn" onclick="searchCars()">🔍 Find Cars</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CAR LISTINGS -->
<section class="listings-section" id="listings">
  <div class="listings-header reveal">
    <div>
      <div class="section-tag">Our Fleet</div>
      <h2 class="section-title">Choose Your Perfect Ride</h2>
      <p class="section-sub">Hand-selected vehicles maintained to the highest standards.</p>
    </div>
  </div>

  <!-- FILTERS -->
  <div class="filters-bar reveal reveal-delay-1">
    <span class="filter-label">Type:</span>
    <div class="filter-group" id="typeFilters">
      <button class="filter-btn active" onclick="filterType(this, 'all')">All</button>
      <button class="filter-btn" onclick="filterType(this, 'Sedan')">Sedan</button>
      <button class="filter-btn" onclick="filterType(this, 'SUV')">SUV</button>
      <button class="filter-btn" onclick="filterType(this, 'Luxury')">Luxury</button>
      <button class="filter-btn" onclick="filterType(this, 'Sports')">Sports</button>
      <button class="filter-btn" onclick="filterType(this, 'Electric')">Electric</button>
    </div>
    <span class="filter-label" style="margin-left:16px">Trans:</span>
    <div class="filter-group" id="transFilters">
      <button class="filter-btn active" onclick="filterTrans(this, 'all')">All</button>
      <button class="filter-btn" onclick="filterTrans(this, 'Automatic')">Automatic</button>
      <button class="filter-btn" onclick="filterTrans(this, 'Manual')">Manual</button>
    </div>
    <div class="price-filter" style="margin-left:16px">
      <span class="filter-label">Max:</span>
      <input type="range" min="2000" max="50000" value="50000" step="500" id="priceRange" oninput="filterPrice(this.value)">
      <span class="price-val" id="priceVal">₹50,000/day</span>
    </div>
  </div>

  <!-- CARS GRID -->
  <div class="cars-grid" id="carsGrid">

    <!-- Maruti Swift -->
    <div class="car-card reveal" data-type="Sedan" data-trans="Manual" data-seats="5" data-price="2499">
      <div class="car-img-wrap">
        <img src="https://www.marutisuzuki.com/content/dam/maruti-suzuki/in/product/swift/gallery/exterior/desktop/swift-exterior-front-side.webp" onerror="this.src='https://images.unsplash.com/photo-1623869675781-80aa31012a5a?w=600&q=80'" alt="Maruti Swift" loading="lazy">
        <span class="car-badge">Sedan</span>
        <span class="car-rating"><span class="star">★</span> 4.5</span>
      </div>
      <div class="car-body">
        <div class="car-name">Maruti Swift</div>
        <div class="car-type-label">Hatchback · 2023</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 5 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Petrol</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Manual</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹2,499</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Maruti Swift', '₹2,499', 2499)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- Toyota Innova Crysta -->
    <div class="car-card reveal reveal-delay-1" data-type="SUV" data-trans="Manual" data-seats="7" data-price="4999">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/115777/innova-crysta-exterior-right-front-three-quarter-2.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1559416523-140ddc3d238c?w=600&q=80'" alt="Toyota Innova Crysta" loading="lazy">
        <span class="car-badge">SUV</span>
        <span class="car-rating"><span class="star">★</span> 4.8</span>
      </div>
      <div class="car-body">
        <div class="car-name">Toyota Innova Crysta</div>
        <div class="car-type-label">Premium MPV · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 7 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Diesel</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Manual</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹4,999</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Toyota Innova Crysta', '₹4,999', 4999)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- Hyundai Creta -->
    <div class="car-card reveal reveal-delay-2" data-type="SUV" data-trans="Automatic" data-seats="5" data-price="3999">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/106815/creta-exterior-right-front-three-quarter-3.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1617654112368-307921291f42?w=600&q=80'" alt="Hyundai Creta" loading="lazy">
        <span class="car-badge">SUV</span>
        <span class="car-rating"><span class="star">★</span> 4.6</span>
      </div>
      <div class="car-body">
        <div class="car-name">Hyundai Creta</div>
        <div class="car-type-label">Compact SUV · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 5 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Petrol</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Automatic</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹3,999</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Hyundai Creta', '₹3,999', 3999)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- BMW 5 Series -->
    <div class="car-card reveal" data-type="Luxury" data-trans="Automatic" data-seats="5" data-price="12999">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/130583/5-series-exterior-right-front-three-quarter-8.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600&q=80'" alt="BMW 5 Series" loading="lazy">
        <span class="car-badge">Luxury</span>
        <span class="car-rating"><span class="star">★</span> 4.9</span>
      </div>
      <div class="car-body">
        <div class="car-name">BMW 5 Series</div>
        <div class="car-type-label">Executive Sedan · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 5 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Petrol</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Automatic</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹12,999</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('BMW 5 Series', '₹12,999', 12999)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- Mercedes-Benz E-Class -->
    <div class="car-card reveal reveal-delay-1" data-type="Luxury" data-trans="Automatic" data-seats="5" data-price="15999">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/51435/e-class-exterior-right-front-three-quarter-2.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&q=80'" alt="Mercedes E-Class" loading="lazy">
        <span class="car-badge">Luxury</span>
        <span class="car-rating"><span class="star">★</span> 4.9</span>
      </div>
      <div class="car-body">
        <div class="car-name">Mercedes-Benz E-Class</div>
        <div class="car-type-label">Luxury Sedan · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 5 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Petrol</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Automatic</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹15,999</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Mercedes-Benz E-Class', '₹15,999', 15999)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- Tata Nexon EV -->
    <div class="car-card reveal reveal-delay-2" data-type="Electric" data-trans="Automatic" data-seats="5" data-price="3499">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/141115/nexon-ev-exterior-right-front-three-quarter-4.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1593941707882-a5bba14938c7?w=600&q=80'" alt="Tata Nexon EV" loading="lazy">
        <span class="car-badge">Electric</span>
        <span class="car-rating"><span class="star">★</span> 4.7</span>
      </div>
      <div class="car-body">
        <div class="car-name">Tata Nexon EV</div>
        <div class="car-type-label">Electric SUV · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 5 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⚡</span> Electric</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Automatic</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹3,499</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Tata Nexon EV', '₹3,499', 3499)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- Audi A6 -->
    <div class="car-card reveal" data-type="Luxury" data-trans="Automatic" data-seats="5" data-price="18999">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/51435/a6-exterior-right-front-three-quarter.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=600&q=80'" alt="Audi A6" loading="lazy">
        <span class="car-badge">Luxury</span>
        <span class="car-rating"><span class="star">★</span> 5.0</span>
      </div>
      <div class="car-body">
        <div class="car-name">Audi A6</div>
        <div class="car-type-label">Premium Sedan · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 5 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Petrol</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Automatic</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹18,999</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Audi A6', '₹18,999', 18999)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- Mahindra Thar -->
    <div class="car-card reveal reveal-delay-1" data-type="SUV" data-trans="Manual" data-seats="4" data-price="5499">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/40087/thar-exterior-right-front-three-quarter-11.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=600&q=80'" alt="Mahindra Thar" loading="lazy">
        <span class="car-badge">SUV</span>
        <span class="car-rating"><span class="star">★</span> 4.7</span>
      </div>
      <div class="car-body">
        <div class="car-name">Mahindra Thar</div>
        <div class="car-type-label">Off-Road SUV · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 4 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Diesel</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Manual</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹5,499</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Mahindra Thar', '₹5,499', 5499)">Book Now</button>
        </div>
      </div>
    </div>

    <!-- Range Rover Vogue -->
    <div class="car-card reveal reveal-delay-2" data-type="Luxury" data-trans="Automatic" data-seats="5" data-price="35000">
      <div class="car-img-wrap">
        <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/135921/range-rover-exterior-right-front-three-quarter-2.jpeg?isig=0&q=75" onerror="this.src='https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?w=600&q=80'" alt="Range Rover Vogue" loading="lazy">
        <span class="car-badge">Luxury</span>
        <span class="car-rating"><span class="star">★</span> 5.0</span>
      </div>
      <div class="car-body">
        <div class="car-name">Range Rover Vogue</div>
        <div class="car-type-label">Ultra Luxury SUV · 2024</div>
        <div class="car-specs">
          <span class="spec-pill"><span class="icon">👥</span> 5 Seats</span>
          <span class="spec-pill"><span class="icon">❄️</span> AC</span>
          <span class="spec-pill"><span class="icon">⛽</span> Petrol</span>
          <span class="spec-pill"><span class="icon">⚙️</span> Automatic</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            <div class="amount">₹35,000</div>
            <div class="per">per day</div>
          </div>
          <button class="book-btn" onclick="openBooking('Range Rover Vogue', '₹35,000', 35000)">Book Now</button>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="why-section" id="why">
  <div style="max-width:1200px;margin:0 auto;">
    <div class="reveal">
      <div class="section-tag">Why Plan&Go</div>
      <h2 class="section-title">The Premium Difference</h2>
      <p class="section-sub">We set a higher standard for every aspect of your journey.</p>
    </div>
    <div class="features-grid">
      <div class="feature-card reveal">
        <div class="feature-icon">🛡️</div>
        <h3>Full Insurance Cover</h3>
        <p>Every rental includes comprehensive insurance and 24/7 roadside assistance at no extra cost.</p>
      </div>
      <div class="feature-card reveal reveal-delay-1">
        <div class="feature-icon">⚡</div>
        <h3>Instant Confirmation</h3>
        <p>Book in seconds. Receive your confirmation and vehicle details immediately via email and SMS.</p>
      </div>
      <div class="feature-card reveal reveal-delay-2">
        <div class="feature-icon">🚗</div>
        <h3>Doorstep Delivery</h3>
        <p>We deliver your car to your hotel, home, or any address — no queuing at the counter.</p>
      </div>
      <div class="feature-card reveal reveal-delay-3">
        <div class="feature-icon">💳</div>
        <h3>Transparent Pricing</h3>
        <p>No hidden fees, no surprises. The price you see is exactly what you pay. Period.</p>
      </div>
      <div class="feature-card reveal">
        <div class="feature-icon">🌍</div>
        <h3>500+ Locations</h3>
        <p>Pick up and return from over 500 locations across 80 countries worldwide.</p>
      </div>
      <div class="feature-card reveal reveal-delay-1">
        <div class="feature-icon">🏆</div>
        <h3>Premium Fleet</h3>
        <p>Every vehicle is under 2 years old, meticulously maintained, and sanitized before your journey.</p>
      </div>
    </div>
  </div>
</section>

<!-- REVIEWS -->
<section class="reviews-section" id="reviews">
  <div style="max-width:1200px;margin:0 auto;">
    <div class="reveal">
      <div class="section-tag">Testimonials</div>
      <h2 class="section-title">What Our Guests Say</h2>
      <p class="section-sub">Over 50,000 satisfied travelers and counting.</p>
    </div>
    <div class="reviews-grid">
      <div class="review-card reveal">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"Absolutely seamless experience from booking to return. The Porsche 911 was immaculate and the delivery to my hotel was right on time. Plan&Go has set a new standard for me."</p>
        <div class="reviewer">
          <div class="reviewer-avatar">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="James">
          </div>
          <div>
            <div class="reviewer-name">James Hartley</div>
            <div class="reviewer-meta">London · Rented Porsche 911</div>
          </div>
        </div>
      </div>
      <div class="review-card reveal reveal-delay-1">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"We needed a 7-seater for our family road trip and the Range Rover Sport was perfect. Kids loved it, parents loved it. No surprises on the bill — I'll never use another service."</p>
        <div class="reviewer">
          <div class="reviewer-avatar">
            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&q=80" alt="Sofia">
          </div>
          <div>
            <div class="reviewer-name">Sofia Marchetti</div>
            <div class="reviewer-meta">Milan · Rented Range Rover</div>
          </div>
        </div>
      </div>
      <div class="review-card reveal reveal-delay-2">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"Rented the Tesla for a week — zero charging anxiety, incredible tech, and Plan&Go's app made everything effortless. The team even sent a card with the keys. Truly premium."</p>
        <div class="reviewer">
          <div class="reviewer-avatar">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&q=80" alt="David">
          </div>
          <div>
            <div class="reviewer-name">David Chen</div>
            <div class="reviewer-meta">Singapore · Rented Tesla Model S</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="faq-section" id="faq">
  <div style="max-width:1100px;margin:0 auto;">
    <div class="reveal">
      <div class="section-tag">FAQ</div>
      <h2 class="section-title">Common Questions</h2>
      <p class="section-sub">Everything you need to know before booking.</p>
    </div>
    <div class="faq-grid reveal">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          What documents do I need to rent?
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-a">You'll need a valid driver's license (held for at least 1 year), a passport or national ID, and a credit card in your name. International licenses are accepted at all our locations worldwide.</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          Is insurance included in the price?
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-a">Yes — all rentals include Collision Damage Waiver (CDW), Theft Protection, and Third-Party Liability. There are no hidden charges. Full peace of mind from day one.</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          Can I cancel or modify my booking?
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-a">Free cancellation is available up to 48 hours before pickup. Modifications can be made at any time through your account portal or by calling our 24/7 support line. No cancellation fees within the window.</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          Do you offer airport pickup/dropoff?
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-a">Absolutely. We operate at over 200 airports globally. Simply enter the airport code or name in the pickup location field and we'll have your vehicle waiting at arrivals.</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          What's the minimum rental age?
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-a">The minimum age is 21 for standard vehicles. Luxury and sports cars require a minimum age of 25. A young driver surcharge may apply for renters under 25.</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          How does fuel policy work?
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-a">We use a full-to-full fuel policy. You receive the car with a full tank and return it full. If returned with less fuel, a refueling charge applies. Electric vehicles are provided with a minimum 80% charge.</div>
      </div>
    </div>
  </div>
</section>

<!-- LOCATION & PICKUP HUB -->
<section class="location-section" id="locations">
  <div style="max-width:1200px;margin:0 auto;">

    <!-- Header -->
    <div class="reveal">
      <div class="section-tag">Our Network</div>
      <h2 class="section-title">Location &amp; Pickup Hub</h2>
      <p class="section-sub">Find our offices, pickup points, and service cities across India.</p>
    </div>

    <!-- Search bar -->
    <div class="loc-search-wrap reveal">
      <input class="loc-search-input" id="citySearchInput" type="text" placeholder="🔍  Search city — e.g. Ahmedabad, Mumbai, Jaipur..." oninput="filterCities()" onkeydown="if(event.key==='Enter')filterCities()">
      <button class="loc-search-btn" onclick="filterCities()">Search</button>
    </div>

    <!-- Stats strip -->
    <div class="loc-stats reveal">
      <div class="loc-stat"><div class="loc-stat-num">8</div><div class="loc-stat-label">Active Cities</div></div>
      <div class="loc-stat"><div class="loc-stat-num">24+</div><div class="loc-stat-label">Pickup Points</div></div>
      <div class="loc-stat"><div class="loc-stat-num">4</div><div class="loc-stat-label">Coming Soon</div></div>
      <div class="loc-stat"><div class="loc-stat-num">24/7</div><div class="loc-stat-label">Support</div></div>
    </div>

    <!-- Filter tabs -->
    <div class="loc-tabs reveal">
      <button class="loc-tab active" onclick="setLocTab(this,'all')">🗺️ All Cities <span class="tc">12</span></button>
      <button class="loc-tab" onclick="setLocTab(this,'active')">✅ Active <span class="tc">8</span></button>
      <button class="loc-tab" onclick="setLocTab(this,'soon')">🔜 Coming Soon <span class="tc">4</span></button>
      <button class="loc-tab" onclick="setLocTab(this,'airport')">✈️ Airport Pickup</button>
      <button class="loc-tab" onclick="setLocTab(this,'railway')">🚂 Railway Station</button>
    </div>

    <!-- Interactive Map -->
    <div class="loc-map-wrap reveal">
      <div id="plangoMap"></div>
      <div style="position:absolute;bottom:14px;left:14px;z-index:999;background:rgba(28,20,80,0.9);backdrop-filter:blur(8px);border:1px solid rgba(250,224,19,0.25);border-radius:10px;padding:10px 16px;font-size:12px;color:#8B82C4;pointer-events:none;">
        <span style="color:#FAE013;font-weight:700;">●</span> Active Hub &nbsp;
        <span style="color:#ffa500;font-weight:700;">●</span> Coming Soon &nbsp;
        <span style="color:#2ecc71;font-weight:700;">●</span> Pickup Point
      </div>
    </div>

    <!-- City Cards -->
    <div class="city-cards-grid" id="cityCardsGrid">

      <!-- AHMEDABAD -->
      <div class="city-card reveal" data-city="ahmedabad" data-status="active" data-has="airport railway">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=600&q=80" alt="Ahmedabad">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Gujarat</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 Ahmedabad</div>
          <div class="city-detail-row"><span class="di">🏢</span> CG Road, Navrangpura, Ahmedabad – 380009</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9624341040</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sun: 7:00 AM – 9:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">✈️ Sardar Patel Airport</span>
            <span class="pickup-tag">🚂 Ahmedabad Junction</span>
            <span class="pickup-tag">🏨 Hotel Delivery</span>
            <span class="pickup-tag">🤝 Partner Office</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(23.0225,72.5714,'Ahmedabad')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Ahmedabad Fleet','₹2,499',2499)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- SURAT -->
      <div class="city-card reveal reveal-delay-1" data-city="surat" data-status="active" data-has="airport railway">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1602940659805-770d1b3b9911?w=600&q=80" alt="Surat">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Gujarat</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 Surat</div>
          <div class="city-detail-row"><span class="di">🏢</span> Ring Road, Athwa Lines, Surat – 395001</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9974106601</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sun: 7:00 AM – 9:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">✈️ Surat Airport</span>
            <span class="pickup-tag">🚂 Surat Railway Station</span>
            <span class="pickup-tag">🏨 Hotel Delivery</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(21.1702,72.8311,'Surat')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Surat Fleet','₹2,499',2499)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- VADODARA -->
      <div class="city-card reveal reveal-delay-2" data-city="vadodara" data-status="active" data-has="railway">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1565018054866-968e244671af?w=600&q=80" alt="Vadodara">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Gujarat</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 Vadodara</div>
          <div class="city-detail-row"><span class="di">🏢</span> Alkapuri, Vadodara – 390007</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9624341040</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sat: 8:00 AM – 8:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">🚂 Vadodara Junction</span>
            <span class="pickup-tag">🏨 Hotel Delivery</span>
            <span class="pickup-tag">🤝 Partner Office</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(22.3072,73.1812,'Vadodara')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Vadodara Fleet','₹2,499',2499)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- MUMBAI -->
      <div class="city-card reveal" data-city="mumbai" data-status="active" data-has="airport railway">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=600&q=80" alt="Mumbai">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Maharashtra</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 Mumbai</div>
          <div class="city-detail-row"><span class="di">🏢</span> Bandra West, Mumbai – 400050</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9974106601</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sun: 6:00 AM – 10:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">✈️ Chhatrapati Shivaji Airport</span>
            <span class="pickup-tag">🚂 Mumbai Central</span>
            <span class="pickup-tag">🏨 Hotel Delivery</span>
            <span class="pickup-tag">🤝 Partner Office</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(19.0760,72.8777,'Mumbai')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Mumbai Fleet','₹3,499',3499)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- DELHI -->
      <div class="city-card reveal reveal-delay-1" data-city="delhi" data-status="active" data-has="airport railway">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=600&q=80" alt="Delhi">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Delhi NCR</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 New Delhi</div>
          <div class="city-detail-row"><span class="di">🏢</span> Connaught Place, New Delhi – 110001</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9624341040</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sun: 6:00 AM – 11:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">✈️ IGI Airport T1/T2/T3</span>
            <span class="pickup-tag">🚂 New Delhi Station</span>
            <span class="pickup-tag">🏨 Hotel Delivery</span>
            <span class="pickup-tag">🤝 Partner Office</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(28.6139,77.2090,'New Delhi')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Delhi Fleet','₹3,499',3499)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- JAIPUR -->
      <div class="city-card reveal reveal-delay-2" data-city="jaipur" data-status="active" data-has="airport railway">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1477587458883-47145ed31769?w=600&q=80" alt="Jaipur">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Rajasthan</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 Jaipur</div>
          <div class="city-detail-row"><span class="di">🏢</span> MI Road, Jaipur – 302001</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9974106601</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sun: 7:00 AM – 9:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">✈️ Jaipur International Airport</span>
            <span class="pickup-tag">🚂 Jaipur Junction</span>
            <span class="pickup-tag">🏨 Hotel Delivery</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(26.9124,75.7873,'Jaipur')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Jaipur Fleet','₹2,999',2999)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- BANGALORE -->
      <div class="city-card reveal" data-city="bangalore" data-status="active" data-has="airport railway">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=600&q=80" alt="Bangalore">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Karnataka</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 Bangalore</div>
          <div class="city-detail-row"><span class="di">🏢</span> MG Road, Bengaluru – 560001</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9624341040</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sun: 6:00 AM – 11:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">✈️ Kempegowda Airport</span>
            <span class="pickup-tag">🚂 KSR Bengaluru</span>
            <span class="pickup-tag">🏨 Hotel Delivery</span>
            <span class="pickup-tag">🤝 Partner Office</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(12.9716,77.5946,'Bangalore')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Bangalore Fleet','₹3,499',3499)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- GOA -->
      <div class="city-card reveal reveal-delay-1" data-city="goa" data-status="active" data-has="airport">
        <div class="city-card-img">
          <img src="https://images.unsplash.com/photo-1614082242765-7c98ca0f3df3?w=600&q=80" alt="Goa">
          <div class="city-card-img-overlay"></div>
          <span class="city-card-region">Goa</span>
          <span class="city-status-badge status-active">● Active</span>
        </div>
        <div class="city-card-body">
          <div class="city-card-name">📍 Goa</div>
          <div class="city-detail-row"><span class="di">🏢</span> Panaji, North Goa – 403001</div>
          <div class="city-detail-row"><span class="di">📞</span> +91-9974106601</div>
          <div class="city-detail-row"><span class="di">🕐</span> Mon–Sun: 7:00 AM – 9:00 PM</div>
          <div class="city-pickup-tags">
            <span class="pickup-tag">✈️ Goa International Airport</span>
            <span class="pickup-tag">🏨 Beach Resort Delivery</span>
            <span class="pickup-tag">🤝 Partner Office</span>
          </div>
          <div class="city-card-footer">
            <button class="city-map-btn" onclick="flyToCity(15.2993,74.1240,'Goa')">🗺️ View on Map</button>
            <button class="city-book-btn" onclick="openBooking('Goa Fleet','₹2,999',2999)">Book Now</button>
          </div>
        </div>
      </div>

      <!-- COMING SOON — PUNE -->
      <div class="city-card coming-soon reveal reveal-delay-2" data-city="pune" data-status="soon">
        <div class="coming-soon-body">
          <div class="coming-soon-icon">🔜</div>
          <div class="coming-soon-city">📍 Pune</div>
          <div style="display:inline-block;margin-bottom:14px;"><span class="city-status-badge status-soon">Service Coming Soon</span></div>
          <div class="coming-soon-text">We're setting up our Pune hub! Get notified when we go live.</div>
          <div class="city-detail-row" style="justify-content:center"><span class="di">📍</span> Maharashtra</div>
          <button class="coming-soon-notify" onclick="notifyCity('Pune')">🔔 Notify Me</button>
        </div>
      </div>

      <!-- COMING SOON — HYDERABAD -->
      <div class="city-card coming-soon reveal" data-city="hyderabad" data-status="soon">
        <div class="coming-soon-body">
          <div class="coming-soon-icon">🔜</div>
          <div class="coming-soon-city">📍 Hyderabad</div>
          <div style="display:inline-block;margin-bottom:14px;"><span class="city-status-badge status-soon">Service Coming Soon</span></div>
          <div class="coming-soon-text">Hyderabad is on our map! Stay tuned for our launch.</div>
          <div class="city-detail-row" style="justify-content:center"><span class="di">📍</span> Telangana</div>
          <button class="coming-soon-notify" onclick="notifyCity('Hyderabad')">🔔 Notify Me</button>
        </div>
      </div>

      <!-- COMING SOON — KOLKATA -->
      <div class="city-card coming-soon reveal reveal-delay-1" data-city="kolkata" data-status="soon">
        <div class="coming-soon-body">
          <div class="coming-soon-icon">🔜</div>
          <div class="coming-soon-city">📍 Kolkata</div>
          <div style="display:inline-block;margin-bottom:14px;"><span class="city-status-badge status-soon">Service Coming Soon</span></div>
          <div class="coming-soon-text">Coming soon to the City of Joy. Register your interest!</div>
          <div class="city-detail-row" style="justify-content:center"><span class="di">📍</span> West Bengal</div>
          <button class="coming-soon-notify" onclick="notifyCity('Kolkata')">🔔 Notify Me</button>
        </div>
      </div>

      <!-- COMING SOON — CHANDIGARH -->
      <div class="city-card coming-soon reveal reveal-delay-2" data-city="chandigarh" data-status="soon">
        <div class="coming-soon-body">
          <div class="coming-soon-icon">🔜</div>
          <div class="coming-soon-city">📍 Chandigarh</div>
          <div style="display:inline-block;margin-bottom:14px;"><span class="city-status-badge status-soon">Service Coming Soon</span></div>
          <div class="coming-soon-text">Expanding to Chandigarh soon. Be the first to know!</div>
          <div class="city-detail-row" style="justify-content:center"><span class="di">📍</span> Punjab / Haryana</div>
          <button class="coming-soon-notify" onclick="notifyCity('Chandigarh')">🔔 Notify Me</button>
        </div>
      </div>

      <!-- No results placeholder (hidden by default) -->
      <div class="no-city-result" id="noCityResult" style="display:none">
        <span class="emoji">😔</span>
        <strong>No city found</strong><br>
        We don't service this location yet — but we're expanding fast!<br><br>
        <button class="coming-soon-notify" style="font-size:13px;padding:11px 28px" onclick="showToast('📨','Request Sent!','We\'ll notify you when we expand there.')">🔔 Request This City</button>
      </div>

    </div><!-- end city cards grid -->

    <!-- Pickup Points Section -->
    <div class="pickup-points-section reveal">
      <div class="section-tag">Pickup Types</div>
      <h2 class="section-title" style="font-size:clamp(26px,3.5vw,42px)">Destination-wise Pickup Points</h2>
      <p class="section-sub">We deliver your car exactly where you need it — no queues, no hassle.</p>
      <div class="pickup-types-grid">
        <div class="pickup-type-card reveal">
          <div class="pickup-type-icon">✈️</div>
          <div class="pickup-type-name">Airport Pickup</div>
          <div class="pickup-type-desc">Car waiting at arrivals when your flight lands. Available at 8 airports across India.</div>
        </div>
        <div class="pickup-type-card reveal reveal-delay-1">
          <div class="pickup-type-icon">🚂</div>
          <div class="pickup-type-name">Railway Station</div>
          <div class="pickup-type-desc">Pickup directly outside major railway stations. Track your train — we track your arrival.</div>
        </div>
        <div class="pickup-type-card reveal reveal-delay-2">
          <div class="pickup-type-icon">🏨</div>
          <div class="pickup-type-name">Hotel Delivery</div>
          <div class="pickup-type-desc">Car delivered to your hotel lobby or resort entrance at your chosen time.</div>
        </div>
        <div class="pickup-type-card reveal reveal-delay-3">
          <div class="pickup-type-icon">🤝</div>
          <div class="pickup-type-name">Partner Office</div>
          <div class="pickup-type-desc">Walk-in to our partner offices across all major cities for a smooth handover experience.</div>
        </div>
        <div class="pickup-type-card reveal">
          <div class="pickup-type-icon">🏠</div>
          <div class="pickup-type-name">Doorstep Delivery</div>
          <div class="pickup-type-desc">We come to your home or office. Enter your address and we handle the rest.</div>
        </div>
        <div class="pickup-type-card reveal reveal-delay-1">
          <div class="pickup-type-icon">📍</div>
          <div class="pickup-type-name">Custom Location</div>
          <div class="pickup-type-desc">Any landmark, mall, or address within city limits — just share your pin and we're there.</div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-main">

    <!-- Quick Links -->
    <div>
      <div class="footer-col-title">Quick Links</div>
      <ul class="footer-links">
        <li><a href="#">About</a></li>
        <li><a href="#">Destinations</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Inquire Now</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>

    <!-- Newsletter -->
    <div>
      <div class="footer-col-title">Newsletter</div>
      <p class="newsletter-text">Subscribe our Newsletter to get Our Latest updates &amp; news</p>
      <div class="newsletter-form">
        <input class="newsletter-input" type="email" placeholder="Enter Email Address" id="newsletterEmail">
        <button class="newsletter-btn" onclick="subscribeNewsletter()">SUBSCRIBE</button>
      </div>
    </div>

    <!-- Contact Us -->
    <div>
      <div class="footer-col-title">Contact Us</div>
      <div class="contact-item">
        <span class="contact-icon">📞</span>
        +91-9624341040
      </div>
      <div class="contact-item">
        <span class="contact-icon">📞</span>
        +91-9974106601
      </div>
      <div class="contact-item">
        <span class="contact-icon">✉️</span>
        infoplandgo@gmail.com
      </div>
      <div class="footer-socials">
        <a href="#" class="footer-social-btn" title="Facebook">𝑓</a>
        <a href="#" class="footer-social-btn" title="Twitter">𝕏</a>
        <a href="#" class="footer-social-btn" title="Instagram">📷</a>
        <a href="#" class="footer-social-btn" title="LinkedIn">in</a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    <span>Copyright 2026. All Rights Reserved to plan &amp; go Travel</span>
    <span>Developed By plan&amp;go team</span>
  </div>
</footer>

<!-- BOOKING MODAL - 3 Step -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
  <div class="modal" id="bookingModal">
    <button class="modal-close-btn" onclick="closeBookingModal()">✕</button>

    <!-- Step progress -->
    <div class="modal-progress">
      <div class="modal-step-tab active" id="tab1">① Personal Info</div>
      <div class="modal-step-tab" id="tab2">② Payment</div>
      <div class="modal-step-tab" id="tab3">③ Confirm</div>
    </div>

    <div class="modal-body">
      <!-- Car summary always visible -->
      <div class="modal-car-bar">
        <div class="modal-car-name" id="modalCarName">—</div>
        <div class="modal-car-price" id="modalCarPrice">—</div>
      </div>

      <!-- ── STEP 1: Personal Info ── -->
      <div id="step1">
        <div class="modal-section-title"><span>1</span> Your Personal Details</div>
        <div class="mform-grid">
          <div class="mform-group">
            <label>First Name *</label>
            <input type="text" id="fname" placeholder="Rahul">
          </div>
          <div class="mform-group">
            <label>Last Name *</label>
            <input type="text" id="lname" placeholder="Sharma">
          </div>
          <div class="mform-group">
            <label>Mobile Number *</label>
            <input type="tel" id="phone" placeholder="+91 98765 43210">
          </div>
          <div class="mform-group">
            <label>Email Address *</label>
            <input type="email" id="email" placeholder="rahul@email.com">
          </div>
          <div class="mform-group">
            <label>Driving License No. *</label>
            <input type="text" id="license" placeholder="GJ01 2024 123456">
          </div>
          <div class="mform-group">
            <label>ID Proof Type</label>
            <select id="idProof">
              <option value="">Select ID</option>
              <option>Aadhaar Card</option>
              <option>PAN Card</option>
              <option>Passport</option>
              <option>Voter ID</option>
            </select>
          </div>
        </div>
        <div class="modal-nav">
          <button class="btn-back" onclick="closeBookingModal()">Cancel</button>
          <button class="btn-next" onclick="goToStep(2)">Next: Payment →</button>
        </div>
      </div>

      <!-- ── STEP 2: Payment ── -->
      <div id="step2" style="display:none">
        <div class="modal-section-title"><span>2</span> Choose Payment Method</div>

        <!-- Payment option cards -->
        <div class="pay-options">

          <!-- CASH -->
          <div class="pay-card" id="payCard-cash" onclick="selectPayMethod('cash')">
            <div class="pay-card-icon">💵</div>
            <div class="pay-card-info">
              <div class="pay-card-title">Cash at Pickup</div>
              <div class="pay-card-sub">Pay full amount when you collect the car</div>
            </div>
            <div class="pay-card-check" id="check-cash">✓</div>
          </div>

          <!-- ONLINE -->
          <div class="pay-card" id="payCard-online" onclick="selectPayMethod('online')">
            <div class="pay-card-icon">📱</div>
            <div class="pay-card-info">
              <div class="pay-card-title">Online Payment</div>
              <div class="pay-card-sub">UPI, Net Banking, Wallets & more</div>
            </div>
            <div class="pay-card-check" id="check-online">✓</div>
          </div>

        </div>

        <!-- CASH details -->
        <div id="cashDetails" style="display:none; margin-top:20px;">
          <div class="pay-info-box">
            <div class="pay-info-row">💡 <strong>Pay at Pickup</strong> — Full payment due when you collect the vehicle.</div>
            <div class="pay-info-row">🔐 A refundable security deposit of <strong>₹5,000</strong> will be collected at handover.</div>
            <div class="pay-info-row">📋 Please carry a valid <strong>Govt. ID + Driving License</strong> at the time of pickup.</div>
            <div class="pay-info-row">✅ No online transaction required. Your booking slot is reserved immediately.</div>
          </div>
        </div>

        <!-- ONLINE details -->
        <div id="onlineDetails" style="display:none; margin-top:20px;">
          <div class="online-sub-label">Select Online Payment Option:</div>
          <div class="online-options">

            <div class="online-opt" id="opt-upi" onclick="selectOnlineOpt('upi')">
              <span class="online-opt-icon">🔗</span>
              <span class="online-opt-name">UPI</span>
              <span class="online-opt-sub">GPay, PhonePe, Paytm</span>
            </div>

            <div class="online-opt" id="opt-netbanking" onclick="selectOnlineOpt('netbanking')">
              <span class="online-opt-icon">🏦</span>
              <span class="online-opt-name">Net Banking</span>
              <span class="online-opt-sub">All Indian banks</span>
            </div>

            <div class="online-opt" id="opt-wallet" onclick="selectOnlineOpt('wallet')">
              <span class="online-opt-icon">👛</span>
              <span class="online-opt-name">Wallets</span>
              <span class="online-opt-sub">Paytm, Amazon Pay</span>
            </div>

          </div>

          <!-- UPI -->
          <div id="upiFields" style="display:none; margin-top:16px;">
            <div class="mform-grid single">
              <div class="mform-group">
                <label>UPI ID *</label>
                <input type="text" id="upiId" placeholder="yourname@okaxis / yourname@ybl">
              </div>
            </div>
            <div style="display:flex;gap:10px;margin-top:10px;flex-wrap:wrap;">
              <div class="upi-app-badge" onclick="selectUpiApp(this,'GPay')">
                <span>G</span> GPay
              </div>
              <div class="upi-app-badge" onclick="selectUpiApp(this,'PhonePe')">
                <span style="color:#5f259f;">P</span> PhonePe
              </div>
              <div class="upi-app-badge" onclick="selectUpiApp(this,'Paytm')">
                <span style="color:#00BAF2;">P</span> Paytm
              </div>
              <div class="upi-app-badge" onclick="selectUpiApp(this,'BHIM')">
                <span style="color:#E2501A;">B</span> BHIM
              </div>
            </div>
          </div>

          <!-- Net Banking -->
          <div id="netFields" style="display:none; margin-top:16px;">
            <div class="mform-grid single">
              <div class="mform-group">
                <label>Select Your Bank *</label>
                <select id="bankName">
                  <option value="">-- Choose Bank --</option>
                  <option>SBI (State Bank of India)</option>
                  <option>HDFC Bank</option>
                  <option>ICICI Bank</option>
                  <option>Axis Bank</option>
                  <option>Kotak Mahindra Bank</option>
                  <option>Bank of Baroda</option>
                  <option>Punjab National Bank</option>
                  <option>Canara Bank</option>
                  <option>Union Bank of India</option>
                  <option>Other Bank</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Wallets -->
          <div id="walletFields" style="display:none; margin-top:16px;">
            <div class="online-sub-label" style="margin-bottom:10px;">Select Wallet:</div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
              <div class="upi-app-badge" onclick="selectWallet(this,'Paytm Wallet')">
                <span style="color:#00BAF2;">P</span> Paytm Wallet
              </div>
              <div class="upi-app-badge" onclick="selectWallet(this,'Amazon Pay')">
                <span style="color:#FF9900;">A</span> Amazon Pay
              </div>
              <div class="upi-app-badge" onclick="selectWallet(this,'Mobikwik')">
                <span style="color:#1B75BB;">M</span> Mobikwik
              </div>
              <div class="upi-app-badge" onclick="selectWallet(this,'Freecharge')">
                <span style="color:#00AC8C;">F</span> Freecharge
              </div>
            </div>
            <input type="hidden" id="selectedWallet" value="">
          </div>

        </div>

        <div class="modal-nav">
          <button class="btn-back" onclick="goToStep(1)">← Back</button>
          <button class="btn-next" onclick="goToStep(3)">Review Order →</button>
        </div>
      </div>

      <!-- ── STEP 3: Review & Confirm ── -->
      <div id="step3" style="display:none">
        <div class="modal-section-title"><span>3</span> Review Your Booking</div>
        <div class="order-summary" id="orderSummary">
          <!-- filled by JS -->
        </div>
        <div style="font-size:12px;color:var(--muted);margin-bottom:20px;line-height:1.6;">
          🔒 Your payment is secured with 256-bit SSL encryption. By confirming you agree to our <a href="#" style="color:var(--gold);">Terms & Conditions</a>.
        </div>
        <div class="modal-nav">
          <button class="btn-back" onclick="goToStep(2)">← Back</button>
          <button class="btn-next" onclick="confirmBooking()" id="confirmBtn">✅ Confirm & Pay</button>
        </div>
      </div>

      <!-- ── SUCCESS ── -->
      <div id="stepSuccess" style="display:none">
        <div class="success-screen">
          <div class="success-icon">🎉</div>
          <h2>Booking Confirmed!</h2>
          <p>Your car has been successfully booked. You'll receive a confirmation on your email & WhatsApp shortly.</p>
          <div class="booking-ref">
            Booking Reference
            <strong id="bookingRef">—</strong>
          </div>
          <button class="btn-next" style="width:100%;justify-content:center" onclick="closeBookingModal()">Done 🚗</button>
        </div>
      </div>

    </div><!-- end modal-body -->
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
  <span class="toast-icon">✅</span>
  <div>
    <div class="toast-title">Booking Confirmed!</div>
    <div class="toast-msg" id="toastMsg">We'll contact you shortly.</div>
  </div>
</div>

<script>
  // Set min dates
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('pickupDate').min = today;
  document.getElementById('returnDate').min = today;
  document.getElementById('pickupDate').value = today;
  const d3 = new Date(); d3.setDate(d3.getDate() + 3);
  document.getElementById('returnDate').value = d3.toISOString().split('T')[0];

  // ── FILTERS ──
  let activeType = 'all', activeTrans = 'all', maxPrice = 50000;

  function applyFilters() {
    document.querySelectorAll('.car-card').forEach(card => {
      const show =
        (activeType === 'all' || card.dataset.type === activeType) &&
        (activeTrans === 'all' || card.dataset.trans === activeTrans) &&
        parseInt(card.dataset.price) <= maxPrice;
      card.classList.toggle('hidden-card', !show);
    });
  }
  function filterType(btn, type) {
    document.querySelectorAll('#typeFilters .filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active'); activeType = type; applyFilters();
  }
  function filterTrans(btn, trans) {
    document.querySelectorAll('#transFilters .filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active'); activeTrans = trans; applyFilters();
  }
  function filterPrice(val) {
    maxPrice = parseInt(val);
    document.getElementById('priceVal').textContent = '₹' + parseInt(val).toLocaleString('en-IN') + '/day';
    applyFilters();
  }

  // ── SEARCH ──
  function searchCars() {
    const pickup = document.getElementById('pickupLoc').value;
    const drop = document.getElementById('dropLoc').value;
    if (!pickup || !drop) { showToast('⚠️', 'Locations Required', 'Please enter pickup and drop locations.'); return; }
    const type = document.getElementById('carTypeForm').value;
    if (type) document.querySelectorAll('#typeFilters .filter-btn').forEach(b => { if (b.textContent.trim() === type) b.click(); });
    document.getElementById('listings').scrollIntoView({ behavior: 'smooth' });
    showToast('🔍', 'Searching Fleet', `Showing results for ${pickup} → ${drop}`);
  }

  // ── BOOKING MODAL STATE ──
  let bookingData = { car: '', price: '', priceNum: 0, days: 1 };
  let currentStep = 1;

  function openBooking(name, price, priceNum) {
    const p1 = document.getElementById('pickupDate').value;
    const p2 = document.getElementById('returnDate').value;
    let days = 1;
    if (p1 && p2) { const diff = (new Date(p2) - new Date(p1)) / 86400000; if (diff > 0) days = diff; }
    bookingData = { car: name, price: price, priceNum: priceNum, days: days };
    document.getElementById('modalCarName').textContent = name;
    document.getElementById('modalCarPrice').textContent = price + '/day';
    // Reset payment state
    selectedPayMain = ''; selectedOnlineOpt = ''; selectedUpiAppName = ''; selectedWalletName = '';
    document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('selected'));
    document.querySelectorAll('.online-opt').forEach(o => o.classList.remove('selected'));
    document.querySelectorAll('.upi-app-badge').forEach(b => b.classList.remove('selected'));
    ['cashDetails','onlineDetails','upiFields','netFields','walletFields'].forEach(id => document.getElementById(id).style.display = 'none');
    goToStep(1);
    document.getElementById('modalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeBookingModal() {
    document.getElementById('modalOverlay').classList.remove('open');
    document.body.style.overflow = '';
  }
  function closeModalOutside(e) {
    if (e.target === document.getElementById('modalOverlay')) closeBookingModal();
  }

  function goToStep(n) {
    // Validate step 1
    if (n === 2 && currentStep === 1) {
      const f = document.getElementById('fname').value.trim();
      const l = document.getElementById('lname').value.trim();
      const p = document.getElementById('phone').value.trim();
      const em = document.getElementById('email').value.trim();
      const lic = document.getElementById('license').value.trim();
      if (!f || !l || !p || !em || !lic) { showToast('⚠️', 'Missing Details', 'Please fill all required personal fields.'); return; }
      if (!/\S+@\S+\.\S+/.test(em)) { showToast('⚠️', 'Invalid Email', 'Please enter a valid email address.'); return; }
    }
    // Validate step 2
    if (n === 3 && currentStep === 2) {
      if (!selectedPayMain) { showToast('⚠️', 'Select Payment', 'Please choose Cash or Online payment.'); return; }
      if (selectedPayMain === 'online') {
        if (!selectedOnlineOpt) { showToast('⚠️', 'Select Option', 'Please select UPI, Net Banking or Wallet.'); return; }
        if (selectedOnlineOpt === 'upi') {
          const uid = document.getElementById('upiId').value.trim();
          if (!uid || !uid.includes('@')) { showToast('⚠️', 'Invalid UPI ID', 'Enter a valid UPI ID e.g. name@okaxis'); return; }
        }
        if (selectedOnlineOpt === 'netbanking' && !document.getElementById('bankName').value) {
          showToast('⚠️', 'Select Bank', 'Please select your bank.'); return;
        }
        if (selectedOnlineOpt === 'wallet' && !selectedWalletName) {
          showToast('⚠️', 'Select Wallet', 'Please select a wallet.'); return;
        }
      }
      buildOrderSummary();
    }

    currentStep = n;
    [1,2,3].forEach(i => {
      const s = document.getElementById('step' + i);
      if (s) s.style.display = i === n ? 'block' : 'none';
    });
    document.getElementById('stepSuccess').style.display = 'none';
    // update tabs
    ['tab1','tab2','tab3'].forEach((id, idx) => {
      const tab = document.getElementById(id);
      tab.classList.toggle('active', idx + 1 === n);
      tab.classList.toggle('done', idx + 1 < n);
    });
    // Scroll modal to top
    document.getElementById('bookingModal').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function buildOrderSummary() {
    const total = bookingData.priceNum * bookingData.days;
    const tax = Math.round(total * 0.18);
    const grand = total + tax;
    const methodLabel = getPayMethodLabel();
    document.getElementById('orderSummary').innerHTML = `
      <div class="order-row"><span>Vehicle</span><span>${bookingData.car}</span></div>
      <div class="order-row"><span>Rental Duration</span><span>${bookingData.days} day${bookingData.days>1?'s':''}</span></div>
      <div class="order-row"><span>Rate</span><span>${bookingData.price}/day</span></div>
      <div class="order-row"><span>Subtotal</span><span>₹${total.toLocaleString('en-IN')}</span></div>
      <div class="order-row"><span>GST (18%)</span><span>₹${tax.toLocaleString('en-IN')}</span></div>
      <div class="order-row"><span>Insurance</span><span style="color:#2ECC71">Included ✓</span></div>
      <div class="order-row"><span>Payment</span><span>${methodLabel}</span></div>
      <div class="order-row total"><span>Total Payable</span><span>₹${grand.toLocaleString('en-IN')}</span></div>
    `;
  }

  // ── PAYMENT METHOD LOGIC ──
  let selectedPayMain = ''; // 'cash' or 'online'
  let selectedOnlineOpt = ''; // 'upi', 'netbanking', 'wallet'
  let selectedUpiAppName = '';
  let selectedWalletName = '';

  function selectPayMethod(method) {
    selectedPayMain = method;
    selectedOnlineOpt = '';
    // Update card UI
    document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('selected'));
    document.getElementById('payCard-' + method).classList.add('selected');
    // Show/hide detail sections
    document.getElementById('cashDetails').style.display   = method === 'cash'   ? 'block' : 'none';
    document.getElementById('onlineDetails').style.display = method === 'online' ? 'block' : 'none';
    // Reset online sub-options
    if (method === 'online') {
      document.querySelectorAll('.online-opt').forEach(o => o.classList.remove('selected'));
      ['upiFields','netFields','walletFields'].forEach(id => document.getElementById(id).style.display = 'none');
    }
  }

  function selectOnlineOpt(opt) {
    selectedOnlineOpt = opt;
    document.querySelectorAll('.online-opt').forEach(o => o.classList.remove('selected'));
    document.getElementById('opt-' + opt).classList.add('selected');
    document.getElementById('upiFields').style.display    = opt === 'upi'        ? 'block' : 'none';
    document.getElementById('netFields').style.display    = opt === 'netbanking' ? 'block' : 'none';
    document.getElementById('walletFields').style.display = opt === 'wallet'     ? 'block' : 'none';
  }

  function selectUpiApp(el, name) {
    selectedUpiAppName = name;
    document.querySelectorAll('.upi-app-badge').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
  }

  function selectWallet(el, name) {
    selectedWalletName = name;
    document.getElementById('selectedWallet').value = name;
    // only highlight wallet badges (not upi badges)
    el.parentElement.querySelectorAll('.upi-app-badge').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
  }

  function getPayMethodLabel() {
    if (selectedPayMain === 'cash') return 'Cash at Pickup';
    if (selectedPayMain === 'online') {
      if (selectedOnlineOpt === 'upi') {
        const uid = document.getElementById('upiId').value.trim();
        return 'UPI' + (selectedUpiAppName ? ' (' + selectedUpiAppName + ')' : '') + (uid ? ' — ' + uid : '');
      }
      if (selectedOnlineOpt === 'netbanking') return 'Net Banking — ' + (document.getElementById('bankName').value || '');
      if (selectedOnlineOpt === 'wallet') return 'Wallet — ' + (selectedWalletName || '');
    }
    return '—';
  }

  function formatCard(inp) {
    let v = inp.value.replace(/\D/g,'').substring(0,16);
    inp.value = v.replace(/(.{4})/g,'$1 ').trim();
  }
  function formatExpiry(inp) {
    let v = inp.value.replace(/\D/g,'').substring(0,4);
    if (v.length >= 2) v = v.substring(0,2) + ' / ' + v.substring(2);
    inp.value = v;
  }

  function confirmBooking() {
    document.getElementById('confirmBtn').disabled = true;
    document.getElementById('confirmBtn').textContent = 'Processing...';
    setTimeout(() => {
      const ref = 'PG' + Date.now().toString().slice(-6).toUpperCase();
      document.getElementById('bookingRef').textContent = ref;
      [1,2,3].forEach(i => { const s = document.getElementById('step'+i); if(s) s.style.display='none'; });
      document.getElementById('stepSuccess').style.display = 'block';
      ['tab1','tab2','tab3'].forEach(id => { document.getElementById(id).classList.remove('active'); document.getElementById(id).classList.add('done'); });
      showToast('🎉', 'Booking Confirmed!', bookingData.car + ' reserved. Check your email.');
      document.getElementById('confirmBtn').disabled = false;
      document.getElementById('confirmBtn').textContent = '✅ Confirm & Pay';
    }, 1800);
  }

  // ── NEWSLETTER ──
  function subscribeNewsletter() {
    const em = document.getElementById('newsletterEmail').value.trim();
    if (!em || !/\S+@\S+\.\S+/.test(em)) { showToast('⚠️', 'Invalid Email', 'Please enter a valid email.'); return; }
    document.getElementById('newsletterEmail').value = '';
    showToast('✅', 'Subscribed!', 'You are now subscribed to Plan&Go updates.');
  }

  // ── TOAST ──
  let toastTimer;
  function showToast(icon, title, msg) {
    const toast = document.getElementById('toast');
    toast.querySelector('.toast-icon').textContent = icon;
    toast.querySelector('.toast-title').textContent = title;
    document.getElementById('toastMsg').textContent = msg;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 3800);
  }

  // ── FAQ ──
  function toggleFaq(el) {
    const item = el.parentElement;
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
  }

  // ── MOBILE NAV ──
  function toggleMobileNav() { document.getElementById('mobileNav').classList.toggle('open'); }

  // ── SCROLL REVEAL ──
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
  }, { threshold: 0.1 });
  reveals.forEach(r => observer.observe(r));

  // ── HEADER SCROLL ──
  window.addEventListener('scroll', () => {
    document.getElementById('header').style.background = window.scrollY > 60
      ? 'rgba(14,11,42,0.98)'
      : 'linear-gradient(180deg, rgba(14,11,42,0.98) 0%, rgba(14,11,42,0.88) 100%)';
  });

  // ── HERO PARALLAX ──
  window.addEventListener('scroll', () => {
    const bg = document.getElementById('heroBg');
    if (bg) bg.style.transform = `scale(1.05) translateY(${window.scrollY * 0.18}px)`;
  });

  // ── LOCATION MAP & FILTERS ──
  const CITIES = [
    { name:'Ahmedabad', lat:23.0225, lng:72.5714, status:'active', region:'Gujarat', address:'CG Road, Navrangpura', phone:'+91-9624341040', hours:'7AM–9PM', pickups:['airport','railway','hotel','partner'] },
    { name:'Surat',     lat:21.1702, lng:72.8311, status:'active', region:'Gujarat', address:'Ring Road, Athwa Lines', phone:'+91-9974106601', hours:'7AM–9PM', pickups:['airport','railway','hotel'] },
    { name:'Vadodara',  lat:22.3072, lng:73.1812, status:'active', region:'Gujarat', address:'Alkapuri, Vadodara', phone:'+91-9624341040', hours:'8AM–8PM', pickups:['railway','hotel','partner'] },
    { name:'Mumbai',    lat:19.0760, lng:72.8777, status:'active', region:'Maharashtra', address:'Bandra West, Mumbai', phone:'+91-9974106601', hours:'6AM–10PM', pickups:['airport','railway','hotel','partner'] },
    { name:'New Delhi', lat:28.6139, lng:77.2090, status:'active', region:'Delhi NCR', address:'Connaught Place, New Delhi', phone:'+91-9624341040', hours:'6AM–11PM', pickups:['airport','railway','hotel','partner'] },
    { name:'Jaipur',    lat:26.9124, lng:75.7873, status:'active', region:'Rajasthan', address:'MI Road, Jaipur', phone:'+91-9974106601', hours:'7AM–9PM', pickups:['airport','railway','hotel'] },
    { name:'Bangalore', lat:12.9716, lng:77.5946, status:'active', region:'Karnataka', address:'MG Road, Bengaluru', phone:'+91-9624341040', hours:'6AM–11PM', pickups:['airport','railway','hotel','partner'] },
    { name:'Goa',       lat:15.2993, lng:74.1240, status:'active', region:'Goa', address:'Panaji, North Goa', phone:'+91-9974106601', hours:'7AM–9PM', pickups:['airport','hotel','partner'] },
    { name:'Pune',      lat:18.5204, lng:73.8567, status:'soon', region:'Maharashtra', address:'Coming Soon', phone:'—', hours:'—', pickups:[] },
    { name:'Hyderabad', lat:17.3850, lng:78.4867, status:'soon', region:'Telangana',   address:'Coming Soon', phone:'—', hours:'—', pickups:[] },
    { name:'Kolkata',   lat:22.5726, lng:88.3639, status:'soon', region:'West Bengal', address:'Coming Soon', phone:'—', hours:'—', pickups:[] },
    { name:'Chandigarh',lat:30.7333, lng:76.7794, status:'soon', region:'Punjab',      address:'Coming Soon', phone:'—', hours:'—', pickups:[] },
  ];

  // Extra pickup point markers (airports, stations)
  const PICKUP_POINTS = [
    { name:'Sardar Patel Airport', lat:23.0733, lng:72.6267, type:'airport', city:'Ahmedabad' },
    { name:'Ahmedabad Jn. Railway', lat:23.0187, lng:72.5980, type:'railway', city:'Ahmedabad' },
    { name:'Surat Airport', lat:21.1146, lng:72.7416, type:'airport', city:'Surat' },
    { name:'Surat Railway Station', lat:21.1983, lng:72.8422, type:'railway', city:'Surat' },
    { name:'IGI Airport Delhi', lat:28.5561, lng:77.1000, type:'airport', city:'New Delhi' },
    { name:'New Delhi Railway Stn.', lat:28.6424, lng:77.2199, type:'railway', city:'New Delhi' },
    { name:'Jaipur Intl. Airport', lat:26.8242, lng:75.8122, type:'airport', city:'Jaipur' },
    { name:'Jaipur Junction', lat:26.9198, lng:75.7883, type:'railway', city:'Jaipur' },
    { name:'Kempegowda Airport', lat:13.1986, lng:77.7066, type:'airport', city:'Bangalore' },
    { name:'KSR Bengaluru', lat:12.9772, lng:77.5705, type:'railway', city:'Bangalore' },
    { name:'Goa Intl. Airport', lat:15.3808, lng:73.8314, type:'airport', city:'Goa' },
    { name:'Mumbai CSMI Airport', lat:19.0896, lng:72.8656, type:'airport', city:'Mumbai' },
    { name:'Mumbai Central', lat:18.9697, lng:72.8194, type:'railway', city:'Mumbai' },
  ];

  let map, locTabActive = 'all';

  function initMap() {
    if (!document.getElementById('plangoMap')) return;

    // Load Leaflet dynamically
    const cssLink = document.createElement('link');
    cssLink.rel='stylesheet'; cssLink.href='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css';
    document.head.appendChild(cssLink);

    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js';
    script.onload = () => buildMap();
    document.head.appendChild(script);
  }

  function buildMap() {
    map = L.map('plangoMap', { zoomControl: true, scrollWheelZoom: false }).setView([22.5, 78.0], 5);

    // Dark tile layer
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
      attribution:'&copy; OpenStreetMap &copy; CartoDB', maxZoom:19
    }).addTo(map);

    // City hub markers
    CITIES.forEach(c => {
      const color = c.status === 'active' ? '#FAE013' : '#ffa500';
      const icon = L.divIcon({
        className: '',
        html: `<div style="width:20px;height:20px;border-radius:50%;background:${color};border:3px solid ${c.status==='active'?'#fff':'rgba(255,255,255,0.5)'};box-shadow:0 0 12px ${color}88;cursor:pointer;"></div>`,
        iconSize:[20,20], iconAnchor:[10,10]
      });
      const popup = c.status === 'active'
        ? `<div class="map-popup-city">📍 ${c.name}</div>
           <div class="map-popup-info">🏢 ${c.address}</div>
           <div class="map-popup-info">📞 ${c.phone}</div>
           <div class="map-popup-info">🕐 ${c.hours}</div>
           <button class="map-popup-btn" onclick="flyToCity(${c.lat},${c.lng},'${c.name}')">View Details</button>`
        : `<div class="map-popup-city">📍 ${c.name}</div>
           <div class="map-popup-info" style="color:#ffa500;font-weight:600">🔜 Service Coming Soon</div>
           <div class="map-popup-info">${c.region}</div>`;

      L.marker([c.lat, c.lng], { icon }).addTo(map).bindPopup(popup, { maxWidth:240 });
    });

    // Pickup point markers (smaller green dots)
    PICKUP_POINTS.forEach(p => {
      const emoji = p.type === 'airport' ? '✈️' : '🚂';
      const icon = L.divIcon({
        className: '',
        html: `<div style="width:14px;height:14px;border-radius:50%;background:#2ecc71;border:2px solid #fff;box-shadow:0 0 8px #2ecc7188;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:7px"></div>`,
        iconSize:[14,14], iconAnchor:[7,7]
      });
      L.marker([p.lat, p.lng], { icon })
        .addTo(map)
        .bindPopup(`<div class="map-popup-city">${emoji} ${p.name}</div><div class="map-popup-info">Pickup Point — ${p.city}</div>`, { maxWidth:200 });
    });
  }

  function flyToCity(lat, lng, name) {
    if (!map) return;
    document.getElementById('locations').scrollIntoView({ behavior:'smooth' });
    setTimeout(() => { map.flyTo([lat, lng], 13, { animate:true, duration:1.2 }); }, 400);
    showToast('📍', name, 'Map zoomed to ' + name + ' hub.');
  }

  // Filter tabs
  function setLocTab(btn, filter) {
    document.querySelectorAll('.loc-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    locTabActive = filter;
    applyLocFilter();
  }

  function applyLocFilter() {
    const q = document.getElementById('citySearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('#cityCardsGrid .city-card');
    let visible = 0;

    cards.forEach(card => {
      const city   = (card.dataset.city || '').toLowerCase();
      const status = card.dataset.status || '';
      const has    = card.dataset.has || '';
      const nameEl = card.querySelector('.city-card-name, .coming-soon-city');
      const text   = (nameEl ? nameEl.textContent : '').toLowerCase();

      let show = true;
      if (q && !city.includes(q) && !text.includes(q)) show = false;
      if (locTabActive === 'active'  && status !== 'active') show = false;
      if (locTabActive === 'soon'    && status !== 'soon')   show = false;
      if (locTabActive === 'airport' && !has.includes('airport')) show = false;
      if (locTabActive === 'railway' && !has.includes('railway')) show = false;

      card.style.display = show ? '' : 'none';
      if (show) visible++;
    });

    document.getElementById('noCityResult').style.display = visible === 0 ? 'block' : 'none';
  }

  function filterCities() { applyLocFilter(); }

  function notifyCity(city) {
    showToast('🔔', 'Registered!', 'You\'ll be notified when we launch in ' + city + '!');
  }

  // Init map when section is in view (lazy)
  let mapInited = false;
  const mapObserver = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting && !mapInited) {
      mapInited = true;
      initMap();
      mapObserver.disconnect();
    }
  }, { threshold: 0.1 });
  const mapSection = document.getElementById('locations');
  if (mapSection) mapObserver.observe(mapSection);
</script>
</body>
</html>
