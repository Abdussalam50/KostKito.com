<div class="min-vh-100 d-flex justify-content-center align-items-center bg-light">
  <div class="card shadow border-0 rounded-4 p-4" style="max-width: 420px; width: 100%;">
    <div class="text-center mb-4">
      <img src="{{ url('img_logo/new_kostkito_form.png') }}" alt="Logo" width="120" class="mb-3">
      <h3 class="fw-bold mb-1" style="color: #FF8238;">Login Owner</h3>
      <p class="text-secondary">Masuk ke sistem pengelolaan kos</p>
    </div>

    <form action="/login/owner/request" method="post">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label fw-semibold text-secondary">Username</label>
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-user text-muted"></i>
          </span>
          <input type="text" name="username" id="username" class="form-control border-start-0" placeholder="Masukkan username" required>
        </div>
      </div>

      <div class="mb-4">
        <label for="password" class="form-label fw-semibold text-secondary">Password</label>
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-lock text-muted"></i>
          </span>
          <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="Masukkan password" required>
        </div>
      </div>

      <button type="submit" 
              class="btn w-100 py-2 fw-semibold text-white rounded-3 shadow-sm"
              style="background-color:#FF8238; font-size:1.05rem; letter-spacing:0.5px;" onclick='memuat()'>
        Masuk
      </button>
    </form>

    <div class="text-center mt-4">

      <p class="text-muted" style="font-size:0.9rem;">Belum punya akun? 
        <a href="https://wa.me" style="color:#FF8238; text-decoration:none;">Daftar</a>
      </p>
    </div>
  </div>
</div>
<script>
  console.log(window.location.origin);

  console.log("User Agent:", navigator.userAgent);

  // Contoh parsing sederhana (khusus Chrome/Edge/Firefox/Safari)
  const ua = navigator.userAgent;
  let browser = "Tidak diketahui";
  let version = "";

  if (ua.includes("Chrome") && !ua.includes("Edg")) {
    browser = "Google Chrome";
    version = ua.match(/Chrome\/([\d.]+)/)[1];
  } else if (ua.includes("Edg")) {
    browser = "Microsoft Edge";
    version = ua.match(/Edg\/([\d.]+)/)[1];
  } else if (ua.includes("Firefox")) {
    browser = "Mozilla Firefox";
    version = ua.match(/Firefox\/([\d.]+)/)[1];
  } else if (ua.includes("Safari") && !ua.includes("Chrome")) {
    browser = "Safari";
    version = ua.match(/Version\/([\d.]+)/)[1];
  }

  console.log(`Browser: ${browser} (versi ${version})`);
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service_worker.js')
      .then(() => console.log('✅ Service Worker Registered'))
      .catch(err => console.error('❌ SW registration failed:', err));
  } else {
    console.warn('Browser tidak mendukung Service Worker');
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function memuat() {
  Swal.fire({
    title: 'Memuat Halaman',
    icon:'info',
    text: 'Tunggu beberapa saat',
    timer: 30000,                  // Durasi 5 detik
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