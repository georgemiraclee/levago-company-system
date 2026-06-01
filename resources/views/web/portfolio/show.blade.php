{{-- resources/views/web/portfolio/show.blade.php --}}
@extends('layouts.web')
@section('title', $portfolio->title . ' — Portfolio Levago')

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
.post-hero {
  background: var(--navy); padding: 120px 0 56px; position: relative; overflow: hidden;
}
.post-hero::before {
  content: ''; position: absolute; top: -200px; right: -200px;
  width: 600px; height: 600px; border-radius: 50%;
  background: radial-gradient(circle, rgba(37,99,235,.12) 0%, transparent 65%);
  pointer-events: none;
}
.breadcrumb {
  font-family: var(--font-body); font-size: 13px;
  color: rgba(255,255,255,.4); margin-bottom: 20px;
  display: flex; align-items: center; gap: 8px;
}
.breadcrumb a { color: rgba(255,255,255,.4); text-decoration: none; transition: color .2s; }
.breadcrumb a:hover { color: rgba(255,255,255,.8); }
.breadcrumb span { color: rgba(255,255,255,.2); }
.post-hero h1 {
  font-family: var(--font-display);
  font-size: clamp(28px, 4vw, 52px); font-weight: 900;
  color: var(--white); line-height: 1.1; margin-bottom: 12px;
}
.hero-client {
  display: inline-flex; align-items: center; gap: 8px;
  font-family: var(--font-body); font-size: 14px;
  color: rgba(255,255,255,.5); margin-top: 8px;
}
.hero-client strong { color: rgba(255,255,255,.8); font-weight: 600; }

/* LAYOUT */
.port-wrap {
  display: grid; grid-template-columns: 1fr 340px;
  gap: 56px; padding: 64px 0 100px; align-items: start;
}

/* IMAGES */
.port-images { display: flex; flex-direction: column; gap: 16px; margin-bottom: 40px; }
.port-images img {
  width: 100%; border-radius: var(--radius-lg);
  border: 1px solid var(--gray-200); box-shadow: var(--shadow-lg);
  transition: transform .4s cubic-bezier(.16,1,.3,1);
}
.port-images img:hover { transform: scale(1.01); }

/* DESCRIPTION */
.port-desc-section { margin-bottom: 0; }
.port-desc-label {
  font-family: var(--font-body); font-size: 11px; font-weight: 700;
  text-transform: uppercase; letter-spacing: .12em; color: var(--accent);
  background: var(--accent-soft); border: 1px solid rgba(37,99,235,.15);
  padding: 5px 14px; border-radius: 100px; display: inline-block; margin-bottom: 16px;
}
.port-desc {
  font-family: var(--font-body); font-size: 16px;
  color: #334155; line-height: 1.9;
}

/* SIDEBAR CARDS */
.port-sidebar { display: flex; flex-direction: column; gap: 16px; }
.scard {
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 24px; box-shadow: var(--shadow);
}
.scard-title {
  font-family: var(--font-display); font-size: 15px; font-weight: 800;
  color: var(--navy); margin-bottom: 16px;
  display: flex; align-items: center; gap: 8px;
}
.info-row {
  display: flex; justify-content: space-between; align-items: center;
  padding: 10px 0; border-bottom: 1px solid var(--gray-100);
  font-family: var(--font-body); font-size: 14px;
}
.info-row:last-child { border-bottom: none; padding-bottom: 0; }
.info-row .lbl { color: var(--text-muted); }
.info-row .val { color: var(--navy); font-weight: 600; text-align: right; }

/* TECH STACK BUBBLES */
.tech-grid { display: flex; flex-wrap: wrap; gap: 8px; }
.tech-bubble {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: var(--font-body); font-size: 12px; font-weight: 600;
  padding: 7px 14px; border-radius: 100px;
  background: linear-gradient(135deg, rgba(37,99,235,.07), rgba(99,102,241,.07));
  color: var(--accent); border: 1.5px solid rgba(37,99,235,.18);
  letter-spacing: .02em; transition: all .22s cubic-bezier(.16,1,.3,1);
  cursor: default; position: relative; overflow: hidden;
}
.tech-bubble::before {
  content: ''; position: absolute; inset: 0;
  background: var(--accent); opacity: 0; transition: opacity .22s;
}
.tech-bubble:hover { color: #fff; border-color: var(--accent); transform: translateY(-3px); box-shadow: 0 6px 20px rgba(37,99,235,.25); }
.tech-bubble:hover::before { opacity: 1; }
.tech-bubble span { position: relative; z-index: 1; }
.tech-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; opacity: .5; position: relative; z-index: 1; flex-shrink: 0; }

