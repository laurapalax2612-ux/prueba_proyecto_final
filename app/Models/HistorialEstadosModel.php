<?php

namespace App\Models;

use CodeIgniter\Model;

class HistorialEstadosModel extends Model
{
    protected $table      = 'historial_estados';
    protected $primaryKey = 'id_historial';

    protected $allowedFields = [
        'id_ticket',
        'estado_anterior',
        'estado_nuevo',
        'fecha_cambio',
        'observacion'
    ];

    //  Relación con tickets
    public function getHistorialConTickets()
    {
        return $this->select('historial_estados.*, tickets.asunto AS asunto_ticket')
                    ->join('tickets', 'tickets.id_ticket = historial_estados.id_ticket')
                    ->orderBy('historial_estados.id_historial', 'DESC')
                    ->findAll();
    }
}
