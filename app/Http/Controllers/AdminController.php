<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\DataAdmin;
use App\Models\DataDetailFasilitas;
use App\Models\DataFasilitas;
use App\Models\DataKontrakan;
use App\Models\DataPemilik;
use App\Models\DataWilayah;
use App\Models\DataTraffic;
use Illuminate\Support\Facades\DB;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Cache;
use PhpParser\Node\Expr\Cast\Object_;
use Spatie\FlareClient\Http\Exceptions\BadResponse;

class AdminController extends Controller
{

  public function action_login(Request $request){
    // dd($request->all());
    $credentials=$request->only('username','password');
  
    if(Auth::guard('admin')->attempt($credentials)){
      
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }else{
      dd('gagal');
    }

    return back()->withErrors([
      'username'=>'Login Failed, Please Check Your Username And Password'
    ]);
  }


  public function panel_index(){
    $data_kontrakkan=DataKontrakan::count();
    $data_pemilik=DataPemilik::count();
    $data_traffic=DataTraffic::sum('jumlah_traffic');
    $latest_kontrakkan=DataKontrakan::latest()->take(5)->get();
    return view("admin/index",['data_kontrakkan'=>$data_kontrakkan,'data_pemilik'=>$data_pemilik,'data_traffic'=>$data_traffic,'latest_kontrakkan'=>$latest_kontrakkan]);
  }

public function menu_index($menu)
{
    $allowedTables = [
        'data_admin', 'data_fasilitas', 'data_kontrakan', 'data_pemilik',
        'data_wilayah', 'data_detail_fasilitas', 'data_peraturan', 'data_kelebihan'
    ];

    // Normalisasi nama tabel
    $table = str_replace(' ', '_', $menu);
    $page=str_replace('data_','',$table);
    // Validasi agar tidak akses tabel sembarangan
    if (!in_array($table, $allowedTables)) {
        abort(422, 'Bad Response');
    }

    // Ambil daftar kolom dari cache atau database schema
    $element = Cache::remember('schema_'.$table, 10000, function () use ($table) {
        return Schema::getColumnListing($table);
    });

    // Ambil semua data dari tabel
    $data = DB::table($table)->get();

    // Buat judul tampilan
    $title = ucwords( $menu);

    // Kembalikan ke view
    return view("admin/menu/$table/index_$page", compact('element', 'data', 'title'));
}
public function menu_tambah($menu){
      $allowedTables = [
        'data_admin', 'data_fasilitas', 'data_kontrakan', 'data_pemilik',
        'data_wilayah', 'data_detail_fasilitas', 'data_peraturan', 'data_kelebihan'
    ];

    $table = str_replace(" ", "_", $menu);
    if (!in_array($table, $allowedTables)) {
        abort(422, 'Bad Response');
    }

    $element=Cache::remember($table,10000,function () use($table){
      return Schema::getColumnListing($table);
    });
    $page=str_replace("data_","",$table);
    $title= 'Tambah '.ucwords($menu);


    return view("admin/menu/$table/tambah_$page",compact('element','title'));
}
public function menu_edit($menu, $id)
{
    $allowedTables = [
        'data_admin', 'data_fasilitas', 'data_kontrakan', 'data_pemilik',
        'data_wilayah', 'data_detail_fasilitas', 'data_peraturan', 'data_kelebihan'
    ];

    $table = str_replace(" ", "_", $menu);
    if (!in_array($table, $allowedTables)) {
        abort(422, 'Bad Response');
    }

    // buat nama kolom ID otomatis, misal data_kontrakan -> id_kontrakan
    $id_column = str_replace("data_", "id_", $table);
    $menu_page = str_replace('data_', '', $table);

    // caching schema kolom
    $schema = Cache::remember($table, 10000, function () use ($table) {
        return Schema::getColumnListing($table);
    });

    // jika yang diedit adalah data kontrakan
    if ($table == 'data_kontrakan') {
        // ambil data utama kontrakan
        $data = DB::table($table)->where($id_column, $id)->first();

        // ambil data terkait peraturan & kelebihan
        $data_peraturan = DB::table('data_peraturan')->where($id_column, $id)->get();
        $data_kelebihan = DB::table('data_kelebihan')->where($id_column, $id)->get();

        // pastikan semuanya dikembalikan dalam bentuk objek untuk dikirim ke view
        $data = (object) [
            'utama' => $data,
            'peraturan' => $data_peraturan,
            'kelebihan' => $data_kelebihan
        ];
        
    } else {
        $data = DB::table($table)->where($id_column, $id)->first();
        $data=(object)['utama'=>$data];
    }
  
    $title = 'Edit ' . ucwords($menu);
    return view("admin/menu/$table/edit_$menu_page", [
        'element' => $schema,
        'title' => $title,
        'data' => $data,
        'id' => $id,
        'menu' => $menu_page
    ]);
}



