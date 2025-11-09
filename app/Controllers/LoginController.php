<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function autenticar()
    {
        $usuario = new UsuariosModel();

        $correo = $this->request->getPost('correo');
        $password = $this->request->getPost('password');

        $data = $usuario->where('correo_electronico', $correo)->first();

        if ($data && password_verify($password, $data['contraseña'])) {
            $session = session();
            $session->set([
                'id_usuario' => $data['id_usuario'],
                'nombre'     => $data['nombre'],
                'rol'        => $data['rol'],
                'logueado'   => true
            ]);

            return redirect()->to(base_url('inicio'));
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
    public function inicio()
    {
        return view('inicio');
    }
}

