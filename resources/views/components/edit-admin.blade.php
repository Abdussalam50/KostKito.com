<div class="container px-3">
    @props(['data'])
    @props(['element'])
    @props(['title'])
    @props(['menu'])
    @props(['id'])

    @php
        $category=['kategori','jenis_kelamin','sistem','status','panel_utama'];
    @endphp
   
    <div class='p-5'>
        <h2 class='text-primary'>{{ucwords($title)}}</h2>

            <form action="/admin/menu/{{'data '.$menu}}/proses_edit/{{$id}}" method="post" enctype="multipart/form-data" id='formdata'>
                @csrf
                @method('PUT')
                @foreach($element as $item)

                    
                <div class="mb-3">
                    @if($item !='created_at'&& $item!='updated_at')
                    <label for="{{$item}}" class="form-label">{{ucwords(str_replace('_',' ',$item))}}</label>
                    @endif
                    @if($item !='created_at'&& $item!='updated_at')
                    @if($item=='waktu pernikahan'||$item=='waktu_resepsi')
                    <input placeholder="{{ucwords(str_replace('_',' ',$item))}}" type="date" name="{{$item}}" id="{{$item}}" class='form-control' value='{{$data->utama->$item}}'>
                    @elseif($item=='password')
                    <input placeholder="{{ucwords(str_replace('_',' ',$item))}}" type="password" name="{{$item}}" id="{{$item}}" class='form-control' value='{{$data->utama->$item}}'>
                    @elseif($item=='waktu')
                    <input placeholder="{{ucwords(str_replace('_',' ',$item))}}" type="datetime-local" name="{{$item}}" id="{{$item}}" class='form-control' value='{{$data->utama->$item}}'>
                    @elseif(strpos($item,'id_')!==false && str_replace('id_','',$item)==$menu)
                        <input placeholder="{{ucwords(str_replace('_',' ',$item))}}" type="text" name="{{$item}}" id="{{$item}}" class='form-control mb-2' value='{{$data->utama->$item}}' readonly>
                        @if($menu=='kontrakan')
                        <label for="" class="form-label">Edit Fasilitas</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Edit Fasilitas"  readonly>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#id_fasilitas">Edit Fasilitas</button>
                        </div>
                        <label for="" class="form-label">Edit Peraturan</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Edit Peraturan"  readonly>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#id_peraturan">Edit Peraturan</button>
                        </div>
                        <label for="" class="form-label">Edit Kelebihan</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Edit Kelebihan"  readonly>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#id_kelebihan">Edit Kelebihan</button>
                        </div>
                        @endif
                    @elseif(strpos($item,'id_')!==false && str_replace('id_','',$item)!==$menu)
                        @if($item=='id_kontrakan')
                        <input placeholder="{{ucwords(str_replace('_',' ',$item))}}" type="text" name="{{$item}}" id="{{$item}}" class='form-control' readonly value='{{$data->utama->$item}}' >
                        
                        
                        @else
                        <select name="{{$item}}" id="{{$item}}" class="form-control" value="{{$data->utama->$item}}">
                            @php
                                $table="data_".$menu;
                            @endphp
                    
                            {!!drop_relation($item,$table)!!}
                        </select>
                        @endif

                    @elseif(in_array($item,$category))
                            @php
                                $table="data_".$menu;
                            @endphp
                        <select name="{{$item}}" id="{{$item}}"  class="form-control">
                            <option value="{{$data->utama->$item}}">{{$data->utama->$item}}</option>
                            @foreach(combo_enum($table,$item) as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    @elseif($item=='harga_tahunan' || $item=='harga_bulanan')
                      <label for="" class="form-label"></label>
                      <div class="input-group mb-3">
                          <span class="input-group-text">Rp</span>
                          <input type="text" class="form-control" name="{{$item}}" id='{{$item}}'value='{{$data->utama->$item}}' required='required'>
                      </div>
                    @elseif(strpos($item,'foto')!==false)
                    <img src="{{ asset('galeri/'.$data->utama->$item) }}" onclick="window.open('{{ asset('galeri/'.$data->utama->$item) }}')" width="50" alt="">
                    <input type="hidden" name="{{$item.'_lama'}}" value="{{$data->utama->$item}}">
                    <input placeholder="{{ucwords(str_replace('_',' ',$item))}}" type="file" name="{{$item}}" id="{{$item}}" class='form-control' value="{{$data->utama->$item}}">
                    @else
                    <input placeholder="{{ucwords(str_replace('_',' ',$item))}}" type="text" name="{{$item}}" id="{{$item}}" class='form-control' value="{{$data->utama->$item}}">
                    @endif
                    @endif
                
                </div>
                @endforeach
 @php

 if($menu=='kontrakan'){
@endphp
<div class="modal fade" id="id_peraturan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='width:50%'>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Peraturan Kontrakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <button class="btn btn-sm btn-primary" id='add_peraturan'>Set Peraturan Baru</button>
        
              @foreach($data->peraturan as $item)
              <div class="my-2">
                  <input type="text" name='peraturan[]' class='form-control' id='peraturan' value="{{$item->peraturan}}"placeholder="Peraturan" >
              </div>
              @endforeach
              <div class="my-2">
                  <input type="text" class='form-control' id='peraturan' value=""placeholder="Peraturan" readonly>
              </div>
            </div>
        
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 
      </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="id_kelebihan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='width:50%'>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelebihan Kontrakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <button class="btn btn-sm btn-primary" id='add_kelebihan'>Edit Kelebihan</button>
          
              @foreach($data->kelebihan as $item)
                <div class="my-2">
                  <input type="text" name='kelebihan[]' class='form-control' id='kelebihan' value="{{$item->kelebihan}}"placeholder="kelebihan" >
                </div>
              @endforeach
              <div class="my-2">
                  <input type="text"  class='form-control' id='kelebihan' value=""placeholder="kelebihan" readonly>
                </div>
          
        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 
      </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="id_fasilitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='width:50%'>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Fasilitas Kontrakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            @foreach(history_fasilitas($data->utama->id_kontrakan) as $item)
    {!! $item !!}
@endforeach
        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 
      </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
    let peraturanCount = 1;
    let kelebihanCount = 1;
    const formdata = document.getElementById('formdata');

    // Tambah input peraturan
    document.getElementById('add_peraturan').addEventListener('click', (e) => {
        e.preventDefault();

        const newInput = document.createElement('input');
        newInput.type = "text";
        newInput.classList.add("form-control", "my-2");
        newInput.id = "peraturan_" + peraturanCount;
        newInput.placeholder = "Peraturan";

        // Hidden input yang akan dikirim
        const hiddenInput = document.createElement('input');
        hiddenInput.type = "hidden";
        hiddenInput.name = "peraturan[]";

        // Sinkronisasi value
        newInput.addEventListener('input', () => {
            hiddenInput.value = newInput.value;
        });

        e.target.insertAdjacentElement('afterend', newInput);
        formdata.appendChild(hiddenInput);

        peraturanCount++;
    });

    // Tambah input kelebihan
    document.getElementById('add_kelebihan').addEventListener('click', (e) => {
        e.preventDefault();

        const newInput = document.createElement('input');
        newInput.type = "text";
        newInput.classList.add("form-control", "my-2");
        newInput.id = "kelebihan_" + kelebihanCount;
        newInput.placeholder = "Kelebihan";

        // Hidden input yang akan dikirim
        const hiddenInput = document.createElement('input');
        hiddenInput.type = "hidden";
        hiddenInput.name = "kelebihan[]";

        // Sinkronisasi value
        newInput.addEventListener('input', () => {
            hiddenInput.value = newInput.value;
        });

        e.target.insertAdjacentElement('afterend', newInput);
        formdata.appendChild(hiddenInput);

        kelebihanCount++;
    });
});
    function add_option(){
        const options=document.querySelectorAll('input[type="checkbox"]');
        options.forEach(option=>{
            if(option.checked){
                const hiddenInput=document.createElement('input');
                hiddenInput.type='hidden';
                hiddenInput.name='fasilitas[]';
                hiddenInput.value=option.value;
                document.getElementById('formdata').appendChild(hiddenInput);
            }
        });
    }
  </script>
  @php
}
  @endphp
                <button type="submit" class='btn btn-primary'> {{ucwords(str_replace('data','',$title))}}</button>
            </form>
        
    </div>
</div>


