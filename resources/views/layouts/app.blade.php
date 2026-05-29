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
        :root {
            --azul-inst: #0000a5;
            --white-inst: #ffffff;
        }

        @import url('https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap');
        .bg-institucional {
            background-color: var(--azul-inst) !important;
        }

        .text-institucional {
            color: var(--azul-inst) !important;
        }

        .text-institucional-menu {
            color: var(--white-inst) !important;
            font-family: initial;
            font-family: "Google Sans", sans-serif;
            font-size: 17px;
            font-weight: 400;
            font-style: normal;
        }

        .text-institucional-menu:hover {
            border-bottom: 2px solid #ddec07f1;
        }

        .btn-primary {
            background-color: var(--azul-inst);
            border-color: var(--azul-inst);
        }

        .btn-primary:hover {
            background-color: #000080;
        }

        .text-menu {}
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-institucional mb-4 shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tickets.index') }}">Soporte Técnico</a>
            <div>
                <a class="navbar-brand text-institucional-menu" href="{{ route('tickets.index') }}">Soporte</a>
                <a class="navbar-brand text-institucional-menu" href="{{ route('tickets.index') }}">Tienda</a>
            </div>
        </div>

    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
