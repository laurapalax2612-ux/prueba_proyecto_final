<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-3">Agentes</h1>

        <!-- Botón modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgente">
            Agregar Agente
        </button>

        <!-- Modal agregar -->
        <div class="modal fade" id="modalAgente" tabindex="-1" aria-labelledby="modalAgenteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAgenteLabel">Nuevo Agente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('agregar_agente'); ?>" method="post">
                            <label for="txt_id_usuario" class="form-label">Usuario</label>
                            <select name="txt_id_usuario" id="txt_id_usuario" class="form-select" required>
                                <option value="">Seleccione un usuario</option>
                                <?php foreach ($usuarios as $u): ?>
                                <option value="<?= $u['id_usuario']; ?>">
                                    <?= esc($u['nombre']); ?> (<?= esc($u['correo_electronico']); ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="txt_especialidad" class="form-label mt-2">Especialidad</label>
                            <input type="text" name="txt_especialidad" id="txt_especialidad" class="form-control"
                                required>

                            <label for="txt_experiencia" class="form-label mt-2">Experiencia</label>
                            <textarea name="txt_experiencia" id="txt_experiencia" class="form-control"
                                rows="3"></textarea>

                            <button type="submit" class="btn btn-primary mt-3 w-100">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID Agente</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Especialidad</th>
                        <th>Experiencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($agentes)): ?>
                    <?php foreach ($agentes as $a): ?>
                    <tr>
                        <td><?= $a['id_agente']; ?></td>
                        <td><?= esc($a['nombre']); ?></td>
                        <td><?= esc($a['correo_electronico']); ?></td>
                        <td><?= esc($a['especialidad']); ?></td>
                        <td><?= esc($a['experiencia']); ?></td>
                        <td>
                            <a href="<?= base_url('buscar_agente/'.$a['id_agente']); ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="<?= base_url('eliminar_agente/'.$a['id_agente']); ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar este agente?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay agentes registrados.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>