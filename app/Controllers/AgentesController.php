<?php

namespace App\Controllers;

use App\Models\AgentesModel;
use App\Models\UsuariosModel;

class AgentesController extends BaseController
{
    public function index(): string
    {
        $agente = new AgentesModel();
        $datos['agentes'] = $agente->getAgentesConUsuarios();

        $usuario = new UsuariosModel();
        $datos['usuarios'] = $usuario->findAll();

        return view('agentes', $datos);
    }

    public function agregarAgente()
    {
        $agente = new AgentesModel();

        $datos = [
            'id_usuario'   => $this->request->getPost('txt_id_usuario'),
            'especialidad' => $this->request->getPost('txt_especialidad'),
            'experiencia'  => $this->request->getPost('txt_experiencia')
        ];

        $agente->insert($datos);
        return redirect()->to(base_url('agentes'));
    }

    public function eliminarAgente($id)
    {
        $agente = new AgentesModel();
        $agente->delete($id);
        return redirect()->to(base_url('agentes'));
    }

    public function buscarAgente($id)
    {
        $agente = new AgentesModel();
        $datos['agente'] = $agente->where('id_agente', $id)->first();

        $usuario = new UsuariosModel();
        $datos['usuarios'] = $usuario->findAll();

        return view('form_editar_agente', $datos);
    }

    public function modificarAgente()
    {
        $agente = new AgentesModel();
        $id = $this->request->getPost('txt_id_agente');

        $datos = [
            'id_usuario'   => $this->request->getPost('txt_id_usuario'),
            'especialidad' => $this->request->getPost('txt_especialidad'),
            'experiencia'  => $this->request->getPost('txt_experiencia')
        ];

        $agente->update($id, $datos);
        return redirect()->to(base_url('agentes'));
    }
}