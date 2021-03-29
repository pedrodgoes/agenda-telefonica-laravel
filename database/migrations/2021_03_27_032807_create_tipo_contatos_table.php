<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Função que cria a tabela tipo_contatos e seus respectivos campos no banco de dados
    public function up()
    {
        Schema::create('tipo_contatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_contatos');
    }
}
