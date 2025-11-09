<?php

namespace App\Models;

use CodeIgniter\Model;

class RespuestasModel extends Model
{
    protected $table      = 'respuestas';
    protected $primaryKey = 'id_respuesta';

    protected $allowedFields = [
        'id_ticket',
        'id_agente',
        'mensaje',
        'fecha_respuesta'
    ];

    // Relación con tickets y agentes
    public function getRespuestasConRelaciones()
    {
        return $this->select('respuestas.*, 
                              tickets.asunto AS asunto_ticket, 
                              usuarios_a.nombre AS nombre_agente')
                    ->join('tickets', 'tickets.id_ticket = respuestas.id_ticket')
                    ->join('agentes', 'agentes.id_agente = respuestas.id_agente')
                    ->join('usuarios AS usuarios_a', 'usuarios_a.id_usuario = agentes.id_usuario')
                    ->orderBy('respuestas.id_respuesta', 'DESC')
                    ->findAll();
    }
}