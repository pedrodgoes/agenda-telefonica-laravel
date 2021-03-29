<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'endereco', 'data_nasc', 'user_id'];

    //Função que define que uma pessoa receba um ou mais tipos de contatos.
    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }
}
