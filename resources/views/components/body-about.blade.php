<style>
    /* Animasi naik-turun lembut */
    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0); }
    }

    .card-main {
        animation: float 3s ease-in-out infinite;
    }

    /* Efek hover untuk kartu fitur */
    .card-feature {
        transition: all 0.4s ease;
        cursor: pointer;
    }

    .card-feature:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(255, 130, 56, 0.3);
    }

    /* Efek bayangan dan tampilan umum */
    .card {
        border-radius: 1.5rem;
        background-color: #fff;
    }

    /* Warna teks dan heading */
    h2, h3, h5 {
        color: #FF8238;
    }

    /* Efek masuk halus (untuk bagian yang belum AOS) */
    [data-aos] {
        opacity: 0;
        transition: opacity 1s ease, transform 1s ease;
    }

    /* Tambahan untuk teks putih di bagian oranye */
    .section-orange {
        background-color: #FF8238;
        border-radius: 12px;
        color: white;
    }

    /* Animasi delay acak untuk masing-masing kartu */
    .float-delay-1 { animation-delay: 0s; }
    .float-delay-2 { animation-delay: 0.5s; }
    .float-delay-3 { animation-delay: 1s; }
</style>

<div class="container py-5" id="about">
    <!-- Bagian 1: Tentang Platform -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6 text-center mb-4 mb-md-0">
            <div class="card rounded-4 shadow-lg border-0 d-flex justify-content-center align-items-center p-4 card-main float-delay-1" 
                 style="width: 250px; height: 250px; margin:auto;">
                <img src="{{ url('/img_logo/new_kostkito_form.png') }}" class="img-fluid" alt="Logo KostKito.id">
            </div>
        </div>
        <div class="col-md-6">
            <h2 data-aos="fade-left" data-aos-delay="200" class="fw-bold text-center text-md-start">KOSTKITO.COM</h2>
            <p data-aos="fade-left" data-aos-delay="400" class="text-start fs-5 mt-3">
                Platform kami siap membantu Anda menemukan hunian yang nyaman, strategis, dan sesuai kebutuhan. 
                KostKito.com mempermudah pencarian kos dan kontrakan dengan sistem pencarian cepat, informasi lengkap 
                untuk wilayah Mendalo dan sekitarnya.
            </p>
        </div>
    </div>

    <!-- Bagian 2: Misi -->
    <div class="row my-5 section-orange p-4">
        <div class="col-12 text-center">
            <h3 data-aos="fade-up" data-aos-delay="400" class="fw-bold mb-3 text-white">Misi Kami</h3>
            <p data-aos="fade-up" data-aos-delay="400" class="fs-5 mb-0">
                Kami hadir untuk membantu pemilik kos mempromosikan propertinya dan memudahkan para pencari hunian 
                untuk menemukan tempat tinggal yang ideal tanpa ribet.
            </p>
        </div>
    </div>

    <!-- Bagian 3: Fitur Utama -->
    <div class="row text-center g-4">
        <div data-aos="fade-up" data-aos-delay="200" class="col-md-4">
            <div class="card card-feature border-0 shadow-sm h-100 p-4 rounded-4 float-delay-1">
                <div class="card-body">
                    <i class="fa fa-search fa-2x mb-3" style="color:#FF8238;"></i>
                    <h5 class="fw-bold mb-2">Pencarian Cepat</h5>
                    <p>Temukan kos dan kontrakan dengan filter lokasi, harga, dan fasilitas hanya dalam hitungan detik.</p>
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="400" class="col-md-4">
            <div class="card card-feature border-0 shadow-sm h-100 p-4 rounded-4 float-delay-2">
                <div class="card-body">
                    <i class="fa fa-home fa-2x mb-3" style="color:#FF8238;"></i>
                    <h5 class="fw-bold mb-2">Informasi Lengkap</h5>
                    <p>Setiap iklan menampilkan detail fasilitas, foto, dan kontak pemilik secara jelas dan terpercaya.</p>
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="600" class="col-md-4">
            <div class="card card-feature border-0 shadow-sm h-100 p-4 rounded-4 float-delay-3">
                <div class="card-body">
                    <i class="fa fa-handshake fa-2x mb-3" style="color:#FF8238;"></i>
                    <h5 class="fw-bold mb-2">Hubungan Langsung</h5>
                    <p>Komunikasikan langsung dengan pemilik kos melalui sistem pesan atau kontak yang tersedia.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian 4: Ajakan -->
    <div class="row mt-5 text-center">
        <div class="col-12">
            <h3 data-aos="fade-up" data-aos-delay="200" class="fw-bold">Mulai Mencari Bersama Kami!</h3>
            <p data-aos="fade-up" data-aos-delay="400" class="fs-5 mb-4">
                Nikmati menjelajah di layanan platform kami dan temukan hunian idealmu dengan cepat dan mudah.
            </p>
            <a data-aos="fade-up" data-aos-delay="600" href="{{ url('/register') }}" 
               class="btn btn-lg text-white px-4 py-2" style="background-color:#FF8238;">
               Mulai Sekarang
            </a>
        </div>
    </div>
<!-- Bagian 5: Hubungi Kami -->
<div class="row mt-5 text-center" id="contact">
  <div class="col-12">
    <h3 data-aos="fade-up" data-aos-delay="200" class="fw-bold" style="color:#FF8238;">Hubungi Kami</h3>
    <p data-aos="fade-up" data-aos-delay="400" class="fs-5 mb-4">
      Butuh bantuan atau ingin bekerja sama? Kami siap membantu melalui WhatsApp.
    </p>
  </div>

  <div class="col-md-6 mx-auto" data-aos="fade-up" data-aos-delay="600">
    <div class="card border-0 shadow-sm rounded-4 p-4">
      <div class="card-body">
        <i class="fa fa-whatsapp fa-3x mb-3" style="color:#25D366;"></i>
        <h5 class="fw-bold mb-3">Chat Langsung di WhatsApp</h5>
        <p class="fs-6 mb-4">
          Klik tombol di bawah untuk terhubung langsung dengan tim KostKito.com.
        </p>
        <a href="https://wa.me/6281234567890?text=Halo%20KostKito.id%2C%20saya%20ingin%20bertanya%20tentang%20hunian%20yang%20tersedia."
           target="_blank"
           class="btn btn-lg text-white rounded-pill px-4 py-2"
           style="background-color:#25D366;">
          <i class="fa fa-whatsapp me-2"></i> Chat Sekarang
        </a>
      </div>
    </div>
  </div>

  <div class="col-12 mt-4">
    <p class="text-muted small mb-0">
      <i class="fa fa-map-marker me-2"></i> Mendalo, Kota Jambi &nbsp;|&nbsp;
      <i class="fa fa-clock me-2"></i> Layanan: 08.00 - 21.00 WIB
    </p>
  </div>
</div>

</div>
