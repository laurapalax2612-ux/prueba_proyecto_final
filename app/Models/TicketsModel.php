<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketsModel extends Model
{
    protected $table      = 'tickets';
    protected $primaryKey = 'id_ticket';

    protected $allowedFields = [
        'id_cliente',
        'id_agente',
        'tipo',
        'asunto',
        'descripcion',
        'estado',
        'fecha_creacion',
        'fecha_cierre',
    ];

    // --- LISTA GENERAL DE TICKETS (con joins) ---
    public function getTickets()
    {
        return $this->select(
                    "tickets.*,
                     clientes.contacto AS contacto_cliente,
                     usuarios_c.nombre AS nombre_cliente,
                     usuarios_a.nombre AS nombre_agente"
                )
                ->join('clientes', 'clientes.id_cliente = tickets.id_cliente')
                ->join('usuarios AS usuarios_c', 'usuarios_c.id_usuario = clientes.id_usuario')
                ->join('agentes', 'agentes.id_agente = tickets.id_agente', 'left')
                ->join('usuarios AS usuarios_a', 'usuarios_a.id_usuario = agentes.id_usuario', 'left')
                ->orderBy('tickets.id_ticket', 'DESC')
                ->findAll();
    } // ←← IMPORTANTE: Cierra este método

    // --- TICKETS DEL CLIENTE (por id_usuario del cliente) ---
    public function getTicketsDeUsuario($idUsuario)
    {
        return $this->select(
                    "tickets.*,
                     clientes.contacto AS contacto_cliente,
                     usuarios_c.nombre AS nombre_cliente,
                     usuarios_a.nombre AS nombre_agente"
                )
                ->join('clientes', 'clientes.id_cliente = tickets.id_cliente')
                ->join('usuarios AS usuarios_c', 'usuarios_c.id_usuario = clientes.id_usuario')
                ->join('agentes', 'agentes.id_agente = tickets.id_agente', 'left')
                ->join('usuarios AS usuarios_a', 'usuarios_a.id_usuario = agentes.id_usuario', 'left')
                ->where('clientes.id_usuario', $idUsuario)
                ->orderBy('tickets.id_ticket', 'DESC')
                ->findAll();
    }
}
