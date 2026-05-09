<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDetailFasilitas extends Model
{
    use HasFactory;
    public $table="data_detail_fasilitas";
    public $incrementing=false;
    protected $primaryKey='id_detail_fasilitas';
    protected $keyType='string';
    protected $fillable=['id_detail_fasilitas','fasilitas','status','created_at','updated_at'];
}
