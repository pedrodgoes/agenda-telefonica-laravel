<?php

namespace App\Http\Livewire;

use App\Models\Pessoa;
use App\Models\TipoContato;
use Livewire\Component;
use Livewire\WithPagination;

class Contato extends Component
{
    use WithPagination;

    public $nome, $contatos, $tipo_contato_id;
    public $isOpen = 0;
    public $search;

    // Função responsável pela renderização da pagina com os critérios
    // de listagem em ordem alfabética e
    // com no máximo 10 pessoas podendo ser listadas por página
    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.contato', [
            'tipo_contato_paginate' => TipoContato::where(
                'nome',
                'like',
                $search
            )
                ->orderBy('nome', 'ASC')
                ->paginate(10),
        ]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por chamar a função "abrir modal"
    //e limpar campos para o cadastro
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por limpar todos os campos da modal
    private function resetInputFields()
    {
        $this->nome = '';
        $this->endereco = '';
        $this->data_nasc = '';
        $this->pessoa_id = '';
        $this->contatos = [['nome' => '', 'valor' => '']];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por abrir modal
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por fechar o modal
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por validar e salvar o formulario
    public function store()
    {
        $this->validate([
            'nome' => 'required',
        ]);

        $contato_tipo = TipoContato::updateOrCreate(
            ['id' => $this->tipo_contato_id],
            [
                'nome' => $this->nome,
            ]
        );
        session()->flash(
            'message',
            $this->tipo_contato_id
                ? 'Tipo de Contato atualizado com sucesso.'
                : 'Tipo de Contato cadastrado com sucesso.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por rendereizar o modal
    //com os valores vindo do banco de dados
    public function edit($id)
    {
        $contatos = TipoContato::findOrFail($id);
        $this->tipo_contato_id = $id;
        $this->nome = $contatos->nome;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por deletar os dados
    // usando o softDelete
    public function delete($id)
    {
        TipoContato::find($id)->delete();
        session()->flash('message', 'Pessoa deletada com sucesso.');
        $this->closeModal();
        $this->resetInputFields();
    }
}
