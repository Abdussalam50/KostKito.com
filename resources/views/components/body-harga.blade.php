@props(['hg_kamar'])

<style>
  /* Custom styles for better aesthetics and responsiveness */
  body {
    background-color: #f4f6f9;
    font-family: 'Inter', sans-serif;
  }

  .container-fluid {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 1.5rem;
    position: relative;
  }

  .btn-back {
    position: fixed;
    top: 1.5rem;
    left: 1.5rem;
    background-color: #ffffff;
    color: #E46A24;
    border: 2px solid #E46A24;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .btn-back:hover {
    background-color: #E46A24;
    color: #ffffff;
    transform: translateY(-2px);
  }

  .logo-container {
    margin: 2rem 0;
  }

  .main-container {
    background-color: #ffffff;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-width: 640px;
    width: 100%;
    transition: transform 0.3s ease;
  }

  .main-container:hover {
    transform: translateY(-5px);
  }

  .form-title {
    color: #2d3748;
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
  }

  .input-group {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }

  .input-group-text {
    background-color: #E46A24;
    color: #ffffff;
    border: none;
    font-weight: 600;
    padding: 0.75rem 1rem;
  }

  .form-control {
    border: 2px solid #e2e8f0;
    font-size: 1.1rem;
    padding: 0.75rem 1rem;
    color: #2d3748;
    transition: border-color 0.3s ease;
  }

  .form-control:focus {
    border-color: #E46A24;
    box-shadow: 0 0 0 3px rgba(228, 106, 36, 0.2);
    outline: none;
  }

  .form-label {
    color: #4a5568;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .text-muted {
    font-size: 0.9rem;
    color: #718096;
  }

  .btn-submit {
    background-color: #E46A24;
    color: #ffffff;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .btn-submit:hover {
    background-color: #c0561f;
    transform: translateY(-2px);
  }

  .btn-submit i {
    margin-right: 0.5rem;
  }

  @media (max-width: 768px) {
    .main-container {
      padding: 1.5rem;
    }

    .form-title {
      font-size: 1.5rem;
    }

    .form-label {
      text-align: center;
    }

    .btn-submit {
      width: 100%;
    }

    .btn-back {
      top: 1rem;
      left: 1rem;
      padding: 0.5rem 1rem;
    }
  }
</style>

<div class="container-fluid">
  <!-- Back Button -->
  <a href="/owner" class="btn btn-back">
    ← Kembali
  </a>

  <!-- Logo -->
  <div class="logo-container d-flex justify-content-center">
    <img src="{{url('img_logo/new_kostkito_form.png')}}" alt="Logo" width="160px">
  </div>

  <!-- Main Form Container -->
  <div class="container main-container">
    <h3 class="form-title">Harga Sewa Saat Ini</h3>
    
    <form action="/owner/set_hargakamar" method="post" id="form-post">
      @csrf
      <div class="row g-4 align-items-center">
        <div class="col-12 col-md-5 text-md-end text-center">
          <label class="form-label">Harga Sewa Kamar</label>
        </div>

        <div class="col-12 col-md-7">
          <div class="input-group input-group-lg">
            <span class="input-group-text">Rp</span>
            <input type="text" 
                   name="number" 
                   min="0" 
                   class="form-control" 
                   value="{{$hg_kamar}}"
                   placeholder="Masukkan nominal">
          </div>
          <small class="text-muted">Masukkan nominal tanpa titik atau koma</small>
        </div>
      </div>

      <div class="text-center mt-5">
        <button type="submit" 
                class="btn btn-submit"
                name="submit_kamar">
          <i class="fas fa-save"></i> Simpan Harga
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
      title: '{{session("message")}}',
      text: '{{session("title")}}',
      icon: 'info',
      confirmButtonText: 'Mengerti',
      confirmButtonColor: '#E46A24',
    });
  </script>
@endif

<script>
  const btnHargaKamar = document.querySelector('button[name=submit_kamar]');
  btnHargaKamar.addEventListener('click', () => {
    Swal.fire({
      title: 'Memproses Permintaan',
      text: 'Harap tunggu beberapa saat...',
      icon: 'info',
      timer: 4000,
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false
    });
  });
</script>