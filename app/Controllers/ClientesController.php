<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\UsuariosModel;

class ClientesController extends BaseController
{
    public function __construct()
    {
        $rol = session('rol');
        if (!in_array($rol, ['administrador','agente'])) {
            header('Location: ' . base_url('inicio'));
            exit;
        }
    }

    public function index(): string
    {
        $cliente = new ClientesModel();
        $datos['clientes'] = $cliente->getClientesConUsuarios();

        // Para mostrar los usuarios en el formulario (select)
        $usuario = new UsuariosModel();
        $datos['usuarios'] = $usuario->findAll();

        return view('clientes', $datos);
    }

    public function agregarCliente()
    {
        $cliente = new ClientesModel();

        $datos = [
            'id_usuario' => $this->request->getPost('txt_id_usuario'),
            'contacto'   => $this->request->getPost('txt_contacto'),
            'historial'  => $this->request->getPost('txt_historial')
        ];

        $cliente->insert($datos);
        return redirect()->to(base_url('clientes'));
    }

    public function eliminarCliente($id)
    {
        $cliente = new ClientesModel();
        $cliente->delete($id);
        return redirect()->to(base_url('clientes'));
    }

    public function buscarCliente($id)
    {
        $cliente = new ClientesModel();
        $datos['cliente'] = $cliente->where('id_cliente', $id)->first();

        $usuario = new UsuariosModel();
        $datos['usuarios'] = $usuario->findAll();

        return view('form_editar_cliente', $datos);
    }

    public function modificarCliente()
    {
        $cliente = new ClientesModel();
        $id = $this->request->getPost('txt_id_cliente');

        $datos = [
            'id_usuario' => $this->request->getPost('txt_id_usuario'),
            'contacto'   => $this->request->getPost('txt_contacto'),
            'historial'  => $this->request->getPost('txt_historial')
        ];

        $cliente->update($id, $datos);
        return redirect()->to(base_url('clientes'));
    }
}
