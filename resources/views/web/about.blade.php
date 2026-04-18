{{-- resources/views/web/about.blade.php --}}
@extends('layouts.web')
@section('title', 'Tentang Kami — Levago')

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
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
}
.page-hero-orb {
  position: absolute; border-radius: 50%; filter: blur(90px); pointer-events: none;
}
.ph-orb-a { width: 500px; height: 500px; left: 50%; top: -100px; transform: translateX(-50%); background: radial-gradient(circle, rgba(37,99,235,.16), transparent 70%); }
.page-hero .sec-label { background: rgba(255,255,255,.08); color: rgba(255,255,255,.8); border-color: rgba(255,255,255,.14); display: inline-flex; margin-bottom: 20px; }
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

/* ════ STORY ════ */
#about-story { padding: 100px 0; background: #fff; }
.story-wrap { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
.story-img-wrap { position: relative; }
.story-img-main {
  width: 100%; border-radius: var(--radius-lg);
  object-fit: cover; aspect-ratio: 4/3;
  box-shadow: var(--shadow-lg);
}
.story-badge-float {
  position: absolute; bottom: -20px; right: -20px;
  background: var(--navy); border-radius: var(--radius);
  padding: 18px 24px; box-shadow: var(--shadow-lg);
  border: 1px solid rgba(255,255,255,.08);
}
.story-badge-float strong {
  font-family: var(--font-display); font-size: 28px; font-weight: 900; color: #fff; display: block; line-height: 1;
}
.story-badge-float span { font-family: var(--font-body); font-size: 12px; color: rgba(255,255,255,.45); margin-top: 4px; display: block; }
.story-content p {
  font-family: var(--font-body); font-size: 16px; color: var(--text-muted); line-height: 1.85;
  margin-bottom: 20px;
}
.story-values { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 32px; }
.sval {
  background: var(--gray-50); border: 1px solid var(--gray-200);
  border-radius: var(--radius); padding: 18px;
  transition: all .3s;
}
.sval:hover { border-color: rgba(37,99,235,.2); background: var(--accent-soft); }
.sval-icon { font-size: 22px; margin-bottom: 8px; }
.sval h4 { font-family: var(--font-display); font-size: 14px; font-weight: 800; color: var(--navy); margin-bottom: 4px; }
.sval p { font-family: var(--font-body); font-size: 12px; color: var(--text-muted); line-height: 1.55; margin: 0; }

/* ════ WHY US ════ */
#why-us { background: var(--gray-50); padding: 100px 0; }
.why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 56px; }
.why-card {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 36px;
  box-shadow: var(--shadow); position: relative; overflow: hidden;
  transition: all .35s cubic-bezier(.16,1,.3,1);
}
.why-card::after {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, var(--accent), #818CF8);
  transform: scaleX(0); transform-origin: left;
  transition: transform .35s cubic-bezier(.16,1,.3,1);
}
.why-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
.why-card:hover::after { transform: scaleX(1); }
.why-num {
  font-family: var(--font-display); font-size: 56px; font-weight: 900;
  color: var(--navy-soft); line-height: 1; margin-bottom: 16px;
  background: linear-gradient(135deg, rgba(37,99,235,.12), rgba(129,140,248,.08));
  -webkit-background-clip: text; background-clip: text; color: transparent;
}
.why-card h3 { font-family: var(--font-display); font-size: 18px; font-weight: 800; color: var(--navy); margin-bottom: 10px; }
.why-card p  { font-family: var(--font-body); font-size: 14px; color: var(--text-muted); line-height: 1.75; }

