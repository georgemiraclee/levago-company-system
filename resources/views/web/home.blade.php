@extends('layouts.web')
@section('title', 'Levago — Partner Digital Bisnis Kamu')

@section('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* ══════════════════════════════════════════
   ROOT VARIABLES
══════════════════════════════════════════ */
:root {
  --navy:        #0A1628;
  --navy-dark:   #060E1C;
  --navy-light:  #0F2040;
  --navy-soft:   rgba(15,32,64,.08);
  --accent:      #2563EB;
  --accent-soft: rgba(37,99,235,.08);
  --white:       #ffffff;
  --gray-50:     #F8FAFC;
  --gray-100:    #F1F5F9;
  --gray-200:    #E2E8F0;
  --gray-400:    #94A3B8;
  --text:        #0F172A;
  --text-muted:  #64748B;
  --radius:      12px;
  --radius-lg:   20px;
  --shadow:      0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.04);
  --shadow-lg:   0 8px 32px rgba(0,0,0,.12), 0 2px 8px rgba(0,0,0,.06);
  --font-display:'Plus Jakarta Sans', sans-serif;
  --font-body:   'DM Sans', sans-serif;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ══════════════════════════════════════════
   HERO — WHITE BACKGROUND
══════════════════════════════════════════ */
#hero {
  min-height: 100vh;
  display: flex; align-items: center;
  position: relative; overflow: hidden; padding: 0;
  background: #ffffff;
}

/* Subtle decorative background elements */
.hero-bg-decor {
  position: absolute; inset: 0; z-index: 0; pointer-events: none; overflow: hidden;
}
.hero-bg-decor::before {
  content: '';
  position: absolute;
  top: -200px; right: -200px;
  width: 700px; height: 700px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(37,99,235,.06) 0%, transparent 65%);
}
.hero-bg-decor::after {
  content: '';
  position: absolute;
  bottom: -150px; left: -150px;
  width: 500px; height: 500px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(99,102,241,.05) 0%, transparent 65%);
}
.hero-grid-decor {
  position: absolute; inset: 0; z-index: 0; pointer-events: none;
  background-image:
    linear-gradient(rgba(37,99,235,.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(37,99,235,.04) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(ellipse 85% 85% at 50% 50%, black 30%, transparent 100%);
}

.hero-inner {
  max-width: 1200px; margin: 0 auto;
  padding: 140px 24px 100px;
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 72px; align-items: center;
  position: relative; z-index: 10;
}

.hero-badge {
  display: inline-flex; align-items: center; gap: 8px;
  font-family: var(--font-body); font-size: 12px; font-weight: 500;
  color: var(--accent);
  background: var(--accent-soft); border: 1px solid rgba(37,99,235,.2);
  padding: 7px 16px; border-radius: 100px; margin-bottom: 28px;
  letter-spacing: .02em;
}
.badge-dot {
  width: 7px; height: 7px; border-radius: 50%; background: #4ADE80;
  box-shadow: 0 0 8px rgba(74,222,128,.7); animation: blink 2s ease-in-out infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.4} }

.hero-h1 {
  font-family: var(--font-display);
  font-size: clamp(38px, 5vw, 62px); font-weight: 900;
  line-height: 1.07; color: var(--navy); margin-bottom: 22px;
}
.hero-h1 .hl {
  color: transparent;
  background: linear-gradient(135deg, #1e40af 0%, #2563eb 60%, #3b82f6 100%);
  -webkit-background-clip: text; background-clip: text;
}
.hero-sub {
  font-family: var(--font-body); font-size: 17px;
  color: var(--text-muted); line-height: 1.8;
  margin-bottom: 38px; max-width: 500px;
}
.hero-sub strong { color: var(--navy); font-weight: 600; }

.hero-ctas { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 52px; }

.btn-primary {
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--navy); color: #fff;
  padding: 14px 28px; border-radius: var(--radius);
  font-family: var(--font-display); font-weight: 800; font-size: 14px;
  text-decoration: none; letter-spacing: .01em;
  transition: transform .2s, box-shadow .2s;
  box-shadow: 0 4px 20px rgba(10,22,40,.2);
}
.btn-primary:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(10,22,40,.28); }

.btn-ghost {
  display: inline-flex; align-items: center; gap: 8px;
  background: transparent; color: var(--navy);
  padding: 14px 28px; border-radius: var(--radius);
  font-family: var(--font-display); font-weight: 600; font-size: 14px;
  text-decoration: none; border: 1.5px solid var(--gray-200);
  transition: all .2s;
}
.btn-ghost:hover { background: var(--gray-100); border-color: var(--gray-400); transform: translateY(-3px); }

