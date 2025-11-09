<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">Editar Ticket</h2>
                <form action="<?= base_url('modificar_ticket'); ?>" method="post">

                    <input type="hidden" name="txt_id_ticket" value="<?= esc($ticket['id_ticket']); ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Cliente</label>
                            <select name="txt_id_cliente" class="form-select">
                                <?php foreach ($clientes as $c): ?>
                                <option value="<?= $c['id_cliente']; ?>"
                                    <?= $c['id_cliente'] == $ticket['id_cliente'] ? 'selected' : ''; ?>>
                                    <?= esc($c['nombre']); ?> (<?= esc($c['correo_electronico']); ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agente</label>
                            <select name="txt_id_agente" class="form-select">
                                <?php foreach ($agentes as $a): ?>
                                <option value="<?= $a['id_agente']; ?>"
                                    <?= $a['id_agente'] == $ticket['id_agente'] ? 'selected' : ''; ?>>
                                    <?= esc($a['nombre']); ?> (<?= esc($a['correo_electronico']); ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <label class="form-label mt-2">Asunto</label>
                    <input type="text" name="txt_asunto" class="form-control" value="<?= esc($ticket['asunto']); ?>">

                    <label class="form-label mt-2">Descripción</label>
                    <textarea name="txt_descripcion" class="form-control"
                        rows="3"><?= esc($ticket['descripcion']); ?></textarea>

                    <label class="form-label mt-2">Estado</label>
                    <select name="txt_estado" class="form-select">
                        <option value="Abierto" <?= $ticket['estado']=='Abierto'?'selected':''; ?>>Abierto</option>
                        <option value="En Progreso" <?= $ticket['estado']=='En Progreso'?'selected':''; ?>>En Progreso
                        </option>
                        <option value="Cerrado" <?= $ticket['estado']=='Cerrado'?'selected':''; ?>>Cerrado</option>
                    </select>

                    <button type="submit" class="btn btn-primary mt-3 w-100">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>