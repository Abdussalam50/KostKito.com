<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataKontrakan;
use App\Models\DataTraffic;
class OwnerController extends Controller
{
    //

    public function action_login(Request $request){
        $credentials=$request->only('username','password');
        if(Auth::guard('owner')->attempt($credentials)){
            
            $request->session()->regenerate();
            return redirect()->route('owner.index');
        }else{
            dd($credentials);
        }
            // Jika gagal
    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ])->onlyInput('username'); 
    }
public function owner_dashboard()
{
    $id_owner = Auth::guard('owner')->id();
    $kontrakan = DataKontrakan::where('id_pemilik', $id_owner)->firstOrFail();

    // Ambil traffic berdasarkan id kontrakan
    $traffic = DataTraffic::where('id_kontrakan', $kontrakan->id_kontrakan)->first();
   
    // Jika tidak ada data traffic, set ke 0
    $jum_traffic = $traffic ? $traffic->jumlah_traffic : 0;

   

    return view('owner.index', compact('jum_traffic'));
}
    public function page_kamar(){
        $owner_id=Auth::guard('owner')->id();
  
        $d_kontrakan=DataKontrakan::where('id_pemilik',$owner_id)->firstOrFail();
        $jum_kamar=$d_kontrakan['jumlah_kamar_kosong'];
        return view('owner/update_kamar',compact('jum_kamar'));
    }

    public function page_harga(){
        $owner_id=Auth::guard('owner')->id();
        $d_kontrakan=DataKontrakan::where('id_pemilik',$owner_id)->firstOrFail();
        if(strtolower($d_kontrakan['sistem'])=='bulanan'){
            $hg_kamar=$d_kontrakan['harga_bulanan'];
        }else{
            $hg_kamar=$d_kontrakan['harga_tahunan'];
        }

        return view('owner/update_harga',compact('hg_kamar'));
    }
    
    public function set_jum_kamar(Request $request){
        $owner_id=Auth::guard('owner')->id();
        $d_kamar=DataKontrakan::where('id_pemilik',$owner_id)->firstOrFail();
        $jumlah_kamar=$request['jumlah'];
        $validation=$d_kamar->update([
            'jumlah_kamar_kosong'=>$jumlah_kamar
        ]);
        if($validation){
            $message='Jumlah Kamar Berhasil Diperbarui';
            $title='Proses Berhasil';
        }else{
            $message='Jumlah Kamar Gagal Diperbarui';
            $title='Proses Gagal';
        }
        return redirect()->back()->with(['message'=>$message,'title'=>$title]);
    }

    public function set_harga_kamar(Request $request){
        $owner_id=Auth::guard('owner')->id();
        $d_kontrakan=DataKontrakan::where('id_pemilik',$owner_id)->firstOrFail();
   
        $h_kamar=$request->input('number');
        if(strtolower($d_kontrakan->sistem)=='bulanan'){
        $validation=$d_kontrakan->update([
            'harga_bulanan'=>$h_kamar
        ]);
        }else{
             
        $validation=$d_kontrakan->update([
            'harga_tahunan'=>$h_kamar
        ]);
        }
        if($validation){
            $message='Harga Kamar Berhasil Disetting';
            $title='Proses Berhasil';
        }else{
            $message='Harga Kamar Gagal Disetting';
            $title='Proses Gagal';
        }

        return redirect()->back()->with(['message'=>$message,'title'=>$title]);
    }

    public function owner_logout(Request $request){
        Auth::guard('owner')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('owner.index');
    }
}