.hero-stats { display: flex; gap: 0; flex-wrap: wrap; }
.hstat { padding: 0 32px 0 0; margin-right: 32px; border-right: 1px solid var(--gray-200); }
.hstat:last-child { border-right: none; margin-right: 0; }
.hstat strong {
  font-family: var(--font-display); font-size: 30px; font-weight: 900; display: block; line-height: 1;
  color: var(--navy);
}
.hstat span { font-family: var(--font-body); font-size: 12px; color: var(--text-muted); margin-top: 5px; display: block; letter-spacing: .03em; }

/* ===============================
   SIMPLE ANIMATION
=============================== */
.js-reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.7s cubic-bezier(.16,1,.3,1);
}
.js-reveal.show { opacity: 1; transform: translateY(0); }

.js-ctr {
  opacity: 0;
  transform: translateY(20px);
  transition: all .6s ease;
}
.js-ctr.show { opacity: 1; transform: translateY(0); }

/* float cards */
.float-cards { display: flex; flex-direction: column; gap: 14px; }
.fcard {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: 18px; padding: 22px 26px;
  box-shadow: var(--shadow-lg);
  transition: border-color .3s, box-shadow .3s;
}
.fcard:hover { border-color: rgba(37,99,235,.3); box-shadow: 0 16px 48px rgba(0,0,0,.12); }
.fc-label { font-family: var(--font-body); font-size: 10px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: .1em; margin-bottom: 12px; }
.fc-row { display: flex; align-items: center; justify-content: space-between; }
.fc-num { font-family: var(--font-display); font-size: 28px; font-weight: 900; color: var(--navy); }
.fc-pill { font-family: var(--font-body); font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 100px; }
.pill-g { background: rgba(74,222,128,.12); color: #16A34A; border: 1px solid rgba(74,222,128,.3); }
.pill-b { background: rgba(37,99,235,.08); color: var(--accent); border: 1px solid rgba(37,99,235,.2); }
.fc-bar { height: 3px; background: var(--gray-100); border-radius: 4px; margin-top: 14px; overflow: hidden; }
.fc-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, #60A5FA, #818CF8); transform-origin: left; animation: barFill .9s .4s cubic-bezier(.16,1,.3,1) forwards; transform: scaleX(0); }
@keyframes barFill { to { transform: scaleX(1); } }

/* scroll hint */
.hero-scroll-hint {
  position: absolute; bottom: 36px; left: 50%; transform: translateX(-50%);
  z-index: 10; display: flex; flex-direction: column; align-items: center; gap: 8px;
}
.scroll-word { font-family: var(--font-body); font-size: 10px; color: var(--gray-400); letter-spacing: .15em; text-transform: uppercase; }
.scroll-line {
  width: 1px; height: 48px;
  background: linear-gradient(to bottom, var(--gray-400), transparent);
  animation: scrolldrop 2s ease-in-out infinite;
}
@keyframes scrolldrop {
  0%   { transform: scaleY(0); transform-origin: top; }
  45%  { transform: scaleY(1); transform-origin: top; }
  55%  { transform: scaleY(1); transform-origin: bottom; }
  100% { transform: scaleY(0); transform-origin: bottom; }
}

/* ══════════════════════════════════════════
   SHARED
══════════════════════════════════════════ */
section { padding: 100px 0; }
.container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

.sec-label {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: var(--font-body); font-size: 11px; font-weight: 700;
  text-transform: uppercase; letter-spacing: .12em;
  color: var(--accent); background: var(--accent-soft);
  border: 1px solid rgba(37,99,235,.15);
  padding: 6px 14px; border-radius: 100px; margin-bottom: 16px;
}
.sec-title {
  font-family: var(--font-display);
  font-size: clamp(28px, 3.8vw, 46px); font-weight: 900;
  color: var(--navy); line-height: 1.12; margin-bottom: 14px;
}
.sec-sub { font-family: var(--font-body); font-size: 16px; color: var(--text-muted); line-height: 1.75; max-width: 560px; }

.btn-outline {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: var(--font-display); font-size: 14px; font-weight: 700;
  color: var(--accent); background: transparent;
  border: 1.5px solid rgba(37,99,235,.25); padding: 10px 22px;
  border-radius: var(--radius); text-decoration: none; transition: all .22s;
}
.btn-outline:hover { background: var(--accent-soft); border-color: var(--accent); }

/* ══════════════════════════════════════════
   MARQUEE
══════════════════════════════════════════ */
.marquee-wrap {
  background: var(--navy); padding: 18px 0; overflow: hidden;
  border-top: 1px solid rgba(255,255,255,.05);
  border-bottom: 1px solid rgba(255,255,255,.05);
}
.marquee-track { display: flex; white-space: nowrap; animation: marquee 28s linear infinite; }
.marquee-track:hover { animation-play-state: paused; }
.mitem { display: inline-flex; align-items: center; gap: 14px; padding: 0 28px; font-family: var(--font-display); font-size: 13px; font-weight: 700; color: rgba(255,255,255,.32); letter-spacing: .04em; }
.mitem .msep { color: #60A5FA; opacity: .5; font-size: 10px; }
@keyframes marquee { 0%{ transform:translateX(0) } 100%{ transform:translateX(-50%) } }

/* ══════════════════════════════════════════
   COUNTERS
══════════════════════════════════════════ */
.counters-section {
  background: var(--navy); padding: 80px 0;
  border-top: 1px solid rgba(255,255,255,.04);
  border-bottom: 1px solid rgba(255,255,255,.04);
}
.counters-grid { display: grid; grid-template-columns: repeat(4, 1fr); }
.ctr-item { text-align: center; padding: 20px 12px; position: relative; }
.ctr-item + .ctr-item::before { content: ''; position: absolute; left: 0; top: 15%; bottom: 15%; width: 1px; background: rgba(255,255,255,.06); }
.ctr-val {
  font-family: var(--font-display);
  font-size: clamp(34px, 4.5vw, 54px); font-weight: 900;
  background: linear-gradient(135deg, #fff 40%, rgba(96,165,250,.75));
  -webkit-background-clip: text; background-clip: text; color: transparent;
  display: block; line-height: 1;
}
.ctr-lbl { font-family: var(--font-body); font-size: 13px; color: rgba(255,255,255,.38); margin-top: 8px; letter-spacing: .04em; }

/* ══════════════════════════════════════════
   PROBLEM
══════════════════════════════════════════ */
#problem { background: var(--gray-50); }
.problem-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-top: 56px; }
.pcard {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow);
  transition: all .35s cubic-bezier(.16,1,.3,1); position: relative; overflow: hidden;
}
.pcard::after {
  content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, var(--accent), #818CF8);
  transform: scaleX(0); transform-origin: left; transition: transform .35s cubic-bezier(.16,1,.3,1);
}
.pcard:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: rgba(37,99,235,.2); }
.pcard:hover::after { transform: scaleX(1); }
.pcard-icon { width: 54px; height: 54px; border-radius: 14px; background: var(--navy-soft); display: flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 20px; }
.pcard h3 { font-family: var(--font-display); font-size: 17px; font-weight: 800; color: var(--navy); margin-bottom: 10px; }
.pcard p  { font-family: var(--font-body); font-size: 14px; color: var(--text-muted); line-height: 1.7; }

