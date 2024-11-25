<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncias';

    protected $fillable = [
        'idPostagem',
        'idUsuario',
        'categoria',
    ];

    public $incrementing = true; // A chave primária é do tipo integer (auto-increment)
    protected $keyType = 'int';
}
