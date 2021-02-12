<?php 
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    require_once 'iRepositorioBase.php';
    interface iRepositorioEntradas extends iRepositorioBase
    {
        public function ObtenerEntradasRangoFechas($fechaInicio, $fechaFinal);
        public function ObtenerEntradasDelMes($mes, $anio);
        public function ObtenerEntradasDia($fecha);
    }
?>