/* ══════════════════════════════════════════
   SOLUTION
══════════════════════════════════════════ */
.sol-wrap { display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }
.sol-list { display: flex; flex-direction: column; gap: 12px; margin-top: 28px; }
.sitem {
  display: flex; gap: 18px;
  background: #fff; border: 1px solid var(--gray-200);
  padding: 22px; border-radius: var(--radius); box-shadow: var(--shadow);
  transition: all .3s cubic-bezier(.16,1,.3,1);
}
.sitem:hover { border-color: rgba(37,99,235,.25); box-shadow: var(--shadow-lg); transform: translateX(6px); }
.sicon { width: 46px; height: 46px; flex-shrink: 0; border-radius: 12px; background: var(--accent-soft); display: flex; align-items: center; justify-content: center; font-size: 20px; }
.stext h4 { font-family: var(--font-display); font-weight: 800; color: var(--navy); margin-bottom: 4px; font-size: 15px; }
.stext p  { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); line-height: 1.6; }
.sol-visual {
  background: var(--navy); border-radius: var(--radius-lg); padding: 40px; position: relative; overflow: hidden;
}
.sol-visual::before {
  content: ''; position: absolute; top: -100px; right: -100px; width: 320px; height: 320px;
  border-radius: 50%; background: radial-gradient(circle, rgba(96,165,250,.10), transparent 70%); pointer-events: none;
}
.tech-title { font-family: var(--font-body); font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: rgba(255,255,255,.32); margin-bottom: 10px; }
.tech-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
.ttag {
  font-family: var(--font-body); font-size: 12px; font-weight: 500;
  padding: 6px 14px; border-radius: 100px;
  border: 1px solid rgba(255,255,255,.10); color: rgba(255,255,255,.62);
  background: rgba(255,255,255,.05); transition: all .22s; cursor: default;
}
.ttag:hover { background: rgba(96,165,250,.14); border-color: rgba(96,165,250,.3); color: #60A5FA; }
.sol-stats { display: flex; gap: 24px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,.07); margin-top: 8px; }
.solstat strong { font-family: var(--font-display); font-size: 26px; font-weight: 900; color: #fff; display: block; }
.solstat span   { font-family: var(--font-body); font-size: 12px; color: rgba(255,255,255,.38); }

/* ══════════════════════════════════════════
   HOW
══════════════════════════════════════════ */
#how { background: var(--gray-50); }
.steps-wrap { display: grid; grid-template-columns: repeat(6,1fr); gap: 0; margin-top: 56px; position: relative; }
.steps-track { position: absolute; top: 27px; left: calc(100%/12); right: calc(100%/12); height: 2px; background: var(--gray-200); z-index: 0; }
.steps-track-fill { height: 100%; width: 0; background: linear-gradient(90deg, var(--accent), #818CF8); border-radius: 2px; }
.step { text-align: center; padding: 0 10px; position: relative; z-index: 1; }
.step-num {
  width: 56px; height: 56px; border-radius: 50%;
  background: #fff; border: 2px solid var(--gray-200);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-display); font-size: 17px; font-weight: 900; color: var(--navy);
  margin: 0 auto 18px; box-shadow: var(--shadow);
  transition: all .35s cubic-bezier(.16,1,.3,1);
}
.step:hover .step-num { border-color: var(--accent); background: var(--accent-soft); color: var(--accent); }
.step h3 { font-family: var(--font-display); font-size: 14px; font-weight: 800; color: var(--navy); margin-bottom: 6px; }
.step p  { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); line-height: 1.55; }

/* ══════════════════════════════════════════
   SERVICES
══════════════════════════════════════════ */
.svcs-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px,1fr)); gap: 20px; margin-top: 56px; }
.svc-card {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); padding: 36px; box-shadow: var(--shadow);
  transition: all .35s cubic-bezier(.16,1,.3,1); position: relative; overflow: hidden;
}
.svc-card::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(37,99,235,.035), transparent 55%);
  opacity: 0; transition: opacity .35s;
}
.svc-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-8px); border-color: rgba(37,99,235,.2); }
.svc-card:hover::before { opacity: 1; }
.svc-icon { width: 58px; height: 58px; border-radius: 16px; background: var(--navy-soft); display: flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 22px; }
.svc-card h3 { font-family: var(--font-display); font-size: 20px; font-weight: 800; color: var(--navy); margin-bottom: 12px; }
.svc-card p  { font-family: var(--font-body); font-size: 14px; color: var(--text-muted); line-height: 1.75; margin-bottom: 18px; }
.svc-list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.svc-list li { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); display: flex; gap: 10px; align-items: center; }
.svc-list li::before { content:'✓'; color: var(--accent); font-weight: 900; flex-shrink: 0; }

