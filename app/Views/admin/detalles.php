<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <?= view('parciales/encabezado_muni'); ?>
            <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container pb-5" style="max-width: 750px;">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4">Ficha Completa de Incidencia #<?= $incidencia['id']; ?></h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>Departamento:</strong> <?= esc($incidencia['nombre_departamento']); ?> (<?= esc($incidencia['usuario_departamento']); ?>)</li>
                    <li class="list-group-item"><strong>Tipo de Incidencia:</strong> <?= esc($incidencia['tipo_incidencia']); ?></li>
                    <li class="list-group-item"><strong>Equipo / Recurso:</strong> <?= esc($incidencia['equipo_o_recurso']); ?></li>
                    <li class="list-group-item"><strong>Prioridad:</strong> <?= esc(str_replace('_', ' ', ucfirst($incidencia['prioridad']))); ?></li>
                    <li class="list-group-item"><strong>Estado:</strong> <?= esc(str_replace('_', ' ', ucfirst($incidencia['estado']))); ?></li>
                    <li class="list-group-item"><strong>Fecha y Hora de Reporte:</strong> <?= esc($incidencia['fecha_reporte']); ?></li>
                    <?php if (!empty($incidencia['fecha_finalizacion'])): ?>
                        <li class="list-group-item"><strong>Fecha y Hora de Finalización:</strong> <?= esc($incidencia['fecha_finalizacion']); ?></li>
                    <?php endif; ?>
                    <li class="list-group-item"><strong>Problema Reportado:</strong><br><p class="text-muted mt-1 mb-0"><?= nl2br(esc($incidencia['descripcion'])); ?></p></li>
                    <li class="list-group-item"><strong>Solución Registrada:</strong><br><p class="text-muted mt-1 mb-0"><?= !empty($incidencia['solucion']) ? nl2br(esc($incidencia['solucion'])) : 'Sin solución registrada.'; ?></p></li>
                </ul>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('admin/panel'); ?>" class="btn btn-secondary">Volver al Panel</a>
                    <a href="<?= base_url('admin/historial'); ?>" class="btn btn-outline-info">Ir al Historial</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>