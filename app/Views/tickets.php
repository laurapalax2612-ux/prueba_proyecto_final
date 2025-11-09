<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-3">Tickets</h1>

        <!-- Botón modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTicket">
            Nuevo Ticket
        </button>

        <!-- Modal agregar -->
        <div class="modal fade" id="modalTicket" tabindex="-1" aria-labelledby="modalTicketLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTicketLabel">Nuevo Ticket</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('agregar_ticket'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Cliente</label>
                                    <select name="txt_id_cliente" class="form-select" required>
                                        <option value="">Seleccione un cliente</option>
                                        <?php foreach ($clientes as $c): ?>
                                        <option value="<?= $c['id_cliente']; ?>">
                                            <?= esc($c['nombre']); ?> (<?= esc($c['correo_electronico']); ?>)
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Agente</label>
                                    <select name="txt_id_agente" class="form-select" required>
                                        <option value="">Seleccione un agente</option>
                                        <?php foreach ($agentes as $a): ?>
                                        <option value="<?= $a['id_agente']; ?>">
                                            <?= esc($a['nombre']); ?> (<?= esc($a['correo_electronico']); ?>)
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <label class="form-label mt-2">Asunto</label>
                            <input type="text" name="txt_asunto" class="form-control" required>

                            <label class="form-label mt-2">Descripción</label>
                            <textarea name="txt_descripcion" class="form-control" rows="3"></textarea>

                            <label class="form-label mt-2">Estado</label>
                            <select name="txt_estado" class="form-select" required>
                                <option value="Abierto">Abierto</option>
                                <option value="En Progreso">En Progreso</option>
                                <option value="Cerrado">Cerrado</option>
                            </select>

                            <button type="submit" class="btn btn-primary mt-3 w-100">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla tickets -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Agente</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tickets)): ?>
                    <?php foreach ($tickets as $t): ?>
                    <tr>
                        <td><?= $t['id_ticket']; ?></td>
                        <td><?= esc($t['nombre_cliente']); ?></td>
                        <td><?= esc($t['nombre_agente']); ?></td>
                        <td><?= esc($t['asunto']); ?></td>
                        <td><?= esc($t['estado']); ?></td>
                        <td><?= esc($t['fecha_creacion']); ?></td>
                        <td>
                            <a href="<?= base_url('buscar_ticket/'.$t['id_ticket']); ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="<?= base_url('eliminar_ticket/'.$t['id_ticket']); ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar este ticket?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay tickets registrados.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>