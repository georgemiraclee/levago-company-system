{{-- resources/views/web/portfolio/index.blade.php --}}
@extends('layouts.web')
@section('title', 'Portfolio — Levago')

@section('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --navy: #0A1628; --accent: #2563EB; --accent-soft: rgba(37,99,235,.08);
  --white: #ffffff; --gray-50: #F8FAFC; --gray-100: #F1F5F9;
  --gray-200: #E2E8F0; --gray-400: #94A3B8; --text-muted: #64748B;
  --radius: 12px; --radius-lg: 20px;
  --shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.04);
  --shadow-lg: 0 8px 32px rgba(0,0,0,.12), 0 2px 8px rgba(0,0,0,.06);
  --font-display: 'Plus Jakarta Sans', sans-serif;
  --font-body: 'DM Sans', sans-serif;
  --navy-soft: rgba(15,32,64,.08);
}

/* HERO */
.page-hero {
  background: var(--navy); padding: 120px 0 64px;
  text-align: center; position: relative; overflow: hidden;
}
.page-hero::before {
  content: ''; position: absolute; top: -200px; left: 50%; transform: translateX(-50%);
  width: 700px; height: 700px; border-radius: 50%;
  background: radial-gradient(circle, rgba(37,99,235,.1) 0%, transparent 65%);
  pointer-events: none;
}
.page-hero .hero-label {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: var(--font-body); font-size: 11px; font-weight: 700;
  text-transform: uppercase; letter-spacing: .12em;
  background: rgba(255,255,255,.08); color: rgba(255,255,255,.7);
  border: 1px solid rgba(255,255,255,.12);
  padding: 6px 16px; border-radius: 100px; margin-bottom: 20px;
}
.page-hero h1 {
  font-family: var(--font-display);
  font-size: clamp(32px, 5vw, 56px); font-weight: 900;
  color: var(--white); margin-bottom: 14px; line-height: 1.1;
}
.page-hero p {
  font-family: var(--font-body); font-size: 17px;
  color: rgba(255,255,255,.5); max-width: 500px; margin: 0 auto;
}

/* FILTER BAR */
.filter-section { padding: 48px 0 0; }
.filter-bar {
  display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 40px;
}
.filter-btn {
  font-family: var(--font-body); font-size: 13px; font-weight: 600;
  padding: 9px 20px; border-radius: 100px;
  border: 1.5px solid var(--gray-200); color: var(--text-muted);
  background: var(--white); cursor: pointer; text-decoration: none;
  transition: all .22s cubic-bezier(.16,1,.3,1);
}
.filter-btn:hover { border-color: rgba(37,99,235,.3); color: var(--accent); background: var(--accent-soft); }
.filter-btn.active { background: var(--navy); color: var(--white); border-color: var(--navy); box-shadow: 0 4px 14px rgba(10,22,40,.2); }

/* PORTFOLIO GRID */
.portfolio-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 24px; margin-bottom: 48px;
}
.portfolio-card {
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow);
  transition: all .35s cubic-bezier(.16,1,.3,1);
  text-decoration: none; color: inherit; display: block;
}
.portfolio-card:hover {
  box-shadow: var(--shadow-lg); transform: translateY(-8px);
  border-color: rgba(37,99,235,.2);
}
.portfolio-card:hover .port-thumb-img { transform: scale(1.07); }

/* THUMBNAIL */
.port-thumb {
  height: 230px; background: var(--navy-soft);
  position: relative; overflow: hidden;
  display: flex; align-items: center; justify-content: center;
}
.port-thumb-img {
  width: 100%; height: 100%; object-fit: cover;
  transition: transform .6s cubic-bezier(.16,1,.3,1);
}
.port-thumb-placeholder { font-size: 56px; opacity: .2; }
.thumb-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,22,40,.4) 0%, transparent 50%);
  opacity: 0; transition: opacity .35s;
}
.portfolio-card:hover .thumb-overlay { opacity: 1; }
.thumb-cat {
  position: absolute; top: 14px; left: 14px;
  font-family: var(--font-body); font-size: 11px; font-weight: 700;
  padding: 5px 12px; border-radius: 8px;
  background: rgba(10,22,40,.75); color: rgba(255,255,255,.9);
  backdrop-filter: blur(8px); letter-spacing: .04em; text-transform: uppercase;
}
.thumb-arrow {
  position: absolute; bottom: 16px; right: 16px;
  width: 36px; height: 36px; border-radius: 50%;
  background: #fff; display: flex; align-items: center; justify-content: center;
  font-size: 14px; opacity: 0; transform: translateY(8px);
  transition: all .3s cubic-bezier(.16,1,.3,1);
}
.portfolio-card:hover .thumb-arrow { opacity: 1; transform: translateY(0); }

