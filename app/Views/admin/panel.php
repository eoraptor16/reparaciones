<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Informática</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <?= view('parciales/encabezado_muni'); ?>
            <div class="d-flex gap-2">
                <!--<a href="<?= base_url('admin/historial'); ?>" class="btn btn-outline-info btn-sm">Historial</a>-->
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Panel de Administración - Incidencias Activas</h3>
            <a href="<?= base_url('admin/historial'); ?>" class="btn btn-secondary btn-sm">Historial</a>
        </div>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('mensaje'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($incidencias)): ?>
            <?php foreach ($incidencias as $inc): ?>
                <?php $formId = 'form-inc-' . $inc['id']; ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div>
                            <strong>#<?= $inc['id']; ?> — <?= esc($inc['nombre_departamento']); ?></strong>
                            <span class="badge bg-primary ms-2"><?= esc($inc['tipo_incidencia']); ?></span>
                            <span class="badge bg-<?= $inc['estado'] === 'en_proceso' ? 'warning text-dark' : 'secondary'; ?> ms-1">
                                Estado: <?= esc(str_replace('_', ' ', ucfirst($inc['estado']))); ?>
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <small class="text-muted">Reportado: <?= esc($inc['fecha_reporte']); ?></small>
                            <a href="<?= base_url('admin/detalles/' . $inc['id']); ?>" class="btn btn-sm btn-info text-white">Detalles</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="mb-1"><strong>Equipo:</strong> <?= esc($inc['equipo_o_recurso']); ?></p>
                        <p class="mb-3"><strong>Problema:</strong> <?= nl2br(esc($inc['descripcion'])); ?></p>

                        <form id="<?= $formId; ?>" action="<?= base_url('admin/actualizar/' . $inc['id']); ?>" method="post">
                            <div class="row g-3 mb-3">
                                <div class="col-md-3">
                                    <label class="form-label"><strong>Prioridad</strong></label>
                                    <select name="prioridad" class="form-select form-select-sm">
                                        <option value="sin_asignar" <?= $inc['prioridad'] === 'sin_asignar' ? 'selected' : ''; ?>>Sin asignar</option>
                                        <option value="baja" <?= $inc['prioridad'] === 'baja' ? 'selected' : ''; ?>>Baja</option>
                                        <option value="media" <?= $inc['prioridad'] === 'media' ? 'selected' : ''; ?>>Media</option>
                                        <option value="alta" <?= $inc['prioridad'] === 'alta' ? 'selected' : ''; ?>>Alta</option>
                                        <option value="critica" <?= $inc['prioridad'] === 'critica' ? 'selected' : ''; ?>>Crítica</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label"><strong>Estado</strong></label>
                                    <select name="estado" class="form-select form-select-sm">
                                        <option value="pendiente" <?= $inc['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                        <option value="en_proceso" <?= $inc['estado'] === 'en_proceso' ? 'selected' : ''; ?>>En proceso</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><strong>Solución Técnica</strong></label>
                                    <textarea name="solucion" class="form-control form-control-sm" rows="2" placeholder="Solución aplicada..."><?= esc($inc['solucion'] ?? ''); ?></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">Actualizar Cambios</button>
                                <button type="submit"
                                        formaction="<?= base_url('admin/finalizar/' . $inc['id']); ?>"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('¿Finalizar esta incidencia y moverla al historial?');">
                                    Finalizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card shadow-sm">
                <div class="card-body text-center text-muted py-5">
                    No hay incidencias activas en este momento.
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>