<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidenciaModel extends Model
{
    protected $table         = 'incidencias';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'departamento_id',
        'equipo_o_recurso',
        'tipo_incidencia',
        'descripcion',
        'prioridad',
        'estado',
        'solucion',
        'fecha_reporte',
        'fecha_finalizacion'
    ];

    public function obtenerConDepartamento()
    {
        return $this->select('incidencias.*, departamentos.nombre_departamento, departamentos.usuario AS usuario_departamento')
                    ->join('departamentos', 'departamentos.id = incidencias.departamento_id');
    }
}