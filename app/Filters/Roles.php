<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Roles implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('logueado')) {
            return redirect()->to(base_url('login'));
        }

        if (! empty($arguments)) {
            $rol = session('rol'); // 'administrador' | 'agente' | 'cliente'
            if (! in_array($rol, $arguments, true)) {
                return redirect()->to(base_url('inicio'))
                                 ->with('error', 'No tienes permisos para acceder a esta sección.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
