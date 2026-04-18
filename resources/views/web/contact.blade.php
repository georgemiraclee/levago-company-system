{{-- resources/views/web/contact.blade.php --}}
@extends('layouts.web')
@section('title', 'Kontak — Levago')

@section('head')
<style>
  .page-hero { background: var(--navy); padding: 120px 0 64px; text-align: center; }
  .page-hero h1 { font-family: var(--font-display); font-size: clamp(32px,5vw,52px); font-weight: 800; color: var(--white); margin-bottom: 12px; }
  .page-hero p { font-size: 17px; color: rgba(255,255,255,.6); }
  .contact-wrap { display: grid; grid-template-columns: 1fr 1.4fr; gap: 64px; align-items: start; padding: 80px 0; }
  .channel { display: flex; align-items: center; gap: 14px; background: var(--white); border: 1px solid var(--gray-200); padding: 18px 20px; border-radius: 14px; margin-bottom: 14px; box-shadow: var(--shadow); transition: all .2s; }
  .channel:hover { border-color: rgba(37,99,235,.2); box-shadow: var(--shadow-lg); }
  .channel-icon { width: 46px; height: 46px; border-radius: 12px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 22px; background: var(--navy-soft); }
  .channel-text span { font-size: 12px; color: var(--text-muted); display: block; margin-bottom: 2px; }
  .channel-text strong { font-size: 14px; color: var(--navy); }
  .contact-form { background: var(--white); border: 1px solid var(--gray-200); border-radius: 24px; padding: 40px; box-shadow: var(--shadow-lg); }
  .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .form-group { display: flex; flex-direction: column; gap: 7px; }
  .form-group.full { grid-column: 1/-1; }
  .form-group label { font-size: 13px; font-weight: 600; color: var(--navy); }
  .form-group input, .form-group select, .form-group textarea {
    background: var(--gray-50); border: 1.5px solid var(--gray-200);
    border-radius: 10px; padding: 12px 16px; font-size: 14px; color: var(--text);
    font-family: var(--font-body); resize: none; outline: none; transition: all .2s;
  }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
    border-color: var(--accent); background: var(--white); box-shadow: 0 0 0 3px rgba(37,99,235,.1);
  }
  .btn-submit {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: var(--navy); color: var(--white); padding: 14px 28px;
    border-radius: var(--radius); font-weight: 700; font-size: 15px; border: none;
    cursor: pointer; width: 100%; margin-top: 8px; font-family: var(--font-body);
    transition: all .2s;
  }
  .btn-submit:hover { background: var(--navy-light); transform: translateY(-1px); }
  .alert-success { background: #ECFDF5; border: 1.5px solid #A7F3D0; color: #065F46; padding: 16px 20px; border-radius: var(--radius); margin-bottom: 20px; font-weight: 500; }
  @media(max-width:900px) { .contact-wrap { grid-template-columns: 1fr; } }
  @media(max-width:640px) { .form-grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<div class="page-hero">
  <div class="container">
    <div class="section-label" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);border-color:rgba(255,255,255,.15);display:inline-flex">📞 Kontak</div>
    <h1>Siap Mulai Perjalanan Digital Kamu?</h1>
    <p>Konsultasi pertama gratis! Kami bantu temukan solusi terbaik untuk bisnis kamu.</p>
  </div>
</div>

<div class="container">
  <div class="contact-wrap">
    <div class="reveal">
      <h2 class="section-title">Hubungi Kami</h2>
      <p class="section-sub" style="margin-bottom:28px">Tim kami siap membantu kamu membangun kehadiran digital yang profesional dan menghasilkan.</p>
      <div class="channel"><div class="channel-icon">💬</div><div class="channel-text"><span>WhatsApp (Respon cepat)</span><strong>+62 812-3456-7890</strong></div></div>
      <div class="channel"><div class="channel-icon">📧</div><div class="channel-text"><span>Email</span><strong>hello@levago.id</strong></div></div>
      <div class="channel"><div class="channel-icon">📍</div><div class="channel-text"><span>Kantor</span><strong>Jakarta, Indonesia</strong></div></div>
      <div class="channel"><div class="channel-icon">🕐</div><div class="channel-text"><span>Jam Operasional</span><strong>Senin–Sabtu, 09.00–18.00 WITA</strong></div></div>
    </div>
    <div class="contact-form reveal">
      @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
      @endif
      <h3 style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--navy);margin-bottom:6px">Ceritakan Kebutuhan Kamu</h3>
      <p style="font-size:14px;color:var(--text-muted);margin-bottom:24px">Kami akan menghubungi kamu dalam 1×24 jam.</p>
      <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="form-grid">
          <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
            @error('name')<span style="font-size:12px;color:#dc2626">{{ $message }}</span>@enderror
          </div>
          <div class="form-group">
            <label>Nomor WhatsApp *</label>
            <input type="tel" name="phone" placeholder="+62 812-xxxx-xxxx" value="{{ old('phone') }}" required>
            @error('phone')<span style="font-size:12px;color:#dc2626">{{ $message }}</span>@enderror
          </div>
          <div class="form-group full">
            <label>Email</label>
            <input type="email" name="email" placeholder="email@bisnis.com" value="{{ old('email') }}">
          </div>
          <div class="form-group full">
            <label>Jenis Layanan</label>
            <select name="service">
              <option value="">— Pilih layanan —</option>
              <option>Company Profile Website</option>
              <option>Landing Page</option>
              <option>E-Commerce</option>
              <option>Custom Web App</option>
              <option>Mobile App</option>
              <option>Lainnya / Belum yakin</option>
            </select>
          </div>
          <div class="form-group full">
            <label>Ceritakan Kebutuhan Kamu</label>
            <textarea name="needs" rows="4" placeholder="Saya punya bisnis kuliner dan ingin membuat website...">{{ old('needs') }}</textarea>
          </div>
        </div>
        <button type="submit" class="btn-submit">🚀 Kirim & Konsultasi Gratis</button>
      </form>
    </div>
  </div>
</div>
@endsection