/* ══════════════════════════════════════════
   PORTFOLIO
══════════════════════════════════════════ */
#portfolio-preview { background: var(--gray-50); }
.port-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px,1fr)); gap: 24px; margin-top: 56px; }
.port-card {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow);
  transition: all .35s cubic-bezier(.16,1,.3,1); text-decoration: none; color: inherit; display: block;
}
.port-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-8px); border-color: rgba(37,99,235,.2); }
.port-card:hover .port-thumb img { transform: scale(1.07); }
.port-thumb { height: 210px; position: relative; overflow: hidden; background: var(--navy-soft); display: flex; align-items: center; justify-content: center; }
.port-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s cubic-bezier(.16,1,.3,1); }
.port-thumb .plabel { position: absolute; top: 14px; left: 14px; font-family: var(--font-body); font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 6px; background: var(--navy); color: rgba(255,255,255,.8); }
.port-info { padding: 24px; }
.port-info h3 { font-family: var(--font-display); font-size: 18px; font-weight: 800; color: var(--navy); margin-bottom: 8px; }
.port-info p  { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); margin-bottom: 16px; line-height: 1.65; }
.port-tags { display: flex; gap: 6px; flex-wrap: wrap; }
.ptag { font-family: var(--font-body); font-size: 11px; padding: 4px 10px; border-radius: 6px; background: var(--navy-soft); color: var(--navy); font-weight: 500; }

/* ══════════════════════════════════════════
   BLOG
══════════════════════════════════════════ */
.blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px,1fr)); gap: 24px; margin-top: 56px; }
.bcard {
  background: #fff; border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow);
  transition: all .35s cubic-bezier(.16,1,.3,1); text-decoration: none; color: inherit; display: block;
}
.bcard:hover { box-shadow: var(--shadow-lg); transform: translateY(-6px); border-color: rgba(37,99,235,.2); }
.bcard:hover .bthumb img { transform: scale(1.06); }
.bthumb { height: 190px; background: var(--navy-soft); overflow: hidden; }
.bthumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s cubic-bezier(.16,1,.3,1); }
.binfo { padding: 24px; }
.bcat { font-family: var(--font-body); font-size: 11px; font-weight: 700; color: var(--accent); text-transform: uppercase; letter-spacing: .1em; margin-bottom: 10px; }
.binfo h3 { font-family: var(--font-display); font-size: 17px; font-weight: 800; color: var(--navy); margin-bottom: 8px; line-height: 1.4; }
.binfo p  { font-family: var(--font-body); font-size: 13px; color: var(--text-muted); line-height: 1.65; margin-bottom: 16px; }
.bmeta { font-family: var(--font-body); font-size: 12px; color: var(--gray-400); }

