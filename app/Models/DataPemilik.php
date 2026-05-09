<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DataPemilik extends Authenticatable
{
    use HasFactory;
    protected $table="data_pemilik";
    protected $primaryKey="id_pemilik";
    public $incrementing=false;
    protected $keyType='string';
    public $fillable=['id_pemilik','nama','alamat','jenis_kelamin','agama','no_wa','username','password','status','created_at','updated_at'];
}
