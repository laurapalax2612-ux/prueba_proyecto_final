<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Respuestas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-3">Respuestas</h1>

        <!-- Botón modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRespuesta">
            Agregar Respuesta
        </button>

        <!-- Modal agregar -->
        <div class="modal fade" id="modalRespuesta" tabindex="-1" aria-labelledby="modalRespuestaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalRespuestaLabel">Nueva Respuesta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('agregar_respuesta'); ?>" method="post">
                            <label for="txt_id_ticket" class="form-label">Ticket</label>
                            <select name="txt_id_ticket" id="txt_id_ticket" class="form-select" required>
                                <option value="">Seleccione un ticket</option>
                                <?php foreach ($tickets as $t): ?>
                                <option value="<?= $t['id_ticket']; ?>">
                                    <?= esc($t['asunto']); ?> (Cliente: <?= esc($t['nombre_cliente']); ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="txt_id_agente" class="form-label mt-2">Agente</label>
                            <select name="txt_id_agente" id="txt_id_agente" class="form-select" required>
                                <option value="">Seleccione un agente</option>
                                <?php foreach ($agentes as $a): ?>
                                <option value="<?= $a['id_agente']; ?>">
                                    <?= esc($a['nombre']); ?> (<?= esc($a['correo_electronico']); ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="txt_mensaje" class="form-label mt-2">Mensaje</label>
                            <textarea name="txt_mensaje" id="txt_mensaje" class="form-control" rows="3"
                                required></textarea>

                            <button type="submit" class="btn btn-primary mt-3 w-100">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de respuestas -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ticket</th>
                        <th>Agente</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($respuestas)): ?>
                    <?php foreach ($respuestas as $r): ?>
                    <tr>
                        <td><?= $r['id_respuesta']; ?></td>
                        <td><?= esc($r['asunto_ticket']); ?></td>
                        <td><?= esc($r['nombre_agente']); ?></td>
                        <td><?= esc($r['mensaje']); ?></td>
                        <td><?= esc($r['fecha_respuesta']); ?></td>
                        <td>
                            <a href="<?= base_url('buscar_respuesta/'.$r['id_respuesta']); ?>"
                                class="btn btn-info btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="<?= base_url('eliminar_respuesta/'.$r['id_respuesta']); ?>"
                                class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta respuesta?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay respuestas registradas.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>