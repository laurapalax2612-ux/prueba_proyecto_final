<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-3">Clientes</h1>


    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCliente">
        Agregar Cliente
    </button>

    <!-- Modal agregar -->
    <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalClienteLabel">Nuevo Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('agregar_cliente'); ?>" method="post">
                        <label for="txt_id_usuario" class="form-label">Usuario</label>
                        <select name="txt_id_usuario" id="txt_id_usuario" class="form-select" required>
                            <option value="">Seleccione un usuario</option>
                            <?php foreach ($usuarios as $u): ?>
                                <option value="<?= $u['id_usuario']; ?>">
                                    <?= esc($u['nombre']); ?> (<?= esc($u['correo_electronico']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="txt_contacto" class="form-label mt-2">Contacto</label>
                        <input type="text" name="txt_contacto" id="txt_contacto" class="form-control" required>

                        <label for="txt_historial" class="form-label mt-2">Historial</label>
                        <textarea name="txt_historial" id="txt_historial" class="form-control" rows="3"></textarea>

                        <button type="submit" class="btn btn-primary mt-3 w-100">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de clientes -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID Cliente</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Contacto</th>
                    <th>Historial</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><?= $c['id_cliente']; ?></td>
                        <td><?= esc($c['nombre']); ?></td>
                        <td><?= esc($c['correo_electronico']); ?></td>
                        <td><?= esc($c['contacto']); ?></td>
                        <td><?= esc($c['historial']); ?></td>
                        <td>
                            <a href="<?= base_url('buscar_cliente/'.$c['id_cliente']); ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="<?= base_url('eliminar_cliente/'.$c['id_cliente']); ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar este cliente?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center text-muted">No hay clientes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
