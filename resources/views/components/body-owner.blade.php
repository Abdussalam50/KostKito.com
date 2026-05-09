@props(['jum_traffic'])

<div class="container py-5" style="background-color:#f8f9fa; min-height:100vh; display:flex; flex-direction:column;">
  <!-- Tombol Logout -->
  <div class="d-flex justify-content-end mb-4">
    <form action="/owner/logout" method="post">
      @csrf
      <button class="btn px-4 py-2 text-white fw-semibold shadow-sm" 
              style="background-color:#E46A24; border-radius: 12px; font-size:1rem;">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
      </button>
    </form>
  </div>

  <!-- Navigasi Utama -->
  <div class="flex-grow-1 d-flex flex-column justify-content-center align-items-center text-center">
    <div class="mb-4">
      <img src="{{ url('/img_logo/new_kostkito_form.png') }}" 
           alt="Logo Aplikasi" 
           style="width: 220px; height: auto; border-radius: 12px; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">
      <h5 class="mt-3 fw-semibold" style="color:#555;">Panel Pemilik Kos</h5>
      <p class="text-muted" style="font-size:0.95rem;">Kelola informasi kamar dan pantau statistik kunjungan</p>
    </div>

    <div class="container-md">
      <div class="row g-4 justify-content-center">

        <div class="col-12 col-md-5">
          <a href="/update_kamar" 
             class="btn w-100 py-3 text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center" 
             style="background-color:#E46A24; border-radius: 14px; font-size:1.05rem;" onclick='memuat()'>
            <i class="fas fa-bed me-2"></i> Kelola Jumlah Kamar
          </a>
        </div>

        <div class="col-12 col-md-5">
          <a href="/owner/update_harga" 
             class="btn w-100 py-3 text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center" 
             style="background-color:#E46A24; border-radius: 14px; font-size:1.05rem;"  onclick='memuat()'>
            <i class="fas fa-tags me-2"></i> Atur Harga Sewa
          </a>
        </div>

        <div class="col-12 col-md-5">
          <button class="btn w-100 py-3 text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center" 
                  style="background-color:#E46A24; border-radius: 14px; font-size:1.05rem;"
                  data-bs-toggle="modal" data-bs-target="#backdrop">
            <i class="fas fa-chart-bar me-2"></i> Lihat Statistik
          </button>
        </div>

        <div class="col-12 col-md-5">
          <a href="/costumer_service" 
             class="btn w-100 py-3 text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center" 
             style="background-color:#E46A24; border-radius: 14px; font-size:1.05rem;">
            <i class="fas fa-headset me-2"></i> Hubungi Bantuan
          </a>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Modal Statistik -->
<div class="modal fade" id="backdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header text-white border-0" style="background-color:#E46A24;">
        <h1 class="modal-title fs-5 fw-semibold" id="staticBackdropLabel">Statistik Kunjungan</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center py-5" style="background-color:#fdfcfb;">
        <h4 class="fw-semibold mb-3" style="color:#333;">Jumlah Pengunjung</h4>
        <h1 class="fw-bold" style="color:#E46A24; font-size:2.5rem;">{{$jum_traffic}}</h1>
        <p class="text-secondary mb-0" style="font-size:1rem;">Total pengunjung yang melihat sejauh ini</p>
      </div>

      <div class="modal-footer border-0 row p-5" style="background-color:#f9f9f9;">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal" style="font-size:0.95rem;">Tutup</button>
        
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function memuat() {
  Swal.fire({
    title: 'Memuat Halaman',
    icon:'info',
    text: 'Tunggu beberapa saat',
    timer: 5000,                  // Durasi 5 detik
    timerProgressBar: true,       // Tampilkan progress bar (opsional)
    allowOutsideClick: false,     // Nonaktifkan klik di luar modal
    allowEscapeKey: false,        // Nonaktifkan tombol Escape
    showConfirmButton: false,     // Hilangkan tombol confirm
    showCancelButton: false,      // Hilangkan tombol cancel
    showCloseButton: false,       // Hilangkan tombol close (X)
    didOpen: () => {
      Swal.showLoading();         // Tampilkan spinner loading di dalam modal
    }
  });
}
</script>