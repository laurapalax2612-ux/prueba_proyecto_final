<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Tickets</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Mis Tickets</h1>
    <a href="<?= base_url('inicio') ?>" class="btn btn-secondary">Volver</a>
  </div>
  <div class="card shadow-sm">
    <div class="card-body">
      <?php if (!empty($tickets)): ?>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Asunto</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Agente</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tickets as $t): ?>
                <tr>
                  <td><?= esc($t['id_ticket']) ?></td>
                  <td><?= esc($t['asunto']) ?></td>
                  <td><?= esc($t['descripcion']) ?></td>
                  <td><?= esc($t['estado']) ?></td>
                  <td><?= esc($t['nombre_agente']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-muted mb-0">No tienes tickets registrados.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>
