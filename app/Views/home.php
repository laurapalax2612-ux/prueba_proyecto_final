<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atención al Cliente - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Sistema de Atención al Cliente</h1>
            <p class="text-muted">Gestiona tickets, clientes y respuestas según tu rol.</p>
        </div>

        <?php if(!session('logueado')): ?>
        <div class="text-center">
            <a class="btn btn-primary btn-lg" href="<?= base_url('login') ?>">Iniciar sesión</a>
        </div>
        <?php else: ?>
        <div class="alert alert-success">Hola, <?= esc(session('nombre')) ?> (Rol: <?= esc(session('rol')) ?>)</div>
        <div class="row g-3">
            <div class="col-md-4"><a class="btn btn-outline-primary w-100" href="<?= base_url('inicio') ?>">Ir a
                    Inicio</a></div>
            <?php if(in_array(session('rol'), ['administrador','agente'])): ?>
            <div class="col-md-4"><a class="btn btn-outline-secondary w-100"
                    href="<?= base_url('clientes') ?>">Clientes</a></div>
            <div class="col-md-4"><a class="btn btn-outline-secondary w-100"
                    href="<?= base_url('tickets') ?>">Tickets</a></div>
            <?php else: ?>
            <div class="col-md-4"><a class="btn btn-outline-secondary w-100"
                    href="<?= base_url('tickets/mis_tickets/'.session('id_usuario')) ?>">Mis Tickets</a></div>
            <?php endif; ?>
            <div class="col-md-4"><a class="btn btn-outline-danger w-100" href="<?= base_url('salir') ?>">Cerrar
                    sesión</a></div>
        </div>
        <?php endif; ?>
    </div>
</body>

</html>