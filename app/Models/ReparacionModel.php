<?php

namespace App\Models;

use CodeIgniter\Model;

class ReparacionModel extends Model
{
    protected $table            = 'reparaciones';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'cliente_nombre', 
        'equipo', 
        'problema', 
        'solucion', 
        'estado', 
        'fecha_ingreso', 
        'fecha_salida'
    ];

}