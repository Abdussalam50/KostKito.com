@props(['data_kontrakan','data_fasilitas','data_peraturan','data_kelebihan'])
<style>
    @media screen and (max-width:768px){
       #thumbnaill img{
            width:140px !important;
       } 
    }
    
</style>
<div class="container-fluid my-4">
    <!-- Judul -->
    <h2 class="text-start mb-4" style="color:#FF8238;">Detail Kontrakan</h2>

    <!-- Card Utama -->
    <div class="container-fluid rounded-4 bg-light shadow-lg p-4">
        <div class="row g-4">
            
            <!-- Gambar Utama + Thumbnail -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <img src="{{url('/galeri/'.$data_kontrakan->foto1)}}" 
                         class="img-fluid rounded-3 w-100 main-image" 
                         style="object-fit:cover; max-height:450px" 
                         alt="Foto Kontrakan">
                </div>
                <div class="d-flex gap-1 flex-wrap" id="thumbnaill">
                    <img src="{{url('/galeri/'.$data_kontrakan->foto1)}}" 
                         class="rounded-2 shadow-sm thumbnail" 
                         style="width:120px;height:80px;object-fit:cover;" 
                         alt="Thumbnail">
                    <img src="{{url('/galeri/'.$data_kontrakan->foto2)}}" 
                         class="rounded-2 shadow-sm thumbnail" 
                         style="width:120px;height:80px;object-fit:cover;" 
                         alt="Thumbnail">
                    <img src="{{url('/galeri/'.$data_kontrakan->foto3)}}" 
                         class="rounded-2 shadow-sm thumbnail" 
                         style="width:120px;height:80px;object-fit:cover;" 
                         alt="Thumbnail">
                    <img src="{{url('/galeri/'.$data_kontrakan->foto4)}}" 
                         class="rounded-2 shadow-sm thumbnail" 
                         style="width:120px;height:80px;object-fit:cover;" 
                         alt="Thumbnail">
                    <img src="{{url('/galeri/'.$data_kontrakan->foto5)}}" 
                         class="rounded-2 shadow-sm thumbnail" 
                         style="width:120px;height:80px;object-fit:cover;" 
                         alt="Thumbnail">
                </div>
            </div>

            <!-- Informasi Kontrakan -->
            <div class="col-12 col-md-6">
                <h3 class="text-start mb-4" style="color:#FF8238;">Informasi Kontrakan</h3>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-semibold" style="width:40%;">Nama Kontrakan</td>
                            <td style="width:5%;">:</td>
                            <td>{{ucwords($data_kontrakan->nama_kontrakan)}}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Kategori</td>
                            <td>:</td>
                            <td>{{$data_kontrakan->kategori}}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Sistem Kontrak</td>
                            <td>:</td>
                            <td>{{$data_kontrakan->sistem}}</td>
                        </tr>
                        @if($data_kontrakan->sistem=='Tahunan')
                        <tr>
                            <td class="fw-semibold">Harga</td>
                            <td>:</td>
                            <td>{!!rupiah($data_kontrakan->harga_tahunan)!!}</td>
                        </tr>
                        @else
                        <tr>
                            <td class="fw-semibold">Harga</td>
                            <td>:</td>
                            <td>{!!rupiah($data_kontrakan->harga_bulanan)!!}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="fw-semibold">Alamat</td>
                            <td>:</td>
                            <td>{{$data_kontrakan->alamat}}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Total Kamar</td>
                            <td>:</td>
                            <td>{{$data_kontrakan->total_kamar}}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Kamar Kosong</td>
                            <td>:</td>
                            <td>{{$data_kontrakan->jumlah_kamar_kosong}} Kamar</td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="text-start mb-4" style="color:#FF8238;">Fasilitas Kontrakan</h3>
                    <div class="container text-start">
                        <div class="row row-cols-2 row-cols-md-3">
                        @php
                            $arr_fasilitas=[
                                    'kipas angin'=>"fas fa-snowflake",
                                    'air pdam'=>"fas fa-tint",
                                    'air sumur bor'=>"fas fa-tint",
                                    'listrik token'=>"fas fa-bolt",
                                    'listrik pln'=>"fas fa-bolt",
                                    'parkir motor'=>"fas fa-motorcycle",
                                    'parkir mobil'=>"fas fa-car",
                                    'ac'=>"fas fa-snowflake",
                                    "free wifi"=>"fas fa-wifi",
                                    "wifi (berbayar)"=>"fas fa-wifi"
                                ];

                            
                        @endphp
                        @foreach($data_fasilitas as $fasilitas)
                                @php 
                                    $nama_fasilitas=strtolower(create_identifier($fasilitas->id_detail_fasilitas,'data_detail_fasilitas','fasilitas'));
                                   
                                 @endphp

                            
                            <div class="col mb-1">
                                @if(in_array($nama_fasilitas,$arr_fasilitas))
                                <i class="{{$arr_fasilitas[$nama_fasilitas]}}"></i> 
                                @else
                                <i class="fas fa-home"></i> 
                                @endif
                                {!! create_identifier($fasilitas->id_detail_fasilitas,'data_detail_fasilitas','fasilitas')!!}</div>
                        @endforeach
                        </div>

                    </div>
                    <h3 class="text-start mb-4" style="color:#FF8238;">Peraturan Kontrakan</h3>
                    <ul class="list-group list-group-flush">
                        @foreach($data_peraturan as $peraturan)
                        <li class="list-group-item border-0">
                            <i class="fas fa-ban text-danger me-2"></i>
                            {{$peraturan->peraturan}}
                        </li>
                        @endforeach

                    </ul>
                    <h3 class="text-start mb-4" style="color:#FF8238;">Kelebihan Kontrakan</h3>
                    <ul class="list-group list-group-flush">
                        @foreach($data_kelebihan as $kelebihan)
                            <li class="list-group-item border-0">
                                <i class="fas fa-check text-success"></i> {{$kelebihan->kelebihan}}
                            </li>
                        @endforeach
                    </ul>

                <div class="row my-4">
    <form id="form-wa" method="POST" action="/home/validate-captcha-wa">
    @csrf

    <input type="hidden" name="wa" value="{!! create_identifier($data_kontrakan->id_pemilik,'data_pemilik','no_wa') !!}">


</form>
                    <a href="#" id="btn-wa" onclick='confirm_robot()'class="btn rounded-pill fw-semibold text-white" style="background-color:#FF8238;"><i class="fas fa-phone text-white"></i> Hubungi Pemilik</a>
                </div>
            </div>

        </div>
    </div>
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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const thumbnails = document.querySelectorAll(".thumbnail");
        const mainImage = document.querySelector(".main-image");

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener("click", function() {
                mainImage.src = this.src;
            });
        });


    });


// Callback setelah reCAPTCHA berhasil
function captchaVerified() {
    Swal.fire({
        title:'Verifikasi Selesai',
        icon:'success',
        showConfirmButton:true
    }).then(()=>{
        window.open("https://wa.me/{!! create_identifier($data_kontrakan->id_pemilik,'data_pemilik','no_wa')!!}","_blank")
    })
}
function confirm_robot(){
    Swal.fire({
        title:'Verifikasi Diri Anda Bukan Robot',
        html:`
         <div id="g-recaptcha"></div>`,
    showConfirmButton:false,
    didOpen:()=>{
        if(typeof grecaptcha !=='undefined' && grecaptcha.rendered){
            grecaptcha.reset();
        }

        grecaptcha.render('g-recaptcha',{
            sitekey:"{{ config('services.recaptcha.site') }}",
            callback:captchaVerified
        })
        grecaptcha.execute();
    }
    })
} 
</script>
