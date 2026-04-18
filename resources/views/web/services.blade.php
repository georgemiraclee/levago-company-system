{{-- resources/views/web/services.blade.php --}}
@extends('layouts.web')
@section('title', 'Layanan — Levago')

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
.page-hero-orb {
  position: absolute; border-radius: 50%; filter: blur(90px); pointer-events: none;
}
.ph-orb-a {
  width: 500px; height: 500px; left: 50%; top: -100px;
  transform: translateX(-50%);
  background: radial-gradient(circle, rgba(37,99,235,.16), transparent 70%);
}
.page-hero .sec-label {
  background: rgba(255,255,255,.08); color: rgba(255,255,255,.8);
  border-color: rgba(255,255,255,.14); display: inline-flex; margin-bottom: 20px;
}
.page-hero h1 {
  font-family: var(--font-display);
  font-size: clamp(36px, 5vw, 60px);
  font-weight: 900; color: var(--white);
  line-height: 1.1; margin-bottom: 16px;
  position: relative; z-index: 1;
}
.page-hero h1 .hl {
  color: transparent;
  background: linear-gradient(135deg, #60A5FA, #818CF8);
  -webkit-background-clip: text; background-clip: text;
}
.page-hero p {
  font-family: var(--font-body); font-size: 17px;
  color: rgba(255,255,255,.58); max-width: 540px; margin: 0 auto;
  line-height: 1.8; position: relative; z-index: 1;
}

/* ════ SERVICE DETAIL CARDS ════ */
.svc-detail-section { padding: 100px 0; }
.svc-detail-section:nth-child(even) { background: var(--gray-50); }
.svc-detail-section:nth-child(odd) { background: #fff; }

.svc-block {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 72px; align-items: center;
}
.svc-block.reverse { direction: rtl; }
.svc-block.reverse > * { direction: ltr; }

.svc-visual {
  border-radius: var(--radius-lg); overflow: hidden;
  position: relative; aspect-ratio: 4/3;
}
.svc-visual-inner {
  width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
  background: var(--navy); position: relative; overflow: hidden;
}
.svc-visual-inner::before {
  content: ''; position: absolute; inset: 0;
  background: radial-gradient(ellipse at 70% 30%, rgba(37,99,235,.25), transparent 60%);
}
.svc-visual-icon { font-size: 80px; position: relative; z-index: 1; }
.svc-visual-deco {
  position: absolute; border-radius: 50%;
  border: 1px solid rgba(255,255,255,.06); pointer-events: none;
}
.deco-1 { width: 200px; height: 200px; right: -50px; top: -50px; }
.deco-2 { width: 300px; height: 300px; right: -100px; top: -100px; }
.deco-3 { width: 400px; height: 400px; right: -150px; top: -150px; }

/* floating badge on visual */
.svc-badge {
  position: absolute; bottom: 20px; left: 20px;
  background: rgba(255,255,255,.1); backdrop-filter: blur(16px);
  border: 1px solid rgba(255,255,255,.15);
  border-radius: var(--radius); padding: 12px 18px; z-index: 2;
}
.svc-badge strong { font-family: var(--font-display); font-size: 20px; font-weight: 900; color: #fff; display: block; }
.svc-badge span { font-family: var(--font-body); font-size: 11px; color: rgba(255,255,255,.55); }

.svc-content .sec-label { margin-bottom: 12px; }
.svc-content h2.sec-title { margin-bottom: 14px; }
.svc-content p {
  font-family: var(--font-body); font-size: 15px; color: var(--text-muted);
  line-height: 1.85; margin-bottom: 28px;
}

/* feature list */
.feat-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 32px; }
.feat-item {
  display: flex; align-items: flex-start; gap: 14px;
  background: var(--gray-50); border: 1px solid var(--gray-200);
  border-radius: var(--radius); padding: 14px 18px;
  transition: all .25s;
}
.feat-item:hover { border-color: rgba(37,99,235,.2); background: var(--accent-soft); }
.feat-icon { width: 36px; height: 36px; flex-shrink: 0; border-radius: 10px; background: var(--accent-soft); display: flex; align-items: center; justify-content: center; font-size: 16px; }
.feat-text h5 { font-family: var(--font-display); font-size: 13px; font-weight: 800; color: var(--navy); margin-bottom: 2px; }
.feat-text p  { font-family: var(--font-body); font-size: 12px; color: var(--text-muted); line-height: 1.5; margin: 0; }

.svc-cta-row { display: flex; gap: 12px; flex-wrap: wrap; }

/* ════ ALL SERVICES GRID ════ */
#all-services { background: var(--gray-50); padding: 100px 0; }
.services-mega-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 56px; }
.smcard {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 32px;
  box-shadow: var(--shadow); position: relative; overflow: hidden;
  transition: all .35s cubic-bezier(.16,1,.3,1);
  text-decoration: none; color: inherit; display: block;
}
.smcard::after {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(37,99,235,.04), transparent 55%);
  opacity: 0; transition: opacity .35s;
}
.smcard:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); border-color: rgba(37,99,235,.2); }
.smcard:hover::after { opacity: 1; }
.smcard:hover .smcard-arrow { transform: translateX(4px); }
.smcard-icon { font-size: 36px; margin-bottom: 18px; }
.smcard h3 { font-family: var(--font-display); font-size: 18px; font-weight: 800; color: var(--navy); margin-bottom: 10px; }
.smcard p  { font-family: var(--font-body); font-size: 14px; color: var(--text-muted); line-height: 1.7; margin-bottom: 20px; }
.smcard-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 20px; }
.smcard-tag { font-family: var(--font-body); font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 100px; background: var(--navy-soft); color: var(--navy); }
.smcard-footer { display: flex; align-items: center; justify-content: space-between; }
.smcard-price { font-family: var(--font-display); font-size: 13px; font-weight: 700; color: var(--accent); }
.smcard-arrow { font-size: 16px; color: var(--accent); transition: transform .25s; }

