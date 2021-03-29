<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden rounded-3xl shadow-xl transform transition-all sm:align-middle sm:max-w-lg "
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-gray-100 flex flex-col justify-center">
                    <div class="relative sm:max-w-xl sm:mx-auto">
                        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                            <div class="max-w-md mx-auto">
                                <div class="flex items-center space-x-5">
                                    <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                                        <h2 class="leading-relaxed">Tipo de Contato</h2>
                                        <p class="text-sm text-gray-500 font-normal leading-relaxed">Campos com (*) são
                                            obrigatórios</p>
                                    </div>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    <div
                                        class="py-4 text-base leading-6 space-y-1 text-gray-700 sm:text-lg sm:leading-7">
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Nome*</label>
                                            <input type="text"
                                                   class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                                   id="nome" wire:model="nome">
                                            @error('nome') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="pt-4 flex items-center space-x-4">
                                        <button
                                            wire:click.prevent="delete({{$tipo_contato_id}})"
                                            type="button"
                                                class="bg-red-500 flex justify-center items-center w-full text-white px-1 py-2 rounded-md focus:outline-none">
                                            Deletar
                                        </button>
                                        <button
                                            wire:click="closeModal()" type="button"
                                                class="flex justify-center items-center w-full text-gray-900 px-1 py-2 rounded-md focus:outline-none"
                                                style="background-color: rgb(221, 220, 215)">
                                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancelar
                                        </button>
                                        <button
                                            wire:click.prevent="store()"
                                            type="button"
                                                class="bg-blue-500 flex justify-center items-center w-full text-white px-1 py-2 rounded-md focus:outline-none">
                                            Cadastrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
