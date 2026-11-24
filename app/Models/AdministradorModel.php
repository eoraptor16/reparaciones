<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministradorModel extends Model
{
    protected $table         = 'administradores';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['usuario', 'password', 'nombre_area'];
}