<div class='container'>
    @props(['data'])
    @props(['title']) 
    @props(['menu']) 
    @props(['schema'])
    @props(['id'])
    <h1 class="text-center">{{ucwords(str_replace('_',' ',$title))}}</h1>
   <div class="table">
    <!-- <h2 class="text-start">{{ucwords(str_replace('data','detail',$menu))}}</h2> -->
        <table class="table">
            @foreach($schema as $item)
                <tr>
                    <td>{{$item}}</td>
                    <td width="2%">:</td>
                    <td>{{$data->$item}}</td>
                </tr>
            @endforeach
        </table>
    <div class="row justify-content-center">
        <div class="col-4 col-md-2">
            
            <a href="../../{{$menu}}" class="btn btn-primary px-3">Kembali</a>
        </div>
        <div class="col-4 col-md-2">

            <a href="../../{{$menu}}/edit/{{$id}}" class="btn btn-warning px-3">Edit Data</a>
        </div>
        <div class="col-4 col-md-2">
            <form action="../../{{$menu}}/proses_hapus/{{$id}}" method="post" class='p-0 m-0'>
                @csrf
                <!--  -->
                <button type="submit" class="btn btn-danger px-3">Hapus</button>
            </form>
        </div>
    </div>
   </div>
</div>

@php
if($menu=='kontrakan'){
@endphp

@php
}

@endphp