/* ══════════════════════════════════════════
   CTA FINAL
══════════════════════════════════════════ */
#cta-final {
  background: var(--navy); text-align: center; padding: 120px 0; position: relative; overflow: hidden;
}
.cta-glow {
  position: absolute; width: 700px; height: 700px; border-radius: 50%;
  top: 50%; left: 50%; transform: translate(-50%,-50%);
  background: radial-gradient(circle, rgba(37,99,235,.14) 0%, transparent 70%);
  pointer-events: none;
}
.cta-inner { position: relative; z-index: 1; }
#cta-final .sec-title { color: #fff; max-width: 640px; margin: 0 auto 16px; }
#cta-final p { font-family: var(--font-body); color: rgba(255,255,255,.52); font-size: 17px; max-width: 480px; margin: 0 auto 40px; line-height: 1.75; }
.cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

/* CTA buttons — light versions for dark section */
#cta-final .btn-primary {
  background: #fff; color: var(--navy);
  box-shadow: 0 4px 20px rgba(255,255,255,.15);
}
#cta-final .btn-primary:hover { box-shadow: 0 12px 32px rgba(255,255,255,.25); }
#cta-final .btn-ghost {
  background: rgba(255,255,255,.08); color: rgba(255,255,255,.85);
  border-color: rgba(255,255,255,.2);
}
#cta-final .btn-ghost:hover { background: rgba(255,255,255,.15); border-color: rgba(255,255,255,.4); }

/* ══════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════ */
@media(max-width:900px){
  .hero-inner { grid-template-columns:1fr; padding-top:120px; padding-bottom:80px; }
  .float-cards { display:none; }
  .sol-wrap { grid-template-columns:1fr; }
  .steps-wrap { grid-template-columns:repeat(3,1fr); }
  .steps-track { display:none; }
  .counters-grid { grid-template-columns:repeat(2,1fr); }
}
@media(max-width:640px){
  section { padding:80px 0; }
  .steps-wrap { grid-template-columns:repeat(2,1fr); gap:28px; }
  .hstat { padding:0 20px 0 0; margin-right:20px; }
  .counters-grid { grid-template-columns:repeat(2,1fr); }
}
</style>
@endsection

@section('content')

<!-- ════════ HERO ════════ -->
<section id="hero">
  <div class="hero-bg-decor"></div>
  <div class="hero-grid-decor"></div>

  <div class="hero-inner">
    <div id="heroLeft">
      <div class="hero-badge" id="hBadge">
        <span class="badge-dot"></span>
        Dipercaya 50+ bisnis di Indonesia
      </div>
      <h1 class="hero-h1" id="hTitle">
        Bikin Website &amp;<br>
        <span class="hl">Aplikasi Bisnis</span><br>
        Tanpa Ribet
      </h1>
      <p class="hero-sub" id="hSub">
        Levago adalah <strong>partner digital bisnis</strong> yang membantu UMKM, startup, dan personal brand tampil profesional — dari konsultasi hingga maintenance.
      </p>
      <div class="hero-ctas" id="hCtas">
        <a href="{{ route('contact') }}" class="btn-primary">💬 Konsultasi Gratis</a>
        <a href="{{ route('services') }}" class="btn-ghost">Lihat Layanan →</a>
      </div>
      <div class="hero-stats" id="hStats">
        <div class="hstat"><strong><span class="hcnt" data-to="50" data-sfx="+">50+</span></strong><span>Project Selesai</span></div>
        <div class="hstat"><strong>3 Thn</strong><span>Pengalaman</span></div>
        <div class="hstat"><strong><span class="hcnt" data-to="98" data-sfx="%">98%</span></strong><span>Client Puas</span></div>
        <div class="hstat"><strong>24/7</strong><span>Support</span></div>
      </div>
    </div>

    <div class="float-cards" id="hCards">
      <div class="fcard">
        <div class="fc-label">Revenue Bisnis Client</div>
        <div class="fc-row"><div class="fc-num">+240%</div><div class="fc-pill pill-g">↑ Naik</div></div>
        <div class="fc-bar"><div class="fc-fill" style="width:75%"></div></div>
      </div>
      <div class="fcard">
        <div class="fc-label">Leads Masuk / Bulan</div>
        <div class="fc-row"><div class="fc-num">128</div><div class="fc-pill pill-b">Rata-rata</div></div>
        <div class="fc-bar"><div class="fc-fill" style="width:60%"></div></div>
      </div>
      <div class="fcard">
        <div class="fc-label">Website Uptime</div>
        <div class="fc-row"><div class="fc-num">99.9%</div><div class="fc-pill pill-g">Stabil</div></div>
        <div class="fc-bar"><div class="fc-fill" style="width:99%;background:linear-gradient(90deg,#4ADE80,#22C55E)"></div></div>
      </div>
    </div>
  </div>

  <div class="hero-scroll-hint">
    <span class="scroll-word">Scroll</span>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- ════════ MARQUEE ════════ -->
