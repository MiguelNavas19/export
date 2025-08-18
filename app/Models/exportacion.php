<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exportacion extends Model
{

    protected $table = 'exportacion';
    protected $fillable = [
        'fecha_veconinter',
        'fecha_entrega',
        'fecha_pago',
        'expediente',
        'renuncia',
        'consignatario',
        'bl',
        'tipo',
        'contenedor',
        'eta',
        'obs',
        'motonave',
        'cliente',
        'linea',
        'envio',
        'estatus',
        'liberacion',
        'id_puerto',
        'send',
        'color',
        'fecha_despacho',
        'fecha_devolucion',
        'fecha_arribo',
        'fecha_registro',
        'fecha_impuesto',
        'fecha_presentacion',
        'fecha_reconocimiento',
        'fecha_validacion',
        'fecha_factura',
        'dias_libres',
        'factura',
        'poder',
        'cantidad_equipos',
        'funcionario',
        'descripcion',
        'peso',
        'dua',
        'autorizado'
    ];

    public function tipoenvio()
    {
        return $this->hasOne(Tipo::class, 'id', 'envio');
    }

    public function tipoestatus()
    {
        return $this->hasOne(Estatus::class, 'id', 'estatus');
    }


    public function tipolinea()
    {
        return $this->hasOne(Naviera::class, 'id', 'linea')->with('datosnaviera');
    }

    public function tipopuerto()
    {
        return $this->hasOne(Puertos::class, 'id', 'id_puerto');
    }

    public function colors()
    {
        return $this->hasOne(Color::class, 'id', 'color');
    }
}
