<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataAdmin extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table='data_admin';
    protected $primaryKey='id_admin';
    public $incrementing=false;
    protected $keyType='string';
  
    public $fillable=['id_admin','nama','username','password','created_at','updated_at']; 
}
