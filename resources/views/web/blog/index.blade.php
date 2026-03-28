{{-- resources/views/web/blog/index.blade.php --}}
@extends('layouts.web')
@section('title', 'Blog — Levago')

@section('head')
<style>
  .page-hero { background: var(--navy); padding: 120px 0 64px; text-align: center; }
  .page-hero h1 { font-family: var(--font-display); font-size: clamp(32px,5vw,52px); font-weight: 800; color: var(--white); margin-bottom: 12px; }
  .page-hero p { font-size: 17px; color: rgba(255,255,255,.6); }
  .filter-bar { display: flex; gap: 8px; flex-wrap: wrap; margin: 40px 0; }
  .filter-btn {
    font-size: 13px; font-weight: 500; padding: 8px 18px; border-radius: 100px;
    border: 1.5px solid var(--gray-200); color: var(--text-muted);
    background: var(--white); cursor: pointer; text-decoration: none;
    transition: all .2s;
  }
  .filter-btn.active, .filter-btn:hover { background: var(--navy); color: var(--white); border-color: var(--navy); }
  .blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
  .blog-card { background: var(--white); border: 1px solid var(--gray-200); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow); transition: all .3s; text-decoration: none; color: inherit; display: block; }
  .blog-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-4px); border-color: rgba(37,99,235,.2); }
  .blog-thumb { height: 200px; background: var(--navy-soft); overflow: hidden; }
  .blog-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
  .blog-card:hover .blog-thumb img { transform: scale(1.05); }
  .blog-info { padding: 22px; }
  .blog-cat { font-size: 11px; font-weight: 700; color: var(--accent); text-transform: uppercase; letter-spacing: .08em; margin-bottom: 8px; }
  .blog-info h2 { font-family: var(--font-display); font-size: 17px; font-weight: 700; color: var(--navy); margin-bottom: 8px; line-height: 1.4; }
  .blog-info p { font-size: 13px; color: var(--text-muted); line-height: 1.6; margin-bottom: 14px; }
  .blog-meta { font-size: 12px; color: var(--gray-400); }
  .pagination-wrap { display: flex; justify-content: center; margin-top: 48px; }
</style>
@endsection

@section('content')
<div class="page-hero">
  <div class="container">
    <div class="section-label" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.15);display:inline-flex">📝 Blog</div>
    <h1>Insight & Tips Digital</h1>
    <p>Artikel terbaru seputar website, aplikasi, dan strategi digital bisnis</p>
  </div>
</div>

<section style="padding-top:48px">
  <div class="container">
    <div class="filter-bar">
      <a href="{{ route('blog') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">Semua</a>
      @foreach($categories as $cat)
        <a href="{{ route('blog', ['category' => $cat]) }}" class="filter-btn {{ request('category') == $cat ? 'active' : '' }}">{{ $cat }}</a>
      @endforeach
    </div>

    @if($blogs->isEmpty())
      <div style="text-align:center;padding:80px 0;color:var(--text-muted)">
        <div style="font-size:48px;margin-bottom:16px">📭</div>
        <p>Belum ada artikel. Pantau terus ya!</p>
      </div>
    @else
      <div class="blog-grid">
        @foreach($blogs as $blog)
        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card reveal">
          <div class="blog-thumb">
            @if($blog->thumbnail)
              <img src="{{ asset('storage/'.$blog->thumbnail) }}" alt="{{ $blog->title }}">
            @endif
          </div>
          <div class="blog-info">
            <div class="blog-cat">{{ $blog->category ?? 'Tips' }}</div>
            <h2>{{ $blog->title }}</h2>
            <p>{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 90) }}</p>
            <div class="blog-meta">{{ \Carbon\Carbon::parse($blog->published_at)->format('d M Y') }}</div>
          </div>
        </a>
        @endforeach
      </div>
      <div class="pagination-wrap">{{ $blogs->links() }}</div>
    @endif
  </div>
</section>
@endsection