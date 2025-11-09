<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class UsuariosController extends BaseController
{
    public function index(): string
    {
        $usuario = new UsuariosModel();
        $datos['usuarios'] = $usuario->findAll();
        return view('usuarios', $datos);
    }

    public function agregarUsuario()
    {
        $usuario = new UsuariosModel();

        $datos = [
            'nombre'            => $this->request->getPost('txt_nombre'),
            'correo_electronico'=> $this->request->getPost('txt_correo'),
            'contraseña'        => password_hash($this->request->getPost('txt_contraseña'), PASSWORD_DEFAULT),
            'rol'               => $this->request->getPost('txt_rol')
        ];

        $usuario->insert($datos);
        return redirect()->to(base_url('usuarios'));
    }

    public function eliminarUsuario($id)
    {
        $usuario = new UsuariosModel();
        $usuario->delete($id);
        return redirect()->to(base_url('usuarios'));
    }

    public function buscarUsuario($id)
    {
        $usuario = new UsuariosModel();
        $datos['usuario'] = $usuario->where('id_usuario', $id)->first();
        return view('form_editar_usuario', $datos);
    }

    public function modificarUsuario()
    {
        $usuario = new UsuariosModel();
        $id = $this->request->getPost('txt_id_usuario');

        $datos = [
            'nombre'            => $this->request->getPost('txt_nombre'),
            'correo_electronico'=> $this->request->getPost('txt_correo'),
            'rol'               => $this->request->getPost('txt_rol')
        ];

        // Solo actualiza la contraseña si se envía una nueva
        if (!empty($this->request->getPost('txt_contraseña'))) {
            $datos['contraseña'] = password_hash($this->request->getPost('txt_contraseña'), PASSWORD_DEFAULT);
        }

        $usuario->update($id, $datos);
        return redirect()->to(base_url('usuarios'));
    }
}