<div class="marquee-wrap">
  <div class="marquee-track">
    <span class="mitem">Website Profesional <span class="msep">✦</span></span>
    <span class="mitem">E-Commerce <span class="msep">✦</span></span>
    <span class="mitem">Landing Page <span class="msep">✦</span></span>
    <span class="mitem">Aplikasi Bisnis <span class="msep">✦</span></span>
    <span class="mitem">SEO Optimization <span class="msep">✦</span></span>
    <span class="mitem">Laravel &amp; React <span class="msep">✦</span></span>
    <span class="mitem">UI/UX Design <span class="msep">✦</span></span>
    <span class="mitem">24/7 Maintenance <span class="msep">✦</span></span>
    <span class="mitem">Website Profesional <span class="msep">✦</span></span>
    <span class="mitem">E-Commerce <span class="msep">✦</span></span>
    <span class="mitem">Landing Page <span class="msep">✦</span></span>
    <span class="mitem">Aplikasi Bisnis <span class="msep">✦</span></span>
    <span class="mitem">SEO Optimization <span class="msep">✦</span></span>
    <span class="mitem">Laravel &amp; React <span class="msep">✦</span></span>
    <span class="mitem">UI/UX Design <span class="msep">✦</span></span>
    <span class="mitem">24/7 Maintenance <span class="msep">✦</span></span>
  </div>
</div>

<!-- ════════ COUNTERS ════════ -->
<div class="counters-section">
  <div class="container">
    <div class="counters-grid">
      <div class="ctr-item js-ctr"><span class="ctr-val" data-to="50"  data-sfx="+">50+</span><div class="ctr-lbl">Project Selesai</div></div>
      <div class="ctr-item js-ctr"><span class="ctr-val" data-to="3"   data-sfx=" Thn">3 Thn</span><div class="ctr-lbl">Pengalaman</div></div>
      <div class="ctr-item js-ctr"><span class="ctr-val" data-to="98"  data-sfx="%">98%</span><div class="ctr-lbl">Client Puas</div></div>
      <div class="ctr-item js-ctr"><span class="ctr-val" data-to="100" data-sfx="%">100%</span><div class="ctr-lbl">Garansi Revisi</div></div>
    </div>
  </div>
</div>

<!-- ════════ PROBLEM ════════ -->
<section id="problem">
  <div class="container">
    <div class="js-reveal" style="text-align:center">
      <div class="sec-label">😓 Pain Points</div>
      <h2 class="sec-title">Bisnis Kamu Terhambat Karena Ini?</h2>
      <p class="sec-sub" style="margin:0 auto">Banyak bisnis kehilangan peluang besar karena masalah-masalah ini.</p>
    </div>
    <div class="problem-grid">
      <div class="pcard js-reveal"><div class="pcard-icon">😕</div><h3>Tidak Dipercaya Tanpa Website</h3><p>Calon customer ragu karena kamu tidak punya kehadiran digital yang profesional.</p></div>
      <div class="pcard js-reveal"><div class="pcard-icon">💸</div><h3>Margin Kepotong Marketplace</h3><p>Biaya komisi marketplace terus menggerus keuntungan bisnis kamu setiap bulannya.</p></div>
      <div class="pcard js-reveal"><div class="pcard-icon">😰</div><h3>Ribet Operasional Digital</h3><p>Tidak ada tim IT sendiri, semua dikerjakan manual dan tidak efisien.</p></div>
      <div class="pcard js-reveal"><div class="pcard-icon">📉</div><h3>Sulit Scaling Bisnis</h3><p>Tanpa sistem yang proper, bisnis kamu stagnan dan susah berkembang.</p></div>
    </div>
  </div>
</section>

