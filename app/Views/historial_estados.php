<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Estados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-3">Historial de Estados</h1>


        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalHistorial">
            Registrar Cambio de Estado
        </button>


        <div class="modal fade" id="modalHistorial" tabindex="-1" aria-labelledby="modalHistorialLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalHistorialLabel">Nuevo Registro de Estado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('agregar_historial'); ?>" method="post">
                            <label for="txt_id_ticket" class="form-label">Ticket</label>
                            <select name="txt_id_ticket" id="txt_id_ticket" class="form-select" required>
                                <option value="">Seleccione un ticket</option>
                                <?php foreach ($tickets as $t): ?>
                                <option value="<?= $t['id_ticket']; ?>">
                                    <?= esc($t['asunto']); ?> (<?= esc($t['nombre_cliente']); ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="txt_estado_anterior" class="form-label mt-2">Estado Anterior</label>
                            <select name="txt_estado_anterior" id="txt_estado_anterior" class="form-select" required>
                                <option value="Abierto">Abierto</option>
                                <option value="En Progreso">En Progreso</option>
                                <option value="Cerrado">Cerrado</option>
                            </select>

                            <label for="txt_estado_nuevo" class="form-label mt-2">Nuevo Estado</label>
                            <select name="txt_estado_nuevo" id="txt_estado_nuevo" class="form-select" required>
                                <option value="Abierto">Abierto</option>
                                <option value="En Progreso">En Progreso</option>
                                <option value="Cerrado">Cerrado</option>
                            </select>

                            <label for="txt_observacion" class="form-label mt-2">Observación</label>
                            <textarea name="txt_observacion" id="txt_observacion" class="form-control"
                                rows="3"></textarea>

                            <button type="submit" class="btn btn-primary mt-3 w-100">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de historial -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ticket</th>
                        <th>Estado Anterior</th>
                        <th>Estado Nuevo</th>
                        <th>Fecha Cambio</th>
                        <th>Observación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($historiales)): ?>
                    <?php foreach ($historiales as $h): ?>
                    <tr>
                        <td><?= $h['id_historial']; ?></td>
                        <td><?= esc($h['asunto_ticket']); ?></td>
                        <td><?= esc($h['estado_anterior']); ?></td>
                        <td><?= esc($h['estado_nuevo']); ?></td>
                        <td><?= esc($h['fecha_cambio']); ?></td>
                        <td><?= esc($h['observacion']); ?></td>
                        <td>
                            <a href="<?= base_url('buscar_historial/'.$h['id_historial']); ?>"
                                class="btn btn-info btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="<?= base_url('eliminar_historial/'.$h['id_historial']); ?>"
                                class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este registro?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay registros de historial.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>