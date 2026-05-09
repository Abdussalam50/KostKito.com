<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTraffic extends Model
{
    use HasFactory;
    protected $table='data_traffic';
    protected $primaryKey='id_traffic';
    public $incrementing=false;
    protected $keyType='string';
    protected $fillable=['id_traffic','id_kontrakan','jumlah_traffic'];

}