<!-- ════════ SOLUTION ════════ -->
<section id="solution">
  <div class="container">
    <div class="sol-wrap">
      <div>
        <div class="sec-label js-reveal">✅ Solusi Levago</div>
        <h2 class="sec-title js-reveal">Solusi Lengkap Supaya Bisnis Kamu <span style="color:var(--accent)">StandOut</span></h2>
        <p class="sec-sub js-reveal">Levago bukan sekadar jasa buat website — kami adalah partner digital yang memastikan bisnis kamu tumbuh.</p>
        <div class="sol-list">
          <div class="sitem js-reveal"><div class="sicon">⚡</div><div class="stext"><h4>Full Custom &amp; Fleksibel</h4><p>Dibangun sesuai kebutuhan spesifik bisnis kamu, bukan template biasa.</p></div></div>
          <div class="sitem js-reveal"><div class="sicon">🛡️</div><div class="stext"><h4>Secure &amp; Reliable</h4><p>Keamanan level enterprise dengan uptime 99.9% dan backup otomatis.</p></div></div>
          <div class="sitem js-reveal"><div class="sicon">🔧</div><div class="stext"><h4>Maintenance Included</h4><p>Tidak perlu khawatir soal update — semua kami yang handle.</p></div></div>
          <div class="sitem js-reveal"><div class="sicon">💰</div><div class="stext"><h4>Affordable &amp; Transparan</h4><p>Harga mulai dari 1 juta/tahun, tanpa biaya tersembunyi.</p></div></div>
        </div>
      </div>
      <div class="sol-visual js-reveal">
        <div class="tech-title">🛠️ Tech Stack Kami</div>
        <div class="tech-title" style="margin-top:16px">Frontend</div>
        <div class="tech-tags"><span class="ttag">Laravel Blade</span><span class="ttag">Tailwind CSS</span><span class="ttag">React</span><span class="ttag">Next.js</span></div>
        <div class="tech-title">Backend</div>
        <div class="tech-tags"><span class="ttag">Laravel</span><span class="ttag">Node.js</span><span class="ttag">Filament</span><span class="ttag">MySQL</span></div>
        <div class="tech-title">Hosting</div>
        <div class="tech-tags"><span class="ttag">VPS Hostinger</span><span class="ttag">Docker</span><span class="ttag">GitHub CI/CD</span></div>
        <div class="sol-stats">
          <div class="solstat"><strong>50+</strong><span>Project Live</span></div>
          <div class="solstat"><strong>3 Thn</strong><span>Pengalaman</span></div>
          <div class="solstat"><strong>100%</strong><span>Garansi Revisi</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════════ HOW IT WORKS ════════ -->
<section id="how">
  <div class="container">
    <div class="js-reveal" style="text-align:center">
      <div class="sec-label">⚙️ Cara Kerja</div>
      <h2 class="sec-title">Proses Simpel, Hasil Maksimal</h2>
      <p class="sec-sub" style="margin:0 auto">Semuanya terencana dengan baik dan dikembangkan dengan penuh perhatian.</p>
    </div>
    <div class="steps-wrap" id="stepsWrap">
      <div class="steps-track"><div class="steps-track-fill" id="stepsFill"></div></div>
      <div class="step js-reveal"><div class="step-num">1</div><h3>Konsultasi</h3><p>Diskusi kebutuhan &amp; tujuan bisnis gratis</p></div>
      <div class="step js-reveal"><div class="step-num">2</div><h3>Konsep</h3><p>Desain UI/UX dan proposal teknis</p></div>
      <div class="step js-reveal"><div class="step-num">3</div><h3>Development</h3><p>Build dengan laporan progress mingguan</p></div>
      <div class="step js-reveal"><div class="step-num">4</div><h3>Revisi</h3><p>Feedback hingga kamu benar-benar puas</p></div>
      <div class="step js-reveal"><div class="step-num">5</div><h3>Go Live</h3><p>Deploy dan website resmi online</p></div>
      <div class="step js-reveal"><div class="step-num">6</div><h3>Maintenance</h3><p>Dukungan teknis berkelanjutan</p></div>
    </div>
  </div>
</section>

<!-- ════════ SERVICES ════════ -->
<section id="services-preview">
  <div class="container">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:16px;margin-bottom:0">
      <div class="js-reveal">
        <div class="sec-label">🧩 Layanan</div>
        <h2 class="sec-title" style="margin-bottom:0">Semua Yang Bisnis Kamu Butuhkan</h2>
      </div>
      <a href="{{ route('services') }}" class="btn-outline js-reveal">Lihat Semua →</a>
    </div>
    <div class="svcs-grid">
      <div class="svc-card js-reveal"><div class="svc-icon">🏢</div><h3>Company Profile</h3><p>Website profesional yang membangun trust dan meningkatkan kredibilitas bisnis kamu.</p><ul class="svc-list"><li>Desain custom sesuai brand</li><li>SEO-friendly &amp; fast loading</li><li>CMS admin panel</li></ul></div>
      <div class="svc-card js-reveal"><div class="svc-icon">🎯</div><h3>Landing Page</h3><p>Halaman penjualan yang dioptimasi untuk konversi tinggi.</p><ul class="svc-list"><li>Copywriting persuasif</li><li>WhatsApp integration</li><li>Analytics setup</li></ul></div>
      <div class="svc-card js-reveal"><div class="svc-icon">🛒</div><h3>E-Commerce</h3><p>Toko online lengkap dengan manajemen produk dan pembayaran.</p><ul class="svc-list"><li>Payment gateway</li><li>Order tracking</li><li>Inventory system</li></ul></div>
    </div>
  </div>
</section>

