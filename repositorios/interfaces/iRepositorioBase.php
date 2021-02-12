<?php 
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    interface iRepositorioBase
    {
        public function ObtenerTodos();
        public function Obtener($id);
        public function Crear($modelo);
        public function Eliminar($id);
        public function Actualizar($modeloActualizado);
    }
?>