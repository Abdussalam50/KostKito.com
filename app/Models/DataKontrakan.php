<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataAdmin;
use App\Models\DataDetailFasilitas;
use App\Models\DataFasilitas;
use App\Models\DataPemilik;
use App\Models\DataWilayah;
use App\Models\DataTraffic;
use App\Models\Peraturan;
use App\Models\Kelebihan;
class DataKontrakan extends Model
{
    use HasFactory;
    protected $table='data_kontrakan';
    public $incrementing=false;
    protected $primaryKey='id_kontrakan';
    protected $keyType='string';
    protected $fillable=['id_kontrakan',
                         'id_pemilik',
                         'nama_kontrakan',
                         'alamat',
                         'kategori',
                         'jumlah_kamar',
                         'harga_bulanan',
                         'harga_tahunan',
                         'id_fasilitas',
                         'id_wilayah',
                         'id_peraturan',
                         'id_kelebihan',
                         'id_traffic',
                         'foto1',
                         'foto2',
                         'foto3',
                         'foto4',
                         'foto5',
                        'panel_utama'];

    public function relasi_fasilitas()
    {   
        return $this->hasMany(DataFasilitas::class,'id_fasilitas','id_fasilitas');
    }

    public function relasi_pemilik(){
        return $this->belongsTo(DataPemilik::class,'id_pemilik','id_pemilik');
    }
    public function relasi_wilayah(){
        return $this->belongsTo(DataWilayah::class,'id_wilayah','id_wilayah');
    }
    public function relasi_traffic(){
        return $this->hasMany(DataTraffic::class,'id_kontrakan','id_kontrakan');
    }

    public function relasi_peraturan(){
        return $this->hasMany(DataPeraturan::class,'id_peraturan','id_peraturan');
    }
    public function relasi_kelebihan(){
        return $this->belongsTo(DataKelebihan::class,'id_kelebihan','id_kelebihan');
    }
}