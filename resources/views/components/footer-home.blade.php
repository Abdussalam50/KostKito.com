
</body>
<!-- Upgraded Footer Mockup for KostKito.id (Bootstrap 5 compatible) -->
<footer class="py-5" style="background-color: #FF8238;">
    <div class="container">
        <div class="row text-white">
            <!-- Brand Section -->
            <div class="col-lg-6 mb-4 mb-lg-0 d-flex flex-column justify-content-center">
                <h1 class="fs-1 fw-bold text-center text-lg-start">KostKito.com</h1>
                <p class="text-center text-lg-start mt-2">
                    Temukan hunian nyaman, strategis, dan terjangkau. KostKito.com hadir untuk membantumu mendapatkan tempat tinggal terbaik sesuai kebutuhanmu.
                </p>
            </div>

            <!-- Links & Social Section -->
            <div class="col-lg-6">
                <div class="row">
                    <!-- Useful Links -->
                    <div class="col-6">
                        <h4 class="fw-semibold text-center text-lg-start mb-3">Useful Links</h4>
                        <ul class="list-unstyled text-center text-lg-start">
                            <li><a href="#" class="text-white text-decoration-none">Beranda</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Kontak</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div class="col-6">
                        <h4 class="fw-semibold text-center text-lg-start mb-3">Ikuti Kami</h4>
                        <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                            <a href="#" class="text-white fs-4"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white fs-4"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white fs-4"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white fs-4"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr class="border-light my-4">

        <!-- Copyright -->
        <div class="text-center text-white">
            <p class="mb-0">&copy; 2025 KostKito.com. All rights reserved.</p>
        </div>
    </div>
</footer>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init()
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function loading_halaman() {
  let timerInterval;
  Swal.fire({
    title: '🔄 Memuat Permintaan...',
    html: `
      <div style="font-size: 15px; color: #333;">
        Mohon tunggu sebentar, sistem sedang memproses.<br>
        <b>Semoga Tuhan merahmati kesabaran Anda.</b>
      </div>
      <div id="progress-bar" style="width:100%; height:8px; background:#ffe6d6; border-radius:4px; margin-top:15px;">
        <div id="progress" style="width:0%; height:100%; background:#FF8238; border-radius:4px; transition:width 0.2s;"></div>
      </div>
    `,
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false,
    background: '#fff9f6',
    color: '#333',
    didOpen: () => {
      Swal.showLoading();
      const progress = Swal.getHtmlContainer().querySelector('#progress');
      let width = 0;
      timerInterval = setInterval(() => {
        width += 100 / (15000 / 200); // 15 detik
        progress.style.width = width + '%';
        if (width >= 100) clearInterval(timerInterval);
      }, 200);
    },
    willClose: () => {
      clearInterval(timerInterval);
    },
    customClass: {
      popup: 'rounded-2xl shadow-lg'
    },
    timer: 15000
  });
}

</script>