<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Di <head> layout.blade.php, sebelum @yield('head') -->
<link rel="icon" type="image/png" href="{{ asset('levago_indonesia_logo.jpeg') }}">
  <title>@yield('title', 'Levago — Partner Digital Bisnis Kamu')</title>
  <meta name="description" content="@yield('description', 'Levago membantu UMKM, startup, dan personal brand memiliki website dan aplikasi profesional.')">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

  <style>
    :root {
      --navy:        #0B1D3A;
      --navy-dark:   #071428;
      --navy-mid:    #132A52;
      --navy-light:  #1E3A6E;
      --navy-soft:   #EEF2F9;
      --accent:      #2563EB;
      --accent-dark: #1D4ED8;
      --accent-soft: #EFF6FF;
      --gold:        #F59E0B;
      --white:       #FFFFFF;
      --gray-50:     #F9FAFB;
      --gray-100:    #F3F4F6;
      --gray-200:    #E5E7EB;
      --gray-400:    #9CA3AF;
      --gray-600:    #4B5563;
      --gray-800:    #1F2937;
      --text:        #0B1D3A;
      --text-muted:  #6B7280;
      --radius:      12px;
      --radius-lg:   20px;
      --shadow:      0 4px 24px rgba(11,29,58,.08);
      --shadow-lg:   0 16px 48px rgba(11,29,58,.12);
    --font-display: 'Poppins', sans-serif;
    --font-body: 'Poppins', sans-serif;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: var(--font-body);
      background: var(--white);
      color: var(--text);
      overflow-x: hidden;
      line-height: 1.6;
    }

    /* ── NAVBAR ── */
    #navbar {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    padding: 18px 0;
    transition: all .3s ease;
    }

    #navbar.scrolled {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(12px);
    box-shadow: 0 4px 30px rgba(11,29,58,.08);
    padding: 12px 0;
    }

    .nav-inner {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    }

    /* Logo */
    .logo-text {
    font-weight: 700;
    font-size: 18px;
    letter-spacing: .3px;
    color: var(--navy);
    }

    .logo img {
    height: 36px;
    width: auto;
    object-fit: contain;
    }

    /* Nav Links */
    .nav-links {
    display: flex;
    gap: 8px;
    align-items: center;
    list-style: none;
    }

    .nav-links a {
    position: relative;
    color: var(--gray-600);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all .25s ease;
    }

    /* Hover underline modern */
    .nav-links a::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 12px;
    width: 0%;
    height: 2px;
    background: var(--accent);
    transition: .3s;
    }

    .nav-links a:hover::after {
    width: calc(100% - 24px);
    }

    .nav-links a:hover {
    color: var(--navy);
    }

    .nav-links a.active {
    color: var(--accent);
    }

    /* CTA Button */
    .btn-nav {
    background: var(--accent) !important;
    color: var(--white) !important;
    border-radius: 999px !important;
    padding: 10px 20px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    transition: all .25s ease !important;
    box-shadow: 0 4px 14px rgba(37,99,235,.25);
    }

    .btn-nav:hover {
    background: var(--accent-dark) !important;
    transform: translateY(-2px);
    }
    .hamburger { display: none; cursor: pointer; flex-direction: column; gap: 5px; background: none; border: none; padding: 4px; }
    .hamburger span { width: 22px; height: 2px; background: var(--navy); border-radius: 2px; transition: .3s; display: block; }

    /* ── SECTIONS ── */
    section { padding: 90px 0; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .section-label {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 12px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
      color: var(--accent); background: var(--accent-soft);
      padding: 6px 14px; border-radius: 100px; margin-bottom: 16px;
      border: 1px solid rgba(37,99,235,.15);
    }
    .section-title {
      font-family: var(--font-display);
      font-size: clamp(28px, 4.5vw, 48px);
      font-weight: 800; line-height: 1.12; color: var(--navy); margin-bottom: 16px;
    }
    .section-sub { font-size: 16px; color: var(--text-muted); max-width: 520px; line-height: 1.75; }

    /* ── BUTTONS ── */
    .btn-primary {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--navy); color: var(--white);
      padding: 14px 28px; border-radius: var(--radius);
      font-weight: 600; font-size: 15px; text-decoration: none;
      transition: all .2s; border: 2px solid var(--navy);
    }
    .btn-primary:hover { background: var(--navy-light); border-color: var(--navy-light); transform: translateY(-2px); box-shadow: var(--shadow-lg); }
    .btn-outline {
      display: inline-flex; align-items: center; gap: 8px;
      background: transparent; color: var(--navy);
      padding: 13px 28px; border-radius: var(--radius);
      font-weight: 600; font-size: 15px; text-decoration: none;
      border: 2px solid var(--gray-200); transition: all .2s;
    }
    .btn-outline:hover { border-color: var(--navy); background: var(--navy-soft); }
    .btn-accent {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--accent); color: var(--white);
      padding: 14px 28px; border-radius: var(--radius);
      font-weight: 600; font-size: 15px; text-decoration: none;
      transition: all .2s;
    }
    .btn-accent:hover { background: var(--accent-dark); transform: translateY(-2px); }

    /* ── CARDS ── */
    .card {
      background: var(--white); border: 1px solid var(--gray-200);
      border-radius: var(--radius-lg); padding: 28px;
      box-shadow: var(--shadow); transition: all .3s;
    }
    .card:hover { box-shadow: var(--shadow-lg); transform: translateY(-4px); border-color: rgba(37,99,235,.2); }

    /* ── FOOTER ── */
    footer {
      background: var(--navy-dark); color: rgba(255,255,255,.7);
      padding: 64px 0 32px;
    }
    .footer-inner {
      display: grid; grid-template-columns: 1.6fr 1fr 1fr 1fr; gap: 48px;
      margin-bottom: 48px;
    }
    .footer-brand .logo-text { color: var(--white); font-size: 22px; }
    .footer-brand img { height: 36px; filter: brightness(0) invert(1); }
    .footer-brand p { font-size: 14px; margin: 16px 0 24px; line-height: 1.75; color: rgba(255,255,255,.55); max-width: 280px; }
    .footer-socials { display: flex; gap: 10px; }
    .social-btn {
      width: 38px; height: 38px; border-radius: 10px;
      border: 1px solid rgba(255,255,255,.12); background: rgba(255,255,255,.06);
      display: flex; align-items: center; justify-content: center; font-size: 16px;
      text-decoration: none; transition: all .2s;
    }
    .social-btn:hover { border-color: rgba(255,255,255,.3); background: rgba(255,255,255,.1); }
    .footer-col h4 { font-family: var(--font-display); font-size: 14px; font-weight: 700; color: var(--white); margin-bottom: 16px; }
    .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .footer-col ul a { font-size: 14px; color: rgba(255,255,255,.5); text-decoration: none; transition: color .2s; }
    .footer-col ul a:hover { color: var(--white); }
    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,.08); padding-top: 28px;
      display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;
    }
    .footer-bottom p { font-size: 13px; color: rgba(255,255,255,.35); }

    /* ── MOBILE MENU ── */
    .nav-mobile {
      display: none; position: fixed; inset: 0;
      background: var(--white); z-index: 999;
      padding: 80px 32px 32px;
      flex-direction: column; gap: 4px;
    }
    .nav-mobile.open { display: flex; }
    .nav-mobile a {
      font-family: var(--font-display); font-size: 24px; font-weight: 700;
      color: var(--navy); text-decoration: none; padding: 14px 0;
      border-bottom: 1px solid var(--gray-100); transition: color .2s;
    }
    .nav-mobile a:hover { color: var(--accent); }
    .close-menu {
      position: absolute; top: 20px; right: 24px;
      font-size: 24px; cursor: pointer; color: var(--gray-600); background: none; border: none;
    }

    /* ── BADGE ── */
    .badge {
      display: inline-block; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 6px;
    }
    .badge-navy { background: var(--navy-soft); color: var(--navy); }
    .badge-accent { background: var(--accent-soft); color: var(--accent); }

    /* ── REVEAL ── */
    .reveal { opacity: 0; transform: translateY(24px); }

    /* ── RESPONSIVE ── */
    @media(max-width: 900px) {
      .footer-inner { grid-template-columns: 1fr 1fr; }
    }
    @media(max-width: 640px) {
      .nav-links { display: none; }
      .hamburger { display: flex; }
      .footer-inner { grid-template-columns: 1fr; gap: 32px; }
      section { padding: 64px 0; }
    }
  </style>
  @yield('head')
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="logo">
      <img src="https://levago.netlify.app/_next/image?url=%2Fimages%2Flevago%2Fbrand.png&w=256&q=75" alt="Levago" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
      <span class="logo-text" style="display:none">Levago</span>
    </a>
    <ul class="nav-links">
      <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
      <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
      <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio*') ? 'active' : '' }}">Portfolio</a></li>
      <li><a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a></li>
      <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a></li>
      <li><a href="{{ route('contact') }}" class="btn-nav">Konsultasi Gratis</a></li>
    </ul>
    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- Mobile Nav -->
