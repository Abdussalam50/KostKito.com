<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKontrakan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    //
    public function dashboard(){
        $page=request()->get('page',1);
        $perPage=12;
        $items=DB::table('data_kontrakan')
    ->leftJoin('data_traffic', 'data_kontrakan.id_kontrakan', '=', 'data_traffic.id_kontrakan')
    ->select(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah',
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic',
        DB::raw('COUNT(data_traffic.id_traffic) as total_views')
    )
    ->groupBy(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah',
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic'
    )
    ->get();
        $datas=new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page,$perPage),
            $items->count(),
            $perPage,
            $page,
            ['path'=>request()->url()]
        );
        $page_slide=DataKontrakan::where('panel_utama','on')->get();
        
        return view('home/index',compact('datas','page_slide'));
    }

    public function detail_item($id){
       
         $data_kontrakan=DB::table('data_kontrakan')->where('id_kontrakan',$id)->first();
         $data_fasilitas=DB::table('data_fasilitas')
                             ->select('id_fasilitas','id_detail_fasilitas')
                             ->where ('id_kontrakan',$id)->get();
         $data_peraturan=DB::table('data_peraturan')
                              ->select('peraturan')
                              ->where ('id_kontrakan',$id)->get();
         $data_kelebihan=DB::table('data_kelebihan')
                             ->where('id_kontrakan',$id)->get();
         //validasi traffic
         $validation=DB::table('data_traffic')->where('id_kontrakan',$id)->exists();
         $id_traffic=id_otomatis('data_traffic',10);
         if($validation){
            DB::table('data_traffic')->where('id_kontrakan',$id)->update([
                'jumlah_traffic'=>DB::raw('jumlah_traffic+1'),
                'updated_at'=>now()
            ]);
         }else{
            DB::table('data_traffic')->insert([
                'id_traffic'=>$id_traffic,
                'id_kontrakan'=>$id,
                'jumlah_traffic'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
         }
        return view('home/detail',compact('data_kontrakan','data_fasilitas','data_peraturan','data_kelebihan'));
    }



    public function find_kontrakan(Request $request){
       
        $id_wilayah=$request->input('id_wilayah');
        $kategori=$request->input('kategori');
        $sistem=$request->input('sistem');
        $page=request()->get('page',1);
        $perPage=12;
       
        $items= DB::table('data_kontrakan')->leftJoin('data_traffic', 'data_kontrakan.id_kontrakan', '=', 'data_traffic.id_kontrakan')
    ->select(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah',
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic',
        DB::raw('COUNT(data_traffic.id_traffic) as total_views')
    )
    ->where('data_kontrakan.id_wilayah', $id_wilayah)
    ->where('data_kontrakan.kategori', $kategori)
    ->where('data_kontrakan.sistem', $sistem)
    
    ->groupBy(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah',
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic'
    )
    ->get();

         $page_slide=DataKontrakan::where('panel_utama','on')->get();
        $datas=new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page,$perPage),
            $items->count(),
            $perPage,
            $page,
            ['path'=>request()->url()]
        );
        
        return view('home/index',compact('datas','page_slide'));
    }
public function filter_kategori($kategori)
{
    $datas = DataKontrakan::withSum('relasi_traffic','jumlah_traffic')
        ->where('kategori', $kategori)
        ->orderByDesc('id_kontrakan')
        ->paginate(12);

    $page_slide = DataKontrakan::where('panel_utama', 'on')->get();

    return view('home.index', compact('datas', 'page_slide'));
}

    public function jarang_dilihat(){
       $page=request()->get('page',1);
        $perPage=12;
        $items = DB::table('data_kontrakan')
        ->leftJoin('data_traffic', 'data_kontrakan.id_kontrakan', '=', 'data_traffic.id_kontrakan')
        ->select(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah',
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic',
        DB::raw('COUNT(data_traffic.id_traffic) as total_views')
    )
    ->groupBy(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah',
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic'
    )
    ->orderBy('total_views','asc')
    ->get();

        $datas=new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page,$perPage),
            $items->count(),
            $perPage,
            $page,
            ['path'=>request()->url()]
        );
        $page_slide=DataKontrakan::where('panel_utama','on')->get();
        return view('home/index',compact('datas','page_slide'));
       
    }
    
    public function belum_dilihat(){
       $page=request()->get('page',1);
        $perPage=12;
$items = DB::table('data_kontrakan')
    ->leftJoin('data_traffic', 'data_kontrakan.id_kontrakan', '=', 'data_traffic.id_kontrakan')
    ->select(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah', 
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic',
        DB::raw('COUNT(data_traffic.id_traffic) as total_views')
    )
    ->groupBy(
        'data_kontrakan.id_kontrakan',
        'data_kontrakan.id_pemilik',
        'data_kontrakan.nama_kontrakan',
        'data_kontrakan.kategori',
        'data_kontrakan.sistem',
        'data_kontrakan.alamat',
        'data_kontrakan.total_kamar',
        'data_kontrakan.jumlah_kamar_kosong',
        'data_kontrakan.harga_tahunan',
        'data_kontrakan.harga_bulanan',
        'data_kontrakan.id_wilayah',
        'data_kontrakan.updated_at',
        'data_kontrakan.foto1',
        'data_kontrakan.foto2',
        'data_kontrakan.foto3',
        'data_kontrakan.foto4',
        'data_kontrakan.foto5',
        'data_kontrakan.panel_utama',
        'data_traffic.jumlah_traffic' 
    )
    ->having('total_views','=',0)
    ->get();

        $datas=new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page,$perPage),
            $items->count(),
            $perPage,
            $page,
            ['path'=>request()->url()]
        );
        $page_slide=DataKontrakan::where('panel_utama','on')->get();
        return view('home/index',compact('datas','page_slide'));
       
    }

    public function about_company(){
        return view('home/about/about');
    }

public function captcha(Request $request)
{
    $request->validate([
        'g-recaptcha-response' => 'required|captcha',
    ]);

    $wa = $request->wa;

    return redirect("https://wa.me/$wa");
}
}
