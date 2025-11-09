<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Atención al Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center" style="height:100vh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-3">Iniciar Sesión</h3>

                        <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session('error') ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= base_url('autenticar') ?>">
                            <label class="form-label">Correo</label>
                            <input type="email" name="correo" class="form-control" required>

                            <label class="form-label mt-2">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>