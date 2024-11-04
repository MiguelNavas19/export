<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exportacion extends Model
{

    protected $table = 'exportacion';
    protected $fillable = [
        'expediente', 'consignatario', 'bl','tipo','contenedor','eta','obs','motonave','cliente','linea','envio','estatus'
    ];
}
