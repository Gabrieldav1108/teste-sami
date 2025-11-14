@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Lista de Pessoas</h2>
        <a href="{{ route('peoples.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
            Nova Pessoa
        </a>
    </div>

    @if($peoples->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Nome</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">CPF</th>
                        <th class="px-4 py-2 text-left">Telefone</th>
                        <th class="px-4 py-2 text-left">Data de Nascimento</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peoples as $people)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $people->nome }}</td>
                        <td class="px-4 py-2">{{ $people->email }}</td>
                        <td class="px-4 py-2">{{ $people->cpf }}</td>
                        <td class="px-4 py-2">{{ $people->telefone }}</td>
                        <td class="px-4 py-2">{{ $people->birth_date_formated }}</td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('peoples.edit', $people->id) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    Editar
                                </a>
                                <form action="{{ route('peoples.destroy', $people->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Tem certeza?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $peoples->links() }}
        </div>
    @else
        <p class="text-gray-500 text-center py-4">Nenhuma pessoa cadastrada.</p>
    @endif
</div>
@endsection