/* CARD INFO */
.port-info { padding: 24px; }
.port-info h2 {
  font-family: var(--font-display); font-size: 18px; font-weight: 800;
  color: var(--navy); margin-bottom: 8px; line-height: 1.3;
}
.port-info p {
  font-family: var(--font-body); font-size: 13px;
  color: var(--text-muted); margin-bottom: 16px; line-height: 1.65;
}

/* TECH BUBBLES */
.ptags { display: flex; gap: 6px; flex-wrap: wrap; }
.ptag {
  font-family: var(--font-body); font-size: 11px; font-weight: 600;
  padding: 5px 12px; border-radius: 100px;
  background: linear-gradient(135deg, rgba(37,99,235,.07), rgba(99,102,241,.07));
  color: var(--accent); border: 1.5px solid rgba(37,99,235,.15);
  transition: all .2s;
}
.ptag:hover { background: var(--accent); color: #fff; border-color: var(--accent); }

/* EMPTY STATE */
.empty-state {
  text-align: center; padding: 100px 0; color: var(--text-muted);
}
.empty-state .empty-icon { font-size: 56px; margin-bottom: 20px; }
.empty-state p { font-family: var(--font-body); font-size: 16px; margin-bottom: 24px; }

/* REVEAL */
.reveal { opacity: 0; transform: translateY(24px); transition: all .7s cubic-bezier(.16,1,.3,1); }
.reveal.show { opacity: 1; transform: translateY(0); }

/* PAGINATION */
.pagination-wrap { display: flex; justify-content: center; padding-bottom: 80px; }

@media(max-width:768px) {
  .portfolio-grid { grid-template-columns: 1fr; }
  .filter-bar { gap: 6px; }
  .filter-btn { font-size: 12px; padding: 8px 16px; }
}
</style>
@endsection

@section('content')

<div class="page-hero">
  <div class="container">
    <div class="hero-label">💼 Portfolio</div>
    <h1>Karya Yang Sudah Kami Bangun</h1>
    <p>Dari berbagai industri — semuanya dibangun dengan standar kualitas tinggi</p>
  </div>
</div>

<section class="filter-section">
  <div class="container">

    <div class="filter-bar">
      <a href="{{ route('portfolio') }}"
         class="filter-btn {{ !request('category') ? 'active' : '' }}">
        Semua
      </a>
      @foreach(['web' => 'Web', 'mobile' => 'Mobile', 'design' => 'Design', 'other' => 'Other'] as $val => $label)
      <a href="{{ route('portfolio', ['category' => $val]) }}"
         class="filter-btn {{ request('category') == $val ? 'active' : '' }}">
        {{ $label }}
      </a>
      @endforeach
    </div>

    @if($portfolios->isEmpty())
      <div class="empty-state">
        <div class="empty-icon">🚀</div>
        <p>Portfolio segera hadir. Hubungi kami untuk melihat project terbaru!</p>
        <a href="{{ route('contact') }}" class="filter-btn active">Hubungi Kami →</a>
      </div>
    @else
      <div class="portfolio-grid">
        @foreach($portfolios as $p)
        <a href="{{ route('portfolio.show', $p->slug) }}" class="portfolio-card reveal">
          <div class="port-thumb">
            @if($p->images && count($p->images) > 0)
              <img class="port-thumb-img" src="{{ asset('storage/' . $p->images[0]) }}" alt="{{ $p->title }}">
            @else
              <span class="port-thumb-placeholder">🖥️</span>
            @endif
            <div class="thumb-overlay"></div>
            <div class="thumb-cat">{{ $p->category }}</div>
            <div class="thumb-arrow">→</div>
          </div>
          <div class="port-info">
            <h2>{{ $p->title }}</h2>
            <p>{{ Str::limit($p->description, 85) }}</p>
            <div class="ptags">
              @foreach(($p->tech_stack ?? []) as $tech)
                <span class="ptag">{{ $tech }}</span>
              @endforeach
            </div>
          </div>
        </a>
        @endforeach
      </div>

      <div class="pagination-wrap">
        {{ $portfolios->links() }}
      </div>
    @endif

  </div>
</section>
@endsection

@section('scripts')
<script>
const observer = new IntersectionObserver(entries => {
  entries.forEach((e, i) => {
    if (e.isIntersecting) {
      setTimeout(() => e.target.classList.add('show'), i * 80);
    }
  });
}, { threshold: 0.08 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
@endsection