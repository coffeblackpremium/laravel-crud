@extends('layout.main')

@section('content')
  @auth
    <nav class="bg-blue-600 flex flex-wrap items-center justify-between py-4 lg:min-w-screen-">
      <div class="">

      </div>
      <div class="flex-grow text-right mx-3 mr-12">
        <a href="#" class="px-4 font-bold text-slate-200 hover:text-slate-400">Home</a>
        <a href="#" class="px-4 font-bold text-slate-200 hover:text-slate-400">Tabelas</a>
      </div>
    </nav>

    <form action="/funcionarios" method="get">
      <div class="flex items-center justify-center mt-32">
        <div class="flex border-2 border-gray-200 rounded">
          <input type="text" id="search" name="search" class="px-4 py-2 w-80" placeholder="Procura...">
          <button type="submit" class="text-white w-16 bg-gray-600 border-l">Ok</button>
        </div>
      </div>
    </form>
    @if($search)
        <h2 class="text-center font-semibold mt-6">Você buscou por: {{$search}} ..</h2>
    @endif
    <div class="flex justify-start pl-14 items-center md:w-1/4 md: lg:w-1/3 float-right">
      <a href="/funcionarios/criar">
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-1 shadow-lg">
          Adicionar Usuario
        </button>
      </a>
    </div>

    <div class="flex justify-between items-center container mx-auto mt-12 lg:min-h-0 sm:min-h-full rounded-xl">
      <div class="mx-auto  bg-white shadow-xl rounded-xl px-16">
        <table>
            <thead>
              <tr class="min-h-full">
                <th class="px-8">
                  Nome do Funcionario
                </th>
                <th class="px-8">
                  CPF
                </th>
                <th class="px-8">
                  Numero Celular
                </th>
                <th class="px-8">
                  Cargo
                </th>
                <th class="px-8">
                  Data de Nascimento
                </th>
              </tr>
          </thead>

          <tbody class="text-center py-4">
            @foreach ($funcionario as $funcionarios)
            <tr class="w-full">
              <td class="py-4 text-sm">
                {{$funcionarios->nome}}
              </td>
              <td class="py-4 text-sm">
                {{$funcionarios->cpf}}
              </td>
              <td class="py-4 text-sm">
                {{$funcionarios->numeroCelular}}
              </td>
              <td class="py-4 text-sm">
                {{$funcionarios->setor}}
              </td>
              <td class="py-4 text-sm">
                {{$funcionarios->dataNascimento}}
              </td>
              <td class="px-8">
                <a href="/funcionarios/edit/{{$funcionarios->id}}">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1 rounded-lg shadow-lg mb-2">
                    Editar
                  </button>
                </a>
              </td>
              <td class="">
                <form action="/funcionarios/{{$funcionarios->id}}" method="POST" >
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-1 rounded-lg shadow-lg mb-2 ">
                    Excluir
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
            @endforeach
        </table>
        {{$paginate->links()}}
      </div>
    </div>
    
  @endauth

  @guest
    <nav class="bg-blue-600 flex items-center justify-between shrink-0 py-6 shadow-lg lg:min-h-full">
      <div class="flex-grow ">
        <a href="{{route ('auth.login')}}" class="px-4 font-bold text-slate-200 hover:text-slate-400 float-right">Login</a>
        <a href="{{route ('auth.register')}}" class="px-4 font-bold text-slate-200 hover:text-slate-400 float-right">Registrar</a>
      </div>
    </nav>


    <div class="flex items-center justify-center shrink-0 lg:min-h-full">
      <h1 class="text-black font-bold font-sans text-lg mt-64">Você não está autenticado para acessar está página!</h1>
    </div>
  @endguest
@endsection