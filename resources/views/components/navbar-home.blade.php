<body>
<nav class="navbar navbar-expand-lg shadow-sm" style="background-color:#FF8238;">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand fs-3 fw-bold text-white" href="#">
      <img src="{{url('img_logo/new_kost_kito_logo_web.png')}}" alt="" srcset="" width='80'>
    </a>

    <!-- Toggle button (mobile) -->
    <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" 
      data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link text-white fw-medium px-3" href="/" onclick='loading_halaman()'>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-medium px-3" href="/home/about" onclick='loading_halaman()'>About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-medium px-3" href="/home/about#contact" onclick='loading_halaman()' >Contact</a>
        </li>
      </ul>

      <!-- Button -->
       @if(!Request::is('*about*') )

      <button class="btn btn-light fw-semibold shadow-sm rounded-pill px-4" data-bs-toggle='modal' data-bs-target="#search-tab">
        <i class="fas fa-search me-2"></i> Cari Kontrakan
      </button>
      @endif
    </div>
  </div>
</nav>


