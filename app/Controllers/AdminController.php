<?php

namespace App\Controllers;

use App\Models\IncidenciaModel;

class AdminController extends BaseController
{
    private function verificarAdmin()
    {
        if (!session()->get('logged_in') || session()->get('rol') !== 'admin') {
            return redirect()->to('/')->send();
        }
    }

    public function index()
    {
        $this->verificarAdmin();

        $incidenciaModel = new IncidenciaModel();
        $data['incidencias'] = $incidenciaModel->obtenerConDepartamento()
            ->whereIn('incidencias.estado', ['pendiente', 'en_proceso'])
            ->orderBy('incidencias.id', 'DESC')
            ->findAll();

        return view('admin/panel', $data);
    }

    public function detalles($id)
    {
        $this->verificarAdmin();

        $incidenciaModel = new IncidenciaModel();
        $incidencia = $incidenciaModel->obtenerConDepartamento()
            ->where('incidencias.id', $id)
            ->first();

        if (!$incidencia) {
            return redirect()->to('admin/panel');
        }

        $data['incidencia'] = $incidencia;
        return view('admin/detalles', $data);
    }

    public function actualizar($id)
    {
        $this->verificarAdmin();

        $incidenciaModel = new IncidenciaModel();
        $estado = $this->request->getPost('estado');

        if (!in_array($estado, ['pendiente', 'en_proceso'])) {
            $estado = 'en_proceso';
        }

        $incidenciaModel->update($id, [
            'prioridad' => $this->request->getPost('prioridad'),
            'estado'    => $estado,
            'solucion'  => $this->request->getPost('solucion')
        ]);

        return redirect()->to('admin/panel')->with('mensaje', 'Incidencia actualizada.');
    }

    public function finalizar($id)
    {
        $this->verificarAdmin();

        $incidenciaModel = new IncidenciaModel();

        $incidenciaModel->update($id, [
            'prioridad'          => $this->request->getPost('prioridad'),
            'solucion'           => $this->request->getPost('solucion'),
            'estado'             => 'finalizada',
            'fecha_finalizacion' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('admin/panel')->with('mensaje', 'Incidencia finalizada y enviada al historial.');
    }

    public function historial()
    {
        $this->verificarAdmin();

        $incidenciaModel = new IncidenciaModel();
        $data['incidencias'] = $incidenciaModel->obtenerConDepartamento()
            ->where('incidencias.estado', 'finalizada')
            ->orderBy('incidencias.fecha_finalizacion', 'DESC')
            ->findAll();

        return view('admin/historial', $data);
    }
}