/* CTA CARD */
.cta-card {
  background: var(--navy); border-radius: var(--radius-lg);
  padding: 28px; position: relative; overflow: hidden;
}
.cta-card::before {
  content: ''; position: absolute; top: -60px; right: -60px;
  width: 200px; height: 200px; border-radius: 50%;
  background: radial-gradient(circle, rgba(37,99,235,.2), transparent 70%);
  pointer-events: none;
}
.cta-card h3 {
  font-family: var(--font-display); font-size: 16px; font-weight: 800;
  color: #fff; margin-bottom: 8px; position: relative; z-index: 1;
}
.cta-card p {
  font-family: var(--font-body); font-size: 13px;
  color: rgba(255,255,255,.5); margin-bottom: 20px;
  line-height: 1.6; position: relative; z-index: 1;
}
.btn-cta {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  background: #fff; color: var(--navy);
  font-family: var(--font-display); font-size: 14px; font-weight: 800;
  padding: 13px 24px; border-radius: var(--radius); text-decoration: none;
  transition: all .22s; position: relative; z-index: 1;
  box-shadow: 0 4px 16px rgba(0,0,0,.15);
}
.btn-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); }

/* LIVE LINK BADGE */
.live-badge {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: var(--font-body); font-size: 12px; font-weight: 600;
  color: #16A34A; background: rgba(74,222,128,.1);
  border: 1.5px solid rgba(74,222,128,.3);
  padding: 4px 12px; border-radius: 100px; text-decoration: none;
  transition: all .2s;
}
.live-badge:hover { background: rgba(74,222,128,.2); transform: translateY(-1px); }
.live-dot { width: 6px; height: 6px; border-radius: 50%; background: #4ADE80; animation: blink 2s infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }

/* REVEAL */
.reveal { opacity: 0; transform: translateY(24px); transition: all .7s cubic-bezier(.16,1,.3,1); }
.reveal.show { opacity: 1; transform: translateY(0); }

@media(max-width:900px) {
  .port-wrap { grid-template-columns: 1fr; gap: 32px; padding: 40px 0 80px; }
}
</style>
@endsection

@section('content')
<div class="post-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span>/</span>
      <a href="{{ route('portfolio') }}">Portfolio</a>
      <span>/</span>
      {{ Str::limit($portfolio->title, 40) }}
    </div>
    <h1>{{ $portfolio->title }}</h1>
    @if($portfolio->client_name)
    <div class="hero-client">Client: <strong>{{ $portfolio->client_name }}</strong></div>
    @endif
  </div>
</div>

<div class="container">
  <div class="port-wrap">

    {{-- MAIN CONTENT --}}
    <div>
      @if($portfolio->images && count($portfolio->images) > 0)
      <div class="port-images reveal">
        @foreach($portfolio->images as $img)
          <img src="{{ asset('storage/' . $img) }}" alt="{{ $portfolio->title }}">
        @endforeach
      </div>
      @endif

      <div class="port-desc-section reveal">
        <div class="port-desc-label">📋 Tentang Project</div>
        <div class="port-desc">{!! nl2br(e($portfolio->description)) !!}</div>
      </div>
    </div>

    {{-- SIDEBAR --}}
    <aside class="port-sidebar">

      {{-- Detail --}}
      <div class="scard reveal">
        <div class="scard-title">🗂️ Detail Project</div>
        <div class="info-row">
          <span class="lbl">Kategori</span>
          <span class="val">{{ ucfirst($portfolio->category) }}</span>
        </div>
        @if($portfolio->client_name)
        <div class="info-row">
          <span class="lbl">Client</span>
          <span class="val">{{ $portfolio->client_name }}</span>
        </div>
        @endif
        @if($portfolio->status)
        <div class="info-row">
          <span class="lbl">Status</span>
          <span class="val" style="color:{{ $portfolio->status === 'active' ? '#16A34A' : '#94A3B8' }}">
            {{ $portfolio->status === 'active' ? '✅ Live' : '📦 Archived' }}
          </span>
        </div>
        @endif
        @if($portfolio->url)
        <div class="info-row">
          <span class="lbl">Link</span>
          <a href="{{ $portfolio->url }}" target="_blank" rel="noopener" class="live-badge">
            <span class="live-dot"></span> Lihat Live
          </a>
        </div>
        @endif
      </div>

      {{-- Tech Stack --}}
      @if($portfolio->tech_stack && count($portfolio->tech_stack) > 0)
      <div class="scard reveal">
        <div class="scard-title">⚡ Tech Stack</div>
        <div class="tech-grid">
          @foreach($portfolio->tech_stack as $tech)
          <span class="tech-bubble">
            <span class="tech-dot"></span>
            <span>{{ $tech }}</span>
          </span>
          @endforeach
        </div>
      </div>
      @endif

      {{-- CTA --}}
      <div class="cta-card reveal">
        <h3>Tertarik Project Serupa?</h3>
        <p>Diskusikan kebutuhan kamu dengan tim kami secara gratis!</p>
        <a href="{{ route('contact') }}" class="btn-cta">💬 Konsultasi Gratis</a>
      </div>

    </aside>
  </div>
</div>
@endsection

@section('scripts')
<script>
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('show'); });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
@endsection