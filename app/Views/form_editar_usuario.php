<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-center">Editar Usuario</h2>
            <form action="<?= base_url('modificar_usuario'); ?>" method="post">

                <label class="form-label">ID Usuario</label>
                <input type="number" name="txt_id_usuario" class="form-control" 
                       value="<?= esc($usuario['id_usuario']); ?>" readonly>

                <label class="form-label mt-2">Nombre</label>
                <input type="text" name="txt_nombre" class="form-control" 
                       value="<?= esc($usuario['nombre']); ?>" required>

                <label class="form-label mt-2">Correo Electrónico</label>
                <input type="email" name="txt_correo" class="form-control" 
                       value="<?= esc($usuario['correo_electronico']); ?>" required>

                <label class="form-label mt-2">Nueva Contraseña (opcional)</label>
                <input type="password" name="txt_contraseña" class="form-control" 
                       placeholder="Dejar en blanco para mantener la actual">

                <label class="form-label mt-2">Rol</label>
                <select name="txt_rol" class="form-select" required>
                    <option value="administrador" <?= $usuario['rol']=='administrador'?'selected':''; ?>>Administrador</option>
                    <option value="agente" <?= $usuario['rol']=='agente'?'selected':''; ?>>Agente</option>
                    <option value="cliente" <?= $usuario['rol']=='cliente'?'selected':''; ?>>Cliente</option>
                </select>

                <button type="submit" class="btn btn-primary mt-3 w-100">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
