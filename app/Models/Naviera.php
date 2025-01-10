<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Naviera extends Model
{
    use HasFactory;

    protected $table = 'navieras';

    protected $fillable = ['nombre', 'status'];

    public function datosnaviera()
    {
        return $this->hasMany(DatosNaviera::class, 'id_naviera');
    }
}
