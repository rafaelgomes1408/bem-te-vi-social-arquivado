<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Postagem extends Model
{
    //use HasFactory;
    use HasUuids;

    protected $table = 'postagens'; // Nome da tabela

    // Especifica que a chave primária é 'idPostagem'
    protected $primaryKey = 'idPostagem';

    protected $fillable = ['conteudo', 'dataHora', 'idUsuario'];

    public $incrementing = false; // Porque o UUID não é autoincrementado
    protected $keyType = 'string'; // O tipo do UUID é string

    // Definindo o campo dataHora como uma data
    protected $dates = ['dataHora'];

    // Relacionamento com o modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }
}