/* ════ TECH STACK ════ */
#tech-stack { background: var(--navy); padding: 80px 0; }
.tech-wrap { display: grid; grid-template-columns: 1fr 2fr; gap: 64px; align-items: center; }
.tech-cats { display: flex; flex-direction: column; gap: 24px; }
.tech-cat h4 { font-family: var(--font-body); font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: rgba(255,255,255,.32); margin-bottom: 10px; }
.tech-cat .ttags { display: flex; flex-wrap: wrap; gap: 8px; }
.ttag-item {
  font-family: var(--font-body); font-size: 12px; font-weight: 500;
  padding: 6px 14px; border-radius: 100px;
  border: 1px solid rgba(255,255,255,.1); color: rgba(255,255,255,.62);
  background: rgba(255,255,255,.05); transition: all .22s; cursor: default;
}
.ttag-item:hover { background: rgba(96,165,250,.14); border-color: rgba(96,165,250,.3); color: #60A5FA; }

/* ════ PROCESS ════ */
#process { background: var(--gray-50); padding: 100px 0; }
.process-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 56px; }
.proc-card {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 32px;
  box-shadow: var(--shadow); position: relative;
  transition: all .3s cubic-bezier(.16,1,.3,1);
}
.proc-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: rgba(37,99,235,.2); }
.proc-num {
  font-family: var(--font-display); font-size: 48px; font-weight: 900;
  background: linear-gradient(135deg, rgba(37,99,235,.15), rgba(129,140,248,.08));
  -webkit-background-clip: text; background-clip: text; color: transparent;
  line-height: 1; margin-bottom: 14px;
}
.proc-card h3 { font-family: var(--font-display); font-size: 16px; font-weight: 800; color: var(--navy); margin-bottom: 8px; }
.proc-card p  { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); line-height: 1.65; }

