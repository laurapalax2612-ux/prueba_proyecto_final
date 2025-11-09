<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table      = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $allowedFields = [
        'id_usuario',
        'contacto',
        'historial'
    ];

    //Relación con usuarios
    public function getClientesConUsuarios()
    {
        return $this->select('clientes.*, usuarios.nombre, usuarios.correo_electronico')
                    ->join('usuarios', 'usuarios.id_usuario = clientes.id_usuario')
                    ->findAll();
    }
}
