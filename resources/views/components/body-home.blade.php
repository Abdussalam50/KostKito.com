
<style>
    /* General Styling */
    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Carousel Styling */
    .carousel-item {
        max-height: 450px;
        object-fit: cover;
        transition: transform 0.5s ease-in-out;
    }

    .carousel-item img {
        transition: transform 0.5s ease;
    }

    .carousel-item:hover img {
        transform: scale(1.05);
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.6);
        border-radius: 8px;
        padding: 15px;
        bottom: 20px;
        text-align: center;
    }

    .carousel-caption h5 {
        color: #FF8238;
        font-size: 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .carousel-caption p {
        color: #fff;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .carousel-caption a {
        background-color: #FF8238;
        border: none;
        padding: 8px 20px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .carousel-caption a:hover {
        background-color: #e06e2f;
    }

    .carousel-control-prev, .carousel-control-next {
        width: 5%;
        background: rgba(0, 0, 0, 0.3);
    }

    /* Navigation Tabs */
    .nav-tabs-custom .nav-link {
        color: #6c757d;
        font-weight: 600;
        padding: 10px 15px;
        transition: color 0.3s ease;
    }

    .nav-tabs-custom .nav-link:hover {
        color: #FF8238;
    }

    .nav-tabs-custom .nav-link i {
        margin-right: 8px;
    }

    /* Card Styling */
    .card {
        display: flex;
        flex-direction: column;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
    }

    .card-text {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
        font-size: 0.9rem;
        color: #4a4a4a;
    }

    .card .btn {
        margin-top: auto;
        background-color: #FF8238;
        border: none;
        font-weight: 600;
        padding: 10px;
        transition: background-color 0.3s ease;
    }

    .card .btn:hover {
        background-color: #e06e2f;
    }

    .view-count {
        background: rgba(255, 130, 56, 0.1);
        color: #FF8238;
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        border-bottom: none;
        padding: 20px;
    }

    .modal-body {
        padding: 20px;
    }

    .input-group-text {
        background-color: #FF8238;
        color: #fff;
        border: none;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding: 10px;
        font-size: 0.9rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #FF8238;
        box-shadow: 0 0 5px rgba(255, 130, 56, 0.5);
    }

    .modal-footer {
        border-top: none;
        padding: 20px;
    }

    .modal-footer .btn-primary {
        background-color: #FF8238;
        border: none;
        font-weight: 600;
    }

    .modal-footer .btn-primary:hover {
        background-color: #e06e2f;
    }
.pagination .page-link {
    color: #FF8238;
    border-color: #FF8238;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination .page-item.active .page-link {
    background-color: #FF8238 !important;
    border-color: #FF8238 !important;
    color: #fff !important;
}

.pagination .page-link:hover {
    background-color: #FF8238;
    border-color: #FF8238;
    color: #fff;
}

.pagination .page-item.disabled .page-link {
    color: #ccc;
    border-color: #ddd;
    background-color: #f8f9fa;
}

/* Panah prev/next jadi lebih bold & besar sedikit */
.pagination .page-link svg,
.pagination .page-link .arrow {
    fill: #FF8238;
}

.pagination .page-item:not(.disabled) .page-link:hover svg {
    fill: #fff;
}

/* Optional: biar lebih bulat & modern */
.pagination .page-link {
    border-radius: 8px !important;
    margin: 0 4px;
}

.pagination .page-item:first-child .page-link,
.pagination .page-item:last-child .page-link {
    border-radius: 50px !important;
    padding-left: 16px;
    padding-right: 16px;
}
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .carousel-item {
            max-height: 400px;
        }

        .carousel-caption h5 {
            font-size: 1.2rem;
        }

        .carousel-caption p {
            font-size: 0.85rem;
        }

        .carousel-caption a {
            font-size: 0.8rem;
            padding: 6px 15px;
        }

        .card-text {
            -webkit-line-clamp: 3;
            font-size: 0.8rem;
        }

        .card-img-top {
            height: 100px;
        }

        .card-body {
            padding: 12px;
        }

        .card-title {
            font-size: 0.95rem;
            margin-bottom: 6px;
        }

        .card .btn {
            padding: 6px;
            font-size: 0.8rem;
        }

        .view-count {
            font-size: 0.7rem;
            padding: 3px 6px;
        }

        .nav-tabs-custom .nav-link {
            font-size: 0.9rem;
            padding: 8px 10px;
        }
/* Khusus halaman home saja */
    }
</style>

<section class="container-fluid py-4">
    <div class="container-fluid px-0 px-md-5">
        <div class="row shadow-sm rounded-3 bg-light my-4 py-3 nav-tabs-custom">
            <div class="col-3 text-center">
                <a href="/daftar/muslim" class="text-secondary nav-link">
                    <i class="fas fa-eye" style="color:#FF8238"></i> Muslim
                </a>
            </div>
            <div class="col-3 text-center">
                <a href="/daftar/muslimah" class="text-secondary nav-link">
                    <i class="fas fa-eye" style="color:#FF8238"></i>Muslimah
                </a>
            </div>
            <div class="col-3 text-center">
                <a href="/daftar/cowok" class="text-secondary nav-link">
                    <i class="fas fa-eye" style="color:#FF8238"></i> Cowok
                </a>
            </div>
            <div class="col-3 text-center">
                <a href="/daftar/cewek" class="text-secondary nav-link">
                    <i class="fas fa-eye" style="color:#FF8238"></i> Cewek
                </a>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid mb-5">
    <div class="container-xl rounded-3 shadow-lg px-0 px-md-5 py-4 bg-light">
        <div id="carouselExampleCaptions" class="carousel slide">
<div class="carousel-indicators">
    @forelse($pageSlide as $index => $panel)
        @if($panel->panel_utama === 'on')
            <button type="button"
                    data-bs-target="#carouselExampleCaptions"
                    data-bs-slide-to="{{ $loop->index }}"
                    class="{{ $loop->first ? 'active' : '' }}"
                    aria-current="{{ $loop->first ? 'true' : 'false' }}"
                    aria-label="Slide {{ $loop->iteration }}">
            </button>
        @endif
    @empty
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true"></button>
    @endforelse
</div>
<div class="carousel-inner">
    @forelse($pageSlide as $index => $panel)
        {{-- Hanya yang panel_utama = 'on' yang ditampilkan --}}
        @if($panel->panel_utama === 'on')
            <div class="carousel-item {{ $loop->first ? 'active' : '' }} position-relative">
                <img src="{{ url('galeri/' . $panel->foto1) }}" class="d-block w-100" alt="{{ $panel->nama_kontrakan }}" loading="lazy">
                
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.45);"></div>
                
                <div class="carousel-caption d-block">
                    <h5 class="fw-bold">{{ strtoupper($panel->nama_kontrakan) }}</h5>
                    <p>{!! create_identifier($panel->id_wilayah, 'data_wilayah', 'wilayah') !!}</p>
                    
                    @if(strtolower($panel->sistem) === 'tahunan')
                        <p>{!! rupiah($panel->harga_tahunan) !!}/Tahun</p>
                    @elseif(strtolower($panel->sistem) === 'bulanan')
                        <p>{!! rupiah($panel->harga_bulanan) !!}/Bulan</p>
                    @endif
                    
                    <p><i class="fas fa-door-open"></i> {{ $panel->jumlah_kamar_kosong }} Kamar Kosong</p>
                    
                    <a href="/detail_home/{{ $panel->id_kontrakan }}" 
                       class="btn btn-sm rounded-pill text-white fw-semibold w-50">
                        Detail
                    </a>
                </div>
            </div>
        @endif
    @empty
        {{-- Kalau tidak ada yang panel_utama = on --}}
        <div class="carousel-item active position-relative">
            <img src="{{ url('img_logo/kost-bg.jpg') }}" class="d-block w-100" alt="Default Banner">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.45);"></div>
            <div class="carousel-caption d-block">
                <h5 class="fw-bold">Temukan Hunian Idamanmu</h5>
                <p>Mulai perjalanan baru di tempat tinggal yang nyaman, strategis, dan sesuai gayamu.</p>
            </div>
        </div>
    @endforelse
