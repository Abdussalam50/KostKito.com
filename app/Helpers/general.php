<?php
use Illuminate\Support\Facades\DB;
use App\Models\{DataAdmin,DataPemilik,DataKontrakan,DataDetailFasilitas,DataFasilitas,DataPeraturan,DataTraffic,DataWilayah,DataKelebihan};
function id_otomatis($table,$length){
    $prefix=strtoupper(str_replace("id_","",$table));
    $pref=substr($prefix,0,3);
    $numreduce=strlen($pref);
    $lengthnum=$length-$numreduce;
    $num='';
    for($i=0;$i<$lengthnum;$i++){
        $num.=mt_rand(0,9);
    }

    return $pref.$num;
}

function option_generator($table){
    $output="";
    $table=str_replace(" ","",$table);
    $replace1=str_replace("_"," ",$table);
    $name=str_replace("data","",$replace1);
    $data=DB::table($table)->get();
    foreach($data as $item){
        $output.='<input type="checkbox" name="'.$name.'[]" value="'.$item->id_detail_fasilitas.'" onclick="add_option()"> <label>'.$item->fasilitas.'</label><br>';
    }
    return $output;
}

function combo_enum($table,$column){
       
$type = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'")[0]->Type;

    preg_match('/^enum\((.*)\)$/', $type, $matches);

    $enum = [];
    if (!empty($matches)) {
        $values = explode(',', $matches[1]);
        foreach ($values as $value) {
            $enum[] = trim($value, "'");
        }
    }

    return $enum;
}

function drop_relation($id,$title){

    $output='';
    if($title=='data '){
        if($id=='id_mempelai'){
           $data= DataDetailFasilitas::all();
            foreach($data as $item){
                $output.='<option value="'.$item->id_mempelai.'">'.$item->nama_mempelai_pria.' dan '.$item->nama_mempelai_wanita.'</option>';
            }
        
        }
        return $output;
    }elseif($title=='data galeri'){
        if($id=='id_mempelai'){
           $data= DataDetailFasilitas::all();
            foreach($data as $item){
                $output.='<option value="'.$item->id_mempelai.'">'.$item->nama_mempelai_pria.' dan '.$item->nama_mempelai_wanita.'</option>';
            }
        
        }
        return $output;
    }elseif($title=='data keluarga besar'){
        if($id=='id_mempelai'){
           $data= DataDetailFasilitas::all();
            foreach($data as $item){
                $output.='<option value="'.$item->id_mempelai.'">'.$item->nama_mempelai_pria.' dan '.$item->nama_mempelai_wanita.'</option>';
            }
        
        }
        return $output;
    }elseif($title=='data rekening'){
        if($id=='id_mempelai'){
           $data= DataDetailFasilitas::all();
            foreach($data as $item){
                $output.='<option value="'.$item->id_mempelai.'">'.$item->nama_mempelai_pria.' dan '.$item->nama_mempelai_wanita.'</option>';
            }
        
        }
        return $output;
    }elseif($title=='data_fasilitas'){
        if($id=='id_detail_fasilitas'){
           $data= DataDetailFasilitas::all();
            foreach($data as $item){
                $output.='<option value="'.$item->id_detail_fasilitas.'">'.$item->fasilitas.'</option>';
            }
        
        }
        return $output;
    }elseif($title=='data_kontrakan'){
        if($id=='id_pemilik'){
           $data= DataPemilik::all();
            foreach($data as $item){
                $output.='<option value="'.$item->id_pemilik.'">'.$item->nama.'</option>';
            }
        return $output;
        }elseif($id=='id_wilayah'){
            $data=DataWilayah::all();
          
        foreach ($data as $item) {
        

            $output .= '<option value="'.$item->id_wilayah.'">'.$item->wilayah.'</option>';
        }

            return $output;
        
        }elseif($id=='id_peraturan'){
            $data=DataKontrakan::with('relasi_peraturan')->get();
            foreach($data as $item){
                $output.='<option value="'.$item->id_peraturan.'">'.$item->peraturan.'</option>';
            }
            return $output;
        }elseif($id=='id_kelebihan'){
            $data=DataKontrakan::with('relasi_kelebihan')->get();
            foreach($data as $item){
                $output.='<option value="'.$item->id_kelebihan.'">'.$item->nama_kelebihan.'</option>';
            }
            return $output;
        }
        
    }
}

