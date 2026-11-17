<?php

namespace App\Controllers;

use App\Models\ReparacionModel;

class ReparacionController extends BaseController
{
    private function verificarSesion()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/')->send();
        }
    }

    public function index()
    {
        $this->verificarSesion();
        
        $reparacionModel = new ReparacionModel();

        $data['reparaciones'] = $reparacionModel->where('estado', 'en_curso')->orderBy('id', 'DESC')->findAll();

        return view('reparaciones/panel', $data);
    }

    public function crear()
    {
        $this->verificarSesion();
        return view('reparaciones/crear');
    }

    public function guardar()
    {
        $this->verificarSesion();

        $reparacionModel = new ReparacionModel();

        $reparacionModel->save([
            'cliente_nombre' => $this->request->getPost('cliente_nombre'),
            'equipo'         => $this->request->getPost('equipo'),
            'problema'       => $this->request->getPost('problema'),
            'solucion'       => $this->request->getPost('solucion'),
            'estado'         => 'en_curso',
            'fecha_ingreso'  => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('panel');
    }

    public function detalles($id)
    {
        $this->verificarSesion();

        $reparacionModel = new ReparacionModel();
        $data['reparacion'] = $reparacionModel->find($id);

        if (!$data['reparacion']) {
            return redirect()->to('panel');
        }

        return view('reparaciones/detalles', $data);
    }

    public function editar($id)
    {
        $this->verificarSesion();

        $reparacionModel = new ReparacionModel();
        $data['reparacion'] = $reparacionModel->find($id);

        if (!$data['reparacion']) {
            return redirect()->to('panel');
        }

        return view('reparaciones/editar', $data);
    }

    public function actualizar($id)
    {
        $this->verificarSesion();

        $reparacionModel = new ReparacionModel();

        $reparacionModel->update($id, [
            'cliente_nombre' => $this->request->getPost('cliente_nombre'),
            'equipo'         => $this->request->getPost('equipo'),
            'problema'       => $this->request->getPost('problema'),
            'solucion'       => $this->request->getPost('solucion')
        ]);

        return redirect()->to('panel');
    }

    public function finalizar($id)
    {
        $this->verificarSesion();

        $reparacionModel = new ReparacionModel();

        $reparacionModel->update($id, [
            'estado'       => 'finalizada',
            'fecha_salida' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('panel');
    }
 
    public function historial()
    {
        $this->verificarSesion();

        $reparacionModel = new ReparacionModel();
        $data['reparaciones'] = $reparacionModel->where('estado', 'finalizada')->orderBy('id', 'DESC')->findAll();

        return view('reparaciones/historial', $data);
    }
}