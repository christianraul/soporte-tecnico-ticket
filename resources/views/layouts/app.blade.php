<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Soporte</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root { --azul-inst: #0000a5; }
        .bg-institucional { background-color: var(--azul-inst) !important; }
        .text-institucional { color: var(--azul-inst) !important; }
        .btn-primary { background-color: var(--azul-inst); border-color: var(--azul-inst); }
        .btn-primary:hover { background-color: #000080; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-institucional mb-4 shadow">
        <div class="container">
            <a class="navbar-brand" href="{{route ('tickets.index')}}">Soporte Técnico</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>