<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-3">Usuarios</h1>

    <!-- Botón para agregar -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalUsuario">
        Agregar Usuario
    </button>

    <!-- Modal agregar -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Nuevo Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('agregar_usuario'); ?>" method="post">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="txt_nombre" class="form-control" required>

                        <label class="form-label mt-2">Correo Electrónico</label>
                        <input type="email" name="txt_correo" class="form-control" required>

                        <label class="form-label mt-2">Contraseña</label>
                        <input type="password" name="txt_contraseña" class="form-control" required>

                        <label class="form-label mt-2">Rol</label>
                        <select name="txt_rol" class="form-select" required>
                            <option value="administrador">Administrador</option>
                            <option value="agente">Agente</option>
                            <option value="cliente">Cliente</option>
                        </select>

                        <button type="submit" class="btn btn-primary mt-3 w-100">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= esc($usuario['id_usuario']); ?></td>
                        <td><?= esc($usuario['nombre']); ?></td>
                        <td><?= esc($usuario['correo_electronico']); ?></td>
                        <td><?= esc($usuario['rol']); ?></td>
                        <td>
                            <a href="<?= base_url('buscar_usuario/'.$usuario['id_usuario']); ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="<?= base_url('eliminar_usuario/'.$usuario['id_usuario']); ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('¿Eliminar este usuario?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center text-muted">No hay usuarios registrados.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
