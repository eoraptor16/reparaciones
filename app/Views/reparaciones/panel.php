<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Taller PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('panel'); ?>">Panel de control</a>
            <div class="d-flex gap-2">
                <a href="<?= base_url('reparaciones/crear'); ?>" class="btn btn-success btn-sm">Nuevo</a>
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Reparaciones en Curso</h2>
            <a href="<?= base_url('reparaciones/historial'); ?>" class="btn btn-outline-secondary">Historial</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Equipo</th>
                                <th>Problema Reportado</th>
                                <th>Fecha de Ingreso</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reparaciones)): ?>
                                <?php foreach ($reparaciones as $rep): ?>
                                    <tr>
                                        <td><?= $rep['id']; ?></td>
                                        <td><strong><?= esc($rep['cliente_nombre']); ?></strong></td>
                                        <td><?= esc($rep['equipo']); ?></td>
                                        <td><?= esc(substr($rep['problema'], 0, 40)); ?>...</td>
                                        <td><?= $rep['fecha_ingreso']; ?></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('reparaciones/detalles/' . $rep['id']); ?>" class="btn btn-info btn-sm text-white">Detalles</a>
                                                <a href="<?= base_url('reparaciones/editar/' . $rep['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="<?= base_url('reparaciones/finalizar/' . $rep['id']); ?>" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de finalizar este trabajo? Pasará al historial.');">
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-0 rounded-end">Finalizar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No hay reparaciones en curso actualmente.</td>
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