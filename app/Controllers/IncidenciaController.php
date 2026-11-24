<?php

namespace App\Controllers;

use App\Models\IncidenciaModel;

class IncidenciaController extends BaseController
{
    private function verificarDepartamento()
    {
        if (!session()->get('logged_in') || session()->get('rol') !== 'departamento') {
            return redirect()->to('/')->send();
        }
    }

    public function index()
{
    $this->verificarDepartamento();

    $incidenciaModel = new IncidenciaModel();
    $deptoId = session()->get('id');

    $data['nombre_departamento'] = session()->get('nombre_departamento');
    $data['incidencias'] = $incidenciaModel
        ->where('departamento_id', $deptoId)
        ->whereIn('estado', ['pendiente', 'en_proceso'])
        ->orderBy('id', 'DESC')
        ->findAll();

    return view('departamentos/reportar', $data);
}

public function historial()
{
    $this->verificarDepartamento();

    $incidenciaModel = new IncidenciaModel();
    $deptoId = session()->get('id');

    $data['nombre_departamento'] = session()->get('nombre_departamento');
    $data['incidencias'] = $incidenciaModel
        ->where('departamento_id', $deptoId)
        ->where('estado', 'finalizada')
        ->orderBy('fecha_finalizacion', 'DESC')
        ->findAll();

    return view('departamentos/historial', $data);
}

    public function guardar()
    {
        $this->verificarDepartamento();

        $incidenciaModel = new IncidenciaModel();

        $incidenciaModel->save([
            'departamento_id'  => session()->get('id'),
            'equipo_o_recurso' => $this->request->getPost('equipo_o_recurso'),
            'tipo_incidencia'  => $this->request->getPost('tipo_incidencia'),
            'descripcion'      => $this->request->getPost('descripcion'),
            'prioridad'        => 'sin_asignar',
            'estado'           => 'pendiente',
            'solucion'         => null,
            'fecha_reporte'    => date('Y-m-d H:i:s'),
            'fecha_finalizacion' => null
        ]);

        return redirect()->to('departamento/reportar')->with('mensaje', 'Incidencia reportada correctamente.');
    }

    public function detalles($id)
    {
        $this->verificarDepartamento();

        $incidenciaModel = new IncidenciaModel();
        $incidencia = $incidenciaModel->obtenerConDepartamento()
            ->where('incidencias.id', $id)
            ->where('incidencias.departamento_id', session()->get('id'))
            ->first();

        if (!$incidencia) {
            return redirect()->to('departamento/reportar');
        }

        $data['incidencia'] = $incidencia;
        return view('departamentos/detalles', $data);
    }
}