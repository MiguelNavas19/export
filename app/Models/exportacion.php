<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exportacion extends Model
{

    protected $table = 'exportacion';
    protected $fillable = [
        'expediente', 'consignatario', 'bl','tipo','contenedor','eta','obs','motonave','cliente','linea','envio','estatus'
    ];

    public function tipoenvio(){
        return $this->hasOne(Tipo::class,'id','envio');
    }

    public function tipoestatus(){
        return $this->hasOne(Estatus::class,'id','estatus');
    }
}
