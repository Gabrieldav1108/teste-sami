<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pessoas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">CRUD Pessoas</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('people.index') }}" class="text-gray-600 hover:text-gray-900">Lista</a>
                    <a href="{{ route('people.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded">Nova Pessoa</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

<script>
    // mask of cpf
    function maskCPF(input) {
        let value = input.value.replace(/\D/g, '');

        if (value.length > 11) value = value.slice(0, 11);

        value = value
            .replace(/(\d{3})(\d)/, "$1.$2")
            .replace(/(\d{3})(\d)/, "$1.$2")
            .replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        input.value = value;
    }

    // mask of phone
    function maskPhone(input) {
        let value = input.value.replace(/\D/g, '');

        if (value.length > 11) value = value.slice(0, 11);

        if (value.length > 10) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
        } else {
            value = value.replace(/^(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
        }

        input.value = value;
    }
</script>
</body>
</html>