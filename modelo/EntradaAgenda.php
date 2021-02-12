<?php 
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    class EntradaAgenda
    {
        public $id;
        public $fecha;
        public $titulo;
        public $descripcion;

        public static function CrearDesdeFila($filaEntrada)
        {
            $entrada = new EntradaAgenda();
            if($filaEntrada)
            {
                $entrada->id = $filaEntrada["Id"];
                $entrada->fecha = $filaEntrada["Fecha"];
                $entrada->titulo = $filaEntrada["Titulo"];
                $entrada->descripcion = $filaEntrada["Descripcion"];
            }
            return $entrada;
        }
    }
?>