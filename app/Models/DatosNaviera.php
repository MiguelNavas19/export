<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DatosNaviera extends Model
{
    use HasFactory;

    protected $table = 'datosnaviera';
    protected $fillable = ['id_naviera', 'email', 'estatus'];

    public function naviera()
    {
        return $this->belongsTo(Naviera::class, 'id_naviera');
    }
}
