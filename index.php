<?php 
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    require_once "appSettings.php";
    require_once "repositorios/RepositorioEntradas.php";
    
    $controlador = 'Agenda';
    
    if(!isset($_REQUEST['c']))
    {
        require_once "controlador/$controlador" . "Controlador.php";
        $controlador = ucwords($controlador) . 'Controlador';
        $controlador = new $controlador(new RepositorioEntradas($appSettings));
        $controlador->Index();    
    }
    else
    {
        $controlador = strtolower($_REQUEST['c']);
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
        require_once "controlador/$controlador" . "Controlador.php";
        $controlador = ucwords($controlador) . 'Controlador';
        if($controlador == "AgendaControlador")
            $controlador = new $controlador(new RepositorioEntradas($appSettings));
        else
            $controlador = new $controlador;
    
        call_user_func(array($controlador, $accion));
    }
?>