/* ════ TEAM ════ */
#team { padding: 100px 0; background: #fff; }
.team-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 56px; }
.team-card {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); overflow: hidden;
  box-shadow: var(--shadow); text-align: center;
  transition: all .35s cubic-bezier(.16,1,.3,1);
}
.team-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); border-color: rgba(37,99,235,.2); }
.team-card:hover .team-avatar { transform: scale(1.05); }
.team-photo {
  height: 200px; overflow: hidden; background: var(--navy-soft);
  display: flex; align-items: center; justify-content: center;
}
.team-avatar { width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform .5s cubic-bezier(.16,1,.3,1); }
.team-avatar-placeholder {
  width: 80px; height: 80px; border-radius: 50%;
  background: linear-gradient(135deg, var(--accent), #818CF8);
  display: flex; align-items: center; justify-content: center;
  font-size: 32px; color: white;
}
.team-info { padding: 20px 16px; }
.team-info h4 { font-family: var(--font-display); font-size: 15px; font-weight: 800; color: var(--navy); margin-bottom: 5px; line-height: 1.3; }
.team-role {
  font-family: var(--font-body); font-size: 11px; font-weight: 600;
  color: var(--accent); text-transform: uppercase; letter-spacing: .08em;
  background: var(--accent-soft); padding: 4px 10px; border-radius: 100px;
  display: inline-block; margin-top: 4px;
}

/* ════ MILESTONES ════ */
#milestones { background: var(--navy); padding: 100px 0; }
.milestone-wrap { display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }
.mile-list { display: flex; flex-direction: column; gap: 0; position: relative; }
.mile-list::before {
  content: ''; position: absolute; left: 22px; top: 0; bottom: 0; width: 2px;
  background: linear-gradient(to bottom, var(--accent), #818CF8, transparent);
}
.mile-item { display: flex; gap: 20px; align-items: flex-start; padding: 20px 0; }
.mile-dot {
  width: 46px; height: 46px; flex-shrink: 0; border-radius: 50%;
  background: var(--navy-light); border: 2px solid rgba(96,165,250,.3);
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; position: relative; z-index: 1;
  transition: all .3s;
}
.mile-item:hover .mile-dot { border-color: var(--accent); background: rgba(37,99,235,.2); }
.mile-text h4 { font-family: var(--font-display); font-size: 15px; font-weight: 800; color: #fff; margin-bottom: 4px; }
.mile-text p  { font-family: var(--font-body); font-size: 13px; color: rgba(255,255,255,.45); line-height: 1.6; }
.mile-year { font-family: var(--font-body); font-size: 11px; font-weight: 600; color: #60A5FA; letter-spacing: .1em; margin-bottom: 4px; }
.mile-stats-side { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.mstat {
  background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.07);
  border-radius: var(--radius-lg); padding: 28px 24px; text-align: center;
  transition: all .3s;
}
.mstat:hover { background: rgba(255,255,255,.08); border-color: rgba(96,165,250,.2); }
.mstat strong {
  font-family: var(--font-display); font-size: 38px; font-weight: 900; display: block;
  background: linear-gradient(135deg, #fff 40%, rgba(96,165,250,.75));
  -webkit-background-clip: text; background-clip: text; color: transparent; line-height: 1;
}
.mstat span { font-family: var(--font-body); font-size: 13px; color: rgba(255,255,255,.4); margin-top: 8px; display: block; }

/* ════ CTA ABOUT ════ */
#about-cta { background: var(--gray-50); padding: 100px 0; text-align: center; }
.cta-cards { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin-top: 40px; }
.cta-card-link {
  display: flex; align-items: center; gap: 12px;
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 18px 24px;
  text-decoration: none; box-shadow: var(--shadow);
  transition: all .3s;
}
.cta-card-link:hover { border-color: rgba(37,99,235,.2); box-shadow: var(--shadow-lg); transform: translateY(-4px); }
.cta-card-link .cc-icon { width: 44px; height: 44px; border-radius: 12px; background: var(--navy-soft); display: flex; align-items: center; justify-content: center; font-size: 20px; }
.cta-card-link .cc-text strong { display: block; font-family: var(--font-display); font-size: 14px; font-weight: 800; color: var(--navy); }
.cta-card-link .cc-text span { font-family: var(--font-body); font-size: 12px; color: var(--text-muted); }

/* ════ RESPONSIVE ════ */
@media(max-width:900px) {
  .story-wrap { grid-template-columns: 1fr; }
  .story-img-wrap { display: none; }
  .why-grid { grid-template-columns: 1fr 1fr; }
  .milestone-wrap { grid-template-columns: 1fr; }
}
@media(max-width:640px) {
  .why-grid { grid-template-columns: 1fr; }
  .story-values { grid-template-columns: 1fr; }
  .mile-stats-side { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

<!-- ════ HERO ════ -->
<div class="page-hero">
  <div class="page-hero-orb ph-orb-a"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="sec-label">🏢 Tentang Kami</div>
    <h1>Partner Digital yang<br><span class="hl">Peduli Bisnis Kamu</span></h1>
    <p>Levago adalah perusahaan penyedia layanan IT terpercaya yang mengkhususkan diri dalam pengembangan teknologi informasi untuk bisnis Indonesia.</p>
  </div>
</div>

<!-- ════ STORY ════ -->
<section id="about-story">
  <div class="container">
    <div class="story-wrap">
      <div class="story-img-wrap js-reveal">
        <img
          src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80"
          alt="Tim Levago" class="story-img-main"
        >
        <div class="story-badge-float">
          <strong>2022</strong>
          <span>Berdiri sejak</span>
        </div>
      </div>
      <div>
        <div class="sec-label js-reveal">📖 Cerita Kami</div>
        <h2 class="sec-title js-reveal">Digitalize Your <span style="color:var(--accent)">Business!</span></h2>
        <div class="js-reveal">
          <p>Levago lahir dari semangat anak muda Indonesia yang percaya bahwa setiap bisnis berhak tampil profesional di dunia digital — tanpa biaya selangit dan tanpa ribet.</p>
          <p>Kami bukan sekadar jasa web development. Kami adalah partner jangka panjang yang menemani pertumbuhan bisnis kamu, dari konsultasi pertama hingga maintenance berkelanjutan.</p>
          <p>Dengan tim berpengalaman di bidang desain, engineering, dan digital marketing, kami telah membantu 50+ bisnis di Indonesia memperkuat kehadiran digital mereka.</p>
        </div>
        <div class="story-values js-reveal">
          <div class="sval">
            <div class="sval-icon">🎯</div>
            <h4>Fokus pada Hasil</h4>
            <p>Bukan sekedar website indah, tapi yang menghasilkan bisnis nyata.</p>
          </div>
          <div class="sval">
            <div class="sval-icon">🤝</div>
            <h4>Partnership Jangka Panjang</h4>
            <p>Kami terus bersama kamu setelah launch, bukan menghilang.</p>
          </div>
          <div class="sval">
            <div class="sval-icon">💡</div>
            <h4>Inovasi Berkelanjutan</h4>
            <p>Selalu update dengan teknologi terbaru untuk bisnis kamu.</p>
          </div>
          <div class="sval">
            <div class="sval-icon">🔒</div>
            <h4>Transparan & Terpercaya</h4>
            <p>Tidak ada biaya tersembunyi, semua jelas di awal.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════ WHY US ════ -->
<section id="why-us">
  <div class="container">
    <div class="js-reveal" style="text-align:center">
      <div class="sec-label">⭐ Kenapa Levago</div>
      <h2 class="sec-title">Apa yang Membuat Kami Berbeda?</h2>
      <p class="sec-sub" style="margin:0 auto">Banyak vendor IT di luar sana — tapi Levago hadir dengan pendekatan yang benar-benar berbeda.</p>
    </div>
    <div class="why-grid">
      <div class="why-card js-reveal">
        <div class="why-num">01</div>
        <h3>Full Custom, Bukan Template</h3>
        <p>Setiap project dibangun dari nol sesuai kebutuhan spesifik bisnis kamu. Tidak ada template copy-paste yang bikin semua website terlihat sama.</p>
      </div>
      <div class="why-card js-reveal">
        <div class="why-num">02</div>
        <h3>Support 24/7 Setelah Launch</h3>
        <p>Hubungi kami kapan saja jika ada masalah. Tim kami siap merespons dan menyelesaikan issue dalam hitungan jam, bukan hari.</p>
      </div>
      <div class="why-card js-reveal">
        <div class="why-num">03</div>
        <h3>Harga Transparan, Tanpa Kejutan</h3>
        <p>Semua biaya dijelaskan di awal kontrak. Tidak ada biaya tambahan yang muncul tiba-tiba di tengah jalan atau setelah project selesai.</p>
      </div>
      <div class="why-card js-reveal">
        <div class="why-num">04</div>
        <h3>Teknologi Modern & Scalable</h3>
        <p>Kami pakai stack teknologi terkini — Laravel, React, Next.js — sehingga website kamu siap tumbuh seiring bisnis berkembang.</p>
      </div>
      <div class="why-card js-reveal">
        <div class="why-num">05</div>
        <h3>Desain Berorientasi Konversi</h3>
        <p>Bukan sekedar cantik, tapi dirancang untuk mengubah pengunjung menjadi customer. Setiap elemen punya tujuan bisnis yang jelas.</p>
      </div>
      <div class="why-card js-reveal">
        <div class="why-num">06</div>
        <h3>Garansi Revisi Tanpa Batas</h3>
        <p>Tidak puas? Kami revisi sampai kamu benar-benar happy. Kepuasan klien adalah prioritas utama kami, bukan milestone terakhir.</p>
      </div>
    </div>
  </div>
</section>


<!-- ════ MILESTONES ════ -->
<section id="milestones">
  <div class="container">
    <div class="milestone-wrap">
      <div>
        <div class="sec-label js-reveal" style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.12)">🚀 Perjalanan Kami</div>
        <h2 class="sec-title js-reveal" style="color:#fff">Dari Nol Menuju<br><span style="color:#60A5FA">50+ Klien</span> Puas</h2>
        <div class="mile-list js-reveal">
          <div class="mile-item">
            <div class="mile-dot">🌱</div>
            <div class="mile-text">
              <div class="mile-year">2022</div>
              <h4>Levago Berdiri</h4>
              <p>Dimulai dari semangat 2 orang founder yang ingin membantu UMKM go digital.</p>
            </div>
          </div>
          <div class="mile-item">
            <div class="mile-dot">📈</div>
            <div class="mile-text">
              <div class="mile-year">2023</div>
              <h4>Project Pertama</h4>
              <p>Berhasil deliver project dengan rating kepuasan 100% dari semua klien.</p>
            </div>
          </div>
          <div class="mile-item">
            <div class="mile-dot">🏢</div>
            <div class="mile-text">
              <div class="mile-year">2024</div>
              <h4>Tim Berkembang</h4>
              <p>Membentuk tim solid 6 orang dengan spesialisasi masing-masing bidang.</p>
            </div>
          </div>
          <div class="mile-item">
            <div class="mile-dot">🎯</div>
            <div class="mile-text">
              <div class="mile-year">2025</div>
              <h4>6+ Klien Terpercaya</h4>
              <p>Mempercayai diri untuk menangani project skala enterprise dan exportir company.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="mile-stats-side js-reveal">
        <div class="mstat"><strong>6+</strong><span>Project Selesai</span></div>
        <div class="mstat"><strong>3+</strong><span>Tahun Pengalaman</span></div>
        <div class="mstat"><strong>98%</strong><span>Client Puas</span></div>
        <div class="mstat"><strong>100%</strong><span>Garansi Revisi</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ════ CTA ════ -->
<section id="about-cta">
  <div class="container">
    <div class="js-reveal">
      <div class="sec-label" style="margin:0 auto 20px;display:table">💬 Mulai Kolaborasi</div>
      <h2 class="sec-title" style="text-align:center;max-width:560px;margin:0 auto 12px">Mari Berkolaborasi Bersama Kami</h2>
      <p class="sec-sub" style="text-align:center;margin:0 auto 0">Kirimkan ide dan kebutuhan kamu — kami siap wujudkan.</p>
    </div>
    <div class="cta-cards">
      <a href="https://wa.me/6285861126558?text=Hi%20Levago!%20Saya%20Mau%20Konsultasi" target="_blank" rel="noopener" class="cta-card-link">
        <div class="cc-icon">💬</div>
        <div class="cc-text"><strong>Chat WhatsApp</strong><span>Respon dalam hitungan menit</span></div>
      </a>
      <a href="{{ route('contact') }}" class="cta-card-link">
        <div class="cc-icon">📋</div>
        <div class="cc-text"><strong>Isi Form Konsultasi</strong><span>Ceritakan kebutuhan detail kamu</span></div>
      </a>
      <a href="{{ route('services') }}" class="cta-card-link">
        <div class="cc-icon">🧩</div>
        <div class="cc-text"><strong>Lihat Layanan</strong><span>Temukan solusi yang tepat</span></div>
      </a>
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