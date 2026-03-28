{{-- resources/views/web/portfolio/index.blade.php --}}
@extends('layouts.web')
@section('title', 'Portfolio — Levago')

@section('head')
<style>
  .page-hero { background: var(--navy); padding: 120px 0 64px; text-align: center; }
  .page-hero h1 { font-family: var(--font-display); font-size: clamp(32px,5vw,52px); font-weight: 800; color: var(--white); margin-bottom: 12px; }
  .page-hero p { font-size: 17px; color: rgba(255,255,255,.6); }
  .filter-bar { display: flex; gap: 8px; flex-wrap: wrap; margin: 40px 0; }
  .filter-btn { font-size: 13px; font-weight: 500; padding: 8px 18px; border-radius: 100px; border: 1.5px solid var(--gray-200); color: var(--text-muted); background: var(--white); cursor: pointer; text-decoration: none; transition: all .2s; }
  .filter-btn.active, .filter-btn:hover { background: var(--navy); color: var(--white); border-color: var(--navy); }
  .portfolio-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 24px; }
  .portfolio-card { background: var(--white); border: 1px solid var(--gray-200); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow); transition: all .3s; text-decoration: none; color: inherit; display: block; }
  .portfolio-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-6px); border-color: rgba(37,99,235,.2); }
  .portfolio-thumb { height: 220px; background: var(--navy-soft); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; }
  .portfolio-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
  .portfolio-card:hover .portfolio-thumb img { transform: scale(1.06); }
  .thumb-cat { position: absolute; top: 14px; left: 14px; font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 6px; background: var(--white); color: var(--navy); }
  .portfolio-info { padding: 24px; }
  .portfolio-info h2 { font-family: var(--font-display); font-size: 18px; font-weight: 700; color: var(--navy); margin-bottom: 8px; }
  .portfolio-info p { font-size: 13px; color: var(--text-muted); margin-bottom: 14px; line-height: 1.6; }
  .ptags { display: flex; gap: 6px; flex-wrap: wrap; }
  .ptag { font-size: 11px; padding: 4px 10px; border-radius: 6px; background: var(--navy-soft); color: var(--navy); font-weight: 500; }
</style>
@endsection

@section('content')
<div class="page-hero">
  <div class="container">
    <div class="section-label" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.15);display:inline-flex">💼 Portfolio</div>
    <h1>Karya Yang Sudah Kami Bangun</h1>
    <p>Dari berbagai industri — semuanya dibangun dengan standar kualitas tinggi</p>
  </div>
</div>

<section style="padding-top:48px">
  <div class="container">
    <div class="filter-bar">
      <a href="{{ route('portfolio') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">Semua</a>
      @foreach(['website','webapp','ecommerce','mobile','landing-page'] as $cat)
        <a href="{{ route('portfolio', ['category' => $cat]) }}" class="filter-btn {{ request('category') == $cat ? 'active' : '' }}">{{ ucfirst($cat) }}</a>
      @endforeach
    </div>

    @if($portfolios->isEmpty())
      <div style="text-align:center;padding:80px 0;color:var(--text-muted)">
        <div style="font-size:48px;margin-bottom:16px">🚀</div>
        <p>Portfolio segera hadir. Hubungi kami untuk melihat project terbaru!</p>
        <a href="{{ route('contact') }}" class="btn-primary" style="margin-top:20px;display:inline-flex">Hubungi Kami</a>
      </div>
    @else
      <div class="portfolio-grid">
        @foreach($portfolios as $p)
        <a href="{{ route('portfolio.show', $p->slug) }}" class="portfolio-card reveal">
          <div class="portfolio-thumb">
            @if($p->images && count($p->images) > 0)
              <img src="{{ $p->images[0] }}" alt="{{ $p->title }}">
            @else
              <span style="font-size:52px;opacity:.25">🖥️</span>
            @endif
            <div class="thumb-cat">{{ $p->category }}</div>
          </div>
          <div class="portfolio-info">
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
      <div style="display:flex;justify-content:center;margin-top:40px">{{ $portfolios->links() }}</div>
    @endif
  </div>
</section>
@endsection