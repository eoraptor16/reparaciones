<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Reparación - Taller PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-4">Ficha Reparación</h3>
                
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>ID de Registro:</strong> #<?= $reparacion['id']; ?></li>
                    <li class="list-group-item"><strong>Cliente:</strong> <?= esc($reparacion['cliente_nombre']); ?></li>
                    <li class="list-group-item"><strong>Equipo:</strong> <?= esc($reparacion['equipo']); ?></li>
                    <li class="list-group-item"><strong>Estado actual:</strong> 
                        <span class="badge bg-<?= $reparacion['estado'] == 'en_curso' ? 'warning text-dark' : 'success'; ?>">
                            <?= ucfirst($reparacion['estado']); ?>
                        </span>
                    </li>
                    <li class="list-group-item"><strong>Fecha de Ingreso:</strong> <?= $reparacion['fecha_ingreso']; ?></li>
                    <?php if (!empty($reparacion['fecha_salida'])): ?>
                        <li class="list-group-item"><strong>Fecha de Salida:</strong> <?= $reparacion['fecha_salida']; ?></li>
                    <?php endif; ?>
                    <li class="list-group-item"><strong>Problema Reportado:</strong><br><p class="text-muted mt-1"><?= nl2br(esc($reparacion['problema'])); ?></p></li>
                    <li class="list-group-item"><strong>Solución Aplicada:</strong><br><p class="text-muted mt-1"><?= !empty($reparacion['solucion']) ? nl2br(esc($reparacion['solucion'])) : 'Aún sin solución registrada.'; ?></p></li>
                </ul>

                <div class="text-end">
                    <a href="<?= base_url('panel'); ?>" class="btn btn-secondary">Regresar al Panel</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>