/* ════ CTA ════ */
#svc-cta { background: var(--navy); padding: 100px 0; text-align: center; position: relative; overflow: hidden; }
.svc-cta-glow {
  position: absolute; width: 600px; height: 600px; border-radius: 50%;
  top: 50%; left: 50%; transform: translate(-50%,-50%);
  background: radial-gradient(circle, rgba(37,99,235,.14), transparent 70%);
  pointer-events: none;
}

/* ════ RESPONSIVE ════ */
@media(max-width:900px) {
  .svc-block, .svc-block.reverse { grid-template-columns: 1fr; direction: ltr; }
  .svc-visual { aspect-ratio: 16/9; }
  .tech-wrap { grid-template-columns: 1fr; }
  .process-grid { grid-template-columns: 1fr 1fr; }
}
@media(max-width:640px) {
  .process-grid { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('content')

<!-- ════ HERO ════ -->
<div class="page-hero">
  <div class="page-hero-orb ph-orb-a"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="sec-label">🧩 Layanan</div>
    <h1>Hadir untuk Menyelesaikan<br><span class="hl">Permasalahan Digital</span> Kamu</h1>
    <p>Dari website landing page hingga aplikasi mobile kompleks — Levago punya solusi untuk setiap kebutuhan bisnis kamu.</p>
  </div>
</div>

<!-- ════ WEBSITE DESIGN ════ -->
<section class="svc-detail-section">
  <div class="container">
    <div class="svc-block">
      <div class="svc-visual js-reveal">
        <div class="svc-visual-inner">
          <div class="svc-visual-deco deco-1"></div>
          <div class="svc-visual-deco deco-2"></div>
          <div class="svc-visual-deco deco-3"></div>
          <div class="svc-visual-icon">🎨</div>
          <div class="svc-badge"><strong>Custom</strong><span>Bukan Template</span></div>
        </div>
      </div>
      <div class="svc-content">
        <div class="sec-label js-reveal">🖥️ Website Design</div>
        <h2 class="sec-title js-reveal">Landing Page &amp; Company Website Profesional</h2>
        <p class="js-reveal">Levago memberikan kebutuhan website landing page, desain, domain, hosting, pengoperasian, dan maintenance — semua dalam satu paket yang terjangkau.</p>
        <div class="feat-list js-reveal">
          <div class="feat-item"><div class="feat-icon">📄</div><div class="feat-text"><h5>Website Template</h5><p>Dapatkan website terbaik dan termurah dengan template premium yang siap pakai.</p></div></div>
          <div class="feat-item"><div class="feat-icon">✏️</div><div class="feat-text"><h5>Website Custom</h5><p>Levago dapat mewujudkan website idaman persis seperti yang kamu harapkan.</p></div></div>
          <div class="feat-item"><div class="feat-icon">📱</div><div class="feat-text"><h5>Mobile Optimized</h5><p>Tampilan sempurna di semua perangkat — desktop, tablet, dan smartphone.</p></div></div>
          <div class="feat-item"><div class="feat-icon">🔍</div><div class="feat-text"><h5>SEO-Friendly</h5><p>Dioptimasi agar bisnis kamu mudah ditemukan di Google dan mesin pencari lainnya.</p></div></div>
        </div>
        <div class="svc-cta-row js-reveal">
          <a href="{{ route('pricing') }}" class="btn-primary" style="background:var(--navy);color:#fff">Lihat Harga →</a>
          <a href="{{ route('contact') }}" class="btn-outline">Konsultasi Gratis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════ APPLICATION ════ -->
<section class="svc-detail-section">
  <div class="container">
    <div class="svc-block reverse">
      <div class="svc-visual js-reveal">
        <div class="svc-visual-inner" style="background:linear-gradient(135deg,#0A1628,#0F2040)">
          <div class="svc-visual-deco deco-1" style="border-color:rgba(129,140,248,.1)"></div>
          <div class="svc-visual-deco deco-2" style="border-color:rgba(129,140,248,.07)"></div>
          <div class="svc-visual-deco deco-3" style="border-color:rgba(129,140,248,.04)"></div>
          <div class="svc-visual-icon">📱</div>
          <div class="svc-badge" style="border-color:rgba(129,140,248,.2)"><strong>Cross</strong><span>Platform App</span></div>
        </div>
      </div>
      <div class="svc-content">
        <div class="sec-label js-reveal">⚙️ Application Development</div>
        <h2 class="sec-title js-reveal">Website App &amp; <span style="color:var(--accent)">Mobile Application</span></h2>
        <p class="js-reveal">Levago memberikan solusi untuk mempermudah pekerjaan dengan sistem website dan merancang aplikasi sesuai keinginan yang dapat diakses kapan saja melalui berbagai device.</p>
        <div class="feat-list js-reveal">
          <div class="feat-item"><div class="feat-icon">🌐</div><div class="feat-text"><h5>Website Application</h5><p>Sistem web-based yang dapat diakses dari browser tanpa perlu install apapun.</p></div></div>
          <div class="feat-item"><div class="feat-icon">📲</div><div class="feat-text"><h5>Mobile Application</h5><p>Aplikasi native/hybrid untuk Android dan iOS dengan performa tinggi.</p></div></div>
          <div class="feat-item"><div class="feat-icon">🗄️</div><div class="feat-text"><h5>Database & Backend</h5><p>Arsitektur backend solid dengan keamanan data dan backup otomatis.</p></div></div>
          <div class="feat-item"><div class="feat-icon">🔗</div><div class="feat-text"><h5>API Integration</h5><p>Integrasi dengan sistem third-party, payment gateway, dan layanan eksternal.</p></div></div>
        </div>
        <div class="svc-cta-row js-reveal">
          <a href="{{ route('pricing') }}" class="btn-primary" style="background:var(--navy);color:#fff">Lihat Harga →</a>
          <a href="{{ route('contact') }}" class="btn-outline">Konsultasi Gratis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════ DIGITAL MARKETING ════ -->
<section class="svc-detail-section">
  <div class="container">
    <div class="svc-block">
      <div class="svc-visual js-reveal">
        <div class="svc-visual-inner" style="background:linear-gradient(135deg,#0F2040,#1a0a40)">
          <div class="svc-visual-deco deco-1" style="border-color:rgba(167,139,250,.1)"></div>
          <div class="svc-visual-deco deco-2" style="border-color:rgba(167,139,250,.07)"></div>
          <div class="svc-visual-deco deco-3" style="border-color:rgba(167,139,250,.04)"></div>
          <div class="svc-visual-icon">📣</div>
          <div class="svc-badge" style="border-color:rgba(167,139,250,.2)"><strong>+240%</strong><span>Growth Rate</span></div>
        </div>
      </div>
      <div class="svc-content">
        <div class="sec-label js-reveal">📊 Digital Marketing</div>
        <h2 class="sec-title js-reveal">Tingkatkan <span style="color:var(--accent)">Online Presence</span> &amp; Brand Awareness</h2>
        <p class="js-reveal">Levago tidak hanya menyediakan solusi teknologi canggih, tetapi juga mengoptimalkan strategi pemasaran digital untuk memastikan kesuksesan bisnis kamu secara menyeluruh.</p>
        <div class="feat-list js-reveal">
          <div class="feat-item"><div class="feat-icon">📸</div><div class="feat-text"><h5>Social Media Management</h5><p>Kelola konten dan engagement media sosial bisnis kamu secara profesional.</p></div></div>
          <div class="feat-item"><div class="feat-icon">🔍</div><div class="feat-text"><h5>SEO Optimization</h5><p>Strategi SEO on-page dan off-page untuk meningkatkan ranking organik.</p></div></div>
          <div class="feat-item"><div class="feat-icon">📧</div><div class="feat-text"><h5>Content Strategy</h5><p>Perencanaan konten yang menarik dan relevan untuk target audiens kamu.</p></div></div>
          <div class="feat-item"><div class="feat-icon">📈</div><div class="feat-text"><h5>Analytics & Reporting</h5><p>Laporan berkala dengan insight actionable untuk mengoptimalkan strategi.</p></div></div>
        </div>
        <div class="svc-cta-row js-reveal">
          <a href="{{ route('contact') }}" class="btn-primary" style="background:var(--navy);color:#fff">Diskusi Kebutuhan</a>
          <a href="{{ route('contact') }}" class="btn-outline">Konsultasi Gratis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════ ALL SERVICES GRID ════ -->
<section id="all-services">
  <div class="container">
    <div class="js-reveal" style="text-align:center">
      <div class="sec-label">🗂️ Semua Layanan</div>
      <h2 class="sec-title">Pilih Solusi yang Tepat</h2>
      <p class="sec-sub" style="margin:0 auto">Kami siap menangani berbagai kebutuhan digital bisnis kamu.</p>
    </div>
    <div class="services-mega-grid">
      @php
        $allServices = [
          ['icon'=>'🏢','title'=>'Company Profile','desc'=>'Website profesional yang membangun trust dan meningkatkan kredibilitas bisnis kamu di mata calon klien.','tags'=>['Laravel','Tailwind','SEO'],'price'=>'Mulai 85K/bln'],
          ['icon'=>'🎯','title'=>'Landing Page','desc'=>'Halaman penjualan yang dioptimasi untuk konversi tinggi dengan copywriting persuasif dan desain menarik.','tags'=>['Conversion','Analytics','WA Integration'],'price'=>'Mulai 85K/bln'],
          ['icon'=>'🛒','title'=>'E-Commerce','desc'=>'Toko online lengkap dengan manajemen produk, payment gateway, dan sistem order tracking yang mudah.','tags'=>['Payment','Inventory','Midtrans'],'price'=>'Mulai 210K/bln'],
          ['icon'=>'⚙️','title'=>'Custom Web App','desc'=>'Aplikasi web yang dirancang khusus sesuai proses bisnis kamu — dari sistem inventory hingga CRM.','tags'=>['Laravel','React','MySQL'],'price'=>'Harga Khusus'],
          ['icon'=>'📱','title'=>'Mobile App','desc'=>'Aplikasi Android & iOS yang dibangun dengan teknologi modern, siap deploy ke App Store dan Play Store.','tags'=>['React Native','iOS','Android'],'price'=>'Harga Khusus'],
          ['icon'=>'🔗','title'=>'Multi Platform','desc'=>'Solusi website dan mobile app sekaligus — ekosistem digital lengkap untuk bisnis yang ingin scale.','tags'=>['Web','Mobile','API'],'price'=>'Harga Khusus'],
        ];
      @endphp
      @foreach($allServices as $svc)
      <a href="{{ route('contact') }}" class="smcard js-reveal">
        <div class="smcard-icon">{{ $svc['icon'] }}</div>
        <h3>{{ $svc['title'] }}</h3>
        <p>{{ $svc['desc'] }}</p>
        <div class="smcard-tags">@foreach($svc['tags'] as $tag)<span class="smcard-tag">{{ $tag }}</span>@endforeach</div>
        <div class="smcard-footer">
          <span class="smcard-price">{{ $svc['price'] }}</span>
          <span class="smcard-arrow">→</span>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>

<!-- ════ TECH STACK ════ -->
<section id="tech-stack">
  <div class="container">
    <div class="tech-wrap">
      <div>
        <div class="sec-label js-reveal" style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.12)">🛠️ Tech Stack</div>
        <h2 class="sec-title js-reveal" style="color:#fff">Teknologi <span style="color:#60A5FA">Modern</span> yang Kami Gunakan</h2>
        <p class="js-reveal" style="font-family:var(--font-body);color:rgba(255,255,255,.5);font-size:15px;line-height:1.8">Stack pilihan kami memastikan website kamu cepat, aman, dan mudah di-maintain untuk jangka panjang.</p>
      </div>
      <div class="tech-cats js-reveal">
        <div class="tech-cat">
          <h4>Frontend</h4>
          <div class="ttags"><span class="ttag-item">Laravel Blade</span><span class="ttag-item">Tailwind CSS</span><span class="ttag-item">React</span><span class="ttag-item">Next.js</span><span class="ttag-item">Vue.js</span></div>
        </div>
        <div class="tech-cat">
          <h4>Backend</h4>
          <div class="ttags"><span class="ttag-item">Laravel</span><span class="ttag-item">Node.js</span><span class="ttag-item">Filament</span><span class="ttag-item">MySQL</span><span class="ttag-item">PostgreSQL</span></div>
        </div>
        <div class="tech-cat">
          <h4>Mobile</h4>
          <div class="ttags"><span class="ttag-item">React Native</span><span class="ttag-item">Expo</span><span class="ttag-item">Flutter</span></div>
        </div>
        <div class="tech-cat">
          <h4>DevOps & Hosting</h4>
          <div class="ttags"><span class="ttag-item">VPS Hostinger</span><span class="ttag-item">Docker</span><span class="ttag-item">GitHub CI/CD</span><span class="ttag-item">Nginx</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════ PROCESS ════ -->
<section id="process">
  <div class="container">
    <div class="js-reveal" style="text-align:center">
      <div class="sec-label">⚙️ Cara Kerja</div>
      <h2 class="sec-title">Bagaimana Proses Kerjanya?</h2>
      <p class="sec-sub" style="margin:0 auto">Proses yang terencana dan transparan dari awal hingga akhir.</p>
    </div>
    <div class="process-grid">
      @php
        $steps = [
          ['num'=>'01','title'=>'Konsultasi Gratis','desc'=>'Diskusi kebutuhan, tujuan bisnis, dan ekspektasi kamu secara detail tanpa biaya apapun.'],
          ['num'=>'02','title'=>'Proposal & Konsep','desc'=>'Kami siapkan desain UI/UX mockup dan proposal teknis + timeline yang terperinci.'],
          ['num'=>'03','title'=>'Development','desc'=>'Proses build dengan laporan progress mingguan agar kamu selalu update perkembangan project.'],
          ['num'=>'04','title'=>'Review & Revisi','desc'=>'Feedback session dan revisi hingga kamu benar-benar puas dengan hasilnya.'],
          ['num'=>'05','title'=>'Go Live','desc'=>'Deploy ke server dan website resmi online, beserta training cara penggunaan admin panel.'],
          ['num'=>'06','title'=>'Maintenance','desc'=>'Dukungan teknis berkelanjutan — update, bug fix, dan minor feature tanpa biaya tambahan.'],
        ];
      @endphp
      @foreach($steps as $step)
      <div class="proc-card js-reveal">
        <div class="proc-num">{{ $step['num'] }}</div>
        <h3>{{ $step['title'] }}</h3>
        <p>{{ $step['desc'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ════ CTA ════ -->
<section id="svc-cta">
  <div class="svc-cta-glow"></div>
  <div class="container">
    <div class="js-reveal" style="position:relative;z-index:1;text-align:center">
      <div class="sec-label" style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.12);display:table;margin:0 auto 24px">🚀 Mulai Sekarang</div>
      <h2 class="sec-title" style="color:#fff;max-width:560px;margin:0 auto 14px">Tidak Yakin Layanan Mana yang Tepat?</h2>
      <p style="font-family:var(--font-body);color:rgba(255,255,255,.5);font-size:16px;max-width:460px;margin:0 auto 36px;line-height:1.8">Konsultasi gratis dengan tim kami — kami bantu tentukan solusi paling tepat untuk bisnis kamu.</p>
      <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
        <a href="https://wa.me/6285861126558?text=Hi%20Levago!%20Saya%20Mau%20Konsultasi" target="_blank" rel="noopener" class="btn-primary">💬 Chat WhatsApp</a>
        <a href="{{ route('contact') }}" class="btn-ghost">📋 Isi Form Konsultasi</a>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add("show");
    });
  }, { threshold: 0.12 });
  document.querySelectorAll(".js-reveal").forEach(el => observer.observe(el));
});
</script>
@endsection