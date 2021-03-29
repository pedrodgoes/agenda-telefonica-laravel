<nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full"
style="background-color: rgb(77, 181, 189); color: white; border-radius: 2px;">
    <div class="mb-2 sm:mb-0 inner">
        <a href="{{ route('dashboard') }}" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold"
        style="background-color: rgb(57, 106, 211); color: white; border-radius: 2px; padding: 3px;">
        Agenda de Contatos</a><br>
        <span class="text-md text-grey-dark font-bold">
        Pedro Góes</span>

    </div>

    <div class="self-right">
        <a href="{{ route('contato') }}" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1"
        style="background-color: rgb(34, 110, 182);color: rgb(255, 255, 255); border-radius: 2px;padding: 2px;">CRUD - Tipos de Contatos</a>
       <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1" 
                                    style="background-color: brown; color: white; border-radius: 2px;">
                    {{ __('SAIR') }}
                </a>
            </form>

    </div>

</nav>
