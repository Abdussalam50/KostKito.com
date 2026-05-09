@props(['jum_kamar'])

<!-- Tombol Kembali -->
<div class="container-fluid py-3" style="background-color:#FAF8F5;">
  <div class="container d-flex justify-content-start">
    <a href="/owner" 
       class="btn fw-semibold px-4 text-white shadow-sm"
       style="background-color:#E56E2E; border:none; border-radius:8px; font-size:16px;">
      ← Kembali
    </a>
  </div>
</div>

<!-- Konten Utama -->
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center" style="background-color:#FAF8F5;">
  <div class="container-md p-5 rounded-4 shadow-sm" 
       style="max-width:520px; background-color:#FFFDF9; border:1px solid #E9E6E2;">
    <form action="/action/update/j_kamar" method="post" id="form-post">
      @csrf

      <!-- Judul -->
      <div class="text-center mb-4">
        <h3 class="fw-bold mb-2" style="color:#E56E2E;">Atur Jumlah Kamar Kosong</h3>
        <p class="text-secondary mb-0" style="font-size:15px;">
          Sesuaikan jumlah kamar kosong sesuai kondisi terkini.
        </p>
      </div>

      <!-- Input Jumlah -->
      <div class="d-flex justify-content-center mb-4">
        <div class="input-group" style="max-width:260px;">
          <button class="btn fw-bold text-white" 
                  type="button" id="decrease" 
                  style="background-color:#E56E2E; font-size:18px;">−</button>

          <input 
            type="number" 
            name="jumlah" 
            min="0" 
            class="form-control form-control-lg text-center border-2"
            id="input-jumlah" 
            style="border-color:#E56E2E; font-size:18px; background-color:#FFFCF9; color:#2F2F2F;" 
            value="{{$jum_kamar}}">

          <button class="btn fw-bold text-white" 
                  type="button" id="increase" 
                  style="background-color:#E56E2E; font-size:18px;">+</button>
        </div>
      </div>

      <!-- Tombol Submit -->
      <div class="text-center">
        <button 
          type="submit" 
          class="btn text-white fw-semibold shadow-sm px-4 py-2"
          name="submit_kamar"
          style="background-color:#E56E2E; border-radius:8px; font-size:16px;">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('message') && session('title'))
<script>
  Swal.fire({
    title: '{{session("title")}}',
    text: "{{session('message')}}",
    timer: 3000,
    icon: 'success',
    confirmButtonColor: '#E56E2E',
    confirmButtonText: 'OK',
    background: '#FFFDF9',
    color: '#2F2F2F',
    timerProgressBar: true
  })
</script>
@endif

<!-- Script -->
<script>
  const decrease = document.getElementById('decrease');
  const increase = document.getElementById('increase');
  const input_jumlah = document.getElementById('input-jumlah');
  const submit_kamar = document.querySelector('button[name=submit_kamar]');

  decrease.addEventListener('click', () => {
    let value = parseInt(input_jumlah.value) || 0;
    if (value > 0) value--;
    input_jumlah.value = value;
  });

  increase.addEventListener('click', () => {
    let value = parseInt(input_jumlah.value) || 0;
    value++;
    input_jumlah.value = value;
  });

  submit_kamar.addEventListener('click', () => {
    Swal.fire({
      title: 'Memproses Permintaan...',
      text: 'Mohon tunggu sebentar',
      icon: 'info',
      showConfirmButton: false,
      background: '#FFFDF9',
      color: '#2F2F2F',
      didOpen: () => {
        Swal.showLoading();
      }
    });
  });
</script>
