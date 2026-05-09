<div class="container mx-3">
    @props(['data'])
    @props(['title'])
    @props(['element'])
    @if(session('type')=='success')
        <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
            <strong>{{session('titles')}}</strong> {{session('messages')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('type')=='danger')
        <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
            <strong>{{session('titles')}}</strong> {{session('messages')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class='container p-2 mb-3'>
@php
    $title1=$title;
    $title = strtolower(trim($title1)); // biar konsisten
    $dir=str_replace(" ","_",$title);
    $menu=str_replace("data","detail",$title);
    $table=str_replace(" ","_",$title);
    $content = $data;
    $no = 1;
    $id = '';
    $id_inherritance=str_replace("data","id",$dir);
    if(strpos($title,'data admin') !== false){
        $id = 'id_admin';
    }elseif(strpos($title,'data pemilik') !== false){
        $id = 'id_pemilik';
    }elseif(strpos($title,'data detail fasilitas') !== false){
        $id = 'id_detail_fasilitas';
    }elseif(strpos($title,'data fasilitas') !== false){
        $id = 'id_fasilitas';
    }elseif(strpos($title,'data kontrakan') !== false){
        $id = 'id_kontrakan';
    }elseif(strpos($title,'data wilayah') !== false){
        $id = 'id_wilayah';
    }elseif(strpos($title,'data peraturan') !== false){
        $id = 'id_peraturan';
    }elseif(strpos($title,'data traffic') !== false){
        $id = 'id_traffic';
    }elseif(strpos($title,'data kelebihan') !== false){
        $id = 'id_kelebihan';
    }
   echo $title;
@endphp
        <h1>{{strtoupper($title)}}</h1>
        <div class="d-flex justify-content-between">
             <a href="/admin/menu/{{$title}}/tambah" class="btn btn-primary ms-2 mt-3"><i class="fa fa-plus"></i> Tambah Data</a>
        <table>
            <form action="{{ url('admin/menu/'.$title.'/cari') }}" method="post">
                @csrf
                 <input type="hidden" name="table" value="{{$table}}">
            <tr>

                <td><select name="option" id="option" class='form-control small' required='required'>
                    <option value="">--Pilih Berdasarkan--</option>
                    @foreach($element as $item)
                       
                        <option value="{{$item}}">{{$item}}</option>
                       
                    @endforeach
                </select></td>
                <td>
                    <div class="input-group">
                        <input type="text" class='form-control sm' name="search" id="search" placeholder="Keyword Anda" required='required'> 
                        <button type="submit" class='btn btn-primary btn-sm'>  <i class="fa fa-search"></i> Search</button>
                    </div>
                </td>
               
            </tr>
            </form>
        </table>
        </div>

           
    </div>
                
    <div class='table-responsive p-2'>
        <table class="table ">
            <thead>
                <th>No</th>
               
                @foreach($element as $item)
                    @if($id_inherritance==$id)
                    <th>{{ucwords(str_replace('id_','',$item))}}</th>
                    @else
                    <th>{{ucwords(str_replace('_',' ',$item))}}</th>
                    @endif
                @endforeach
            </thead>
            <tbody>

            @if(count($data)>0)
                @foreach($data as $item)
                    <tr>
                        <td>{{$no++}}</td>

                        @foreach($element as $col)
                           @if($col=='foto')
                            <td><img src="{{asset('/galeri/'.$item->$col)}}" height="120"alt="" srcset=""></td>
                           @elseif(strpos($col,'id_')!==false)
                             @if($col==$id)
                                <td><a href="{{$title}}/detail/{{$item->$id}}">{{$item->$col}}</a></td>
                             @else
                                @php 
                                    $table_relation=str_replace("id","data",$col);
                                    $ids=str_replace(" ","", $item->$col);
                                    $keyword='';
                                    if($col=='id_pemilik'){
                                        $keyword='nama';
                                    }elseif($col=='id_wilayah'){
                                        $keyword='wilayah';
                                    }elseif($col=='id_kontrakan'){
                                        $keyword='nama_kontrakan';
                                    }elseif($col=='id_detail_fasilitas'){
                                        $keyword='fasilitas';
                                    }
                                    
                                    
                                @endphp
                            <td>{!!create_identifier($ids,$table_relation,$keyword)!!}</td>
                            @endif
                           @elseif($col=="password")
                            <td>{{substr($item->$col,0,10)}}....</td>
                           @else
                            <td>{{$item->$col}}</td>
                          @endif
                        @endforeach
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{count($element)+2}}" class='text-center'>Data Tidak Ditemukan</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>