  public function tambah_data(Request $request, $menu){
      //  
      
    $allowedTables=[
      'data_admin','data_fasilitas','data_kontrakan','data_pemilik','data_wilayah','data_detail_fasilitas','data_peraturan','data_kelebihan'
    ];

    $table=$menu;
  
 
    if(!in_array($table,$allowedTables)){
      abort(422,'Bad Response');
    }
  
    $menu_page=str_replace("data","index",$table);
    
    $schema=Cache::remember($table,10000,function ()use($table){
        return Schema::getColumnListing($table);
    });

    unset($request['_token']);
    unset($request['tambah']);
   
    $rules=[];
    foreach($schema as $item){
        if($item=='updated_at'||$item=='created_at'){
            continue;
        }elseif($item=='gambar'){
            $rules[$item]='required|image|mimes:jpg,jpeg,png|max:4048';
        }elseif($item=='password'){
            $rules[$item]='required|string|min:8';
        }elseif(strpos($item,'foto')!==false){
            $rules[$item]='nullable|image|mimes:jpg,jpeg,png|max:10048';
        }else{
            $rules[$item]='required|string';
        }
    }
    // dd($rules);
$request->validate($rules);
// dd($request->all());

    $data_send = $request->all();
    
    $ada_foto=false;
      for($i=0;$i<=5;$i++){
        if($request->hasFile("foto$i")){
          $data_send["foto$i"]=move_files($request->file("foto$i"));
          $ada_foto=true;
        }
        
      }
    
    if($request['password']){
      $data_send['password']=Hash::make($data_send['password']);
    }
    
    if($request->has('peraturan') && is_array($request['peraturan'])){
      // dd('peraturan');
        $is_peraturan=false;
        
        $request['peraturan']=array_unique($request['peraturan']);
        $data_peraturan_send=[];
        $primary_traffic=id_otomatis('id_traffic',10);
        $data_traffic=[
          'id_traffic'=>$primary_traffic,
          'id_kontrakan'=>$request['id_kontrakan'],
          'jumlah_traffic'=>0,
          'created_at'=>date('Y-m-d H:i:s'),
          'updated_at'=>date('Y-m-d H:i:s')
        ];

        foreach($request['peraturan'] as $item){
          $primary_peraturan=id_otomatis('id_peraturan',10);
          $data_peraturan_send[]=[
            'id_peraturan'=>$primary_peraturan,
            'id_kontrakan'=>$data_send['id_kontrakan'],
            'peraturan'=>$item,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
          ];
        }
        $is_peraturan=DB::table('data_peraturan')->insert($data_peraturan_send);
        DB::table('data_traffic')->insert($data_traffic);
        unset($data_send['peraturan']);
      }  

      if($request->has('fasilitas') && is_array($request['fasilitas'])){
        // dd('fasilitas');
        $is_fasilitas=false;
        $request['fasilitas']=array_unique($request['fasilitas']);
        $data_fasilitas_send=[];
          foreach($request['fasilitas'] as $item){
           $data_fasilitas_send[]=[
             'id_fasilitas'=>id_otomatis('id_fasilitas',10),
             'id_kontrakan'=>$data_send['id_kontrakan'],
             'id_detail_fasilitas'=>$item,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s')
           ];
          }
        $is_fasilitas=DB::table('data_fasilitas')->insert($data_fasilitas_send);
        
        unset($data_send['fasilitas']);
        }
      
      if($request->has('kelebihan') && is_array($request['kelebihan'])){
        // dd('kelebihan');
      
        $request['kelebihan']=array_unique($request['kelebihan']);
        $data_kelebihan_send=[];
          foreach($request['kelebihan'] as $item){
           $data_kelebihan_send[]=[
             'id_kelebihan'=>id_otomatis('id_kelebihan',10),
             'id_kontrakan'=>$data_send['id_kontrakan'],
             'kelebihan'=>$item,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s')
           ];
          }
        $is_kelebihan=DB::table('data_kelebihan')->insert($data_kelebihan_send);
        
        unset($data_send['kelebihan']);
      }
    
  
    $inserted = DB::table($table)->insert($data_send);
    

    $type  = $inserted ? 'success' : 'danger';
    $title = $inserted ? 'Proses Berhasil' : 'Proses Gagal';
    $text  = $inserted ? 'Data Berhasil Ditambahkan' : 'Data Gagal Ditambahkan';

    $pages=str_replace("_"," ",$table);
    return redirect("admin/menu/$pages/")
            ->with(['type' => $type, 'titles' => $title, 'text' => $text]);
  
    
  }

