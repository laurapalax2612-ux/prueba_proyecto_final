<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Historial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-center">Editar Historial de Estado</h2>
            <form action="<?= base_url('modificar_historial'); ?>" method="post">

                <input type="hidden" name="txt_id_historial" value="<?= esc($historial['id_historial']); ?>">

                <label class="form-label">Ticket</label>
                <select name="txt_id_ticket" class="form-select">
                    <?php foreach ($tickets as $t): ?>
                        <option value="<?= $t['id_ticket']; ?>" <?= $t['id_ticket'] == $historial['id_ticket'] ? 'selected' : ''; ?>>
                            <?= esc($t['asunto']); ?> (<?= esc($t['nombre_cliente']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label class="form-label mt-2">Estado Anterior</label>
                <select name="txt_estado_anterior" class="form-select">
                    <option value="Abierto" <?= $historial['estado_anterior']=='Abierto'?'selected':''; ?>>Abierto</option>
                    <option value="En Progreso" <?= $historial['estado_anterior']=='En Progreso'?'selected':''; ?>>En Progreso</option>
                    <option value="Cerrado" <?= $historial['estado_anterior']=='Cerrado'?'selected':''; ?>>Cerrado</option>
                </select>

                <label class="form-label mt-2">Nuevo Estado</label>
                <select name="txt_estado_nuevo" class="form-select">
                    <option value="Abierto" <?= $historial['estado_nuevo']=='Abierto'?'selected':''; ?>>Abierto</option>
                    <option value="En Progreso" <?= $historial['estado_nuevo']=='En Progreso'?'selected':''; ?>>En Progreso</option>
                    <option value="Cerrado" <?= $historial['estado_nuevo']=='Cerrado'?'selected':''; ?>>Cerrado</option>
                </select>

                <label class="form-label mt-2">Observación</label>
                <textarea name="txt_observacion" class="form-control" rows="3"><?= esc($historial['observacion']); ?></textarea>

                <button type="submit" class="btn btn-primary mt-3 w-100">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
