<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puertos extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'estatus'];
}
