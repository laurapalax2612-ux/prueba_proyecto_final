<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Agente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4 text-center">Editar Agente</h2>
                <form action="<?= base_url('modificar_agente'); ?>" method="post">

                    <label class="form-label">ID Agente</label>
                    <input type="number" name="txt_id_agente" class="form-control"
                        value="<?= esc($agente['id_agente']); ?>" readonly>

                    <label class="form-label mt-2">Usuario</label>
                    <select name="txt_id_usuario" class="form-select">
                        <?php foreach ($usuarios as $u): ?>
                        <option value="<?= $u['id_usuario']; ?>"
                            <?= $u['id_usuario'] == $agente['id_usuario'] ? 'selected' : ''; ?>>
                            <?= esc($u['nombre']); ?> (<?= esc($u['correo_electronico']); ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label mt-2">Especialidad</label>
                    <input type="text" name="txt_especialidad" class="form-control"
                        value="<?= esc($agente['especialidad']); ?>">

                    <label class="form-label mt-2">Experiencia</label>
                    <textarea name="txt_experiencia" class="form-control"
                        rows="3"><?= esc($agente['experiencia']); ?></textarea>

                    <button type="submit" class="btn btn-primary mt-3 w-100">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>