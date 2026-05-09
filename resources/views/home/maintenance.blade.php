<x-header-home/>
<!-- Simple Maintenance Page
     File: halaman-maintenance.html
     Single-file HTML + CSS. Salin ke index.html di server Anda.
-->

  <style>
    :root{
      --bg1: #0f172a;
      --bg2: #071033;
      --accent: #60a5fa;
      --card: rgba(255,255,255,0.06);
      --glass: rgba(255,255,255,0.04);
      --muted: rgba(255,255,255,0.7);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
      background: radial-gradient(1200px 800px at 10% 10%, rgba(96,165,250,0.06), transparent 10%),
                  linear-gradient(180deg,var(--bg1) 0%, var(--bg2) 100%);
      color: #fff;
      -webkit-font-smoothing:antialiased;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:32px;
    }

    .card{
      width:100%;
      max-width:880px;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border:1px solid rgba(255,255,255,0.06);
      border-radius:16px;
      padding:36px;
      box-shadow: 0 10px 30px rgba(2,6,23,0.6);
      display:grid;
      grid-template-columns: 160px 1fr;
      gap:24px;
      align-items:center;
      backdrop-filter: blur(6px);
    }

    .logo-wrap{display:flex;align-items:center;justify-content:center}

    .badge{
      width:120px;height:120px;border-radius:16px;
      display:flex;align-items:center;justify-content:center;
      background: linear-gradient(135deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
      border:1px solid rgba(255,255,255,0.04);
      position:relative;
    }

    /* gear/spinner animation */
    .gear{width:78px;height:78px;display:block}
    .spin{animation:spin 3s linear infinite}
    @keyframes spin{to{transform:rotate(360deg)}}

    h1{margin:0;font-size:24px;letter-spacing:-0.4px}
    p{margin:8px 0 0;color:var(--muted);line-height:1.5}

    .meta{margin-top:18px;display:flex;gap:12px;flex-wrap:wrap}
    .meta span{background:var(--glass);padding:8px 12px;border-radius:999px;font-size:13px;color:var(--muted);border:1px solid rgba(255,255,255,0.03)}

    .actions{margin-top:20px}
    .btn{
      display:inline-block;padding:10px 16px;border-radius:10px;font-weight:600;text-decoration:none;
      border:1px solid rgba(255,255,255,0.06);
      background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
    }

    .muted-text{font-size:13px;color:rgba(255,255,255,0.65);margin-top:10px}

    /* responsive */
    @media (max-width:640px){
      .card{grid-template-columns:1fr; text-align:center}
      .logo-wrap{order:-1}
    }
  </style>
</head>
<body>
  <main class="card" role="main" aria-labelledby="title">
    <div class="logo-wrap">
      <div class="badge" aria-hidden="true">
        <!-- simple SVG gear -->
        <svg class="gear spin" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <g fill="none" stroke="white" stroke-opacity="0.9" stroke-width="3">
            <path d="M50 68a18 18 0 1 0 0-36 18 18 0 0 0 0 36z" fill="none" stroke-opacity="0.9"/>
            <g stroke-linecap="round" stroke-linejoin="round">
              <path d="M50 14v8"/>
              <path d="M50 86v-8"/>
              <path d="M14 50h8"/>
              <path d="M86 50h-8"/>
              <path d="M24 24l5.6 5.6"/>
              <path d="M76 76l-5.6-5.6"/>
              <path d="M76 24l-5.6 5.6"/>
              <path d="M24 76l5.6-5.6"/>
            </g>
          </g>
        </svg>
      </div>
    </div>

    <div>
      <h1 id="title">Sedang dalam Pengembangan</h1>
      <p>Kami sedang melakukan perbaikan untuk meningkatkan layanan. Terima kasih atas kesabaran Anda — kami akan segera kembali.</p>

      <div class="meta" role="status" aria-live="polite">
        <span>Estimasi: 2 Minggu</span>
        <span>Kontak:082282169581</span>
        <span>Hubungi via Whatsapp</span>
      </div>

      <div class="actions">
    
        <a class="btn" href="https://wa.me/082282169581" style="margin-left:8px">Hubungi Support</a>
      </div>

      <div class="muted-text">Atau coba segarkan halaman beberapa menit lagi.</div>
    </div>
  </main>
