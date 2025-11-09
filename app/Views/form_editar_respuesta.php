<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Respuesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4 text-center">Editar Respuesta</h2>
                <form action="<?= base_url('modificar_respuesta'); ?>" method="post">

                    <input type="hidden" name="txt_id_respuesta" value="<?= esc($respuesta['id_respuesta']); ?>">

                    <label class="form-label">Ticket</label>
                    <select name="txt_id_ticket" class="form-select">
                        <?php foreach ($tickets as $t): ?>
                        <option value="<?= $t['id_ticket']; ?>"
                            <?= $t['id_ticket'] == $respuesta['id_ticket'] ? 'selected' : ''; ?>>
                            <?= esc($t['asunto']); ?> (Cliente: <?= esc($t['nombre_cliente']); ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label mt-2">Agente</label>
                    <select name="txt_id_agente" class="form-select">
                        <?php foreach ($agentes as $a): ?>
                        <option value="<?= $a['id_agente']; ?>"
                            <?= $a['id_agente'] == $respuesta['id_agente'] ? 'selected' : ''; ?>>
                            <?= esc($a['nombre']); ?> (<?= esc($a['correo_electronico']); ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label mt-2">Mensaje</label>
                    <textarea name="txt_mensaje" class="form-control"
                        rows="3"><?= esc($respuesta['mensaje']); ?></textarea>

                    <button type="submit" class="btn btn-primary mt-3 w-100">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>