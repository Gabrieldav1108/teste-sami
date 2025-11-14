@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Cadastrar Nova Pessoa</h2>
        <a href="{{ route('peoples.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
            Voltar
        </a>
    </div>

    <form action="{{ route('peoples.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome *</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('nome') border-red-500 @enderror" required>
            @error('nome') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('email') border-red-500 @enderror" required>
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF *</label>
            <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('cpf') border-red-500 @enderror" required>
            @error('cpf') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone *</label>
            <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('telefone') border-red-500 @enderror">
            @error('telefone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento *</label>
            <input type="date" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('data_nascimento') border-red-500 @enderror" required>
            @error('data_nascimento') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('peoples.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Cancelar</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Salvar</button>
        </div>
    </form>
</div>
@endsection