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
            <label for="name" class="block text-sm font-medium text-gray-700">
                Nome Completo *
            </label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('name') border-red-500 @enderror"
                required
            />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email *
            </label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('email') border-red-500 @enderror"
                required
            />
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700">
                CPF *
            </label>
            <input
                type="text"
                id="cpf"
                name="cpf"
                value="{{ old('cpf') }}"
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
                id="phone"
                name="phone"
                value="{{ old('phone') }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('phone') border-red-500 @enderror"
            />
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="birth_date" class="block text-sm font-medium text-gray-700">
                Data de Nascimento *
            </label>
            <input
                type="date"
                id="birth_date"
                name="birth_date"
                value="{{ old('birth_date') }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('birth_date') border-red-500 @enderror"
                required
            />
            @error('birth_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('peoples.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                Cancelar
            </a>
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"
            >
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection