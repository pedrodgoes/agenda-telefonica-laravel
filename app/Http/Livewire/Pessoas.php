<?php

namespace App\Http\Livewire;

use App\Models\Contato;
use App\Models\Pessoa;
use App\Models\TipoContato;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Pessoas extends Component
{
    use WithPagination;

    public $nome,
        $endereco,
        $data_nasc,
        $pessoas,
        $pessoa_id,
        $contatos,
        $tipo_contato;
    public $isOpen = 0;
    public $search;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // Função responsável por renderizar a pagína principal
    // com a busca por nome do contato
    //com no mínimo de 3 letras como pedido no requisito
    public function render()
    {
        $search = '%%';

        if (strlen($this->search) > 2) {
            $search = '%' . $this->search . '%';
        }

        return view('livewire.pessoas', [
            'pessoas_paginate' => Pessoa::where('nome', 'like', $search)
                ->where('user_id', auth()->user()->id)
                ->orderBy('nome', 'ASC')
                ->paginate(10),
        ]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por pegar os tipos de contatos de cada pessoa
    public function mount()
    {
        $this->tipo_contato = TipoContato::all();
        $this->contatos = [['nome' => '', 'valor' => '']];
    }

    //Função responsável por adicionar um tipo de contato
    public function addContato()
    {
        $this->contatos[] = ['nome' => '', 'valor' => ''];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por chamar as funções responsáveis de cadastrar pessoas
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

    //Função responsável por fechar modal
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //Função responsável por resetar, limpar os campos do formulário de cadastro
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

    //Função responsável por pegar os dados colocados pelo usuário e
    // salvar no banco de dados
    public function store()
    {
        $this->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'data_nasc' => 'required',
        ]);

        Contato::where('pessoa_id', $this->pessoa_id)->delete();

        $pessoa = Pessoa::updateOrCreate(
            ['id' => $this->pessoa_id],
            [
                'nome' => $this->nome,
                'endereco' => $this->endereco,
                'data_nasc' => $this->data_nasc,
                'user_id' => auth()->user()->id,
            ]
        );

        foreach ($this->contatos as $value) {
            Contato::create([
                'tipo_contatos_id' => $value['nome'],
                'valor' => $value['valor'],
                'pessoa_id' => $pessoa->id,
            ]);
        }

        session()->flash(
            'message',
            $this->pessoa_id
                ? 'Usuário atualizado com sucesso.'
                : 'Usuário cadastrado com sucesso.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por editar os dados do contato já cadastrado
    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $this->pessoa_id = $id;
        $this->nome = $pessoa->nome;
        $this->endereco = $pessoa->endereco;
        $this->data_nasc = $pessoa->data_nasc;

        $contato = Contato::where('pessoa_id', $id)->get();
        $allContato = [];

        foreach ($contato as $value) {
            $allContato[] = [
                'nome' => $value->tipo_contatos_id,
                'valor' => $value->valor,
            ];
        }
        $this->contatos = $allContato;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Função responsável por deletar a pessoa já cadastrada
    public function delete($id)
    {
        Pessoa::find($id)->delete();
        session()->flash('message', 'Pessoa deletada com sucesso.');
        $this->closeModal();
        $this->resetInputFields();
    }

    //Função responsável por deletar o tipo de contato, por exemplo e-mail
    public function removeContato($index)
    {
        unset($this->contatos[$index]);
    }
}
