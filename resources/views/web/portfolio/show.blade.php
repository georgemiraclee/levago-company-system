{{-- resources/views/web/portfolio/show.blade.php --}}
@extends('layouts.web')
@section('title', $portfolio->title . ' — Portfolio Levago')

@section('head')
<style>
  .post-hero { background: var(--navy); padding: 120px 0 48px; }
  .post-hero .breadcrumb { font-size: 13px; color: rgba(255,255,255,.45); margin-bottom: 16px; }
  .post-hero .breadcrumb a { color: rgba(255,255,255,.45); text-decoration: none; }
  .post-hero h1 { font-family: var(--font-display); font-size: clamp(28px,4vw,46px); font-weight: 800; color: var(--white); line-height: 1.15; }
  .port-wrap { display: grid; grid-template-columns: 1fr 320px; gap: 48px; padding: 64px 0; align-items: start; }
  .port-images img { width: 100%; border-radius: var(--radius-lg); margin-bottom: 16px; border: 1px solid var(--gray-200); }
  .port-desc { font-size: 16px; color: var(--gray-800); line-height: 1.85; }
  .port-sidebar .card { margin-bottom: 20px; }
  .port-sidebar h3 { font-family: var(--font-display); font-size: 15px; font-weight: 700; color: var(--navy); margin-bottom: 12px; }
  .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--gray-100); font-size: 14px; }
  .info-row:last-child { border-bottom: none; }
  .info-row span:first-child { color: var(--text-muted); }
  .info-row span:last-child { color: var(--navy); font-weight: 600; }
  .tech-list { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 4px; }
  .tech-pill { font-size: 12px; padding: 4px 12px; border-radius: 100px; background: var(--navy-soft); color: var(--navy); font-weight: 500; }
  @media(max-width:900px) { .port-wrap { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<div class="post-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Home</a> / <a href="{{ route('portfolio') }}">Portfolio</a> / {{ Str::limit($portfolio->title, 40) }}
    </div>
    <h1>{{ $portfolio->title }}</h1>
    @if($portfolio->client_name)
    <p style="font-size:15px;color:rgba(255,255,255,.5);margin-top:10px">Client: {{ $portfolio->client_name }}</p>
    @endif
  </div>
</div>

<div class="container">
  <div class="port-wrap">
    <div>
      @if($portfolio->images && count($portfolio->images) > 0)
        <div class="port-images reveal">
          @foreach($portfolio->images as $img)
            <img src="{{ $img }}" alt="{{ $portfolio->title }}">
          @endforeach
        </div>
      @endif
      <div class="port-desc reveal">{!! nl2br(e($portfolio->description)) !!}</div>
    </div>
    <aside class="port-sidebar">
      <div class="card reveal">
        <h3>Detail Project</h3>
        <div class="info-row"><span>Kategori</span><span>{{ $portfolio->category }}</span></div>
        @if($portfolio->client_name)<div class="info-row"><span>Client</span><span>{{ $portfolio->client_name }}</span></div>@endif
        @if($portfolio->url)<div class="info-row"><span>Link</span><a href="{{ $portfolio->url }}" target="_blank" style="color:var(--accent);font-size:14px">Lihat Live →</a></div>@endif
      </div>
      @if($portfolio->tech_stack)
      <div class="card reveal">
        <h3>Tech Stack</h3>
        <div class="tech-list">
          @foreach($portfolio->tech_stack as $tech)
            <span class="tech-pill">{{ $tech }}</span>
          @endforeach
        </div>
      </div>
      @endif
      <div class="card reveal">
        <h3>Tertarik Project Serupa?</h3>
        <p style="font-size:13px;color:var(--text-muted);margin-bottom:16px">Diskusikan kebutuhan kamu dengan tim kami secara gratis!</p>
        <a href="{{ route('contact') }}" class="btn-primary" style="width:100%;justify-content:center">💬 Konsultasi Gratis</a>
      </div>
    </aside>
  </div>
</div>
@endsection