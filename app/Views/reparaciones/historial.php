<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial - Taller PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('panel'); ?>">Panel de Control</a>
            <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Historial de Reparaciones Finalizadas</h2>
            <a href="<?= base_url('panel'); ?>" class="btn btn-outline-primary">Volver al Panel de control</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Equipo</th>
                                <th>Fecha Ingreso</th>
                                <th>Fecha Salida</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reparaciones)): ?>
                                <?php foreach ($reparaciones as $rep): ?>
                                    <tr>
                                        <td><?= $rep['id']; ?></td>
                                        <td><strong><?= esc($rep['cliente_nombre']); ?></strong></td>
                                        <td><?= esc($rep['equipo']); ?></td>
                                        <td><?= $rep['fecha_ingreso']; ?></td>
                                        <td><?= $rep['fecha_salida']; ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('reparaciones/detalles/' . $rep['id']); ?>" class="btn btn-info btn-sm text-white">Ver Detalles</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No hay registros en el historial todavía.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>