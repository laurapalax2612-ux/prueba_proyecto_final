<?php

namespace App\Controllers;

use App\Models\TicketsModel;
use App\Models\ClientesModel;
use App\Models\AgentesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;

class TicketsController extends BaseController
{
    // Listado de tickets (solo administrador o agente)
    public function index(): ResponseInterface|string
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $ticket = new TicketsModel();
        $datos['tickets'] = $ticket->getTickets();

        $cliente = new ClientesModel();
        $datos['clientes'] = method_exists($cliente, 'getClientesConUsuarios')
            ? $cliente->getClientesConUsuarios()
            : $cliente->findAll();

        $agente = new AgentesModel();
        $datos['agentes'] = method_exists($agente, 'getAgentesConUsuarios')
            ? $agente->getAgentesConUsuarios()
            : $agente->findAll();

        return view('tickets', $datos);
    }

    // Crear ticket (solo administrador o agente)
    public function agregarTicket(): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $ticket = new TicketsModel();

        $datos = [
            'id_cliente'     => $this->request->getPost('txt_id_cliente'),
            'id_agente'      => $this->request->getPost('txt_id_agente') ?: null,
            'tipo'           => $this->request->getPost('txt_tipo') ?: null,
            'asunto'         => $this->request->getPost('txt_asunto'),
            'descripcion'    => $this->request->getPost('txt_descripcion'),
            'estado'         => $this->request->getPost('txt_estado') ?: 'abierto',
            'fecha_creacion' => date('Y-m-d H:i:s'),
        ];

        $ticket->insert($datos);
        return redirect()->to(base_url('tickets'));
    }

    // Eliminar ticket (solo administrador o agente)
    public function eliminarTicket($id): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $ticket = new TicketsModel();
        $ticket->delete((int)$id);

        return redirect()->to(base_url('tickets'));
    }

    // Cargar formulario de edición (solo administrador o agente)
    public function buscarTicket($id): ResponseInterface|string
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $ticket = new TicketsModel();
        $datos['ticket'] = $ticket->where('id_ticket', (int)$id)->first();

        $cliente = new ClientesModel();
        $datos['clientes'] = method_exists($cliente, 'getClientesConUsuarios')
            ? $cliente->getClientesConUsuarios()
            : $cliente->findAll();

        $agente = new AgentesModel();
        $datos['agentes'] = method_exists($agente, 'getAgentesConUsuarios')
            ? $agente->getAgentesConUsuarios()
            : $agente->findAll();

        return view('form_editar_ticket', $datos);
    }

    // Guardar edición (solo administrador o agente)
    public function modificarTicket(): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $ticket = new TicketsModel();
        $id = (int)$this->request->getPost('txt_id_ticket');

        // (Opcional) para historial
        $anterior = $ticket->find($id);

        $datos = [
            'id_cliente'  => $this->request->getPost('txt_id_cliente'),
            'id_agente'   => $this->request->getPost('txt_id_agente') ?: null,
            'tipo'        => $this->request->getPost('txt_tipo') ?: null,
            'asunto'      => $this->request->getPost('txt_asunto'),
            'descripcion' => $this->request->getPost('txt_descripcion'),
            'estado'      => $this->request->getPost('txt_estado'),
        ];

        $ticket->update($id, $datos);

        // (Opcional) registrar historial si cambió el estado
        if ($anterior && isset($anterior['estado']) && $anterior['estado'] !== $datos['estado']) {
            $db = \Config\Database::connect();
            $db->table('historial_estados')->insert([
                'id_ticket'       => $id,
                'estado_anterior' => $anterior['estado'],
                'estado_nuevo'    => $datos['estado'],
                'fecha'           => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to(base_url('tickets'));
    }

    // Tickets del cliente autenticado
    public function mis_tickets($idUsuario): ResponseInterface|string
    {
        if (session('rol') !== 'cliente' || (int)$idUsuario !== (int)session('id_usuario')) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $ticket = new TicketsModel();
        $datos['tickets'] = $ticket->getTicketsDeUsuario((int)$idUsuario);

        return view('tickets_cliente', $datos);
    }
}
