<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center p-5">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px;">
                            <svg class="text-white" width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </div>

                        <h1 class="card-title h3 mb-3">Sistema de Pessoas</h1>
                        <p class="text-muted mb-4">
                            Sistema para gerenciamento de cadastros de pessoas
                        </p>

                        <a href="{{ route('peoples.index') }}" 
                           class="btn btn-primary btn-lg w-100">
                            Acessar Gerenciador de Pessoas
                        </a>

                        <div class="mt-4 pt-3 border-top">
                            <small class="text-muted">
                                Desenvolvido com Laravel & Tailwind CSS
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>