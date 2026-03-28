{{-- resources/views/web/blog/show.blade.php --}}
@extends('layouts.web')
@section('title', $blog->seo_title ?? $blog->title . ' — Levago Blog')
@section('description', $blog->seo_description ?? $blog->excerpt)

@section('head')
<style>
  .post-hero { background: var(--navy); padding: 120px 0 48px; }
  .post-hero .breadcrumb { font-size: 13px; color: rgba(255,255,255,.45); margin-bottom: 16px; }
  .post-hero .breadcrumb a { color: rgba(255,255,255,.45); text-decoration: none; }
  .post-hero .breadcrumb a:hover { color: rgba(255,255,255,.8); }
  .post-hero h1 { font-family: var(--font-display); font-size: clamp(28px,4vw,46px); font-weight: 800; color: var(--white); line-height: 1.15; max-width: 760px; }
  .post-hero .meta { font-size: 13px; color: rgba(255,255,255,.45); margin-top: 16px; display: flex; gap: 16px; align-items: center; flex-wrap: wrap; }
  .post-wrap { display: grid; grid-template-columns: 1fr 320px; gap: 48px; padding: 64px 0; }
  .post-content { font-size: 16px; line-height: 1.85; color: var(--gray-800); }
  .post-content h2, .post-content h3 { font-family: var(--font-display); color: var(--navy); margin: 32px 0 14px; font-weight: 700; }
  .post-content h2 { font-size: 24px; }
  .post-content h3 { font-size: 20px; }
  .post-content p { margin-bottom: 18px; }
  .post-content img { max-width: 100%; border-radius: 12px; margin: 20px 0; }
  .post-content ul, .post-content ol { margin: 16px 0 16px 24px; }
  .post-content li { margin-bottom: 8px; }
  .post-content blockquote { border-left: 4px solid var(--accent); padding: 16px 20px; background: var(--accent-soft); border-radius: 0 8px 8px 0; margin: 24px 0; color: var(--navy); font-style: italic; }
  .post-content pre { background: var(--navy-dark); color: #e2e8f0; padding: 20px; border-radius: 12px; overflow-x: auto; margin: 20px 0; font-size: 14px; }
  .sidebar .card { margin-bottom: 20px; }
  .sidebar h3 { font-family: var(--font-display); font-size: 15px; font-weight: 700; color: var(--navy); margin-bottom: 14px; }
  .related-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 32px; }
  .related-card { background: var(--white); border: 1px solid var(--gray-200); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow); transition: all .3s; text-decoration: none; color: inherit; display: block; }
  .related-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-3px); }
  .related-card .rb { height: 140px; background: var(--navy-soft); overflow: hidden; }
  .related-card .rb img { width: 100%; height: 100%; object-fit: cover; }
  .related-card .ri { padding: 16px; }
  .related-card .ri h4 { font-family: var(--font-display); font-size: 15px; font-weight: 700; color: var(--navy); margin-bottom: 6px; line-height: 1.4; }
  .related-card .ri span { font-size: 12px; color: var(--text-muted); }
  @media(max-width:900px) { .post-wrap { grid-template-columns: 1fr; } .sidebar { display: none; } }
</style>
@endsection

@section('content')
<div class="post-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Home</a> / <a href="{{ route('blog') }}">Blog</a> / {{ Str::limit($blog->title, 40) }}
    </div>
    <h1>{{ $blog->title }}</h1>
    <div class="meta">
      <span>📅 {{ \Carbon\Carbon::parse($blog->published_at)->format('d M Y') }}</span>
      @if($blog->category)<span>🏷️ {{ $blog->category }}</span>@endif
    </div>
  </div>
</div>

<div class="container">
  <div class="post-wrap">
    <article class="post-content reveal">
      @if($blog->thumbnail)
        <img src="{{ asset('storage/'.$blog->thumbnail) }}" alt="{{ $blog->title }}" style="width:100%;height:320px;object-fit:cover;border-radius:16px;margin-bottom:32px">
      @endif
      {!! $blog->content !!}
    </article>
    <aside class="sidebar">
      <div class="card">
        <h3>Butuh Website?</h3>
        <p style="font-size:13px;color:var(--text-muted);margin-bottom:16px">Konsultasi gratis dengan tim Levago sekarang!</p>
        <a href="{{ route('contact') }}" class="btn-primary" style="width:100%;justify-content:center">💬 Konsultasi Gratis</a>
      </div>
      @if($blog->tags)
      <div class="card">
        <h3>Tags</h3>
        <div style="display:flex;flex-wrap:wrap;gap:6px">
          @foreach($blog->tags as $tag)
            <span class="badge badge-navy">{{ $tag }}</span>
          @endforeach
        </div>
      </div>
      @endif
    </aside>
  </div>

  @if($related->isNotEmpty())
  <div style="padding-bottom:64px">
    <h2 class="section-title reveal">Artikel Terkait</h2>
    <div class="related-grid">
      @foreach($related as $r)
      <a href="{{ route('blog.show', $r->slug) }}" class="related-card reveal">
        <div class="rb">@if($r->thumbnail)<img src="{{ asset('storage/'.$r->thumbnail) }}" alt="{{ $r->title }}">@endif</div>
        <div class="ri"><h4>{{ $r->title }}</h4><span>{{ \Carbon\Carbon::parse($r->published_at)->format('d M Y') }}</span></div>
      </a>
      @endforeach
    </div>
  </div>
  @endif
</div>
@endsection