  public function edit_data(Request $request,$menu,$id){
    // dd($request->all());
    $allowedTables=[
      'data_admin','data_fasilitas','data_kontrakan','data_pemilik','data_wilayah','data_detail_fasilitas','data_peraturan','data_kelebihan'
    ];

    $table=str_replace(" ","_",$menu );
    if(!in_array($table,$allowedTables)){
      abort(422,'Bad Response');
    }
    
    $id_table=str_replace("data","id",$table);
    $menu_page=str_replace("data","index",$table);
    $schema=Cache::remember($table,10000,function() use($table){
      return Schema::getColumnListing($table);
    });

    $rules=[];
    foreach($schema as $item){
        if($item=='updated_at'||$item=='created_at'){
            continue;
        }elseif($item=='gambar'){
            $rules[$item]='required|image|mimes:jpg,jpeg,png|max:2048';
        }elseif($item=='password'){
            $rules[$item]='required|string|min:8';
        }elseif(strpos($item,'foto')!==false){
            $rules[$item]='nullable|image|mimes:jpg,jpeg,png|max:10048';
        }else{
            $rules[$item]='required|string';
        } 
    }

    $request->validate($rules);
    
    $data_send=$request->all();
    unset($data_send['_token']);
    unset($data_send['edit']);
    unset($data_send['method']);
    for($i=0;$i<=5;$i++){

      if($request->hasFile("foto$i")){
        
           unset($data_send["foto$i"."_lama"]);
          $data_send["foto$i"]=move_files($request->file("foto$i"));

      
          
      }elseif(!$request->hasFile('foto'.$i) && $request->filled("foto{$i}_lama")){
          $data_send['foto'.$i]=$request['foto'.$i.'_lama'];
          unset($data_send["foto$i"."_lama"]);
      }
    }

   
      if($request->has('peraturan')){
        $request['peraturan']=array_unique($request['peraturan']);
        $data_peraturan_send=[];
        foreach($request['peraturan'] as $item){
          $primary_peraturan=id_otomatis('id_peraturan',10);
          $data_peraturan_send[]=[
            'id_peraturan'=>$primary_peraturan,
            'id_kontrakan'=>$request['id_kontrakan'],
            'peraturan'=>$item,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
          ];
        }
        DB::table('data_peraturan')->where('id_kontrakan',$request['id_kontrakan'])->delete();
        DB::table('data_peraturan')->insert($data_peraturan_send);
        unset($data_send['peraturan']);
      }
      
      if($request->has('kelebihan')){
        $request['kelebihan']=array_unique($request['kelebihan']);
        $data_kelebihan_send=[];
        foreach($request['kelebihan'] as $item){
          $primary_kelebihan=id_otomatis('id_kelebihan',10);
          $data_kelebihan_send[]=[
            'id_kelebihan'=>$primary_kelebihan,
            'id_kontrakan'=>$request['id_kontrakan'],
            'kelebihan'=>$item,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
          ];
        }
        DB::table('data_kelebihan')->where('id_kontrakan',$request['id_kontrakan'])->delete();
        DB::table('data_kelebihan')->insert($data_kelebihan_send);
        unset($data_send['kelebihan']);
      }

      if($request->has('fasilitas') && $table=='data_kontrakan'){
        $request['fasilitas']=array_unique($request['fasilitas']);
        $data_fasilitas_send=[];
        foreach($request['fasilitas'] as $item){
          $primary_fasilitas=id_otomatis('id_fasilitas',10);
          $data_fasilitas_send[]=[
            'id_fasilitas'=>$primary_fasilitas,
            'id_kontrakan'=>$request['id_kontrakan'],
            'id_detail_fasilitas'=>$item,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
          ];
        }
        DB::table('data_fasilitas')->where('id_kontrakan',$request['id_kontrakan'])->delete();
        DB::table('data_fasilitas')->insert($data_fasilitas_send);
        unset($data_send['fasilitas']);
      }
      if($request['password']){
        $request['password']=Hash::make($request['password']);
        $data_send['password']=$request['password'];
      }
      $data_send['updated_at']=now();

      unset($data_send['_method']);
      $find=DB::table($table)->where($id_table,$id)->update($data_send);
      // $result= $find->update($request->all());
      $type=$find?'success':'danger';
      $text=$find?'Data Telah Berhasil Diubah':'Data Gagal Untuk Diubah';
      $title=$find?'Proses Selesai':'Proses Gagal';
      $menu_page=str_replace("_"," ",$table);
      return redirect("admin/menu/$menu_page/")->with(['type'=>$type,'text'=>$text,'titles'=>$title]);
    
  }

