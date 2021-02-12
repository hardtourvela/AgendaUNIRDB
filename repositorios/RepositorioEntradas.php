<?php 
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    require_once 'modelo/EntradaAgenda.php';
    require_once 'interfaces/iRepositorioEntradas.php';
    require_once 'herramientas/Conexion.php';
    class RepositorioEntradas implements iRepositorioEntradas
    {
        private $connection;

        public function __construct($appSettings)
        {
            $this->connection = new Conexion($appSettings);
        }

        public function Obtener($id)
        {
            $con = $this->connection->Conectar();
            $stmt = $con->prepare("SELECT * FROM Entradas WHERE Id = ?");
            If($stmt === false)
            {
                die(mysqli_error($con));
                return false;
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $fila = $resultado->fetch_assoc();
            $entrada = EntradaAgenda::CrearDesdeFila($fila);
            $this->connection->Desconectar();

            return $entrada;
        }

        public function ObtenerEntradasRangoFechas($fechaInicio, $fechaFinal)
        {
            $listaEntradas = [];
            $con = $this->connection->Conectar();
            $stmt = $con->prepare("SELECT * FROM Entradas WHERE Fecha BETWEEN ? AND ?");
            If($stmt === false)
            {
                die(mysqli_error($con));
                return false;
            }
            $stmt->bind_param("ss", $fechaInicio, $fechaFinal);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while($fila = $resultado->fetch_assoc())
            {
                $entrada = EntradaAgenda::CrearDesdeFila($fila);
                $listaEntradas[$entrada->id] = $entrada;
            }
            $this->connection->Desconectar();
            return $listaEntradas;
        }

        public function ObtenerEntradasDia($fecha)
        {
            return $this->ObtenerEntradasRangoFechas("$fecha 00:00:00", "$fecha 23:59:59");
        }

        public function ObtenerEntradasDelMes($mes, $anio)
        {

            return $this->ObtenerEntradasRangoFechas("$anio-$mes-1 00:00:00",date("Y-m-t 23:59:59", strtotime("$anio-$mes-1")));
        }

        public function ObtenerTodos()
        {
            $listaEntradas = [];
            $con = $this->connection->Conectar();
            $resultado = $con->query("SELECT * FROM Entradas");
            while($fila = $resultado->fetch_assoc())
            {
                $entrada = EntradaAgenda::CrearDesdeFila($fila);
                $listaEntradas[$entrada->id] = $entrada;
            }
            $this->connection->Desconectar();
            return $listaEntradas;
        }

        public function Crear($entrada)
        {
            $con = $this->connection->Conectar();
            $stmt = $con->prepare("INSERT INTO ENTRADAS(Fecha, Titulo, Descripcion) VALUES(?,?,?)");
            If($stmt === false)
            {
                die(mysqli_error($con));
                return false;
            }
            $stmt->bind_param("sss", $fecha, $titulo, $descripcion);
            $fecha = $entrada->fecha;
            $titulo = $entrada->titulo;
            $descripcion = $entrada->descripcion;
            $response = $stmt->execute();
            $this->connection->Desconectar();
            return $response;
        }

        public function Eliminar($id)
        {
            $con = $this->connection->Conectar();
            $stmt = $con->prepare("DELETE FROM ENTRADAS WHERE Id = ?");
            If($stmt === false)
            {
                die(mysqli_error($con));
                return false;
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $this->connection->Desconectar();
            return true;
        }

        public function Actualizar($entradaAActualizar)
        {
            $con = $this->connection->Conectar();
            $stmt = $con->prepare("UPDATE ENTRADAS SET Fecha = ?, Titulo = ?, Descripcion = ? WHERE Id = ?");
            If($stmt === false)
            {
                die(mysqli_error($con));
                return false;
            }
            $stmt->bind_param("sssi", $fecha, $titulo, $descripcion, $id);
            $id = $entradaAActualizar->id;
            $fecha = $entradaAActualizar->fecha;
            $titulo = $entradaAActualizar->titulo;
            $descripcion = $entradaAActualizar->descripcion;
            $stmt->execute();
            $this->connection->Desconectar();
            return true;
        }
    }
?>