<!-- ════════ PORTFOLIO ════════ -->
@if($featuredPortfolios->isNotEmpty())
<section id="portfolio-preview">
  <div class="container">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:16px;margin-bottom:0">
      <div class="js-reveal"><div class="sec-label">💼 Portfolio</div><h2 class="sec-title" style="margin-bottom:0">Karya Yang Sudah Kami Bangun</h2></div>
      <a href="{{ route('portfolio') }}" class="btn-outline js-reveal">Semua Portfolio →</a>
    </div>
    <div class="port-grid">
      @foreach($featuredPortfolios->take(3) as $p)
      <a href="{{ route('portfolio.show', $p->slug) }}" class="port-card js-reveal">
        <div class="port-thumb">
          @if($p->images && count($p->images) > 0)
            <img src="{{ $p->images[0] }}" alt="{{ $p->title }}">
          @else
            <span style="font-size:52px;opacity:.2">🖥️</span>
          @endif
          <div class="plabel">{{ $p->category }}</div>
        </div>
        <div class="port-info">
          <h3>{{ $p->title }}</h3>
          <p>{{ Str::limit($p->description, 80) }}</p>
          <div class="port-tags">@foreach(($p->tech_stack ?? []) as $tech)<span class="ptag">{{ $tech }}</span>@endforeach</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ════════ BLOG ════════ -->
@if($latestBlogs->isNotEmpty())
<section id="blog-preview">
  <div class="container">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:16px;margin-bottom:0">
      <div class="js-reveal"><div class="sec-label">📝 Blog</div><h2 class="sec-title" style="margin-bottom:0">Insight &amp; Tips Digital</h2></div>
      <a href="{{ route('blog') }}" class="btn-outline js-reveal">Semua Artikel →</a>
    </div>
    <div class="blog-grid">
      @foreach($latestBlogs as $blog)
      <a href="{{ route('blog.show', $blog->slug) }}" class="bcard js-reveal">
        <div class="bthumb">@if($blog->thumbnail)<img src="{{ asset('storage/'.$blog->thumbnail) }}" alt="{{ $blog->title }}">@endif</div>
        <div class="binfo">
          <div class="bcat">{{ $blog->category ?? 'Tips' }}</div>
          <h3>{{ $blog->title }}</h3>
          <p>{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 90) }}</p>
          <div class="bmeta">{{ \Carbon\Carbon::parse($blog->published_at)->format('d M Y') }}</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ════════ CTA ════════ -->
<section id="cta-final">
  <div class="cta-glow"></div>
  <div class="container">
    <div class="cta-inner js-reveal">
      <div class="sec-label" style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.75);border-color:rgba(255,255,255,.12);margin:0 auto 24px;display:table">🚀 Mulai Sekarang</div>
      <h2 class="sec-title" style="color:#fff;max-width:640px;margin:0 auto 16px">Mulai Tingkatkan Brand &amp; Order Bisnis Kamu</h2>
      <p>Bergabung bersama 50+ bisnis yang sudah mempercayakan digital presence mereka ke Levago.</p>
      <div class="cta-btns">
        <a href="https://wa.me/6281234567890?text=Halo%20Levago%2C%20saya%20ingin%20konsultasi%20gratis" class="btn-primary" target="_blank" rel="noopener">💬 Chat WhatsApp</a>
        <a href="{{ route('contact') }}" class="btn-ghost">📋 Isi Form Konsultasi</a>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

  /* ===============================
     1. SIMPLE COUNTER
  =============================== */
  function animateCounter(el) {
    const target = parseInt(el.dataset.to);
    const suffix = el.dataset.sfx || "";
    let current = 0;
    const increment = target / 60;

    function update() {
      current += increment;
      if (current < target) {
        el.textContent = Math.floor(current) + suffix;
        requestAnimationFrame(update);
      } else {
        el.textContent = target + suffix;
      }
    }
    update();
  }

  /* ===============================
     2. INTERSECTION OBSERVER
  =============================== */
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");

        if (entry.target.classList.contains("js-ctr")) {
          const el = entry.target.querySelector(".ctr-val");
          if (el && !el.classList.contains("counted")) {
            animateCounter(el);
            el.classList.add("counted");
          }
        }
      }
    });
  }, { threshold: 0.15 });

  document.querySelectorAll(".js-reveal, .js-ctr").forEach(el => {
    observer.observe(el);
  });

  /* ===============================
     3. HERO ENTRY ANIMATION
  =============================== */
  const heroEls = [
    document.getElementById('hBadge'),
    document.getElementById('hTitle'),
    document.getElementById('hSub'),
    document.getElementById('hCtas'),
    document.getElementById('hStats'),
    document.getElementById('hCards'),
  ];

  heroEls.forEach((el, i) => {
    if (!el) return;
    el.style.opacity = '0';
    el.style.transform = 'translateY(28px)';
    el.style.transition = 'opacity .7s cubic-bezier(.16,1,.3,1), transform .7s cubic-bezier(.16,1,.3,1)';
    setTimeout(() => {
      el.style.opacity = '1';
      el.style.transform = 'translateY(0)';
    }, 100 + i * 110);
  });

});
</script>
@endsection