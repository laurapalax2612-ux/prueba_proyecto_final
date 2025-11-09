<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');


//  AUTENTICACIÓN

$routes->get('login', 'LoginController::index');
$routes->post('autenticar', 'LoginController::autenticar');
$routes->get('salir', 'LoginController::salir');

//  ZONA CON SESIÓN (CUALQUIER ROL)

$routes->group('', ['filter' => 'auth'], static function ($routes) {

    // Dashboard después del login
    $routes->get('inicio', 'LoginController::inicio');

    // Cliente → solo puede ver sus tickets
    $routes->get('tickets/mis_tickets/(:num)', 'TicketsController::mis_tickets/$1');

    
    //  ZONA ADMINISTRADOR / AGENTE (CRUD TOTAL)
    
    $routes->group('', ['filter' => 'roles:administrador,agente'], static function ($routes) {

        // USUARIOS
        $routes->get('usuarios', 'UsuariosController::index');
        $routes->post('agregar_usuario', 'UsuariosController::agregarUsuario');
        $routes->get('eliminar_usuario/(:num)', 'UsuariosController::eliminarUsuario/$1');
        $routes->get('buscar_usuario/(:num)', 'UsuariosController::buscarUsuario/$1');
        $routes->post('modificar_usuario', 'UsuariosController::modificarUsuario');

        // CLIENTES
        $routes->get('clientes', 'ClientesController::index');
        $routes->post('agregar_cliente', 'ClientesController::agregarCliente');
        $routes->get('eliminar_cliente/(:num)', 'ClientesController::eliminarCliente/$1');
        $routes->get('buscar_cliente/(:num)', 'ClientesController::buscarCliente/$1');
        $routes->post('modificar_cliente', 'ClientesController::modificarCliente');

        // AGENTES
        $routes->get('agentes', 'AgentesController::index');
        $routes->post('agregar_agente', 'AgentesController::agregarAgente');
        $routes->get('eliminar_agente/(:num)', 'AgentesController::eliminarAgente/$1');
        $routes->get('buscar_agente/(:num)', 'AgentesController::buscarAgente/$1');
        $routes->post('modificar_agente', 'AgentesController::modificarAgente');

        // TICKETS CRUD
        $routes->get('tickets', 'TicketsController::index');
        $routes->post('agregar_ticket', 'TicketsController::agregarTicket');
        $routes->get('eliminar_ticket/(:num)', 'TicketsController::eliminarTicket/$1');
        $routes->get('buscar_ticket/(:num)', 'TicketsController::buscarTicket/$1');
        $routes->post('modificar_ticket', 'TicketsController::modificarTicket');

        // RESPUESTAS
        $routes->get('respuestas', 'RespuestasController::index');
        $routes->post('agregar_respuesta', 'RespuestasController::agregarRespuesta');
        $routes->get('eliminar_respuesta/(:num)', 'RespuestasController::eliminarRespuesta/$1');
        $routes->get('buscar_respuesta/(:num)', 'RespuestasController::buscarRespuesta/$1');
        $routes->post('modificar_respuesta', 'RespuestasController::modificarRespuesta');

        // HISTORIAL DE ESTADOS
        $routes->get('historial_estados', 'HistorialEstadosController::index');
        $routes->post('agregar_historial', 'HistorialEstadosController::agregarHistorial');
        $routes->get('eliminar_historial/(:num)', 'HistorialEstadosController::eliminarHistorial/$1');
        $routes->get('buscar_historial/(:num)', 'HistorialEstadosController::buscarHistorial/$1');
        $routes->post('modificar_historial', 'HistorialEstadosController::modificarHistorial');
    });

});