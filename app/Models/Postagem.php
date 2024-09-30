<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Postagem extends Model
{
    //use HasFactory;
    use HasUuids;

    protected $table = 'postagens'; // Definindo o nome correto da tabela

    protected $fillable = ['conteudo', 'dataHora', 'isOfensiva', 'idUsuario'];

    // Relacionamento com o modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }
}
