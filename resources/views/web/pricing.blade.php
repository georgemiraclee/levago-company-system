{{-- resources/views/web/pricing.blade.php --}}
@extends('layouts.web')
@section('title', 'Harga — Levago')

@section('head')
<style>
/* ════ PAGE HERO ════ */
.page-hero {
  background: var(--navy-dark);
  padding: 140px 0 80px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.page-hero::before {
  content: '';
  position: absolute; inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
}
.ph-orb {
  position: absolute; border-radius: 50%; filter: blur(90px); pointer-events: none;
  width: 500px; height: 500px; left: 50%; top: -100px; transform: translateX(-50%);
  background: radial-gradient(circle, rgba(37,99,235,.16), transparent 70%);
}
.page-hero .sec-label { background: rgba(255,255,255,.08); color: rgba(255,255,255,.8); border-color: rgba(255,255,255,.14); display: inline-flex; margin-bottom: 20px; }
.page-hero h1 { font-family: var(--font-display); font-size: clamp(36px,5vw,60px); font-weight: 900; color: #fff; line-height: 1.1; margin-bottom: 16px; position: relative; z-index: 1; }
.page-hero h1 .hl { color: transparent; background: linear-gradient(135deg,#60A5FA,#818CF8); -webkit-background-clip: text; background-clip: text; }
.page-hero p { font-family: var(--font-body); font-size: 17px; color: rgba(255,255,255,.58); max-width: 540px; margin: 0 auto; line-height: 1.8; position: relative; z-index: 1; }

/* ════ TOGGLE ════ */
.pricing-toggle-wrap { display: flex; justify-content: center; align-items: center; gap: 14px; margin-bottom: 56px; }
.toggle-label { font-family: var(--font-body); font-size: 14px; font-weight: 600; color: var(--text-muted); }
.toggle-label.active { color: var(--navy); }
.toggle-switch {
  width: 52px; height: 28px; background: var(--navy); border-radius: 100px;
  cursor: pointer; position: relative; border: 1px solid rgba(255,255,255,.1);
  transition: background .3s;
}
.toggle-knob {
  width: 20px; height: 20px; background: #fff; border-radius: 50%;
  position: absolute; top: 3px; left: 4px;
  transition: transform .3s cubic-bezier(.16,1,.3,1);
  box-shadow: 0 2px 6px rgba(0,0,0,.2);
}
.toggle-switch.annual .toggle-knob { transform: translateX(24px); }
.save-badge { font-family: var(--font-body); font-size: 11px; font-weight: 700; color: #4ADE80; background: rgba(74,222,128,.12); border: 1px solid rgba(74,222,128,.2); padding: 3px 10px; border-radius: 100px; }

/* ════ PRICING GRID ════ */
#pricing { padding: 100px 0; background: var(--gray-50); }
.pricing-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
.pcard {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 36px;
  box-shadow: var(--shadow); position: relative; overflow: hidden;
  transition: all .35s cubic-bezier(.16,1,.3,1);
  display: flex; flex-direction: column;
}
.pcard.featured {
  background: var(--navy); border-color: rgba(96,165,250,.3);
  box-shadow: 0 8px 40px rgba(37,99,235,.25), var(--shadow);
}
.pcard:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
.pcard.featured:hover { box-shadow: 0 20px 60px rgba(37,99,235,.35), var(--shadow-lg); }

.popular-badge {
  position: absolute; top: 20px; right: 20px;
  font-family: var(--font-body); font-size: 10px; font-weight: 700;
  text-transform: uppercase; letter-spacing: .1em;
  background: linear-gradient(135deg, #60A5FA, #818CF8);
  color: #fff; padding: 5px 12px; border-radius: 100px;
}

.pcard-icon { font-size: 36px; margin-bottom: 20px; }
.pcard-name { font-family: var(--font-display); font-size: 22px; font-weight: 900; color: var(--navy); margin-bottom: 6px; }
.pcard.featured .pcard-name { color: #fff; }
.pcard-sub { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); margin-bottom: 24px; line-height: 1.5; }
.pcard.featured .pcard-sub { color: rgba(255,255,255,.55); }

.pcard-price { margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--gray-200); }
.pcard.featured .pcard-price { border-bottom-color: rgba(255,255,255,.1); }
.price-label { font-family: var(--font-body); font-size: 11px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: .1em; margin-bottom: 6px; }
.pcard.featured .price-label { color: rgba(255,255,255,.4); }
.price-main { display: flex; align-items: baseline; gap: 4px; }
.price-currency { font-family: var(--font-display); font-size: 18px; font-weight: 800; color: var(--navy); }
.pcard.featured .price-currency { color: #60A5FA; }
.price-num { font-family: var(--font-display); font-size: 44px; font-weight: 900; color: var(--navy); line-height: 1; }
.pcard.featured .price-num { color: #fff; }
.price-period { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); }
.pcard.featured .price-period { color: rgba(255,255,255,.45); }
.price-orig { font-family: var(--font-body); font-size: 12px; color: var(--text-muted); text-decoration: line-through; margin-top: 4px; }
.price-request { font-family: var(--font-display); font-size: 28px; font-weight: 900; color: var(--navy); }
.pcard.featured .price-request { color: #fff; }
.price-request-sub { font-family: var(--font-body); font-size: 12px; color: var(--text-muted); margin-top: 4px; }
.pcard.featured .price-request-sub { color: rgba(255,255,255,.45); }

.pcard-features { flex: 1; margin-bottom: 28px; }
.feat-row {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 9px 0; border-bottom: 1px solid var(--gray-100);
  font-family: var(--font-body); font-size: 13px; color: var(--text-muted);
}
.pcard.featured .feat-row { border-bottom-color: rgba(255,255,255,.07); color: rgba(255,255,255,.65); }
.feat-row:last-child { border-bottom: none; }
.feat-check { color: var(--accent); font-size: 14px; flex-shrink: 0; margin-top: 1px; }
.pcard.featured .feat-check { color: #4ADE80; }
.feat-row strong { color: var(--navy); }
.pcard.featured .feat-row strong { color: #fff; }

.pcard-btn {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  padding: 14px; border-radius: var(--radius);
  font-family: var(--font-display); font-size: 14px; font-weight: 800;
  text-decoration: none; transition: all .25s; text-align: center;
}
.pcard-btn.primary { background: var(--navy); color: #fff; }
.pcard-btn.primary:hover { background: var(--navy-light); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(10,22,40,.3); }
.pcard-btn.featured-btn { background: #fff; color: var(--navy); }
.pcard-btn.featured-btn:hover { background: var(--gray-100); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(255,255,255,.2); }
.pcard-btn.outline-btn { background: transparent; color: var(--accent); border: 1.5px solid rgba(37,99,235,.25); }
.pcard-btn.outline-btn:hover { background: var(--accent-soft); border-color: var(--accent); }

/* ════ ENTERPRISE ════ */
#enterprise { background: var(--navy); padding: 100px 0; }
.enterprise-wrap {
  display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center;
}
.ent-features { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 32px; }
.ent-feat {
  background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.07);
  border-radius: var(--radius); padding: 20px;
  transition: all .3s;
}
.ent-feat:hover { background: rgba(255,255,255,.08); border-color: rgba(96,165,250,.2); }
.ent-feat-icon { font-size: 24px; margin-bottom: 10px; }
.ent-feat h4 { font-family: var(--font-display); font-size: 13px; font-weight: 800; color: #fff; margin-bottom: 4px; }
.ent-feat p  { font-family: var(--font-body); font-size: 12px; color: rgba(255,255,255,.45); line-height: 1.5; }
.ent-visual {
  background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
  border-radius: var(--radius-lg); padding: 40px;
}
.ent-stat-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; }
.estat {
  background: rgba(255,255,255,.05); border-radius: var(--radius); padding: 24px;
  text-align: center;
}
.estat strong { font-family: var(--font-display); font-size: 32px; font-weight: 900; display: block; background: linear-gradient(135deg,#fff 40%,rgba(96,165,250,.7)); -webkit-background-clip: text; background-clip: text; color: transparent; line-height: 1; }
.estat span { font-family: var(--font-body); font-size: 12px; color: rgba(255,255,255,.4); margin-top: 6px; display: block; }
.ent-contact { background: rgba(37,99,235,.12); border: 1px solid rgba(37,99,235,.2); border-radius: var(--radius); padding: 20px; text-align: center; }
.ent-contact p { font-family: var(--font-body); font-size: 13px; color: rgba(255,255,255,.6); margin-bottom: 14px; line-height: 1.6; }

/* ════ FAQ ════ */
#faq-pricing { padding: 100px 0; background: var(--gray-50); }
.faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 56px; }
.faq-item {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 28px;
  box-shadow: var(--shadow); transition: all .3s;
}
.faq-item:hover { border-color: rgba(37,99,235,.2); box-shadow: var(--shadow-lg); }
.faq-item h4 { font-family: var(--font-display); font-size: 15px; font-weight: 800; color: var(--navy); margin-bottom: 10px; }
.faq-item p  { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); line-height: 1.75; }

/* ════ CTA ════ */
#pricing-cta { background: var(--navy); padding: 100px 0; text-align: center; position: relative; overflow: hidden; }
.pricing-cta-glow { position: absolute; width: 600px; height: 600px; border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%,-50%); background: radial-gradient(circle, rgba(37,99,235,.14), transparent 70%); pointer-events: none; }

/* ════ RESPONSIVE ════ */
@media(max-width:1100px) { .pricing-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:900px) {
  .enterprise-wrap { grid-template-columns: 1fr; }
  .faq-grid { grid-template-columns: 1fr; }
}
@media(max-width:640px) {
  .pricing-grid { grid-template-columns: 1fr; }
  .ent-features { grid-template-columns: 1fr; }
  .ent-stat-row { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

<!-- ════ HERO ════ -->
<div class="page-hero">
  <div class="ph-orb"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="sec-label">💰 Harga Layanan</div>
    <h1>Harga <span class="hl">Transparan</span>,<br>Tanpa Kejutan</h1>
    <p>Berbagai pilihan paket sesuai kebutuhan dan budget bisnis kamu — mulai dari landing page sederhana hingga aplikasi enterprise.</p>
  </div>
</div>

<!-- ════ PRICING ════ -->
<section id="pricing">
  <div class="container">

    <div class="pricing-toggle-wrap js-reveal">
      <span class="toggle-label active" id="lblMonthly">Bulanan</span>
      <div class="toggle-switch" id="pricingToggle" onclick="togglePricing()">
        <div class="toggle-knob" id="toggleKnob"></div>
      </div>
      <span class="toggle-label" id="lblAnnual">Tahunan</span>
      <span class="save-badge">Hemat 15%</span>
    </div>

    <div class="pricing-grid">

      <!-- LANDING PAGE -->
      <div class="pcard js-reveal">
        <div class="pcard-icon">📄</div>
        <div class="pcard-name">Website Landing Page</div>
        <div class="pcard-sub">Solusi terbaik untuk bisnis yang butuh kehadiran digital cepat dan terjangkau.</div>
        <div class="pcard-price">
          <div class="price-label">Starting From</div>
          <div class="price-main">
            <span class="price-currency">Rp</span>
            <span class="price-num" data-monthly="85" data-annual="72">85</span>
            <span class="price-period">rb/bulan</span>
          </div>
          <div class="price-orig" id="origLP" style="display:none">Rp 85rb/bulan</div>
        </div>
        <div class="pcard-features">
          <div class="feat-row"><span class="feat-check">✓</span><span><strong>Server dan Domain</strong> sudah termasuk</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Template Website Premium</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Maintenance & Bug Fixing 1 Tahun</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Add Minor Feature 1 Tahun</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Optimalisasi Mobile</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>WhatsApp Integration</span></div>
        </div>
        <a href="{{ route('contact') }}" class="pcard-btn primary">Pilih Paket Ini →</a>
      </div>

      <!-- WEBSITE CUSTOM — FEATURED -->
      <div class="pcard featured js-reveal">
        <div class="popular-badge">⭐ Paling Populer</div>
        <div class="pcard-icon">✏️</div>
        <div class="pcard-name">Website Custom</div>
        <div class="pcard-sub">Website didesain 100% sesuai brand dan kebutuhan spesifik bisnis kamu.</div>
        <div class="pcard-price">
          <div class="price-label">Starting From</div>
          <div class="price-main">
            <span class="price-currency">Rp</span>
            <span class="price-num" data-monthly="210" data-annual="179">210</span>
            <span class="price-period">rb/bulan</span>
          </div>
          <div class="price-orig" id="origCustom" style="display:none">Rp 210rb/bulan</div>
        </div>
        <div class="pcard-features">
          <div class="feat-row"><span class="feat-check">✓</span><span><strong>Server dan Domain</strong> sudah termasuk</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span><strong>Design by Request</strong> sesuai brand</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Maintenance & Bug Fixing 1 Tahun</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Add Minor Feature (Unlimited)</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Optimalisasi Mobile</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Admin Panel (CMS)</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>SEO Basic Setup</span></div>
        </div>
        <a href="{{ route('contact') }}" class="pcard-btn featured-btn">Pilih Paket Ini →</a>
      </div>

      <!-- WEBSITE APPLICATION -->
      <div class="pcard js-reveal">
        <div class="pcard-icon">⚙️</div>
        <div class="pcard-name">Website Application</div>
        <div class="pcard-sub">Sistem web aplikasi custom sesuai proses bisnis dan alur kerja perusahaan kamu.</div>
        <div class="pcard-price">
          <div class="price-label">Starting From</div>
          <div class="price-request">Request</div>
          <div class="price-request-sub">Harga sesuai kompleksitas fitur</div>
        </div>
        <div class="pcard-features">
          <div class="feat-row"><span class="feat-check">✓</span><span><strong>Server dan Domain</strong> sudah termasuk</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Garansi Bug & Maintenance</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Garansi Design & Keamanan</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Backup Database Otomatis</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Major Feature: Custom Request</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>API Integration</span></div>
        </div>
        <a href="{{ route('contact') }}" class="pcard-btn outline-btn">Diskusi Kebutuhan →</a>
      </div>

      <!-- MOBILE APPLICATION -->
      <div class="pcard js-reveal">
        <div class="pcard-icon">📱</div>
        <div class="pcard-name">Mobile Application</div>
        <div class="pcard-sub">Aplikasi Android & iOS yang siap dipublish di App Store dan Google Play Store.</div>
        <div class="pcard-price">
          <div class="price-label">Starting From</div>
          <div class="price-request">Request</div>
          <div class="price-request-sub">Harga sesuai fitur yang dibutuhkan</div>
        </div>
        <div class="pcard-features">
          <div class="feat-row"><span class="feat-check">✓</span><span><strong>Deploy</strong> App Store & Play Store</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Garansi Bug & Maintenance</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Garansi Design & Keamanan</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Backup Database Otomatis</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Major Feature: Custom Request</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Push Notification</span></div>
        </div>
        <a href="{{ route('contact') }}" class="pcard-btn outline-btn">Diskusi Kebutuhan →</a>
      </div>

      <!-- MULTI PLATFORM -->
      <div class="pcard js-reveal" style="grid-column: span 1;">
        <div class="pcard-icon">🔗</div>
        <div class="pcard-name">Multi Platform</div>
        <div class="pcard-sub">Solusi lengkap — website dan mobile app sekaligus untuk ekosistem digital bisnis kamu.</div>
        <div class="pcard-price">
          <div class="price-label">Starting From</div>
          <div class="price-request">Request</div>
          <div class="price-request-sub">Paket bundling lebih hemat</div>
        </div>
        <div class="pcard-features">
          <div class="feat-row"><span class="feat-check">✓</span><span><strong>Website & Mobile Application</strong></span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Server dan Domain</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Deploy App Store & Play Store</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Garansi Bug & Maintenance</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Backup Database Otomatis</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Major Feature: Custom Request</span></div>
        </div>
        <a href="{{ route('contact') }}" class="pcard-btn outline-btn">Diskusi Kebutuhan →</a>
      </div>

      <!-- E-COMMERCE -->
      <div class="pcard js-reveal">
        <div class="pcard-icon">🛒</div>
        <div class="pcard-name">E-Commerce</div>
        <div class="pcard-sub">Toko online lengkap dengan payment gateway, manajemen produk, dan order tracking.</div>
        <div class="pcard-price">
          <div class="price-label">Starting From</div>
          <div class="price-request">Request</div>
          <div class="price-request-sub">Harga sesuai kebutuhan toko</div>
        </div>
        <div class="pcard-features">
          <div class="feat-row"><span class="feat-check">✓</span><span>Payment Gateway (Midtrans)</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Manajemen Produk & Kategori</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Order Tracking</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Inventory System</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Laporan Penjualan</span></div>
          <div class="feat-row"><span class="feat-check">✓</span><span>Mobile Optimized</span></div>
        </div>
        <a href="{{ route('contact') }}" class="pcard-btn outline-btn">Diskusi Kebutuhan →</a>
      </div>

    </div>
  </div>
</section>

<!-- ════ ENTERPRISE ════ -->
<section id="enterprise">
  <div class="container">
    <div class="enterprise-wrap">
      <div>
        <div class="sec-label js-reveal" style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.12)">🏢 Enterprise</div>
        <h2 class="sec-title js-reveal" style="color:#fff">Butuh Solusi <span style="color:#60A5FA">Skala Besar?</span></h2>
        <p class="js-reveal" style="font-family:var(--font-body);color:rgba(255,255,255,.55);font-size:15px;line-height:1.85;margin-bottom:28px">Untuk project enterprise dengan kebutuhan khusus, tim, SLA, dan dukungan prioritas — kami siapkan paket yang benar-benar sesuai.</p>
        <div class="ent-features js-reveal">
          <div class="ent-feat"><div class="ent-feat-icon">⚡</div><h4>Dedicated Team</h4><p>Tim developer khusus yang fokus penuh pada project kamu.</p></div>
          <div class="ent-feat"><div class="ent-feat-icon">🛡️</div><h4>SLA Guarantee</h4><p>Service Level Agreement dengan uptime dan response time terjamin.</p></div>
          <div class="ent-feat"><div class="ent-feat-icon">🔐</div><h4>Security Audit</h4><p>Audit keamanan berkala dan penetration testing.</p></div>
          <div class="ent-feat"><div class="ent-feat-icon">📊</div><h4>Custom Reporting</h4><p>Dashboard dan laporan performa custom sesuai KPI bisnis kamu.</p></div>
        </div>
      </div>
      <div class="ent-visual js-reveal">
        <div class="ent-stat-row">
          <div class="estat"><strong>50+</strong><span>Project Enterprise</span></div>
          <div class="estat"><strong>99.9%</strong><span>Uptime SLA</span></div>
          <div class="estat"><strong>24/7</strong><span>Priority Support</span></div>
          <div class="estat"><strong>100%</strong><span>Garansi Revisi</span></div>
        </div>
        <div class="ent-contact">
          <p>Konsultasi langsung dengan tim kami untuk mendapatkan proposal dan penawaran khusus sesuai kebutuhan.</p>
          <a href="https://wa.me/6285861126558?text=Hi%20Levago!%20Saya%20tertarik%20dengan%20paket%20Enterprise" target="_blank" rel="noopener" class="btn-primary" style="background:#fff;color:var(--navy);display:inline-flex">💬 Hubungi Tim Enterprise</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════ FAQ ════ -->
<section id="faq-pricing">
  <div class="container">
    <div class="js-reveal" style="text-align:center">
      <div class="sec-label">❓ FAQ</div>
      <h2 class="sec-title">Pertanyaan yang Sering Ditanyakan</h2>
    </div>
    <div class="faq-grid">
      @php
        $faqs = [
          ['q'=>'Apakah ada biaya tersembunyi?', 'a'=>'Tidak ada biaya tersembunyi sama sekali. Semua biaya sudah dijelaskan di awal dan kamu akan mendapatkan invoice yang detail sebelum memulai project.'],
          ['q'=>'Berapa lama proses pengerjaan?', 'a'=>'Landing page: 3-7 hari kerja. Website custom: 2-4 minggu. Aplikasi: 1-3 bulan tergantung kompleksitas fitur yang dibutuhkan.'],
          ['q'=>'Apakah bisa cicilan?', 'a'=>'Ya, kami menerima pembayaran dengan sistem DP 50% di awal dan pelunasan setelah project selesai. Untuk project besar, bisa diatur pembayaran bertahap.'],
          ['q'=>'Apa yang termasuk dalam maintenance?', 'a'=>'Bug fixing, update keamanan, update minor konten, backup data rutin, dan monitoring uptime. Semua ini sudah termasuk dalam paket selama 1 tahun.'],
          ['q'=>'Bisa revisi berapa kali?', 'a'=>'Tidak terbatas! Kami terus revisi sampai kamu benar-benar puas dengan hasilnya. Kepuasan klien adalah prioritas utama kami.'],
          ['q'=>'Apakah domain dan hosting sudah termasuk?', 'a'=>'Ya, untuk paket Landing Page dan Website Custom, domain .com/.id dan hosting sudah termasuk dalam harga yang tertera.'],
          ['q'=>'Bagaimana jika saya ingin menambah fitur?', 'a'=>'Fitur minor bisa ditambahkan tanpa biaya tambahan selama masa maintenance 1 tahun. Untuk fitur major, kami akan berdiskusi dan memberikan penawaran yang transparan.'],
          ['q'=>'Apakah ada garansi setelah website live?', 'a'=>'Ya! Semua project dilindungi garansi bug fix selama 1 tahun. Jika ada issue teknis, kami langsung tangani tanpa biaya tambahan.'],
        ];
      @endphp
      @foreach($faqs as $faq)
      <div class="faq-item js-reveal">
        <h4>{{ $faq['q'] }}</h4>
        <p>{{ $faq['a'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ════ CTA ════ -->
<section id="pricing-cta">
  <div class="pricing-cta-glow"></div>
  <div class="container">
    <div class="js-reveal" style="position:relative;z-index:1;text-align:center">
      <div class="sec-label" style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.12);display:table;margin:0 auto 24px">🤝 Mulai Kolaborasi</div>
      <h2 class="sec-title" style="color:#fff;max-width:560px;margin:0 auto 14px">Bergabung Bersama 50+ Bisnis yang Sudah Percaya Levago</h2>
      <p style="font-family:var(--font-body);color:rgba(255,255,255,.5);font-size:16px;max-width:460px;margin:0 auto 36px;line-height:1.8">Konsultasi pertama gratis — kami bantu temukan paket yang paling tepat dan hemat untuk bisnis kamu.</p>
      <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
        <a href="https://wa.me/6285861126558?text=Hi%20Levago!%20Saya%20Mau%20Konsultasi" target="_blank" rel="noopener" class="btn-primary">💬 Chat WhatsApp Gratis</a>
        <a href="{{ route('contact') }}" class="btn-ghost">📋 Isi Form Konsultasi</a>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
var isAnnual = false;

function togglePricing() {
  isAnnual = !isAnnual;
  const toggle = document.getElementById('pricingToggle');
  const lblM = document.getElementById('lblMonthly');
  const lblA = document.getElementById('lblAnnual');
  const origLP = document.getElementById('origLP');
  const origCustom = document.getElementById('origCustom');

  if (isAnnual) {
    toggle.classList.add('annual');
    lblA.classList.add('active');
    lblM.classList.remove('active');
    if (origLP) origLP.style.display = 'block';
    if (origCustom) origCustom.style.display = 'block';
  } else {
    toggle.classList.remove('annual');
    lblM.classList.add('active');
    lblA.classList.remove('active');
    if (origLP) origLP.style.display = 'none';
    if (origCustom) origCustom.style.display = 'none';
  }

  document.querySelectorAll('.price-num').forEach(function(el) {
    const monthly = el.dataset.monthly;
    const annual = el.dataset.annual;
    if (!monthly) return;

    el.style.transform = 'translateY(-10px)';
    el.style.opacity = '0';
    el.style.transition = 'all .25s';

    setTimeout(function() {
      el.textContent = isAnnual ? annual : monthly;
      el.style.transform = 'translateY(0)';
      el.style.opacity = '1';
    }, 150);
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add("show");
    });
  }, { threshold: 0.1 });
  document.querySelectorAll(".js-reveal").forEach(el => observer.observe(el));
});
</script>
@endsection