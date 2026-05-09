@props(['element'])
@props(['title'])

<div class="container-md py-5" style="min-height:100vh">
    <div class='py-5 px-3'>
        <h2 class='text-start'>{{ ucwords($title) }}</h2>
        @php
            $primary = str_replace(" ", "_", strtolower($title));
            $primary1 = str_replace("tambah_data", "id", $primary);
            $table = str_replace("tambah_data", "data", $primary);
        @endphp  
        <form action="/admin/menu/{{ $table }}/tambah" method="post" id='formdata' enctype="multipart/form-data">
            @csrf
            @foreach($element as $index)
                
                <div class="mb-3">
                    @if($index !== 'created_at' && $index !== 'updated_at')
                        @php
                            $replace = str_replace("id", "", $index);
                        @endphp
                        <label for="{{ $index }}" class='form-label'>{{ ucwords(str_replace("_", " ", $replace)) }}</label>
                    @endif
                    @if($index == 'peraturan' || $index == 'kelebihan')
                        <div id="slot_input_{{ $index }}">
                            <div class="input-group mb-2">
                                <input type="text" name="{{ $index }}[]" id="{{ $index }}_0" class='form-control' placeholder="{{ucwords($index)}}">
                                <button type="button" class='btn btn-primary add-item' data-target="{{ $index }}">Tambah {{ ucwords($index) }}</button>
                            </div>
                        </div>
                    @elseif($index == 'waktu')
                        <input type="datetime-local" name="{{ $index }}" id="{{ $index }}" class='form-control'>
                    @elseif($index == 'password')
                        <input type="password" name="{{ $index }}" id="{{ $index }}" class='form-control' placeholder="{{ ucwords(str_replace('_', ' ', $index)) }}">
                    @elseif($index == 'created_at' || $index == 'updated_at')
                        <input type="hidden" name="{{ $index }}" id="{{ $index }}" class='form-control' value="{{ date('Y-m-d H:i:s') }}">
                    @elseif(strpos($index, 'id_') !== false)
                        @if($index === $primary1)
                            <input type="text" name="{{ $index }}" id="{{ $index }}" value="{{ id_otomatis($index, 10) }}" readonly class='form-control mb-2'>
                                @if($primary1 == 'id_kontrakan')
                                <label for="" class="form-label">Tambah Fasilitas</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" placeholder="Tambah Fasilitas Kontrakan">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id_fasilitas">
                                    Tambah Fasilitas
                                    </button>
                                </div>
                                <label for="" class="form-label">Tambah Peraturan</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" placeholder="Tambah Peraturan Kontrakan">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id_peraturan">
                                    Tambah Peraturan
                                    </button>
                                </div>                        
                                <label for="" class="form-label">Tambah Kelebihan</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" placeholder="Tambah Kelebihan Kontrakan">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id_kelebihan">
                                    Tambah Kelebihan
                                    </button>
                                </div>  
                                @endif                      
                        @else

                                <select name="{{ $index }}" id="{{ $index }}" class="form-control">
                                    <option value="">--Pilih {{ str_replace("id_", "", $index) }}--</option>
                                    
                                    {!! drop_relation($index, $table) !!}
                                </select>
                            
                        @endif
                    @elseif(in_array($index, ['jenis_kelamin', 'status', 'kategori', 'sistem', 'agama','panel_utama']))
                        <select name="{{ $index }}" id="{{ $index }}" class="form-control">
                            @foreach(combo_enum($table, $index) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    @elseif($index==='harga_tahunan'||$index==='harga_bulanan')
                       
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" value='0' class="form-control" name='{{$index}}' id='{{$index}}'>
                        </div>
                    @elseif(strpos($index, 'foto') !== false)
                        <input type="file" name="{{$index}}" id="{{$index}}" class='form-control'>
                    @else
                        <input type="text" name="{{ $index }}" id="{{ $index }}" class='form-control' placeholder="{{ ucwords(str_replace('_', ' ', $index)) }}">
                    @endif
                </div>
            @endforeach
            <button type="submit" name='tambah' class='btn btn-primary mt-4'>Tambah</button>
        </form>

        @if($primary1 == 'id_kontrakan')
            @php
                $fieldName = str_replace('id_', '', $primary1);
            @endphp
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const container = document.querySelector('#slot_input_{{ $fieldName }}');
                    let inputCount = 1;

                    container.addEventListener('click', (e) => {
                        if (e.target.classList.contains('add-item') && e.target.dataset.target === '{{ $fieldName }}') {
                            const newInputGroup = document.createElement('div');
                            newInputGroup.classList.add('input-group', 'mb-2');
                            newInputGroup.innerHTML = `
                                <input type="text" name="{{ $fieldName }}[]" id="{{ $fieldName }}_${inputCount}" placeholder='{{ucwords($fieldName)}}'class="form-control">
                            `;
                            container.appendChild(newInputGroup);
                            inputCount++;
                        }
                    });
                });
            </script>
        @endif
    </div>
</div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Launch demo modal
</button> -->

<!-- Modal -->
 @php

 if($primary1=='id_kontrakan'){
@endphp
<div class="modal fade" id="id_peraturan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='width:50%'>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Peraturan Kontrakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <button class="btn btn-sm btn-primary" id='add_peraturan'>Tambah Peraturan</button>
          <form action="" method="post">

              <div class="my-2">
                  <input type="text" class='form-control' id='peraturan' value=""placeholder="Peraturan" readonly>
                </div>
            </div>
        </form>
      
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kelebihan Kontrakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <button class="btn btn-sm btn-primary" id='add_kelebihan'>Tambah Kelebihan</button>
          <form action="" method="post">

              <div class="my-2">
                  <input type="text"  class='form-control' id='kelebihan' value=""placeholder="kelebihan" readonly>
                </div>
            </form>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Fasilitas Kontrakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            {!!option_generator('data_detail_fasilitas ')!!}
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
