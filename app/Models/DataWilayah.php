<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWilayah extends Model
{
    use HasFactory;
    protected $table="data_wilayah";
    protected $primaryKey="id_wilayah";
    public $incrementing=false;
    protected $keyType='string';
    public $fillable=['id_wilayah','wilayah','latitude','longitude','created_at','updated_at'];
}
