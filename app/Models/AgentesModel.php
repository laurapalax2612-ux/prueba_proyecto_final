<?php

namespace App\Models;

use CodeIgniter\Model;

class AgentesModel extends Model
{
    protected $table      = 'agentes';
    protected $primaryKey = 'id_agente';

    protected $allowedFields = [
        'id_usuario',
        'especialidad',
        'experiencia'
    ];

    // Relación con usuarios
    public function getAgentesConUsuarios()
    {
        return $this->select('agentes.*, usuarios.nombre, usuarios.correo_electronico')
                    ->join('usuarios', 'usuarios.id_usuario = agentes.id_usuario')
                    ->findAll();
    }
}
