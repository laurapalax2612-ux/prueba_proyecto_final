<?php

namespace App\Controllers;

use App\Models\RespuestasModel;
use App\Models\TicketsModel;
use App\Models\AgentesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;

class RespuestasController extends BaseController
{
    public function index(): ResponseInterface|string
    {
        // Solo admin/agente
        if (!in_array(session('rol'), ['administrador', 'agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $respuesta = new RespuestasModel();

        // ---- Respuestas con relaciones (fallback seguro) ----
        if (method_exists($respuesta, 'getRespuestasConRelaciones')) {
            $datos['respuestas'] = $respuesta->getRespuestasConRelaciones();
        } elseif (method_exists($respuesta, 'getRespuestas')) {
            $datos['respuestas'] = $respuesta->getRespuestas();
        } else {
            // Builder directo por si tu modelo aún no trae método
            $datos['respuestas'] = $respuesta->select(
                    "respuestas.*,
                     tickets.asunto AS asunto_ticket,
                     usuarios_a.nombre AS nombre_agente"
                )
                ->join('tickets', 'tickets.id_ticket = respuestas.id_ticket')
                ->join('agentes', 'agentes.id_agente = respuestas.id_agente', 'left')
                ->join('usuarios AS usuarios_a', 'usuarios_a.id_usuario = agentes.id_usuario', 'left')
                ->orderBy('respuestas.id_respuesta', 'DESC')
                ->findAll();
        }

        // ---- Tickets para el select ----
        $ticket = new TicketsModel();
        if (method_exists($ticket, 'getTicketsConRelaciones')) {
            $datos['tickets'] = $ticket->getTicketsConRelaciones();
        } elseif (method_exists($ticket, 'getTickets')) {
            $datos['tickets'] = $ticket->getTickets();
        } else {
            $datos['tickets'] = $ticket->findAll();
        }

        // ---- Agentes para el select ----
        $agente = new AgentesModel();
        if (method_exists($agente, 'getAgentesConUsuarios')) {
            $datos['agentes'] = $agente->getAgentesConUsuarios();
        } else {
            $datos['agentes'] = $agente->findAll();
        }

        return view('respuestas', $datos);
    }

    public function agregarRespuesta(): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador', 'agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $respuesta = new RespuestasModel();

        $datos = [
            'id_ticket'       => $this->request->getPost('txt_id_ticket'),
            'id_agente'       => $this->request->getPost('txt_id_agente') ?: null,
            'mensaje'         => $this->request->getPost('txt_mensaje'),
            'fecha'           => date('Y-m-d H:i:s'),  // si tu columna es 'fecha'; cambia a 'fecha_respuesta' si corresponde
        ];

        // Ajusta el nombre de la columna fecha según tu BD:
        //  - Si tu tabla se llama 'respuestas' y el campo es 'fecha' (según tu diseño_bd), deja 'fecha'.
        //  - Si se llama 'fecha_respuesta', cambia la clave arriba.

        $respuesta->insert($datos);
        return redirect()->to(base_url('respuestas'));
    }

    public function eliminarRespuesta($id): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador', 'agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $respuesta = new RespuestasModel();
        $respuesta->delete((int)$id);

        return redirect()->to(base_url('respuestas'));
    }

    public function buscarRespuesta($id): ResponseInterface|string
    {
        if (!in_array(session('rol'), ['administrador', 'agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $respuesta = new RespuestasModel();
        $datos['respuesta'] = $respuesta->where('id_respuesta', (int)$id)->first();

        // Tickets para el select
        $ticket = new TicketsModel();
        if (method_exists($ticket, 'getTickets')) {
            $datos['tickets'] = $ticket->getTickets();
        } else {
            $datos['tickets'] = $ticket->findAll();
        }

        // Agentes para el select
        $agente = new AgentesModel();
        if (method_exists($agente, 'getAgentesConUsuarios')) {
            $datos['agentes'] = $agente->getAgentesConUsuarios();
        } else {
            $datos['agentes'] = $agente->findAll();
        }

        return view('form_editar_respuesta', $datos);
    }

    public function modificarRespuesta(): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador', 'agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $respuesta = new RespuestasModel();
        $id = (int)$this->request->getPost('txt_id_respuesta');

        $datos = [
            'id_ticket' => $this->request->getPost('txt_id_ticket'),
            'id_agente' => $this->request->getPost('txt_id_agente') ?: null,
            'mensaje'   => $this->request->getPost('txt_mensaje'),
        ];

        $respuesta->update($id, $datos);
        return redirect()->to(base_url('respuestas'));
    }
}
