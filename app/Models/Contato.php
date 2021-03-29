<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['valor', 'pessoa_id', 'tipo_contatos_id'];

    //Função que atribui um ou mais tipos de contatos para uma pessoa.
    public function tipo()
    {
        return $this->belongsTo(TipoContato::class, 'tipo_contatos_id', 'id');
    }
}
