@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Editar Pessoa</h2>
    </div>

    <form action="{{ route('people.update', $people->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Nome Completo 
            </label>
            <input
                type="text"
                id="nome"
                name="nome"
                value="{{ old('nome', $people->nome) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('nome') border-red-500 @enderror"
                required
            />
            @error('nome')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email 
            </label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $people->email) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('email') border-red-500 @enderror"
                required
            />
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700">
                CPF 
            </label>
            <input
                type="text"
                id="cpf"
                name="cpf"
                oninput="maskCPF(this)"
                value="{{ old('cpf', $people->cpf_formatted) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('cpf') border-red-500 @enderror"
                required
            />
            @error('cpf')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">
                Telefone
            </label>
            <input
                type="text"
                id="telefone"
                name="telefone"
                oninput="maskPhone(this)"
                value="{{ old('telefone', $people->phone_formatted) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('telefone') border-red-500 @enderror"
            />
            @error('telefone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="birth_date" class="block text-sm font-medium text-gray-700">
                Data de Nascimento 
            </label>
            <input
                type="date"
                id="data_nascimento"
                name="data_nascimento"
                value="{{ old('data_nascimento', $people->data_nascimento) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('data_nascimento') border-red-500 @enderror"
                required
            />
            @error('data_nascimento')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('people.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                Cancelar
            </a>
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"
            >
                Atualizar
            </button>
        </div>
    </form>
</div>
@endsection