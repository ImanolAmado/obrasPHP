<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Obra extends Model
{
    use HasFactory;

    function user(){
        return $this->hasOne('User::class');
    }

    // Asignación masiva
    protected $fillable = ['titulo', 'descripcion', 'imagen', 'estado', 'categoria', 'user_id'];
}
