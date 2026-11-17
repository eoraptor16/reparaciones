<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Reparación - Taller PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-4">Registrar Nueva Reparación</h3>
                <form action="<?= base_url('reparaciones/guardar'); ?>" method="post">
                    <div class="mb-3">
                        <label for="cliente_nombre" class="form-label">Nombre del Cliente:</label>
                        <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="equipo" class="form-label">Equipo:</label>
                        <input type="text" class="form-control" id="equipo" name="equipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="problema" class="form-label">Problema del Equipo:</label>
                        <textarea class="form-control" id="problema" name="problema" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="solucion" class="form-label">Solución Aplicada:</label>
                        <textarea class="form-control" id="solucion" name="solucion" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('panel'); ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>