</div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<div class="container-fluid px-0 px-md-5">
    <div class="container-fluid rounded-3 shadow-sm bg-light py-4">
        <div class="row g-4">
            @if(count($datas)>0)
            @foreach($datas as $item)
         
            <div class="col-6 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 rounded-4 position-relative">
                    <span class="position-absolute top-0 end-0 me-3 mt-2 view-count"><i class="fas fa-eye"></i> {{ optional($item)->jumlah_traffic ?? optional($item)->relasi_traffic_sum_jumlah_traffic ?? 0 }} x dilihat</span>
                    @if($item->foto1)
                    <img src="{{url('/galeri/'.$item->foto1)}}" 
                         class="card-img-top rounded-top-4" 
                         alt="Nama Kontrakan"
                         loading="lazy">
                    @endif
                    <div class="card-body d-flex flex-column">
                        @if($item->nama_kontrakan)
                        <h5 class="card-title mb-3">{{ucwords($item->nama_kontrakan)}} ({{$item->kategori}})</h5>
                        @endif
                        @if($item->alamat)
                        <p class="card-text mb-1">
                            <i class="fas fa-map-marker-alt text-secondary"></i>
                              {{$item->alamat}}
                        </p>
                        @endif

                     @if($item->jumlah_kamar_kosong)
                        <p class="card-text mb-1">
                            <i class="fas fa-door-open text-secondary"></i>
                            {{$item->jumlah_kamar_kosong}} Kamar Kosong
                        </p>
                        @endif
                        <p class="card-text mb-1" style='color:#FF8238;font-weight:bolder'>
                            <i class="fas fa-dollar-sign" style='color:#FF8238;font-weight:bolder'></i>
                            @if($item->harga_tahunan)
                             {!! rupiah($item->harga_tahunan)!!} Per-Tahun
                            @elseif($item->harga_bulanan)
                             {!! rupiah($item->harga_bulanan)!!} Per-Bulan
                            @endif
                        </p>

                        @if($item->updated_at)
                        <p class="card-text mb-3">
                            <i class="fas fa-check text-success"></i>
                            <strong>Update:</strong> {!!countdown($item->updated_at) !!}
                        </p>
                        @endif
                        
                        <a href="/detail_home/{{$item->id_kontrakan}}" 
                           class="btn fw-bolder text-white mt-3 w-100" onclick='loading_halaman()'>
                            <i class="fas fa-arrow-right me-2"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                <div class="d-flex flex-md-row flex-column justify-content-center align-items-center p-1 p-md-5 ">
                    
                        <img src="{{asset('img_logo/error-404.png')}}" alt="" srcset="" width='120' class='me-3'>
                   
                    
                        <h2 class='text-center'>Tidak Ada Data Kontrakan yang  Ditemukan</h2>
                    
                </div>
            @endif
            <!-- Static Cards -->

        </div>
    </div>
</div>

<div class="d-flex justify-content-center my-4">
    {{ $datas->links('pagination::bootstrap-5') }}
</div>

<div class="modal fade" id="search-tab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tab Pencarian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/home/find_kontrakan" method="post">
                @csrf
                <div class="modal-body">
                    <!-- <div class="mb-3">
                        <label for="nama_kontrakan" class="form-label">Nama Kontrakan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <input type="text" name="nama_kontrakan" id="nama_kontrakan" placeholder="Ketik Nama Kontrakan" class="form-control">
                        </div>
                    </div> -->
                    <div class="mb-3">
                        <label for="id_wilayah" class="form-label">Wilayah</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <select name="id_wilayah" id="id_wilayah" class="form-select">
                                {!!drop_relation("id_wilayah",'data_kontrakan')!!}
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sistem" class="form-label">Sistem Kontrak</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-cog"></i></span>
                            <select name="sistem" id="sistem" class="form-select">
                                @foreach(combo_enum("data_kontrakan",'sistem') as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-folder"></i></span>
                            <select name="kategori" id="kategori" class="form-select">
                                @foreach(combo_enum("data_kontrakan","kategori") as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>

