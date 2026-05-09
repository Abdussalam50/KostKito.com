<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFasilitas extends Model
{
    use HasFactory;
    protected $table="data_fasilitas";
    protected $primaryKey="id_fasilitas";
    public $incrementing=false;
    protected $keyType='string';
    public $fillable=['id_fasilitas','id_detail_fasilitas','created_at','updated_at'];
}