<div class="nav-mobile" id="mobileNav">
  <button class="close-menu" id="closeMenu" aria-label="Tutup">✕</button>
  <a href="{{ route('home') }}" onclick="closeMobileNav()">Home</a>
  <a href="{{ route('about') }}" onclick="closeMobileNav()">About</a>
  <a href="{{ route('services') }}" onclick="closeMobileNav()">Services</a>
  <a href="{{ route('portfolio') }}" onclick="closeMobileNav()">Portfolio</a>
  <a href="{{ route('pricing') }}" onclick="closeMobileNav()">Pricing</a>
  <a href="{{ route('blog') }}" onclick="closeMobileNav()">Blog</a>
  <a href="{{ route('contact') }}" onclick="closeMobileNav()">Konsultasi Gratis →</a>
</div>

<!-- CONTENT -->
<main>
  @yield('content')
</main>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="footer-inner">
      <div class="footer-brand">
        <a href="{{ route('home') }}" class="logo" style="margin-bottom:0">
          <img src="https://levago.netlify.app/_next/image?url=%2Fimages%2Flevago%2Fbrand.png&w=256&q=75" alt="Levago" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
          <span class="logo-text" style="display:none">Levago</span>
        </a>
        <p>Partner digital bisnis terpercaya. Website, aplikasi, dan sistem yang membantu bisnis kamu tumbuh di era digital.</p>
        <div class="footer-socials">
          <a href="#" class="social-btn">📸</a>
          <a href="#" class="social-btn">💼</a>
          <a href="https://wa.me/6281234567890" class="social-btn" target="_blank">💬</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Layanan</h4>
        <ul>
          <li><a href="{{ route('services') }}">Company Profile</a></li>
          <li><a href="{{ route('services') }}">Landing Page</a></li>
          <li><a href="{{ route('services') }}">E-Commerce</a></li>
          <li><a href="{{ route('services') }}">Custom Web App</a></li>
          <li><a href="{{ route('services') }}">Mobile App</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Perusahaan</h4>
        <ul>
          <li><a href="{{ route('about') }}">Tentang Kami</a></li>
          <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
          <li><a href="{{ route('blog') }}">Blog</a></li>
          <li><a href="{{ route('pricing') }}">Harga</a></li>
          <li><a href="{{ route('contact') }}">Kontak</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Kontak</h4>
        <ul>
          <li><a href="https://wa.me/6281234567890">+62 812-3456-7890</a></li>
          <li><a href="mailto:hello@levago.id">hello@levago.id</a></li>
          <li><a href="#">Jakarta, Indonesia</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© {{ date('Y') }} Levago Indonesia. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
  // Navbar scroll
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 40);
  });

  // Mobile nav
  document.getElementById('hamburgerBtn').addEventListener('click', () => {
    document.getElementById('mobileNav').classList.add('open');
    document.body.style.overflow = 'hidden';
  });
  document.getElementById('closeMenu').addEventListener('click', closeMobileNav);
  function closeMobileNav() {
    document.getElementById('mobileNav').classList.remove('open');
    document.body.style.overflow = '';
  }

  // GSAP Scroll Reveal
  gsap.registerPlugin(ScrollTrigger);
  gsap.utils.toArray('.reveal').forEach((el, i) => {
    gsap.to(el, {
      opacity: 1, y: 0, duration: 0.7, ease: 'power2.out',
      scrollTrigger: {
        trigger: el, start: 'top 88%', toggleActions: 'play none none none'
      },
      delay: (i % 4) * 0.08
    });
  });
</script>

@yield('scripts')
</body>
</html>