  public function hapus_data($menu,$id){
      $allowedTables=[
      'data_admin','data_fasilitas','data_kontrakan','data_pemilik','data_wilayah','data_detail_fasilitas','data_peraturan','data_kelebihan'
    ];

    $table=str_replace(" ","_",$menu);
    if(!in_array($table,$allowedTables)){
      abort(422,'Bad Response');
    }
   
    $id_table=str_replace("data","id",$table);
    $menu_page=str_replace("data","index",$table);
    $file_del=DB::table($table)->where($id_table,$id)->get();
    
    if(isset($file_del[0]->foto1)){
      for($i=1;$i<=5;$i++){
        if(isset($file_del[0]->{"foto$i"}) && $file_del[0]->{"foto$i"}!=null){
          $path=public_path("{$file_del[0]->{"foto$i"}}");
          if(file_exists($path)){
            unlink($path);
          }
        }
      }
      DB::table('data_peraturan')->where('id_kontrakan',$file_del[0]->id_kontrakan)->delete();
      DB::table('data_fasilitas')->where('id_kontrakan',$file_del[0]->id_kontrakan)->delete();
      DB::table('data_kelebihan')->where('id_kontrakan',$file_del[0]->id_kontrakan)->delete();
    }
    $request_del=DB::table($table)->where($id_table,$id)->delete();
    
    $type=$request_del?'success':'danger';
    $text=$request_del?'Data Berhasil Dihapus':'Data Tidak Berhasil Dihapus';
    $title=$request_del?'Proses Berhasil':'Proses Gagal';
    return redirect("admin/menu/$table/")->with(['type'=>$type,'titles'=>$title,'text'=>$text]);
  }

  public function detail($menu,$id){
        $allowedTables=[
      'data_admin','data_fasilitas','data_kontrakan','data_pemilik','data_wilayah','data_detail_fasilitas','data_peraturan','data_kelebihan'
    ];

    $table=str_replace(" ","_",$menu);
    if(!in_array($table,$allowedTables)){
      abort(422,'Bad Response');
    }
 
    $menu_page=str_replace("data","detail",$table);
    $schema=Cache::remember($table,10000,function() use($table){
      return Schema::getColumnListing($table);
    });
    $id_column=str_replace("data_","id_",$table);
    $data=DB::table($table)->where($id_column,$id)->first();
    if($data){
    return view("admin/menu/$table/$menu_page",['data'=>$data,'title'=>$menu_page,'menu'=>$menu,'schema'=>$schema,'id'=>$id]);
    }else{
      abort(404);
    }
  }

  public function search(Request $request){
    $allowedTable=[
      'data_admin',
      'data_pemilik',
      'data_kontrakan',
      'data_fasilitas',
      'data_detail_fasilitas',
      'data_peraturan',
      'data_kelebihan',
      'data_wilayah'
    ];
    $table=$request['table'];
    if(!in_array($table,$allowedTable)){
      abort(422,'Bad Response');
    }
    $search=$request['option'];
    $keywords=$request['search'];
    $title=str_replace("_"," ",$table);
    $menu_page=str_replace("data","index",$table);
    $schema=Cache::remember($table,10000,function()use($table){
      return Schema::getColumnListing($table);
    });
    $find=DB::table($table)->where($search,'LIKE',"%$keywords%")->get();
    
    return view("admin/menu/$table/$menu_page",['element'=>$schema,'title'=>$title,'data'=>$find]);
  }
  
  public function logout(Request $request){
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.dashboard');
  }
}
