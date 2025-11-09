<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">Atención al Cliente</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    <?= esc(session('nombre')) ?> · <span
                        class="badge bg-info text-dark"><?= esc(session('rol')) ?></span>
                </span>
                <a href="<?= base_url('salir') ?>" class="btn btn-danger">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h1 class="mb-4">Bienvenido, <?= esc(session('nombre')) ?></h1>

        <?php if (in_array(session('rol'), ['administrador','agente'])): ?>
        <div class="row g-3">

            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?= base_url('usuarios') ?>" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Usuarios</h5>
                            <p class="card-text text-muted mb-0">Administrar cuentas y roles.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?= base_url('agentes') ?>" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Agentes</h5>
                            <p class="card-text text-muted mb-0">Información de agentes.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?= base_url('clientes') ?>" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Clientes</h5>
                            <p class="card-text text-muted mb-0">CRUD de clientes.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?= base_url('tickets') ?>" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Tickets</h5>
                            <p class="card-text text-muted mb-0">Gestión de tickets.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?= base_url('respuestas') ?>" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Respuestas</h5>
                            <p class="card-text text-muted mb-0">Responder a tickets.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?= base_url('historial_estados') ?>" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Historial de estados</h5>
                            <p class="card-text text-muted mb-0">Cambios de estado por ticket.</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <?php else: // cliente ?>
        <div class="alert alert-info">
            Solo puedes ver tus tickets.
        </div>
        <a href="<?= base_url('tickets/mis_tickets/'.session('id_usuario')) ?>" class="btn btn-primary">
            Ver mis tickets
        </a>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>