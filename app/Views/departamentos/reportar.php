<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <?= view('parciales/encabezado_muni'); ?>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-info text-dark fs-6"><?= esc($nombre_departamento); ?></span>
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
                <a href="<?= base_url('departamento/historial'); ?>" class="btn btn-outline-info btn-sm">Historial</a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('mensaje'); ?>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong>Nueva Incidencia - <?= esc($nombre_departamento); ?></strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('departamento/guardar'); ?>" method="post">
                            <div class="mb-3">
                                <label for="tipo_incidencia" class="form-label">Tipo de Problema</label>
                                <select class="form-select" id="tipo_incidencia" name="tipo_incidencia" required>
                                    <option value="">Selecciona una categoría...</option>
                                    <option value="Impresora">Impresora</option>
                                    <option value="Red">Corte de red / internet</option>
                                    <option value="Software">Software</option>
                                    <option value="Hardware">Solicitud para reparación de equipo</option>
                                    <option value="Otro">Otro problema técnico</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="equipo_o_recurso" class="form-label">Equipo Afectado</label>
                                <input type="text" class="form-control" id="equipo_o_recurso" name="equipo_o_recurso" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción del Problema</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Describe qué ocurre..." required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Enviar Reporte</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <strong>Reportes Enviados por <?= esc($nombre_departamento); ?></strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo / Equipo</th>
                                        <th>Estado</th>
                                        <th>Fecha y Hora</th>
                                        <th>Desarrollo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($incidencias)): ?>
                                        <?php foreach ($incidencias as $inc): ?>
                                            <tr>
                                                <td><?= $inc['id']; ?></td>
                                                <td>
                                                    <strong><?= esc($inc['tipo_incidencia']); ?></strong><br>
                                                    <small class="text-muted"><?= esc($inc['equipo_o_recurso']); ?></small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?= $inc['estado'] === 'finalizada' ? 'success' : ($inc['estado'] === 'en_proceso' ? 'warning text-dark' : 'secondary'); ?>">
                                                        <?= esc(str_replace('_', ' ', ucfirst($inc['estado']))); ?>
                                                    </span>
                                                </td>
                                                <td><small><?= esc($inc['fecha_reporte']); ?></small></td>
                                                <td>
                                                    <a href="<?= base_url('departamento/detalles/' . $inc['id']); ?>" class="btn btn-sm btn-outline-info">Detalles</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Aún no ha enviado reportes este departamento.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>