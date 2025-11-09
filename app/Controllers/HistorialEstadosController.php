<?php

namespace App\Controllers;

use App\Models\HistorialEstadosModel;
use App\Models\TicketsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;

class HistorialEstadosController extends BaseController
{
    public function index(): ResponseInterface|string
    {
        // Solo admin/agente
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $historial = new HistorialEstadosModel();

        // Historial con relaciones (fallback seguro)
        if (method_exists($historial, 'getHistorialConTickets')) {
            $datos['historiales'] = $historial->getHistorialConTickets();
        } else {
            // Builder directo por si el modelo no trae método
            $datos['historiales'] = $historial->select(
                    "historial_estados.*,
                     tickets.asunto AS asunto_ticket"
                )
                ->join('tickets', 'tickets.id_ticket = historial_estados.id_ticket')
                ->orderBy('historial_estados.id_historial', 'DESC')
                ->findAll();
        }

        $ticket = new TicketsModel();
        if (method_exists($ticket, 'getTicketsConRelaciones')) {
            $datos['tickets'] = $ticket->getTicketsConRelaciones();
        } elseif (method_exists($ticket, 'getTickets')) {
            $datos['tickets'] = $ticket->getTickets();
        } else {
            $datos['tickets'] = $ticket->findAll();
        }

        return view('historial_estados', $datos);
    }

    public function agregarHistorial(): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $historial = new HistorialEstadosModel();

        $datos = [
            'id_ticket'       => $this->request->getPost('txt_id_ticket'),
            'estado_anterior' => $this->request->getPost('txt_estado_anterior'),
            'estado_nuevo'    => $this->request->getPost('txt_estado_nuevo'),
            // En tu diagrama el campo es "fecha" (no "fecha_cambio")
            'fecha'           => date('Y-m-d H:i:s'),
            'observacion'     => $this->request->getPost('txt_observacion') ?: null,
        ];

        $historial->insert($datos);
        return redirect()->to(base_url('historial_estados'));
    }

    public function eliminarHistorial($id): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $historial = new HistorialEstadosModel();
        $historial->delete((int)$id);

        return redirect()->to(base_url('historial_estados'));
    }

    public function buscarHistorial($id): ResponseInterface|string
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $historial = new HistorialEstadosModel();
        $datos['historial'] = $historial->where('id_historial', (int)$id)->first();

        $ticket = new TicketsModel();
        if (method_exists($ticket, 'getTickets')) {
            $datos['tickets'] = $ticket->getTickets();
        } else {
            $datos['tickets'] = $ticket->findAll();
        }

        return view('form_editar_historial', $datos);
    }

    public function modificarHistorial(): RedirectResponse
    {
        if (!in_array(session('rol'), ['administrador','agente'], true)) {
            return redirect()->to(base_url('inicio'))->with('error', 'No autorizado');
        }

        $historial = new HistorialEstadosModel();
        $id = (int)$this->request->getPost('txt_id_historial');

        $datos = [
            'id_ticket'       => $this->request->getPost('txt_id_ticket'),
            'estado_anterior' => $this->request->getPost('txt_estado_anterior'),
            'estado_nuevo'    => $this->request->getPost('txt_estado_nuevo'),
            'observacion'     => $this->request->getPost('txt_observacion') ?: null,
            // Si quieres actualizar fecha cuando edites:
            // 'fecha'        => date('Y-m-d H:i:s'),
        ];

        $historial->update($id, $datos);
        return redirect()->to(base_url('historial_estados'));
    }
}