function history_fasilitas($id_kontrakan){
   $data= DataFasilitas::where('id_kontrakan',$id_kontrakan)->get();
   $detail_fasilitas=DataDetailFasilitas::all();
    $checklist=[];
    foreach($data as $item){
        $id_detail_fasilitas=$item->id_detail_fasilitas;
        $checklist[]=$id_detail_fasilitas;
    }
    $options=[];
    foreach($detail_fasilitas as $item_fasilitas){
        if(in_array($item_fasilitas->id_detail_fasilitas,$checklist)){
            $options[]='<input type="checkbox" name="fasilitas[]" value="'.$item_fasilitas->id_detail_fasilitas.'" checked> <label>'.$item_fasilitas->fasilitas.'</label><br>';
        }else{
            $options[]='<input type="checkbox" name="fasilitas[]" value="'.$item_fasilitas->id_detail_fasilitas.'"> <label>'.$item_fasilitas->fasilitas.'</label><br>';
        }
    }
    return $options;
}

function move_files($file){
    $ext_galery = ['jpeg','jpg','png','avif'];
    $extension = $file->getClientOriginalExtension();

    $folder = in_array($extension, $ext_galery) ? 'galeri' : '';
    $file_name = time() . '-' . $file->getClientOriginalName();

    $file->move(public_path($folder), $file_name);
    return $file_name;
}

function extract_zip($file){
$zipFileName=$file->getClientOriginalName();
$zipPath=public_path($zipFileName);
$file->move(public_path(),$zipFileName);

 $zip=new ZipArchive;
 if($zip->open($zipPath)===true){
 $nameTheme=str_replace(".zip","",$zipFileName);
 $destination=public_path("themes/$nameTheme");  
 
 $destination1=resource_path("views/themes/$nameTheme");
 if(!file_exists($destination)){
    mkdir($destination,0755,true);
 }  
 if(!file_exists($destination1)){
    mkdir($destination1,0755,true);
 }

 for($i=0;$i<$zip->numFiles;$i++){
    $entry=$zip->getNameIndex($i);

    if(str_starts_with($entry,'partials/')||$entry==='index.blade.php'){
        $zip->extractTo($destination1,$entry);        
    }elseif(in_array($entry,['style.css','config.json']) ){
        $zip->extractTo($destination,$entry);
    }
 }


 $zip->close();
 unlink($zipPath);
 return $nameTheme;
 }else{
    return 'false';
 }

    
}

function create_identifier($id, $table, $keyword){
    $keyword=trim($keyword);
    $map = [
        'admin' => DataAdmin::class,
        'detail_fasilitas' => DataDetailFasilitas::class,
        'fasilitas' => DataFasilitas::class,
        'kontrakan' => DataKontrakan::class,
        'wilayah' => DataWilayah::class,
        'pemilik' => DataPemilik::class,
        'peraturan' => DataPeraturan::class,
        'kelebihan' => DataKelebihan::class,
    ];

    foreach($map as $key => $model){
        if(strpos($table,$key)!==false){
            $data = $model::findOrFail($id);
            return $data->$keyword ?? null;
        }
    }

    return null; // kalau tidak cocok
}

function rupiah($value){
    $format_number=number_format($value);
    return "Rp ".$format_number;
}

function countdown($tgl,$shortyears=false){
    if(!($tgl instanceof DateTime)){
        try{
            $time=new Datetime($tgl);
        }catch(Exception $e){
            return '';
        }
    }else{
        $time=clone $tgl;
    }
    $now=new DateTime('now',$time->getTimezone());
    $diff=$now->diff($time );
    $years=(int) $diff->y;
    $month=(int) $diff->m;
    $day=(int) $diff->d;
    $jam=(int) $diff->h;
    $menit=(int) $diff->i;
    $detik=(int) $diff->s;
    if($years>0){
        if($shortyears && $years>=2){
            return 'Beberapa tahun yang lalu';
        }

        return $years." Tahun yang lalu";
    }

    if($month>0){
        return $month.($month==1?' Bulan yang lalu':'Bulan yang lalu');
    }

    if($day>0){
                // untuk hari: 1 hari lalu -> "kemarin"
        if ($day === 1) return 'kemarin';
        if ($day < 7) return $day . ' hari yang lalu';
        if ($day < 14) return '1 minggu yang lalu';
        if ($day < 30) return floor($day / 7) . ' minggu yang lalu';
        // fallback ke bulan jika >30 hari (tetap jarang terjadi karena months menang di atas)
        return $day . ' hari yang lalu';
    }
    if ($jam > 0) {
        return $jam . ($jam === 1 ? ' jam yang lalu' : ' jam yang lalu');
    }
    if ($menit > 0) {
        return $menit . ($menit === 1 ? ' menit yang lalu' : ' menit yang lalu');
    }
    // detik kecil -> "baru saja"
    if ($detik <= 5) {
        return 'baru saja';
    }
    return $detik . ' detik yang lalu';
}

