
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-center p-4 px-3 py-10">
        <div style="width: 50%">
            <div class="bg-white shadow-md rounded-lg px-3 py-2 mb-4">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                         role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="block text-gray-700 text-lg font-semibold py-2 px-2 mb-2">
                    Listagem
                    <button wire:click="create()"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded float-right mb-3">
                        Novo Cadastro
                    </button>
                    @if($isOpen)
                        @include('livewire.create')
                    @endif
                </div>
                <div class="flex items-center bg-gray-200 rounded-md mt-4">
                    <div class="pl-2">
                        <svg class="fill-current text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24">
                            <path class="heroicon-ui"
                                  d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
                        </svg>
                    </div>
                    <input
                        class="w-full rounded-md bg-gray-200 text-gray-700 leading-tight focus:outline-none py-2 px-2 ml-1"
                        id="search" type="text"  wire:model="search" placeholder="Search teams or members">
                </div>
                <div class="py-3 text-sm">
                    @foreach($pessoas_paginate as $pessoa)
                        <div wire:click="edit({{ $pessoa->id }})"
                             class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                            <span class="bg-gray-400 h-2 w-2 m-2 rounded-full"></span>
                            <div class="flex-grow px-2 font-bold">{{ $pessoa->nome }}</div>
                            <div class="space-y-4 ...">
                                @foreach($pessoa->contatos as $contato)
                                    <div class="text-sm font-normal text-gray-500 tracking-wide">{{$contato->valor}}
                                        - {{$contato->tipo->nome}}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                    {{$pessoas_paginate->links()}}
                <div class="block bg-gray-200 text-sm text-right py-2 px-3 -mx-3 -mb-2 rounded-b-lg">
                </div>
            </div>
        </div>
    </div>
</div>

