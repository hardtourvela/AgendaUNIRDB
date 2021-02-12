<?php
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    class Conexion
    {
        private $appSettings;
        private $conexionActual;

        public function __construct($appSettings)
        {
            $this->appSettings = $appSettings;
        }

        public function Conectar()
        {
            $this->Desconectar();

            $this->conexionActual = new mysqli(
                $this->appSettings['DBServer'], 
                $this->appSettings['DBUser'], 
                $this->appSettings['DBPass'], 
                $this->appSettings['DBName'], 
                $this->appSettings['DBPort'], 
                $this->appSettings['DBSocket']
            );

            if (mysqli_connect_errno()) {
                printf("La conexión falló: %s\n", mysqli_connect_error());
                exit();
            }

            return $this->conexionActual;
        }

        public function Desconectar()
        {
            if($this->conexionActual)
            {
                $this->conexionActual->close();
                $this->conexionActual = null;
            }
        }
    }
?>