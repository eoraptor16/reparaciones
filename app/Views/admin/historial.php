<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <?= view('parciales/encabezado_muni'); ?>
            <div class="d-flex gap-2">
                <a href="<?= base_url('admin/panel'); ?>" class="btn btn-outline-light btn-sm">Panel Activo</a>
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Historial de Incidencias Finalizadas</h3>
            <a href="<?= base_url('admin/panel'); ?>" class="btn btn-primary btn-sm">Volver al Panel</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Departamento</th>
                                <th>Equipo / Tipo</th>
                                <th>Prioridad</th>
                                <th>Solución</th>
                                <th>Reporte / Cierre</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($incidencias)): ?>
                                <?php foreach ($incidencias as $inc): ?>
                                    <tr>
                                        <td><?= $inc['id']; ?></td>
                                        <td><strong><?= esc($inc['nombre_departamento']); ?></strong></td>
                                        <td>
                                            <?= esc($inc['equipo_o_recurso']); ?><br>
                                            <small class="text-muted"><?= esc($inc['tipo_incidencia']); ?></small>
                                        </td>
                                        <td><?= esc(str_replace('_', ' ', ucfirst($inc['prioridad']))); ?></td>
                                        <td><small><?= !empty($inc['solucion']) ? esc($inc['solucion']) : '—'; ?></small></td>
                                        <td>
                                            <small class="d-block">In: <?= esc($inc['fecha_reporte']); ?></small>
                                            <small class="d-block text-success">Fin: <?= esc($inc['fecha_finalizacion']); ?></small>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/detalles/' . $inc['id']); ?>" class="btn btn-info btn-sm text-white">Ver</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No hay incidencias finalizadas en el historial.</td>
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