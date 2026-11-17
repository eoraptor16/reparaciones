<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('panel');
        }
        return view('auth/login');
    }

    public function autenticar()
    {
        $session = session();
        $usuarioModel = new UsuarioModel();

        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $datosUsuario = $usuarioModel->where('usuario', $usuario)->first();

        if ($datosUsuario) {
            if ($password === $datosUsuario['password']) {
                $sesionData = [
                    'id'       => $datosUsuario['id'],
                    'usuario'  => $datosUsuario['usuario'],
                    'logged_in' => true
                ];
                $session->set($sesionData);
                return redirect()->to('panel');
            }
        }

        return redirect()->back()->with('error', 'Credenciales inválidas');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}