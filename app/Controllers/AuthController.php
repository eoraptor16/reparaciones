<?php

namespace App\Controllers;

use App\Models\AdministradorModel;
use App\Models\DepartamentoModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            if (session()->get('rol') === 'admin') {
                return redirect()->to('admin/panel');
            }
            return redirect()->to('departamento/reportar');
        }

        return view('auth/login');
    }

    public function autenticar()
    {
        $session = session();
        $usuario = trim((string) $this->request->getPost('usuario'));
        $password = (string) $this->request->getPost('password');

        $adminModel = new AdministradorModel();
        $datosAdmin = $adminModel->where('usuario', $usuario)->first();

        if ($datosAdmin && $password === $datosAdmin['password']) {
            $session->set([
                'id'          => $datosAdmin['id'],
                'usuario'     => $datosAdmin['usuario'],
                'nombre_area' => $datosAdmin['nombre_area'],
                'rol'         => 'admin',
                'logged_in'   => true
            ]);

            return redirect()->to('admin/panel');
        }

        $departamentoModel = new DepartamentoModel();
        $datosDepto = $departamentoModel->where('usuario', $usuario)->first();

        if ($datosDepto && $password === $datosDepto['password']) {
            $session->set([
                'id'                  => $datosDepto['id'],
                'usuario'             => $datosDepto['usuario'],
                'nombre_departamento' => $datosDepto['nombre_departamento'],
                'rol'                 => 'departamento',
                'logged_in'           => true
            ]);

            return redirect()->to('departamento/reportar');
        }

        return redirect()->back()->with('error', 'Credenciales inválidas');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}